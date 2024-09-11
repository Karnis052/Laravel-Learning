<template>
  <nav class="bg-green-700 border border-green-500 p-4">
    <div class="container mx-auto flex justify-between items-center">
      
        <div class="flex"> 
            <RouterLink to ="/" class="flex flex-shrink-0 items-center mr-4">
              <img class="h-8 w-auto" :src="logo" alt="Vue Jobs"/>
              <span class="hidde md:block text-white font-semibold text-2xl ml-2">Vue Jobs</span>
            </RouterLink>
        </div>

        <div class="text-white space-x-2"> 
            <RouterLink to="/"  :class="[ 
              isActiveLink('/') 
              ? 'bg-green-900'
              : 'hover:bg-gray-900',
              'px-3','py-2','rounded-md']"
            >
                Home
            </RouterLink>

            <RouterLink to="/jobs"  :class="[ 
              isActiveLink('/jobs') 
              ? 'bg-green-900'
              : 'hover:bg-gray-900',
              'px-3','py-2','rounded-md']"
            >
                Jobs
            </RouterLink>

            <RouterLink to="/jobs/add"  :class="[ 
              isActiveLink('/jobs/add') 
              ? 'bg-green-900'
              : 'hover:bg-gray-900',
              'px-3','py-2','rounded-md']"
            >
                Add Jobs
            </RouterLink>
        </div>
    </div>
  </nav>
</template>

<script setup>
import logo from '@/assets/img/logo.png'
import { RouterLink, useRoute } from 'vue-router';


const isActiveLink = (routePath)=>{
  const route = useRoute();
   return route.path === routePath;
}

</script>