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
        <input type="text" class="form-control" id="title" name="title" v-model="title" value="">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea class="form-control" id="description" name="description" v-model="description" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="published_at" class="form-label">Publicado em</label>
        <input type="date" class="form-control" id="published_at" name="published_at" v-model="published_at" value="">
      </div>
      <div class="mb-3">
        <label for="author_id" class="form-label">Autor</label>
        <select class="form-control" id="author_id" name="author_id" v-model="author_id">
          <option value="">Selecione</option>
            <option ></option>
        </select>
      </div>
      <div class="mb-3">
        <label for="cover" class="form-label">Capa do Livro</label>
        <input type="file" class="form-control" id="cover" name="cover" @change="handleFileChange" accept="image/png, image/jpg">
      </div>
      <div class="mb-3">
        <img v-if="previewImage" :src="previewImage" alt="Pré-visualização da capa" id="preview-image" class="img-fluid">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getBookById, updateBook } from '@/api'
import { useRoute } from 'vue-router'
import Swal from 'sweetalert2'
import axios from 'axios'

const isLoading = ref(false)

const title = ref("")
const description = ref("")
const published_at = ref("")
const author_id = ref("")
const cover = ref(null)
const previewImage = ref(null)
const errors = ref([])

const route = useRoute()
const bookId = route.params.id

onMounted(async () => {
  isLoading.value = true
  try {
    const book = await getBookById(bookId)

    title.value = book.title
    description.value = book.description
    published_at.value = book.published_at
    author_id.value = book.author_id
    author_id.value = book.author_id
    previewImage.value = `http://localhost/storage/uploads/booksCover/${book.cover}`
  } catch (error) {
    console.error("Erro ao buscar o livro:", error)
  } finally {
    isLoading.value = false
  }
})

const handleFileChange = (event) => {
  const file = event.target.files[0]
  cover.value = file
  previewImage.value = URL.createObjectURL(file)
}

const saveBook = async () => {
  if (isLoading.value) return 

  const formData = new FormData()
  formData.append('title', 'Nome do Livro')
  formData.append('description', 'Descrição do livro')
  formData.append('published_at', '2025-02-10')
  formData.append('author_id', 1)

  const updatedBook = updateBook(bookId, formData)
}
</script>