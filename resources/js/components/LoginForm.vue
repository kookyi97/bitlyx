<template>
  <div class="auth-container">
    
    <div class="brand-panel">
      <div class="mesh-gradients"></div>
      
      <div class="brand-content">
        <div class="brand-icon-wrap">
          <svg class="hero-logo" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3zM6 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3z"/>
            <path d="M14 8h-4M14 16h-4"/>
          </svg>
        </div>
        
        <h2 class="hero-title">Domina la tecnología concepto a concepto.</h2>
        <p class="hero-subtitle">
          Simplifica arquitecturas complejas, asimila código de vanguardia y potencia tus habilidades de ingeniería a través de micro-aprendizaje guiado.
        </p>
      </div>
      
      <div class="brand-footer">
        <span>&copy; {{ currentYear }} Bitlyx Platform. Todos los derechos reservados.</span>
      </div>
    </div>

    <div class="form-panel">
      <form method="POST" action="/login" class="login-core">
        <input type="hidden" name="_token" :value="csrf">

        <div class="form-header">
          <span class="platform-name">Bitlyx</span>
          <h1>Bienvenido de nuevo</h1>
          <p class="signup-prompt">
            ¿No tienes una cuenta? <a href="/register">Regístrate ahora de forma gratuita.</a>
          </p>
        </div>

        <div v-if="errorMsg" class="error-toast">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>
          </svg>
          <span>{{ errorMsg }}</span>
        </div>

        <div class="form-fields">
          <div class="field-group">
            <label for="email">Correo electrónico</label>
            <input
              id="email"
              type="email"
              name="email"
              v-model="email"
              placeholder=""
              autocomplete="email"
              required
            >
          </div>

          <div class="field-group">
            <label for="password">Contraseña</label>
            <div class="password-input-container">
              <input
                id="password"
                :type="showPass ? 'text' : 'password'"
                name="password"
                v-model="password"
                placeholder=""
                autocomplete="current-password"
                required
              >
              <button type="button" class="toggle-password" @click="showPass = !showPass">
                <svg v-if="!showPass" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
                </svg>
                <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="submit-btn" :disabled="!isValid">
            Iniciar sesión ahora
          </button>
          
          <a href="/password/reset" class="forgot-password">¿Olvidaste tu contraseña?</a>
        </div>
      </form>
    </div>

  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const email = ref(window.oldEmail || '')
const password = ref('')
const showPass = ref(false)
const currentYear = computed(() => new Date().getFullYear())

const csrf = document.querySelector('meta[name="csrf-token"]')?.content || ''

const errorMsg = computed(() => {
  const e = window.loginErrors?.email
  return e ? e[0] : null
})

const isValid = computed(() =>
  email.value.includes('@') && password.value.length >= 6
)
</script>

<style scoped>

* { 
  box-sizing: border-box; 
  margin: 0; 
  padding: 0; 
}

.auth-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  height: 100dvh;
  min-height: 100dvh; 
  overflow: hidden;
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  background-color: #ffffff;
}


/* ==========================================================================
   PANEL IZQUIERDO 
   ========================================================================== */
.brand-panel {
  position: relative;
  height: 100%;
  background: linear-gradient(135deg, #1e3a8a 0%, #020617 100%);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 40px;
  overflow: hidden;
}

.mesh-gradients {
  position: absolute;
  inset: 0;
  opacity: 0.15;
  background-image: 
    linear-gradient(#ffffff 1px, transparent 1px),
    linear-gradient(90deg, #ffffff 1px, transparent 1px);
  background-size: 40px 40px;
  mask-image: radial-gradient(ellipse at center, black, transparent 80%);
}

.brand-content {
  position: relative;
  z-index: 2;
  max-width: 520px;
  margin-top: auto;
  margin-bottom: auto;
}

.brand-icon-wrap {
  width: 56px;
  height: 56px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 32px;
  color: #ffffff;
}

.hero-logo {
  width: 28px;
  height: 28px;
}

.hero-title {
  color: #ffffff;
  font-size: 42px;
  font-weight: 700;
  line-height: 1.15;
  letter-spacing: -0.03em;
  margin-bottom: 20px;
}

.hero-subtitle {
  color: #94a3b8;
  font-size: 16px;
  line-height: 1.6;
}

.brand-footer {
  position: relative;
  z-index: 2;
  color: #64748b;
  font-size: 13px;
}

/* ==========================================================================
   PANEL DERECHO
   ========================================================================== */
.form-panel {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px;
  background-color: #ffffff;
}

.login-core {
  width: 100%;
  max-width: 420px;
  display: flex;
  flex-direction: column;
  gap: 28px;
}

.platform-name {
  display: block;
  font-size: 22px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.02em;
  margin-bottom: 40px;
}

.form-header h1 {
  font-size: 32px;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.02em;
  margin-bottom: 10px;
}

.signup-prompt {
  font-size: 14px;
  color: #64748b;
}

.signup-prompt a {
  color: #2563eb;
  text-decoration: none;
  font-weight: 500;
}

.signup-prompt a:hover {
  text-decoration: underline;
}

/* Campos */
.form-fields {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.field-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.field-group label {
  font-size: 13px;
  font-weight: 500;
  color: #334155;
}

input {
  width: 100%;
  padding: 12px 0px; 
  border: none;
  border-bottom: 2px solid #e2e8f0;
  font-size: 15px;
  color: #0f172a;
  outline: none;
  transition: border-color 0.2s;
}

input:focus {
  border-bottom-color: #0f172a;
}

input::placeholder {
  color: #cbd5e1;
}

/* Contenedor Contraseña */
.password-input-container {
  position: relative;
}

.toggle-password {
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  color: #94a3b8;
  padding: 4px;
  display: flex;
}

.toggle-password:hover {
  color: #0f172a;
}

.toggle-password svg {
  width: 20px;
  height: 20px;
}

/* Errores */
.error-toast {
  background-color: #fef2f2;
  border: 1px solid #fee2e2;
  color: #991b1b;
  border-radius: 8px;
  padding: 12px 16px;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.error-toast svg {
  width: 18px;
  height: 18px;
  flex-shrink: 0;
}

/* Acciones y Botón */
.form-actions {
  display: flex;
  flex-direction: column;
  gap: 16px;
  align-items: center;
}

.submit-btn {
  width: 100%;
  padding: 14px;
  background-color: #111827;
  color: #ffffff;
  border: none;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s;
}

.submit-btn:hover:not(:disabled) {
  background-color: #1f2937;
}

.submit-btn:disabled {
  background-color: #94a3b8;
  cursor: not-allowed;
  opacity: 0.6;
}

.forgot-password {
  font-size: 13px;
  color: #64748b;
  text-decoration: none;
}

.forgot-password:hover {
  color: #0f172a;
  text-decoration: underline;
}

/* Responsividad para pantallas móviles */
@media (max-width: 900px) {
  .auth-container {
    grid-template-columns: 1fr;
  }
  .brand-panel {
    display: none; 
  }
  .form-panel {
    padding: 40px 24px;
  }
}

html, body, #app {
  margin: 0;
  padding: 0;
  width: 100vw;
  height: 100vh;
  overflow-x: hidden;
  background-color: #ffffff; 
}
</style>