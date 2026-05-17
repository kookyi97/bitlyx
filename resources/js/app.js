import { createApp } from 'vue'
import LoginForm from './components/LoginForm.vue'

if (document.getElementById('login-app')) {
  createApp(LoginForm).mount('#login-app')
}
import UserDashboard from './components/UserDashboard.vue'
import VistaLeccion from './components/VistaLeccion.vue'

if (document.getElementById('user-dashboard-app')) {
  createApp(UserDashboard).mount('#user-dashboard-app')
}
if (document.getElementById('leccion-app')) {
  createApp(VistaLeccion).mount('#leccion-app')
}