<template>
  <nav class="d-flex justify-content-center">
    <ul class="pagination">
      <li class="page-item" :class="{ disabled: currentPage === 1 }">
        <a class="page-link" href="#" @click.prevent="prevPage">Anterior</a>
      </li>
      <li 
        class="page-item" 
        v-for="page in totalPages" 
        :key="page" 
        :class="{ active: currentPage === page }">
        <a class="page-link" href="#" @click.prevent="goToPage(page)">{{ page }}</a>
      </li>
      <li class="page-item" :class="{ disabled: currentPage === totalPages }">
        <a class="page-link" href="#" @click.prevent="nextPage">Próximo</a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  currentPage: {
    type: Number,
    required: true
  },
  totalItems: {
    type: Number,
    required: true
  },
  itemsPerPage: {
    type: Number,
    required: true
  }
})

const emit = defineEmits(['update:currentPage'])

const totalPages = computed(() => {
  return Math.ceil(props.totalItems / props.itemsPerPage)
})

const goToPage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    emit('update:currentPage', page)
  }
}

const nextPage = () => {
  if (props.currentPage < totalPages.value) {
    emit('update:currentPage', props.currentPage + 1)
  }
}

const prevPage = () => {
  if (props.currentPage > 1) {
    emit('update:currentPage', props.currentPage - 1)
  }
}
</script>
