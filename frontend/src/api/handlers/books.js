import axios from "axios"

export const getBooks = async () => {
  const token = localStorage.getItem("token")

  try {
    const response = await axios.get("http://localhost:80/api/books", {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    return response.data
  } catch (error) {
    console.error("Erro ao buscar por livros:", error)
    throw error
  }
}

export const deleteBook = async (id) => {
  const token = localStorage.getItem("token")

  try {
    const response = await axios.delete(`http://localhost:80/api/books/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    return response.data
  } catch (error) {
    console.error("Erro ao deletar livro:", error)
    throw error
  }
}

export const getBookById = async (id) => {
  const token = localStorage.getItem("token")

  try {
    const response = await axios.get(`http://localhost:80/api/books/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    return response.data
  } catch (error) {
    console.error("Erro ao buscar livro:", error)
    throw error
  }
}

export const updateBook = async (id, formData) => {
  const token = localStorage.getItem('token');

  return axios.post(`http://localhost:80/api/books/${id}`, formData, {
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'multipart/form-data',
    }
  })
}

export const storeBook = async (formData) => {
  const token = localStorage.getItem('token');

  return axios.post(`http://localhost:80/api/books/`, formData, {
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'multipart/form-data',
    }
  })
}