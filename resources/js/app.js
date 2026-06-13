import { createApp } from 'vue'

// Dashboard usuario
import UserDashboard from './components/UserDashboard.vue'
if (document.getElementById('user-dashboard-app')) {
  createApp(UserDashboard).mount('#user-dashboard-app')
}

// Vista de lección
import VistaLeccion from './components/VistaLeccion.vue'
if (document.getElementById('leccion-app')) {
  createApp(VistaLeccion).mount('#leccion-app')
}

// Quiz
import QuizComponent from './components/QuizComponent.vue'
if (document.getElementById('quiz-app')) {
  createApp(QuizComponent).mount('#quiz-app')
}
