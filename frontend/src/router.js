import { createRouter, createWebHistory } from 'vue-router'
import DefaultLayout from './layouts/Default.vue'
import AuthenticatedLayout from './layouts/Authenticated.vue'

import Login from './pages/auth/Login.vue'
import Register from './pages/auth/Register.vue'
import Dashboard from './pages/Dashboard.vue'

import Books from './pages/books/Books.vue'
import EditBook from './pages/books/EditBook.vue'

const isAuthenticated = () => !!localStorage.getItem('token')

const routes = [
  {
    path: '/login',
    component: DefaultLayout,
    children: [
      { path: '', component: Login }
    ]
  },
  {
    path: '/register',
    component: DefaultLayout,
    children: [
      { path: '', component: Register }
    ]
  },

  {
    path: '/',
    component: AuthenticatedLayout,
    meta: { requiresAuth: true },
    children: [
      { path: 'dashboard', component: Dashboard },
    ]
  },

  {
    path: '/books',
    component: AuthenticatedLayout,
    meta: { requiresAuth: true },
    children: [
      { path: '', component: Books },
      { path: 'edit-book/:id', component: EditBook },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !isAuthenticated()) {
    next('/login')
  } else {
    next()
  }
})

export default router