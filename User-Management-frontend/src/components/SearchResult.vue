<template>
    <div>
        <div v-if="error" class=" p-4 text-red-500">  
            {{ error }}
        </div>
        <ul v-else class="max-h-60 overflow-auto">
            <li v-for="user in users" :key="user.username" class="border-gray-200 last:border-b-0"> 
                <div class="hover:bg-gray-50 p-4"> 
                    <p class="font-bold">  {{ user.name }}</p>
                    <p class="text-sm  text-gray-600"> {{ user.username }} | {{ user.email }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>



<script setup>
defineProps({
    users:{
        type: Array,
        required: true
    },
    error:{
        type: String,
        default: null
    }
})
</script>