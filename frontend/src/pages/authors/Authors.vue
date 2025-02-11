<template>
  <div class="container my-5">
    <h1>Lista de Autores</h1>
    <h5 class="subtitle"><router-link to="/authors/register">Cadastrar novo</router-link></h5>

    <table class="table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="author in paginatedAuthors" :key="author.id">
          <td>{{ author.name }}</td>
          <td>{{ author.state }}</td>
          <td class="d-flex justify-content-end">
            <router-link
              class="btn btn-secondary btn-sm me-2"
              :to="`/authors/edit/${author.id}`"
            >
              Editar
            </router-link>
            <button 
              type="button" 
              class="btn btn-danger btn-sm" 
              @click="confirmDelete(author.id)">
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
      :totalItems="authors.length"
      :itemsPerPage="itemsPerPage"
      @update:currentPage="updateCurrentPage"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { getAuthors, deleteAuthor } from '@/api'
import Pagination from '@/components/Pagination.vue'
import Swal from 'sweetalert2'

const authors = ref([])
const currentPage = ref(1)
const itemsPerPage = ref(10)
const isLoading = ref(false)

const paginatedAuthors = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  return authors.value.slice(start, start + itemsPerPage.value)
})

onMounted(async () => {
  authors.value = await getAuthors()
})

const updateCurrentPage = (page) => {
  currentPage.value = page
}

const confirmDelete = async (id) => {
  const confirm = await Swal.fire({
    title: 'Você tem certeza que deseja excluir esse autor?',
    text: "Essa ação não pode ser revertida.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sim',
    cancelButtonText: 'Cancelar',
  })

  if (confirm.isConfirmed) {
    isLoading.value = true
    try {
      await deleteAuthor(id)
      authors.value = authors.value.filter(author => author.id !== id)
      Swal.fire(
        'Deletado!',
        'O autor foi excluído com sucesso.',
        'success'
      )
    } catch (error) {
      Swal.fire(
        'Erro!',
        error.response.data.message,
        'error'
      )
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