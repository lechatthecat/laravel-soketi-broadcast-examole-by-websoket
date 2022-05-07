import Home from './components/Home.vue';
import Home2 from './components/Home2.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'home2',
        path: '/home2',
        component: Home2
    },
];
