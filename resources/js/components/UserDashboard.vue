<template>
  <div class="dashboard-container">

    <!-- NAVBAR -->
    <nav class="dash-nav">
      <span class="brand-name">Bitlyx</span>
      <div class="nav-right">
        <span class="xp-badge"> {{ usuario.xp_total }} XP</span>
        <span class="user-avatar">{{ iniciales }}</span>
        <form method="POST" action="/logout" style="display:inline">
          <input type="hidden" name="_token" :value="csrf">
          <button type="submit" class="logout-btn">Salir</button>
        </form>
      </div>
    </nav>

    <div class="dash-content">
      <div class="welcome-block">
        <h1 class="welcome-title">Bienvenido de vuelta, <span class="name-highlight">{{ usuario.nombre }}</span></h1>
        <p class="welcome-sub">Continúa desde donde lo dejaste.</p>
      </div>

      <!-- ESTADÍSTICAS -->
      <div class="stats-row">
        <div class="stat-card">
          <span class="stat-number">{{ stats.lecciones_completadas }} / {{ stats.total_lecciones }}</span>
          <span class="stat-label">Lecciones</span>
        </div>
        <div class="stat-card">
          <span class="stat-number">{{ usuario.xp_total }}</span>
          <span class="stat-label">Puntos XP</span>
        </div>
        <div class="stat-card">
          <span class="stat-number">{{ porcentajeGlobal }}%</span>
          <span class="stat-label">Progreso global</span>
        </div>
      </div>

      <!-- MÓDULOS -->
      <div class="modulos-section">
        <h2 class="section-title">Mis módulos</h2>

        <div v-if="modulos.length === 0" class="empty-state">
          No hay módulos disponibles todavía.
        </div>

        <div v-for="modulo in modulos" :key="modulo.id" class="modulo-card">
          <div class="modulo-header">
            <div>
              <h3 class="modulo-titulo">{{ modulo.titulo }}</h3>
              <p class="modulo-desc">{{ modulo.descripcion }}</p>
              <span class="modulo-meta">{{ modulo.lecciones.length }} lecciones</span>
            </div>
            <div class="modulo-porcentaje">{{ modulo.porcentaje }}%</div>
          </div>

          <!-- Barra de progreso -->
          <div class="progress-bar-wrap">
            <div class="progress-bar-fill" :style="{ width: modulo.porcentaje + '%' }"></div>
          </div>

          <!-- Lecciones del módulo -->
          <div class="lecciones-list">
            <a
              v-for="leccion in modulo.lecciones"
              :key="leccion.id"
              :href="'/leccion/' + leccion.id"
              class="leccion-item"
              :class="{ 'leccion-completada': leccion.completada }"
            >
              <span class="leccion-check">
                <svg v-if="leccion.completada" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span v-else class="leccion-num">{{ leccion.orden }}</span>
              </span>
              <span class="leccion-titulo-text">{{ leccion.titulo }}</span>
              <svg class="leccion-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </a>
          </div>

          <!-- Botón continuar -->
          <div class="modulo-footer">
            <a
              v-if="proximaLeccion(modulo)"
              :href="'/leccion/' + proximaLeccion(modulo).id"
              class="btn-continuar"
            >
              {{ modulo.completadas === 0 ? 'Comenzar módulo' : 'Continuar' }} →
            </a>
            <span v-else class="modulo-completado-badge">Módulo completado</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const el = document.getElementById('user-dashboard-app')
const usuario  = JSON.parse(el.dataset.usuario)
const stats    = JSON.parse(el.dataset.stats)
const modulos  = JSON.parse(el.dataset.modulos)
const csrf     = document.querySelector('meta[name="csrf-token"]')?.content || ''

const iniciales = computed(() => {
  const partes = (usuario.nombre || '').split(' ')
  return partes.slice(0, 2).map(p => p[0]?.toUpperCase() || '').join('')
})

const porcentajeGlobal = computed(() => {
  if (stats.total_lecciones === 0) return 0
  return Math.round((stats.lecciones_completadas / stats.total_lecciones) * 100)
})

// Devuelve la primera lección no completada del módulo
function proximaLeccion(modulo) {
  return modulo.lecciones.find(l => !l.completada) || null
}
</script>

<style scoped>
* { box-sizing: border-box; margin: 0; padding: 0; }

.dashboard-container {
  min-height: 100vh;
  background-color: #f8fafc;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.dash-nav {
  background-color: #ffffff;
  border-bottom: 1px solid #e2e8f0;
  padding: 0 40px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 100;
}

.brand-name {
  font-size: 20px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.02em;
}

.nav-right {
  display: flex;
  align-items: center;
  gap: 16px;
}

.xp-badge {
  font-size: 13px;
  font-weight: 600;
  color: #1e3a8a;
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  padding: 4px 12px;
  border-radius: 20px;
}

.user-avatar {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background: linear-gradient(135deg, #1e3a8a, #2563eb);
  color: #fff;
  font-size: 13px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logout-btn {
  background: none;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  padding: 6px 14px;
  font-size: 13px;
  color: #64748b;
  cursor: pointer;
  transition: all 0.15s;
}
.logout-btn:hover { background: #f1f5f9; color: #0f172a; }

.dash-content {
  max-width: 820px;
  margin: 0 auto;
  padding: 48px 24px;
}

.welcome-block { margin-bottom: 36px; }
.welcome-title {
  font-size: 30px;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.02em;
  margin-bottom: 6px;
}
.name-highlight { color: #1e3a8a; }
.welcome-sub { font-size: 15px; color: #64748b; }

.stats-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin-bottom: 48px;
}

.stat-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 24px;
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.stat-number {
  font-size: 28px;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.02em;
}
.stat-label {
  font-size: 13px;
  color: #64748b;
  font-weight: 500;
}

.section-title {
  font-size: 18px;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 20px;
}

.empty-state {
  color: #94a3b8;
  font-size: 14px;
  padding: 40px;
  text-align: center;
  background: #fff;
  border: 1px dashed #e2e8f0;
  border-radius: 12px;
}

.modulo-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 28px;
  margin-bottom: 20px;
}

.modulo-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 16px;
}

.modulo-titulo {
  font-size: 17px;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 4px;
}
.modulo-desc {
  font-size: 13px;
  color: #64748b;
  margin-bottom: 8px;
}
.modulo-meta {
  font-size: 12px;
  color: #94a3b8;
}

.modulo-porcentaje {
  font-size: 22px;
  font-weight: 700;
  color: #1e3a8a;
  min-width: 52px;
  text-align: right;
}

.progress-bar-wrap {
  background: #f1f5f9;
  border-radius: 99px;
  height: 6px;
  margin-bottom: 20px;
  overflow: hidden;
}
.progress-bar-fill {
  height: 100%;
  background: linear-gradient(90deg, #1e3a8a, #2563eb);
  border-radius: 99px;
  transition: width 0.4s ease;
}

.lecciones-list {
  display: flex;
  flex-direction: column;
  gap: 2px;
  margin-bottom: 20px;
}

.leccion-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 8px;
  text-decoration: none;
  color: #334155;
  font-size: 14px;
  transition: background 0.15s;
}
.leccion-item:hover { background: #f8fafc; }

.leccion-completada { color: #64748b; }
.leccion-completada .leccion-check { background: #dcfce7; border-color: #86efac; }
.leccion-completada .leccion-check svg { color: #16a34a; }

.leccion-check {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  border: 2px solid #e2e8f0;
  background: #f8fafc;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.leccion-check svg { width: 14px; height: 14px; }
.leccion-num { font-size: 11px; font-weight: 700; color: #94a3b8; }

.leccion-titulo-text { flex: 1; }

.leccion-arrow {
  width: 16px;
  height: 16px;
  color: #cbd5e1;
}

.modulo-footer { display: flex; justify-content: flex-end; }

.btn-continuar {
  display: inline-block;
  padding: 10px 22px;
  background: #111827;
  color: #ffffff;
  text-decoration: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  transition: background 0.15s;
}
.btn-continuar:hover { background: #1f2937; }

.modulo-completado-badge {
  font-size: 13px;
  font-weight: 600;
  color: #16a34a;
  background: #dcfce7;
  border: 1px solid #86efac;
  padding: 6px 14px;
  border-radius: 20px;
}

@media (max-width: 600px) {
  .dash-nav { padding: 0 16px; }
  .dash-content { padding: 24px 16px; }
  .stats-row { grid-template-columns: 1fr 1fr; }
  .welcome-title { font-size: 22px; }
}
</style>
