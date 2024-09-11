<template>
    
    <section class="bg-green-700 py-20 mb-4">
        <div class="text-center"> 
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl md:text-5xl">
               {{ title }}
            </h1>
            <p class="text-white my-4 text-xl font-light">
               {{ subtitle }}
            </p>
        </div>
    </section>
</template>

<script setup>

import { defineProps } from 'vue';

defineProps({
    title:{
        type:String,
        default: 'Become a web Developer'
    },
    subtitle:{
        type:String,
        default: ' Find the Vue Jobs that fits your skills and need'
    }

});

</script>
