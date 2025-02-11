<template>
  <div class="container my-5">
    <h1>Cadastrar Autor</h1>
    <h5 class="subtitle"><router-link to="/authors">Voltar</router-link></h5>

    <div class="alert alert-danger" v-if="errors.length > 0">
      <ul class="mb-0">
          <li v-for="(error, index) in errors" :key="index">{{ error.message }}</li>
      </ul>
    </div>

    <form @submit.prevent="saveAuthor">
      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" v-model="author.name" value="">
      </div>
      <div class="mb-3">
        <label for="state" class="form-label">Estado</label>
        <input type="text" class="form-control" id="state" name="state" v-model="author.state" value="">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <div v-if="isLoading" class="loader-container">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only"></span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { storeAuthor } from '@/api'
import { useRouter } from 'vue-router'
import Swal from 'sweetalert2'

const isLoading = ref(false)
const errors = ref([])
const author = ref({
  name: "",
  state: "",
})

const router = useRouter()

const saveAuthor = async () => {
  if (isLoading.value) return 

  isLoading.value = true

  const formData = new FormData()
  formData.append('name', author.value.name)
  formData.append('state', author.value.state)

  try {
    const response = await storeAuthor(formData)
    Swal.fire(
      'Sucesso!',
      'O autor foi cadastrado com sucesso.',
      'success'
    )

    router.push("/authors")
  } catch (error) {
    errors.value = Object.entries(error.response.data.errors).flatMap(([field, messages]) =>
      messages.map(message => ({ field, message }))
    )
  } finally {
    isLoading.value = false
  }
}
</script>