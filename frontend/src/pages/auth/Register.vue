<template>
  <div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="text-center">Registre-se</h3>

          <div class="alert alert-danger" v-if="errors.length > 0">
            <ul class="mb-0">
                <li v-for="(error, index) in errors" :key="index">{{ error.message }}</li>
            </ul>
          </div>

          <form @submit.prevent="registerUser">
            <div class="mb-3">
              <label for="name" class="form-label">Nome</label>
              <input type="name" class="form-control" name="name" v-model="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" name="email" v-model="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Senha</label>
              <input type="password" class="form-control" name="password" v-model="password" required>
            </div>
            <div class="mb-3">
              <label for="password_confirm" class="form-label">Confirme sua senha</label>
              <input type="password" class="form-control" name="password_confirm" v-model="password_confirm" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrar</button>
          </form>
          <p class="mt-3 text-center">
            Já possui uma conta? <router-link to="/login">Faça login</router-link>
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
import { register } from "@/api"
import { ref } from "vue"
import { useRouter } from "vue-router"
import Swal from 'sweetalert2'

const name = ref("")
const email = ref("")
const password = ref("")
const password_confirm = ref("")
const errors = ref([])

const isLoading = ref(false)
const router = useRouter()

const registerUser = async () => {
  isLoading.value = true

  const formData = new FormData()
  formData.append('name', name.value)
  formData.append('email', email.value)
  formData.append('password', password.value)
  formData.append('password_confirm', password_confirm.value)

  try {
    register(formData)
    Swal.fire(
      'Sucesso!',
      'Registrado com sucesso, agora faça login.',
      'success'
    )

    router.push("/login")
  } catch (error) {
    errors.value = Object.entries(error.response.data.errors).flatMap(([field, messages]) =>
      messages.map(message => ({ field, message }))
    )
  } finally {
    isLoading.value = false
  }
}
</script>