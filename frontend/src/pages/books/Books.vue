<template>
  <div class="container my-5">
    <h1>Lista de Livros</h1>
    <h5 class="subtitle"><a href="">Cadastrar novo</a></h5>

    <!-- @if(session('success'))
      <div class="alert alert-success" id="success-message">
        {{ session('success') }}
      </div>
    @endif -->

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
        <tr v-for="livro in livros" :key="livro.id">
          <td>{{ livro.titulo }}</td>
          <td class="text-truncate">{{ livro.descricao }}</td>
          <td>{{ livro.publicado_em }}</td>
          <td>{{ livro.autor }}</td>
          <td class="d-flex justify-content-end">
            <a class="btn btn-secondary btn-sm me-2">Editar</a>
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que deseja excluir este livro?')">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getBooks } from "@/api"

const livros = ref([])

onMounted(async () => {
  console.log(getBooks())
})
</script>
