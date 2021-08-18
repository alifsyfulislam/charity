import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import(/* webpackChunkName: "home" */ '../views/Home')
    },
    {
        path: '/causes',
        name: 'Causes',
        component: () => import(/* webpackChunkName: "causes" */ '../views/Causes')
    },
    {
        path: '/gallery',
        name: 'Gallery',
        component: () => import(/* webpackChunkName: "gallery" */ '../views/Gallery')
    },
    {
        path: '/events',
        name: 'Events',
        component: () => import(/* webpackChunkName: "events" */ '../views/Events')
    },
    {
        path: '/contact',
        name: 'Contact',
        component: () => import(/* webpackChunkName: "contact" */ '../views/Contact')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
})

// router.beforeEach((to, from, next) => {
//     // to top
//     window.scrollTo(0, 0);
//     next();
// });


export default router
