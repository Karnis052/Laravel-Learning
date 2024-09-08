<!-- <template>
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-white text-xl font-bold">My App</a>
            <a href="/searchByName" class="text-white text-xl font-bold">Search</a>
            <div> 
                <a href ="/register" class="text-white mr-4 hover:text-gray-300">Register</a>
                <a href="/login" class="text-white hover:text-gray-300">Login</a>
            </div>
        </div>
    </nav>
</template>

<script setup>

</script> -->


<template>
    <nav class="bg-gray-800 p-4">
      <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-white text-xl font-bold">My App</a>
        <!-- <div class="relative flex-grow max-w-xl mx-4"> 
            <input 
            v-model="searchQuery"
            type="text"
            placeholder="Search user by name"
            class="w-full p-2 pr-10 border border-gray-300 rounded-md focus:outline-none foucs:ring-2 focus:rign-blue-500 bg-white text-gray-900"
            />
            <div v-if="loading" class="absolute right-3 top-2">
                <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
               </svg>
            </div>
            <SearchResult 
              v-if="users.length>0 ||(error && searchQuery>=2)"
              :users="users"
              :error="error"
            />
        </div> -->
        <div> 
          <a href="/register" class="text-white mr-4 hover:text-gray-300">Register</a>
          <a href="/login" class="text-white hover:text-gray-300">Login</a>
        </div>
      </div>
    </nav>
  </template>
  
<script setup>
import { useUserSearch } from '@/composables/useUserSearch';
// import SearchResult from './SearchResult.vue';
   const { searchQuery, users, loading, error } = useUserSearch()
</script>