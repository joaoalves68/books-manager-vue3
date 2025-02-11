import axios from "axios"

export const auth = async(email, password) => {
  return await axios.post("http://localhost:80/api/login", {
    email,
    password
  })
}

export const register = async (formData) => {
  return axios.post(`http://localhost:80/api/register/`, formData)
}

export const logout = () => {
  localStorage.removeItem('token')
}