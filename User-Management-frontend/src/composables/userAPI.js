// useUserSearch.js
import { ref, watch } from 'vue'
import axios from 'axios'

export function useUserSearch() {
  const searchQuery = ref('')
  const users = ref([])
  const count = ref(0)
  const loading = ref(false)
  const error = ref(null)

  const searchUsers = async () => {
    if (searchQuery.value.length < 2) {
      users.value = []
      count.value = 0
      return
    }

    loading.value = true
    error.value = null

    try {
      const response = await axios.post('http://127.0.0.1:8000/api/searchByName', {
        name: searchQuery.value
      })
      users.value = response.data.data
      count.value = response.data.count
    } catch (err) {
      error.value = 'An error occurred while searching. Please try again.'
      console.error('Search error:', err)
      users.value = []
      count.value = 0
    } finally {
      loading.value = false
    }
  }

  const debounce = (fn, delay) => {
    let timeoutId
    return (...args) => {
      clearTimeout(timeoutId)
      timeoutId = setTimeout(() => fn(...args), delay)
    }
  }

  const debouncedSearch = debounce(() => {
    searchUsers()
  }, 300)

  watch(searchQuery, (newValue) => {
    if (newValue.length >= 2) {
      debouncedSearch()
    } else {
      users.value = []
      count.value = 0
    }
  })

  return {
    searchQuery,
    users,
    count,
    loading,
    error,
    searchUsers
  }
}