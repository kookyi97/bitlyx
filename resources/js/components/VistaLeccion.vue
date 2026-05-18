<template>
  <div class="leccion-wrapper">

    <div class="leccion-topbar">
      <a href="/user/dashboard" class="btn-salir">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Salir
      </a>

      <div class="topbar-center">
        <span class="modulo-breadcrumb">{{ leccion.modulo }}</span>
        <span class="sep">›</span>
        <span class="leccion-counter">Lección {{ leccion.orden }} de {{ total }}</span>
      </div>

      <span class="xp-badge"> {{ usuario.xp_total }} XP</span>
    </div>

    <!-- BARRA PROGRESO DEL MÓDULO -->
    <div class="module-progress-bar">
      <div class="module-progress-fill" :style="{ width: porcentaje + '%' }"></div>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="leccion-main">
      <div class="leccion-card">

        <!-- Título -->
        <div class="leccion-heading">
          <h1 class="leccion-titulo">{{ leccion.titulo }}</h1>
          <span v-if="leccion.completada" class="badge-completada">Completada</span>
        </div>

        <!-- Contenido de la lección -->
        <div class="leccion-body">
          <p class="leccion-texto" v-html="contenidoFormateado"></p>
        </div>

        <!-- Nota de progreso -->
        <div class="leccion-progress-info">
          <div class="mini-progress-bar">
            <div class="mini-progress-fill" :style="{ width: porcentaje + '%' }"></div>
          </div>
          <span class="progress-label">{{ completadas }} de {{ total }} lecciones completadas en este módulo</span>
        </div>

        <!-- NAVEGACIÓN INFERIOR -->
        <div class="leccion-nav-buttons">
          <a
            v-if="anterior"
            :href="'/leccion/' + anterior.id"
            class="btn-nav btn-anterior"
          >
            Anterior
          </a>
          <div v-else class="btn-nav-placeholder"></div>

          <!-- Botón de marcar completada -->
          <form
            v-if="!leccion.completada"
            method="POST"
            :action="'/leccion/' + leccion.id + '/completar'"
          >
            <input type="hidden" name="_token" :value="csrf">
            <button type="submit" class="btn-completar">
              Marcar como completada 
            </button>
          </form>
          <span v-else class="ya-completada">Ya completada</span>
          <a
            v-if="leccion.completada"
            :href="'/quiz/' + leccion.id"
            class="btn-quiz"
          >
            Ir al Quiz ⚡
          </a>

          <a
            v-if="siguiente"
            :href="'/leccion/' + siguiente.id"
            class="btn-nav btn-siguiente"
          >
            Siguiente 
          </a>
          <div v-else class="btn-nav-placeholder"></div>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { computed } from 'vue'

const el         = document.getElementById('leccion-app')
const leccion    = JSON.parse(el.dataset.leccion)
const anterior   = JSON.parse(el.dataset.anterior)
const siguiente  = JSON.parse(el.dataset.siguiente)
const porcentaje = parseInt(el.dataset.porcentaje || '0')
const total      = parseInt(el.dataset.total || '0')
const completadas = parseInt(el.dataset.completadas || '0')
const usuario    = JSON.parse(el.dataset.usuario)
const csrf       = document.querySelector('meta[name="csrf-token"]')?.content || ''

const contenidoFormateado = computed(() =>
  (leccion.contenido || '').replace(/\n/g, '<br>')
)
</script>

<style scoped>
* { box-sizing: border-box; margin: 0; padding: 0; }

.leccion-wrapper {
  min-height: 100vh;
  background: #f8fafc;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  display: flex;
  flex-direction: column;
}

.leccion-topbar {
  background: #ffffff;
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
  transition: color 0.15s;
}
.btn-salir:hover { color: #0f172a; }
.btn-salir svg { width: 18px; height: 18px; }

.topbar-center {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
}
.modulo-breadcrumb { color: #64748b; }
.sep { color: #cbd5e1; }
.leccion-counter { font-weight: 600; color: #0f172a; }

.xp-badge {
  font-size: 13px;
  font-weight: 600;
  color: #1e3a8a;
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  padding: 4px 12px;
  border-radius: 20px;
}

.module-progress-bar {
  height: 3px;
  background: #e2e8f0;
}
.module-progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #1e3a8a, #2563eb);
  transition: width 0.4s ease;
}

.leccion-main {
  flex: 1;
  display: flex;
  justify-content: center;
  padding: 48px 24px;
}

.leccion-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 48px;
  width: 100%;
  max-width: 720px;
  display: flex;
  flex-direction: column;
  gap: 32px;
}

.leccion-heading {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
}

.leccion-titulo {
  font-size: 28px;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.02em;
  line-height: 1.25;
}

.badge-completada {
  flex-shrink: 0;
  font-size: 12px;
  font-weight: 600;
  color: #16a34a;
  background: #dcfce7;
  border: 1px solid #86efac;
  padding: 4px 12px;
  border-radius: 20px;
  white-space: nowrap;
}

.leccion-body {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  padding: 28px;
}

.leccion-texto {
  font-size: 15px;
  line-height: 1.75;
  color: #334155;
}

.leccion-progress-info {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.mini-progress-bar {
  height: 6px;
  background: #f1f5f9;
  border-radius: 99px;
  overflow: hidden;
}
.mini-progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #1e3a8a, #2563eb);
  border-radius: 99px;
  transition: width 0.4s ease;
}
.progress-label {
  font-size: 13px;
  color: #94a3b8;
}

.leccion-nav-buttons {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding-top: 8px;
  border-top: 1px solid #f1f5f9;
}

.btn-nav {
  padding: 10px 20px;
  border-radius: 8px;
  text-decoration: none;
  font-size: 14px;
  font-weight: 600;
  transition: all 0.15s;
}

.btn-anterior {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  color: #334155;
}
.btn-anterior:hover { background: #f1f5f9; }

.btn-siguiente {
  background: #0f172a;
  color: #ffffff;
}
.btn-siguiente:hover { background: #1e293b; }

.btn-nav-placeholder { min-width: 100px; }

.btn-completar {
  padding: 12px 28px;
  background: linear-gradient(135deg, #1e3a8a, #2563eb);
  color: #ffffff;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.15s;
}
.btn-completar:hover { opacity: 0.9; }

.ya-completada {
  font-size: 13px;
  font-weight: 600;
  color: #16a34a;
  background: #dcfce7;
  border: 1px solid #86efac;
  padding: 10px 20px;
  border-radius: 8px;
}

@media (max-width: 600px) {
  .leccion-card { padding: 24px 20px; }
  .leccion-titulo { font-size: 22px; }
  .leccion-topbar { padding: 0 16px; }
  .topbar-center { display: none; }
  .leccion-nav-buttons { flex-wrap: wrap; justify-content: center; }
}
.btn-quiz {
  padding: 12px 28px;
  background: linear-gradient(135deg, #1e3a8a, #2563eb);
  color: #ffffff;
  border-radius: 8px;
  text-decoration: none;
  font-size: 14px;
  font-weight: 600;
  transition: opacity 0.15s;
}
.btn-quiz:hover { opacity: 0.9; }
</style>
