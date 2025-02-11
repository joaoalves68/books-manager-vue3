import { createRouter, createWebHistory } from 'vue-router'
import DefaultLayout from './layouts/Default.vue'
import AuthenticatedLayout from './layouts/Authenticated.vue'

import Login from './pages/auth/Login.vue'
import Register from './pages/auth/Register.vue'
import Dashboard from './pages/Dashboard.vue'

import Books from './pages/books/Books.vue'
import EditBook from './pages/books/EditBook.vue'
import RegisterBook from './pages/books/RegisterBook.vue' 
import Authors from './pages/authors/Authors.vue'
import EditAuthor from './pages/authors/EditAuthor.vue'
import RegisterAuthor from './pages/authors/RegisterAuthor.vue'

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
      { path: 'edit/:id', component: EditBook },
      { path: 'register', component: RegisterBook },
    ]
  },
  {
    path: '/authors',
    component: AuthenticatedLayout,
    meta: { requiresAuth: true },
    children: [
      { path: '', component: Authors },
      { path: 'edit/:id', component: EditAuthor },
      { path: 'register', component: RegisterAuthor },
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