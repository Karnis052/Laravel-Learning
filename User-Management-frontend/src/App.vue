<script setup>
import Navbar from './components/Navbar.vue';
</script>

<template> 
    <div class="min-h-screen bg-gray-100">
        <Navbar/>
        <div class="container mx-auto px-4">
            <router-view></router-view>
        </div>
    </div>
</template>


 