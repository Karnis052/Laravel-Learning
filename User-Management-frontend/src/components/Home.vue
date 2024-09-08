<template>
    <div class="mt-6">
        <h2 class="text-2xl font-bold mb-4">User List </h2>
        <ul v-if="users.length" class="space-y-2">
            <li v-for="user in users" :key="user.id" >
                <span class="font-semibold">{{ user.username }}</span> - 
                <span class="text-gray-600">{{ user.name}}</span> - 
                <span class="text-gray-600">{{ user.email}}</span>   
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



