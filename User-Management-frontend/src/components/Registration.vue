<template>
  <div class="max-w-md mx-auto mt-8">
    <form @submit.prevent="handleRegistration" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <h2 class="text-2xl font-bold mb-6 text-center">Create Account</h2>
      
      <div v-if="errorMessage" class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
        {{ errorMessage }}
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
          Username
        </label>
        <input 
          v-model="form.username" 
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          :class="{ 'border-red-500': errors.username }"
          id="username" 
          type="text" 
          placeholder="Username"
        >
        <p v-if="errors.username" class="text-red-500 text-xs italic">{{ errors.username[0] }}</p>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Name
        </label>
        <input 
          v-model="form.name" 
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          :class="{ 'border-red-500': errors.name }"
          id="name" 
          type="text" 
          placeholder="Full Name"
        >
        <p v-if="errors.name" class="text-red-500 text-xs italic">{{ errors.name[0] }}</p>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
          Email
        </label>
        <input 
          v-model="form.email" 
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          :class="{ 'border-red-500': errors.email }"
          id="email" 
          type="email" 
          placeholder="Email"
        >
        <p v-if="errors.email" class="text-red-500 text-xs italic">{{ errors.email[0] }}</p>
      </div>
      
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input 
          v-model="form.password" 
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
          :class="{ 'border-red-500': errors.password }"
          id="password" 
          type="password" 
          placeholder="******"
        >
        <p v-if="errors.password" class="text-red-500 text-xs italic">{{ errors.password[0] }}</p>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="department">
            Department
        </label>
        <select
            v-model="form.department_id" 
            class="shadow appearance-none border rounded w-full px-2 py-2 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            :class="{ 'border-red-500': errors.department_id }"
            id ='department'
        >
            <option value="">Select a Department</option>
            <option v-for="dept in departments" :key="dept.id" :value="dept.id">
              {{ dept.name }}
            </option>

        </select>

      </div>
      
      <div class="flex items-center justify-between">
        <button 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
          type="submit"
        >
          Sign Up
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const form = reactive({
  username: '',
  name: '',
  email: '',
  password: '',
  department_id: '',
});

const errors = reactive({});
const errorMessage = ref('');
const departments = ref([])

onMounted(async() => {
  try{
    const response = await axios.get('http://127.0.0.1:8000/api/departments/')
    departments.value = response.data;
  }catch(error){
    errorMessage.value = 'Failed to load departments. Please try again later.';
  }

});

const handleRegistration = async () => {
  try {
    Object.keys(errors).forEach(key => delete errors[key]);
    errorMessage.value = '';
    
    const response = await axios.post('http://127.0.0.1:8000/api/users', form);
    
    if (response.data.user) {
      console.log('User registered:', response.data.user);
      router.push('/login');
    }
  } catch (error) {
    if (error.response) {
      if (error.response.status === 422) {
        const responseErrors = error.response.data.errors;
        Object.keys(responseErrors).forEach(key => {
          errors[key] = responseErrors[key];
        });
        errorMessage.value = 'Please correct the errors below.';
      } else {
        errorMessage.value = error.response.data.message || 'An unexpected error occurred';
      }
    } else if (error.request) {
      errorMessage.value = 'No response from the server. Please try again later.';
    } else {
      errorMessage.value = 'An error occurred while setting up the request.';
    }
    console.error('Registration error:', error);
  }
};
</script>