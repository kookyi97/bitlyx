<template>
  <div class="quiz-wrapper">

    <!-- TOPBAR -->
    <div class="quiz-topbar">
      <a href="/user/dashboard" class="btn-salir">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Salir
      </a>
      <div class="topbar-center">
        <span class="leccion-name">{{ leccion.titulo }}</span>
        <span class="sep">›</span>
        <span class="counter">Pregunta {{ actual + 1 }} de {{ preguntas.length }}</span>
      </div>
      <span class="xp-badge">⚡ {{ usuario.xp_total }} XP</span>
    </div>

    <!-- BARRA PROGRESO -->
    <div class="progress-bar">
      <div class="progress-fill" :style="{ width: (actual / preguntas.length * 100) + '%' }"></div>
    </div>

    <!-- QUIZ -->
    <div class="quiz-main">
      <div class="quiz-card">

        <div class="enunciado-block">
          <span class="xp-tag">+{{ preguntaActual.xp }} XP</span>
          <p class="enunciado">{{ preguntaActual.enunciado }}</p>
        </div>

        <div class="opciones-list">
          <button
            v-for="opcion in preguntaActual.opciones"
            :key="opcion.id"
            class="opcion-btn"
            :class="claseOpcion(opcion)"
            :disabled="respondida"
            @click="seleccionar(opcion)"
          >
            {{ opcion.texto }}
          </button>
        </div>

        <div v-if="respondida" class="feedback" :class="esCorrecta ? 'feedback-ok' : 'feedback-mal'">
          <span v-if="esCorrecta">✓ ¡Correcto! +{{ preguntaActual.xp }} XP</span>
          <span v-else>✗ Incorrecto. La respuesta correcta era: <b>{{ opcionCorrecta.texto }}</b></span>
        </div>

        <div class="quiz-footer">
          <button
            v-if="!respondida"
            class="btn-confirmar"
            :disabled="!opcionSeleccionada"
            @click="confirmar"
          >
            Confirmar respuesta
          </button>
          <button
            v-else-if="actual < preguntas.length - 1"
            class="btn-siguiente"
            @click="siguiente"
          >
            Siguiente →
          </button>
          <button
            v-else
            class="btn-siguiente"
            @click="finalizar"
          >
            Ver resultados →
          </button>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const el       = document.getElementById('quiz-app')
const preguntas = JSON.parse(el.dataset.preguntas)
const leccion  = JSON.parse(el.dataset.leccion)
const usuario  = JSON.parse(el.dataset.usuario)
const csrf     = document.querySelector('meta[name="csrf-token"]')?.content || ''

const actual             = ref(0)
const opcionSeleccionada = ref(null)
const respondida         = ref(false)
const esCorrecta         = ref(false)
const puntaje            = ref({ correctas: 0, xp: 0 })

const preguntaActual = computed(() => preguntas[actual.value])
const opcionCorrecta = computed(() => preguntaActual.value.opciones.find(o => o.es_correcta))

function seleccionar(opcion) {
  if (respondida.value) return
  opcionSeleccionada.value = opcion
}

function claseOpcion(opcion) {
  if (!respondida.value) {
    return opcionSeleccionada.value?.id === opcion.id ? 'opcion-seleccionada' : ''
  }
  if (opcion.es_correcta) return 'opcion-correcta'
  if (opcionSeleccionada.value?.id === opcion.id) return 'opcion-incorrecta'
  return ''
}

function confirmar() {
  if (!opcionSeleccionada.value) return
  respondida.value = true
  esCorrecta.value = opcionSeleccionada.value.es_correcta
  if (esCorrecta.value) {
    puntaje.value.correctas++
    puntaje.value.xp += preguntaActual.value.xp
  }
}

function siguiente() {
  actual.value++
  opcionSeleccionada.value = null
  respondida.value = false
  esCorrecta.value = false
}

async function finalizar() {
  const res = await fetch('/quiz/guardar', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrf,
    },
    body: JSON.stringify({
      leccion_id: leccion.id,
      correctas:  puntaje.value.correctas,
      total:      preguntas.length,
      xp_ganado:  puntaje.value.xp,
    }),
  })
  const data = await res.json()
  window.location.href = data.redirect
}
</script>

<style scoped>
* { box-sizing: border-box; margin: 0; padding: 0; }
.quiz-wrapper {
  min-height: 100vh;
  background: #f8fafc;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  display: flex;
  flex-direction: column;
}
.quiz-topbar {
  background: #fff;
  border-bottom: 1px solid #e2e8f0;
  height: 60px;
  padding: 0 32px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 100;
}
.btn-salir {
  display: flex;
  align-items: center;
  gap: 6px;
  color: #64748b;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
}
.btn-salir svg { width: 18px; height: 18px; }
.topbar-center { display: flex; align-items: center; gap: 8px; font-size: 14px; }
.leccion-name { color: #64748b; }
.sep { color: #cbd5e1; }
.counter { font-weight: 600; color: #0f172a; }
.xp-badge {
  font-size: 13px;
  font-weight: 600;
  color: #1e3a8a;
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  padding: 4px 12px;
  border-radius: 20px;
}
.progress-bar { height: 4px; background: #e2e8f0; }
.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #1e3a8a, #2563eb);
  transition: width 0.4s ease;
}
.quiz-main {
  flex: 1;
  display: flex;
  justify-content: center;
  padding: 48px 24px;
}
.quiz-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 40px;
  width: 100%;
  max-width: 680px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.enunciado-block { display: flex; flex-direction: column; gap: 12px; }
.xp-tag {
  font-size: 12px;
  font-weight: 600;
  color: #1e3a8a;
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  padding: 3px 10px;
  border-radius: 20px;
  align-self: flex-start;
}
.enunciado { font-size: 18px; font-weight: 600; color: #0f172a; line-height: 1.5; }
.opciones-list { display: flex; flex-direction: column; gap: 10px; }
.opcion-btn {
  width: 100%;
  padding: 14px 18px;
  text-align: left;
  border: 2px solid #e2e8f0;
  border-radius: 10px;
  background: #fff;
  font-size: 15px;
  color: #334155;
  cursor: pointer;
  transition: all 0.15s;
}
.opcion-btn:hover:not(:disabled) { border-color: #93c5fd; background: #f0f9ff; }
.opcion-seleccionada { border-color: #2563eb !important; background: #eff6ff !important; color: #1e3a8a !important; font-weight: 600; }
.opcion-correcta   { border-color: #16a34a !important; background: #dcfce7 !important; color: #14532d !important; font-weight: 600; }
.opcion-incorrecta { border-color: #dc2626 !important; background: #fee2e2 !important; color: #7f1d1d !important; }
.opcion-btn:disabled { cursor: default; }
.feedback { padding: 14px 18px; border-radius: 10px; font-size: 14px; font-weight: 500; }
.feedback-ok  { background: #dcfce7; color: #14532d; border: 1px solid #86efac; }
.feedback-mal { background: #fee2e2; color: #7f1d1d; border: 1px solid #fca5a5; }
.quiz-footer { display: flex; justify-content: flex-end; }
.btn-confirmar {
  padding: 12px 28px;
  background: #0f172a;
  color: #fff;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.15s;
}
.btn-confirmar:disabled { opacity: 0.4; cursor: not-allowed; }
.btn-confirmar:not(:disabled):hover { background: #1e293b; }
.btn-siguiente {
  padding: 12px 28px;
  background: linear-gradient(135deg, #1e3a8a, #2563eb);
  color: #fff;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
}
.btn-siguiente:hover { opacity: 0.9; }
@media (max-width: 600px) {
  .quiz-card { padding: 24px 18px; }
  .enunciado { font-size: 16px; }
  .quiz-topbar { padding: 0 16px; }
  .topbar-center { display: none; }
}
</style>