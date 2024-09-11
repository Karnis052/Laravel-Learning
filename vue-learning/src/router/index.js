import { createRouter, createWebHashHistory } from 'vue-router';
import HomeView from '@/views/HomeView.vue';
import JobsView from '@/views/JobsView.vue';
import NotFoundView from '@/views/NotFoundView.vue';

const router = createRouter({
    history: createWebHashHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: HomeView
        },
        {
            path:'/jobs',
            name: 'Jobs',
            component: JobsView
        },
        {
            path: '/:catchAll(.*)', 
            name: 'Not-Found',
            component: NotFoundView
        },
    ]
});

export default router;