import axios from "axios"

export const getAuthors = async () => {
  const token = localStorage.getItem("token")

  try {
    const response = await axios.get("http://localhost:80/api/authors", {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    return response.data
  } catch (error) {
    throw error
  }
}

export const deleteAuthor = async (id) => {
  const token = localStorage.getItem("token")

  try {
    const response = await axios.delete(`http://localhost:80/api/authors/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    return response.data
  } catch (error) {
    throw error
  }
}

export const getAuthorById = async (id) => {
  const token = localStorage.getItem("token")

  try {
    const response = await axios.get(`http://localhost:80/api/authors/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    return response.data
  } catch (error) {
    throw error
  }
}

export const updateAuthor = async (id, formData) => {
  const token = localStorage.getItem('token');

  return axios.post(`http://localhost:80/api/authors/${id}`, formData, {
    headers: {
      'Authorization': `Bearer ${token}`,
    }
  })
}

export const storeAuthor = async (formData) => {
  const token = localStorage.getItem('token');

  return axios.post(`http://localhost:80/api/authors/`, formData, {
    headers: {
      'Authorization': `Bearer ${token}`,
    }
  })
}