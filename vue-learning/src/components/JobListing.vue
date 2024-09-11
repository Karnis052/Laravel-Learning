<template> 
<div class="shadow-md bg-white rounded-xl p-4">
    <div class="mb-4"> 
        <p class="text-gray-600">{{ job.type }}</p>
        <h3 class="text-xl font-bold"> {{ job.title }} </h3>
    </div>
  
    <div class="mb-4">
        <div>{{ truncatedDescription }}</div>
        <button @click="toggleDescription" class="text-green-500 hover:text-green-700 mb-4">
             {{ showFullDescription? "Less": "More"}}
        </button>
    </div>
   <h3 class="text-green-500 mb-2"> {{ job.salary }}/Year </h3>
   <div class="border border-gray-100 mb-4"> 
        <div class="flex flex-col lg:flex-row justify-between mb-4"> 
            <div class="text-orange-500 mb-2">
                <i class="pi pi-map-marker text-orange-700"></i> 
                {{ job.location }} 
            </div>
            <RouterLink
            :to="'/jobs/' + job.id"
            class="h-10 bg-green-500 text-white hover:bg-green-700 text-center text-sm rounded-lg px-4 py-2"
            > 
                Read More
            </RouterLink>
        </div>
   </div>
</div>



</template>

<script setup> 
import { defineProps, ref, computed} from 'vue';
import { RouterLink } from 'vue-router';

const props = defineProps({
    job: Object,
});


const showFullDescription = ref(false);

const toggleDescription = ()=>{
    showFullDescription.value = !showFullDescription.value;
}

const truncatedDescription = computed(() =>{
    let description = props.job.description;
    if(!showFullDescription.value){
        description = description.substring(0, 90) + '...';
    }
    return description;
});


</script>