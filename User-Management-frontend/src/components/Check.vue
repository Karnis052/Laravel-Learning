<template>
  <div class="mt-1">
    <h2 class="text-2xl font-bold mb-4">User List and Search</h2>
    <div class="mb-4"> 
      <input
        v-model="searchQuery"
        @input="handleSearch"
        type="text"
        placeholder="Search users by name"
        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
    </div>

    <p v-if="loading" class="text-gray-600">Loading users....</p>
    <p v-if="error" class="text-red-500">{{ error }}</p>

    <ul v-if="displayedUsers.length > 0" class="space-y-2">
      <li v-for="user in displayedUsers" :key="user.id">
        <span class="font-semibold">{{ user.username }}</span> -
        <span class="text-gray-600">{{ user.name }}</span> -
        <span class="text-gray-600">{{ user.email }}</span> -
        <span class="text-gray-600">{{ user.department?.name || 'No Department' }}</span>
      </li>
    </ul>  
    <p v-else-if="!loading && searchQuery.length > 0" class="text-gray-600">No user found matching your search</p>
    <p v-else-if="!loading && allUsers.length === 0" class="text-gray-600">No users available</p>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios';
import { useUserSearch } from '@/composables/useUserSearch'; 

const allUsers = ref([]);
const loading = ref(true);
const error = ref(null);

const { searchQuery, users: searchResults, searchUsers } = useUserSearch();

const fetchAllUsers = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/users/');
      allUsers.value = response.data;
    } catch (err) {
      console.error('Error fetching users', err);
      error.value = 'Error fetching users. Please try again later.';
    } finally {
      loading.value = false;
    }
};

onMounted(() => {
  fetchAllUsers();
});

const handleSearch = () => {
  if (searchQuery.value.length >= 2) {
    searchUsers();
  }
};

const displayedUsers = computed(() => {
  if (searchQuery.value.length === 0) {
    return allUsers.value;
  } else if (searchQuery.value.length < 2) {
    return [];
  } else {
    return searchResults.value;
  }
});
</script>