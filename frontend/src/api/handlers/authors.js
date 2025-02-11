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
    console.error("Erro ao buscar por autores:", error)
    throw error
  }
}