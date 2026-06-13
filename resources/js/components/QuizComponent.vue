<template>
  <div class="quiz-wrapper" :class="{ dark: darkMode }">

    <div class="quiz-topbar">
      <a href="/user/dashboard" class="btn-salir">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Salir
      </a>
      <div class="topbar-center">
        <span class="modulo-name">{{ modulo.titulo }}</span>
        <span class="sep">›</span>
        <span class="counter">{{ actual + 1 }} / {{ preguntas.length }}</span>
      </div>
      <div class="topbar-right">
        <span class="xp-badge">⚡ {{ usuario.xp_total }} XP</span>
        <button class="dark-toggle" @click="darkMode = !darkMode">
          <span v-if="darkMode">☀️</span><span v-else>🌙</span>
        </button>
      </div>
    </div>

    <div class="progress-track">
      <div class="progress-fill" :style="{ width: progressPct + '%' }"></div>
    </div>

    <div v-if="fase === 'quiz'" class="quiz-main">
      <div class="quiz-card" :class="cardAnim">
        <div class="card-header">
          <span class="xp-tag">+{{ preguntaActual.xp }} XP</span>
          <div class="timer-wrap" :class="timerClass">
            <svg class="timer-ring" viewBox="0 0 36 36">
              <circle class="ring-bg" cx="18" cy="18" r="15" />
              <circle class="ring-fg" cx="18" cy="18" r="15" :style="{ strokeDashoffset: timerDash }" />
            </svg>
            <span class="timer-num">{{ timerSeg }}</span>
          </div>
        </div>

        <p class="enunciado">{{ preguntaActual.enunciado }}</p>

        <div class="opciones-list">
          <button
            v-for="(opcion, idx) in preguntaActual.opciones"
            :key="opcion.id"
            class="opcion-btn"
            :class="[claseOpcion(opcion), { shake: shakeIncorrecto && opcion.id === opcionSeleccionada?.id }]"
            :disabled="respondida"
            @click="seleccionar(opcion)"
          >
            <span class="opcion-letra">{{ letras[idx] }}</span>
            <span class="opcion-texto">{{ opcion.texto }}</span>
            <span class="opcion-check" v-if="respondida && opcion.es_correcta">✓</span>
            <span class="opcion-check rojo" v-else-if="respondida && opcionSeleccionada?.id === opcion.id && !opcion.es_correcta">✗</span>
          </button>
        </div>

        <transition name="slide-up">
          <div v-if="respondida" class="feedback" :class="esCorrecta ? 'feedback-ok' : 'feedback-mal'">
            <span v-if="esCorrecta">🎉 ¡Correcto! <b>+{{ preguntaActual.xp }} XP</b></span>
            <span v-else>❌ Incorrecto — la respuesta era: <b>{{ opcionCorrecta.texto }}</b></span>
          </div>
        </transition>

        <div class="quiz-footer">
          <button v-if="!respondida" class="btn-confirmar" :disabled="!opcionSeleccionada" @click="confirmar">
            Confirmar respuesta
          </button>
          <button v-else-if="actual < preguntas.length - 1" class="btn-siguiente" @click="siguiente">
            Siguiente →
          </button>
          <button v-else class="btn-siguiente btn-finalizar" @click="finalizarQuiz">
            Ver resultados →
          </button>
        </div>
      </div>
    </div>

    <div v-if="fase === 'enviando'" class="fase-center">
      <div class="spinner"></div>
      <p>Guardando resultados...</p>
    </div>

    <div v-if="fase === 'error'" class="fase-center">
      <p class="error-msg">⚠️ Error al guardar. Intenta de nuevo.</p>
      <button class="btn-confirmar" @click="enviarResultado">Reintentar</button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'

const el        = document.getElementById('quiz-app')
const preguntas = JSON.parse(el.dataset.preguntas)
const modulo    = JSON.parse(el.dataset.modulo)
const usuario   = JSON.parse(el.dataset.usuario)
const csrf      = document.querySelector('meta[name="csrf-token"]')?.content || ''

const darkMode           = ref(localStorage.getItem('bitlyx-dark') === '1')
const fase               = ref('quiz')
const cardAnim           = ref('')
const actual             = ref(0)
const opcionSeleccionada = ref(null)
const respondida         = ref(false)
const esCorrecta         = ref(false)
const shakeIncorrecto    = ref(false)
const puntaje            = ref({ correctas: 0, xp: 0 })
const respuestas         = ref([])

const TIEMPO_TOTAL = 30
const timerSeg     = ref(TIEMPO_TOTAL)
let   timerHandle  = null

const timerDash = computed(() => {
  const c = 2 * Math.PI * 15
  return c - (timerSeg.value / TIEMPO_TOTAL) * c
})
const timerClass = computed(() => {
  if (timerSeg.value <= 5)  return 'timer-rojo'
  if (timerSeg.value <= 10) return 'timer-amarillo'
  return ''
})

function iniciarTimer() {
  limpiarTimer()
  timerSeg.value = TIEMPO_TOTAL
  timerHandle = setInterval(() => {
    if (respondida.value) { limpiarTimer(); return }
    timerSeg.value--
    if (timerSeg.value <= 0) {
      limpiarTimer()
      respondida.value = true
      esCorrecta.value = false
      respuestas.value.push({ pregunta_id: preguntaActual.value.id, opcion_seleccionada_id: null, es_correcta: false })
    }
  }, 1000)
}
function limpiarTimer() { if (timerHandle) { clearInterval(timerHandle); timerHandle = null } }

const preguntaActual = computed(() => preguntas[actual.value])
const opcionCorrecta = computed(() => preguntaActual.value.opciones.find(o => o.es_correcta))
const progressPct    = computed(() => (actual.value / preguntas.length) * 100)
const letras         = ['A', 'B', 'C', 'D']

watch(darkMode, v => localStorage.setItem('bitlyx-dark', v ? '1' : '0'))

function seleccionar(opcion) { if (!respondida.value) opcionSeleccionada.value = opcion }

function claseOpcion(opcion) {
  if (!respondida.value) return opcionSeleccionada.value?.id === opcion.id ? 'opcion-seleccionada' : ''
  if (opcion.es_correcta) return 'opcion-correcta'
  if (opcionSeleccionada.value?.id === opcion.id) return 'opcion-incorrecta'
  return 'opcion-neutral'
}

function confirmar() {
  if (!opcionSeleccionada.value || respondida.value) return
  limpiarTimer()
  respondida.value = true
  esCorrecta.value = !!opcionSeleccionada.value.es_correcta
  if (esCorrecta.value) { puntaje.value.correctas++; puntaje.value.xp += preguntaActual.value.xp }
  else { shakeIncorrecto.value = true; setTimeout(() => { shakeIncorrecto.value = false }, 600) }
  respuestas.value.push({ pregunta_id: preguntaActual.value.id, opcion_seleccionada_id: opcionSeleccionada.value?.id ?? null, es_correcta: !!opcionSeleccionada.value?.es_correcta })
}

function siguiente() {
  cardAnim.value = 'card-exit'
  setTimeout(() => {
    actual.value++; opcionSeleccionada.value = null; respondida.value = false; esCorrecta.value = false
    cardAnim.value = 'card-enter'
    setTimeout(() => { cardAnim.value = '' }, 350)
    iniciarTimer()
  }, 200)
}

function finalizarQuiz() { limpiarTimer(); fase.value = 'enviando'; enviarResultado() }

async function enviarResultado() {
  fase.value = 'enviando'
  try {
    const res = await fetch('/quiz/guardar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
      body: JSON.stringify({ modulo_id: modulo.id, correctas: puntaje.value.correctas, total: preguntas.length, xp_ganado: puntaje.value.xp, respuestas: respuestas.value }),
    })
    if (!res.ok) throw new Error()
    const data = await res.json()
    window.location.href = data.redirect
  } catch { fase.value = 'error' }
}

onMounted(() => iniciarTimer())
onUnmounted(() => limpiarTimer())
</script>

<style scoped>
.quiz-wrapper{--bg:#f8fafc;--surface:#ffffff;--border:#e2e8f0;--text:#0f172a;--text-muted:#64748b;--primary:#15803d;--primary-bg:#dcfce7;--accent:#2563eb;--ok-bg:#dcfce7;--ok-text:#14532d;--ok-border:#86efac;--err-bg:#fee2e2;--err-text:#7f1d1d;--err-border:#fca5a5;--timer-fg:#15803d;min-height:100vh;background:var(--bg);font-family:'Inter',-apple-system,sans-serif;display:flex;flex-direction:column;transition:background .25s,color .25s}
.quiz-wrapper.dark{--bg:#0D0D0D;--surface:#1A1A1A;--border:#2D2D2D;--text:#F9FAFB;--text-muted:#9CA3AF;--primary:#4ade80;--primary-bg:#14532d;--accent:#60a5fa;--ok-bg:#14532d;--ok-text:#bbf7d0;--ok-border:#15803d;--err-bg:#450a0a;--err-text:#fca5a5;--err-border:#7f1d1d;--timer-fg:#4ade80}
.quiz-topbar{background:var(--surface);border-bottom:1px solid var(--border);height:60px;padding:0 28px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;transition:background .25s,border-color .25s}
.btn-salir{display:flex;align-items:center;gap:6px;color:var(--text-muted);text-decoration:none;font-size:14px;font-weight:500;transition:color .15s}
.btn-salir:hover{color:var(--text)}.btn-salir svg{width:18px;height:18px}
.topbar-center{display:flex;align-items:center;gap:8px;font-size:14px;color:var(--text-muted)}
.counter{font-weight:700;color:var(--text)}.sep{color:var(--border)}
.topbar-right{display:flex;align-items:center;gap:10px}
.xp-badge{font-size:13px;font-weight:700;color:var(--primary);background:var(--primary-bg);border:1px solid var(--ok-border);padding:4px 12px;border-radius:20px}
.dark-toggle{background:var(--border);border:none;border-radius:50%;width:34px;height:34px;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;transition:background .2s}
.progress-track{height:5px;background:var(--border)}
.progress-fill{height:100%;background:linear-gradient(90deg,var(--primary),var(--accent));transition:width .45s cubic-bezier(.4,0,.2,1)}
.quiz-main{flex:1;display:flex;justify-content:center;align-items:flex-start;padding:40px 20px}
.quiz-card{background:var(--surface);border:1px solid var(--border);border-radius:20px;padding:36px 40px;width:100%;max-width:680px;display:flex;flex-direction:column;gap:22px;transition:background .25s,border-color .25s,transform .2s,opacity .2s}
.card-exit{transform:translateX(-24px);opacity:0}
.card-enter{transform:translateX(24px);opacity:0;animation:slideIn .35s cubic-bezier(.4,0,.2,1) forwards}
@keyframes slideIn{to{transform:translateX(0);opacity:1}}
.card-header{display:flex;align-items:center;justify-content:space-between}
.xp-tag{font-size:12px;font-weight:700;color:var(--primary);background:var(--primary-bg);border:1px solid var(--ok-border);padding:4px 12px;border-radius:20px}
.timer-wrap{position:relative;width:48px;height:48px;display:flex;align-items:center;justify-content:center}
.timer-ring{position:absolute;inset:0;width:100%;height:100%;transform:rotate(-90deg)}
.ring-bg{fill:none;stroke:var(--border);stroke-width:3}
.ring-fg{fill:none;stroke:var(--timer-fg);stroke-width:3;stroke-linecap:round;stroke-dasharray:94.25;transition:stroke-dashoffset .9s linear,stroke .3s}
.timer-num{font-size:14px;font-weight:700;color:var(--text);z-index:1}
.timer-amarillo .ring-fg{stroke:#f59e0b}.timer-amarillo .timer-num{color:#f59e0b}
.timer-rojo .ring-fg{stroke:#ef4444}.timer-rojo .timer-num{color:#ef4444}
.enunciado{font-size:18px;font-weight:600;color:var(--text);line-height:1.6}
.opciones-list{display:flex;flex-direction:column;gap:10px}
.opcion-btn{display:flex;align-items:center;gap:12px;width:100%;padding:13px 16px;text-align:left;border:2px solid var(--border);border-radius:12px;background:var(--surface);font-size:15px;color:var(--text);cursor:pointer;transition:border-color .15s,background .15s,transform .1s;position:relative}
.opcion-btn:hover:not(:disabled){border-color:var(--accent);background:var(--primary-bg);transform:translateX(3px)}
.opcion-letra{min-width:28px;height:28px;border-radius:50%;background:var(--border);color:var(--text-muted);font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background .15s,color .15s}
.opcion-texto{flex:1}.opcion-check{font-size:16px;font-weight:700;flex-shrink:0}.opcion-check.rojo{color:var(--err-text)}
.opcion-seleccionada{border-color:var(--accent)!important;background:color-mix(in srgb,var(--accent) 12%,var(--surface))!important}
.opcion-seleccionada .opcion-letra{background:var(--accent);color:#fff}
.opcion-correcta{border-color:#16a34a!important;background:var(--ok-bg)!important;color:var(--ok-text)!important}
.opcion-correcta .opcion-letra{background:#16a34a;color:#fff}
.opcion-incorrecta{border-color:#dc2626!important;background:var(--err-bg)!important;color:var(--err-text)!important}
.opcion-incorrecta .opcion-letra{background:#dc2626;color:#fff}
.opcion-neutral{opacity:.55}.opcion-btn:disabled{cursor:default}
@keyframes shake{0%,100%{transform:translateX(0)}20%{transform:translateX(-6px)}40%{transform:translateX(6px)}60%{transform:translateX(-4px)}80%{transform:translateX(4px)}}
.shake{animation:shake .5s ease}
.feedback{padding:14px 18px;border-radius:10px;font-size:14px;font-weight:500;border:1px solid}
.feedback-ok{background:var(--ok-bg);color:var(--ok-text);border-color:var(--ok-border)}
.feedback-mal{background:var(--err-bg);color:var(--err-text);border-color:var(--err-border)}
.slide-up-enter-active{transition:all .3s cubic-bezier(.4,0,.2,1)}
.slide-up-enter-from{opacity:0;transform:translateY(10px)}
.quiz-footer{display:flex;justify-content:flex-end}
.btn-confirmar{padding:12px 28px;background:var(--text);color:var(--surface);border:none;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;transition:opacity .15s,transform .1s}
.btn-confirmar:disabled{opacity:.35;cursor:not-allowed}
.btn-confirmar:not(:disabled):hover{opacity:.85;transform:translateY(-1px)}
.btn-siguiente{padding:12px 28px;background:linear-gradient(135deg,var(--primary),var(--accent));color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;transition:opacity .15s,transform .1s}
.btn-siguiente:hover{opacity:.9;transform:translateY(-1px)}
.btn-finalizar{background:linear-gradient(135deg,#15803d,#2563eb)}
.fase-center{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:20px;color:var(--text-muted);font-size:15px}
.spinner{width:42px;height:42px;border:4px solid var(--border);border-top-color:var(--primary);border-radius:50%;animation:spin .7s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.error-msg{color:#ef4444;font-weight:600}
@media(max-width:600px){.quiz-card{padding:24px 18px}.enunciado{font-size:16px}.quiz-topbar{padding:0 16px}.topbar-center{display:none}}
</style>