<template>
  <div class="container my-5">
    <h1>Lista de Livros</h1>
    <h5 class="subtitle"><router-link to="/books/register">Cadastrar novo</router-link></h5>

    <table class="table">
      <thead>
        <tr>
          <th>Título</th>
          <th>Descrição</th>
          <th>Publicado em</th>
          <th>Autor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in paginatedBooks" :key="book.id">
          <td>{{ book.title }}</td>
          <td class="text-truncate">{{ book.description }}</td>
          <td>{{ formatDate(book.published_at) }}</td>
          <td>{{ book.author_name }}</td>
          <td class="d-flex justify-content-end">
            <router-link
              class="btn btn-secondary btn-sm me-2"
              :to="`/books/edit/${book.id}`"
            >
              Editar
            </router-link>
            <button 
              type="button" 
              class="btn btn-danger btn-sm" 
              @click="confirmDelete(book.id)">
              Excluir
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="isLoading" class="loader-container">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only"></span>
      </div>
    </div>

    <Pagination 
      :currentPage="currentPage"
      :totalItems="books.length"
      :itemsPerPage="itemsPerPage"
      @update:currentPage="updateCurrentPage"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { getBooks, deleteBook } from '@/api'
import Pagination from '@/components/Pagination.vue'
import Swal from 'sweetalert2'

const books = ref([])
const currentPage = ref(1)
const itemsPerPage = ref(10)
const isLoading = ref(false)

const paginatedBooks = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  return books.value.slice(start, start + itemsPerPage.value)
})

onMounted(async () => {
  books.value = await getBooks()
})

const updateCurrentPage = (page) => {
  currentPage.value = page
}

const confirmDelete = async (id) => {
  const confirm = await Swal.fire({
    title: 'Você tem certeza que deseja excluir o livro?',
    text: "Essa ação não pode ser revertida.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sim',
    cancelButtonText: 'Cancelar',
  })

  if (confirm) {
    isLoading.value = true
    try {
      await deleteBook(id)
      books.value = books.value.filter(book => book.id !== id)
      Swal.fire(
        'Deletado!',
        'O livro foi excluído com sucesso.',
        'success'
      )
    } catch (error) {
      console.error("Erro ao excluir livro:", error)
    } finally {
      isLoading.value = false
    }
  }
}

const formatDate = (date) => {
  if (!date) return ""
  return date.split("-").reverse().join("/")
}
</script>