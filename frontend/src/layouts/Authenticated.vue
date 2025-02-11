<template>
  <div>
    <!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Books Manager</title>
        </head>
        <body class="d-flex flex-column min-vh-100">
          <div class="d-flex flex-grow-1" id="wrapper">

            <div class="border-right" id="sidebar-wrapper" style="width: 250px;">
              <div class="logo text-center py-4"><router-link to="/dashboard"><img width="230" src="https://www.inovcorp.com/site/imagens/logo_1.png" alt="InovCorp"></router-link></div>
              <div class="list-group list-group-flush">
                <router-link class="list-group-item list-group-item-action py-3" to="/books">Livros</router-link>
                <router-link class="list-group-item list-group-item-action py-3" to="/authors">Autores</router-link>
              </div>
            </div>

            <div id="page-content-wrapper" class="flex-grow-1">

              <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                <div class="collapse navbar-collapse justify-content-end px-3" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                      <button @click="handleLogout()" class="btn btn-link nav-link">Logout</button>
                    </li>
                  </ul>
                </div>
              </nav>

              <div class="container-fluid">
                <router-view></router-view>
              </div>
            </div>
          </div>

        </body>
      </html>

  </div>
</template>

<script setup>
import { useRouter } from "vue-router"
import { logout } from "@/api"

const router = useRouter()

const handleLogout = () => {
  logout()
  router.push('/login')
}
</script>
