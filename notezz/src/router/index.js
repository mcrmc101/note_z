import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import Notez from '../views/Notez.vue'
import NewNote from '../views/NewNote.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/note_z',
    name: 'Notez',
    component: Notez
  },
  {
    path: '/new_note',
    name: 'NewNote',
    component: NewNote
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
