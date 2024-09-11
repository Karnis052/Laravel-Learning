<template>
    <div>
        <Hero title="Test Title" subtitle = "Test Subtitle"/>
        <HomeCards/>
        <JobListings :limit="3" :showButton="true"/>
    </div>
</template>

<script setup>
import Hero from '@/components/Hero.vue';
import HomeCards from '@/components/HomeCards.vue';
import JobListings from '@/components/JobListings.vue';
</script>
