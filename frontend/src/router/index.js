import { createRouter, createWebHistory } from 'vue-router'

import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Home from '../views/Home.vue'
import Profile from '../views/Profile.vue'
import Difficulties from '../views/Difficulties.vue'
import DifficultyCreate from '../views/DifficultyCreate.vue'
import { useAuthStore } from '../stores/auth'

const router = createRouter({
  history: createWebHistory(),

  routes: [
    {
      path: '/login',
      name: 'login',
      component: Login
    },

    {
      path: '/register',
      name: 'register',
      component: Register
    },

    {
      path: '/',
      name: 'home',
      component: Home,
      meta: {
        requiresAuth: true
      }
    },

    {
      path: '/profile',
      name: 'profile',
      component: Profile,
      meta: {
        requiresAuth: true
      }
    },

    {
      path: '/difficulties',
      name: 'difficulties',
      component: Difficulties,
      meta: {
        requiresAuth: true
      }
    },

    {
      path: '/difficulties/create',
      name: 'difficulty-create',
      component: DifficultyCreate,
      meta: {
        requiresAuth: true
      }
    }
  ]
})


router.beforeEach((to) => {

  const auth = useAuthStore()


  if (
    to.meta.requiresAuth &&
    !auth.isLogin
  ) {

    return '/login'

  }


  return true

})

export default router