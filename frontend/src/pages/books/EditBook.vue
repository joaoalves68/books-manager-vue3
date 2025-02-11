<template>
  <div class="container my-5">
    <h1>Editar Livro</h1>
    <h5 class="subtitle"><router-link to="/books">Voltar</router-link></h5>

    <div class="alert alert-danger" v-if="errors.length > 0">
      <ul class="mb-0">
          <li v-for="(error, index) in errors" :key="index">{{ error.message }}</li>
      </ul>
    </div>

    <form @submit.prevent="saveBook">
      <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" class="form-control" id="title" name="title" v-model="book.title" value="">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea class="form-control" id="description" name="description" v-model="book.description" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="published_at" class="form-label">Publicado em</label>
        <input type="date" class="form-control" id="published_at" name="published_at" v-model="book.published_at" value="">
      </div>
      <div class="mb-3">
        <label for="author_id" class="form-label">Autor</label>
        <select class="form-control" id="author_id" name="author_id" v-model="book.author_id">
          <option value="">Selecione</option>
          <option 
            v-for="author in authors" 
            :key="author.id" 
            :value="author.id"
            :selected="author.id === book.author_id">
            {{ author.name }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <label for="cover" class="form-label">Capa do Livro</label>
        <input type="file" class="form-control" id="cover" name="cover" @change="handleFileChange" accept="image/png, image/jpg">
      </div>
      <div class="mb-3">
        <div class="mb-3">
          <img 
            v-if="previewImage || book.cover"
            :src="previewImage || `http://localhost:80/storage/uploads/booksCover/${book.cover}`"
            alt="Pré-visualização da capa"
            id="preview-image"
            class="img-fluid"
          >
        </div>
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
import { ref, onMounted } from 'vue'
import { getBookById, updateBook, getAuthors } from '@/api'
import { useRoute, useRouter } from 'vue-router'
import Swal from 'sweetalert2'

const isLoading = ref(false)
const errors = ref([])
const book = ref({})
const authors = ref([])
const previewImage = ref("")

const route = useRoute()
const router = useRouter()
const bookId = route.params.id

onMounted(async () => {
  isLoading.value = true
  try {
    book.value = await getBookById(bookId)
  } catch (error) {
    router.push('/books')
  } finally {
    isLoading.value = false
  }
  
  authors.value = await getAuthors()
})

const handleFileChange = (event) => {
  const file = event.target.files[0]
  if(file) {
    book.value.cover = file
    previewImage.value = URL.createObjectURL(file)
  }
}

const saveBook = async () => {
  if (isLoading.value) return 

  isLoading.value = true

  const formData = new FormData()
  formData.append('title', book.value.title)
  formData.append('description', book.value.description)
  formData.append('published_at', book.value.published_at)
  formData.append('author_id', book.value.author_id)
  if (book.value.cover instanceof File) formData.append('cover', book.value.cover)
  formData.append('_method', 'PUT')

  try {
    await updateBook(bookId, formData)
    Swal.fire(
      'Sucesso!',
      'O livro foi atualizado com sucesso.',
      'success'
    )
  } catch (error) {
    errors.value = Object.entries(error.response.data.errors).flatMap(([field, messages]) =>
      messages.map(message => ({ field, message }))
    )
  }
  isLoading.value = false
}
</script>