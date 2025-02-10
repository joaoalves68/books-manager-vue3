import axios from "axios"

export const auth = async(email, password) => {
  return await axios.post("http://localhost:80/api/login", {
    email,
    password
  })
}

export const logout = () => {
  localStorage.removeItem('token')
}