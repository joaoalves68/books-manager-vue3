<template>
  <div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="text-center">Login</h3>

          <form @submit.prevent="login">
            <div class="mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" v-model="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Senha</label>
              <input type="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
              Entrar
            </button>
          </form>
          <p class="mt-3 text-center">
            Ainda não possui uma conta? <router-link to="/register">Cadastre-se</router-link>
          </p>
          
          <div v-if="isLoading" class="loader-container">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only"></span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { auth } from "@/api"
import { ref } from "vue"
import { useRouter } from "vue-router"
import Swal from 'sweetalert2'

const email = ref("")
const password = ref("")
const isLoading = ref(false)
const router = useRouter()

const login = async () => {
  isLoading.value = true

  try {
    const {data} = await auth(email.value, password.value)

    localStorage.setItem("token", data.token)
    router.push("/dashboard")
  } catch (error) {
    Swal.fire(
      'Erro!',
      'As credenciais estão incorretas.',
      'warning'
    )
  } finally {
    isLoading.value = false
  }
}
</script>
