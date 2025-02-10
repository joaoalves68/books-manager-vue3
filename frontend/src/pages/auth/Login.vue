<template>
  <div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="text-center">Login</h3>

          <div v-if="errorMessage" class="alert alert-danger">
            {{ errorMessage }}
          </div>

          <form @submit.prevent="login">
            <div class="mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" v-model="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Senha</label>
              <input type="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" :disabled="loading">
              {{ loading ? 'Entrando...' : 'Entrar' }}
            </button>
          </form>
          <p class="mt-3 text-center">
            Ainda não possui uma conta? <router-link to="/register">Cadastre-se</router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { auth } from "@/api"
import { ref } from "vue"
import { useRouter } from "vue-router"

const email = ref("")
const password = ref("")
const loading = ref(false)
const errorMessage = ref(null)
const router = useRouter()

const login = async () => {
  loading.value = true
  errorMessage.value = null

  try {
   const {data} = await auth(email.value, password.value)

    localStorage.setItem("token", data.token)
    router.push("/dashboard")
  } catch (error) {
    errorMessage.value = "As credenciais estão incorretas."
  } finally {
    loading.value = false
  }
}
</script>
