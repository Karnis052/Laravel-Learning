<template>
    <section class="flex flex-col items-center justify-center text-center mt-10">
        <i class="pi pi-exclamation-triangle text-7xl text-orange-500 mb-6"></i>       
        <h1 class="text-3xl font-bold mb-4">404 Not Found</h1>
        <p class="mb-4">This page does not exist</p>
        <RouterLink
        to="/"
        class="bg-green-700 text-white hover:bg-green-900 rounded-md px-4 py-2"
        >
        Go Back 
        </RouterLink>
    </section>  
</template>

<script setup>
import { RouterLink } from 'vue-router';
</script>
