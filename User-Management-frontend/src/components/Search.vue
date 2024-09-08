<template>
    <div class="max-w-2xl mx-auto p-6">
      <h2 class="text-2xl font-bold mb-4">User Search</h2>
      <div class="mb-4">
        <input
          v-model="searchQuery"
          @input="debouncedSearch"
          type="text"
          placeholder="Enter full name to search"
          class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>
      <div v-if="loading" class="text-center my-4">
        <p class="text-gray-600">Searching...</p>
      </div>
      <div v-if="error" class="text-center my-4">
        <p class="text-red-500">{{ error }}</p>
      </div>
      <div v-if="users.length > 0" class="mt-6">
        <h3 class="text-xl font-semibold mb-3">Results ({{ count }})</h3>
        <ul class="space-y-4">
          <li v-for="user in users" :key="user.username" class="border border-gray-200 rounded-md p-4 hover:bg-gray-50">
            <p class="font-bold text-lg">{{ user.name }}</p>
            <p class="text-gray-600">Username: {{ user.username }}</p>
            <p class="text-gray-600">Email: {{ user.email }}</p>
          </li>
        </ul>
      </div>
      <div v-else-if="!loading && searchQuery.length >= 2" class="text-center my-4">
        <p class="text-gray-600">No users found.</p>
      </div>
    </div>
  </template>

 
  
  <script setup>
  import { ref, watch } from 'vue'
  import axios from 'axios'
  
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
  
  // Watch for changes in searchQuery
  watch(searchQuery, (newValue) => {
    if (newValue.length >= 2) {
      debouncedSearch()
    } else {
      users.value = []
      count.value = 0
    }
  })
  </script>