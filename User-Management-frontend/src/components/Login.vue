<template>
<div class="max-w-md mx-auto mt-8">
    
    <form  @submit.prevent="handleLogin" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <h2 class="mb-6 text-center text-2xl font-bold text-gray-900">
        Sign in to your account
    </h2>
    <div class="rounded-md shadow-sm space-y-px">
        <div class="mb-4">
        <label for="email-address" class="sr-only">Email address</label>
        <input id="email-address" name="email" type="email" autocomplete="email" required
            v-model="form.email"
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Email address">
        </div>
        <div class="mb-4">
        <label for="password" class="sr-only">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required
            v-model="form.password"
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Password">
        </div>
    </div>

    <div>
        <button type="submit"
        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Sign in
        </button>
    </div>
    </form>
    <p v-if="errorMessage" class="mt-2 text-center text-sm text-red-600">
    {{ errorMessage }}
    </p>
</div>
 
</template>

<script setup>
import { ref, reactive } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const form = reactive({
  email: '',
  password: '',
});

const errorMessage = ref('');

const handleLogin = async () => {
  try {
    errorMessage.value = '';
    
    const response = await axios.post('http://127.0.0.1:8000/api/login/', form);
    
    if (response.data.token) {
      // Store the token in localStorage or a state management solution
      localStorage.setItem('authToken', response.data.token);
      console.log('User logged in:', response.data.user);
      // Redirect to a dashboard or home page
      router.push('/');
    }
  } catch (error) {
    if (error.response) {
      errorMessage.value = error.response.data.message || 'An error occurred during login';
    } else if (error.request) {
      errorMessage.value = 'No response from the server. Please try again later.';
    } else {
      errorMessage.value = 'An error occurred while setting up the request.';
    }
    console.error('Login error:', error);
  }
};
</script>

