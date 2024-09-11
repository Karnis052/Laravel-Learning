<template>
    <section class="py-4">
        <div class="container-xl lg:container m-auto grid grid-cols-1 md:grid-cols-2 p-4 gap-8 rounded-lg">
            <Card> 
                <h2 class="text-2xl font-bold">  
                    For Developer
                </h2>
                <p class="mt-2 mb-4">Browse our vue jobs and start your dream job here</p>
                <RouterLink 
                    to ="/jobs"
                    class="inline-block bg-black text-white rounded-md px-3 py-2 hover:bg-gray-700"
                    >
                    Browse Jobs
                </RouterLink>
            </Card>
            <Card bg="bg-green-100"> 
                <h2 class="text-2xl font-bold">  
                    For Employers
                </h2>
                <p class="mt-2 mb-4">List your jobs to find perfect developer for the role</p>
                <RouterLink 
                    to="/jobs/add"
                    class="inline-block bg-black text-white rounded-md px-3 py-2 hover:bg-gray-700"
                    >
                    Browse Jobs
                </RouterLink>
            </Card>
        </div>
    </section>
</template>

<script setup>
import Card from './Card.vue';
import { RouterLink } from 'vue-router';

</script>