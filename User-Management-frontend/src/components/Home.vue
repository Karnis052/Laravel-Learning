<!-- <template>
    <div class="mt-6">
        <h2 class="text-2xl font-bold mb-4">User List </h2>
        <ul v-if="users.length" class="space-y-2">
            <li v-for="user in users" :key="user.id" >
                <span class="font-semibold">{{ user.username }}</span> - 
                <span class="text-gray-600">{{ user.name}}</span> - 
                <span class="text-gray-600">{{ user.email}}</span>-  
                <span class="text-gray-700"> {{ user.department_id }}</span>
            </li>
        </ul>
        <p v-else-if="loading" class="text-gray-600">Loading User</p>
        <p v-else class="text-gray-600">User not found</p>
    </div>
</template>



<script setup>
import {ref, onMounted} from 'vue';
import axios from 'axios';
const users =  ref([]);
const loading = ref(true);

const fetchUsers = async()=>{
    try{
        const response = await axios.get('http://127.0.0.1:8000/api/users/');
        users.value = response.data
        console.log(users.value)

    }catch (error){
        console.error('Error fetching users:', error);
    }finally{
        loading.value = false;
    }
};

onMounted(() =>{
    fetchUsers();
});
</script>


 -->
 <template>
    <div class="mt-6">
      <h2 class="text-2xl font-bold mb-4">User List and Search</h2>
      
      <!-- Search Input -->
      <div class="mb-4">
        <input
          v-model="searchQuery"
          @input="handleSearch"
          type="text"
          placeholder="Search users by name"
          class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>
  
      <!-- Loading Indicator -->
      <p v-if="loading" class="text-gray-600">Loading users...</p>
  
      <!-- Error Message -->
      <p v-if="error" class="text-red-500">{{ error }}</p>
  
      <!-- User List / Search Results -->
      <ul v-if="displayedUsers.length > 0" class="space-y-2">
        <li v-for="user in displayedUsers" :key="user.id">
          <span class="font-semibold">{{ user.username }}</span> - 
          <span class="text-gray-600">{{ user.name }}</span> - 
          <span class="text-gray-600">{{ user.email }}</span> - 
          <span class="text-gray-700">{{ user.department_id }}</span>
        </li>
      </ul>
  
      <!-- No Results Message -->
      <p v-else-if="!loading && searchQuery.length > 0" class="text-gray-600">No users found matching your search.</p>
      <p v-else-if="!loading && allUsers.length === 0" class="text-gray-600">No users available.</p>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from 'vue';
  import axios from 'axios';
  import { useUserSearch } from '@/composables/useUserSearch';
  
  const allUsers = ref([]);
  const loading = ref(true);
  const error = ref(null);
  
  const { searchQuery, searchUsers, users: searchResults } = useUserSearch();
  
  const fetchAllUsers = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/users/');
      allUsers.value = response.data;
    } catch (error) {
      console.error('Error fetching users:', error);
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