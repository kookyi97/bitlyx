import { createApp } from 'vue'
import LoginForm from './components/LoginForm.vue'

if (document.getElementById('login-app')) {
  createApp(LoginForm).mount('#login-app')
}