import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import(/* webpackChunkName: "home" */ '../views/Home'),
        meta:{
            title : 'Charity'
        }
    },
    {
        path: '/causes',
        name: 'Causes',
        component: () => import(/* webpackChunkName: "causes" */ '../views/Causes'),
        meta:{
            title : 'Causes'
        }
    },
    {
        path: '/cause-details/:slug',
        name: 'CauseDetails',
        component: () => import(/* webpackChunkName: "causedetails" */ '../views/CauseDetails'),
        meta:{
            title : 'Causes Details'
        }
    },
    {
        path: '/gallery',
        name: 'Gallery',
        component: () => import(/* webpackChunkName: "gallery" */ '../views/Gallery'),
        meta:{
            title : 'Gallery'
        }
    },
    {
        path: '/events',
        name: 'Events',
        component: () => import(/* webpackChunkName: "events" */ '../views/Events'),
        meta:{
            title : 'Events'
        }
    },
    {
        path: '/contact',
        name: 'Contact',
        component: () => import(/* webpackChunkName: "contact" */ '../views/Contact'),
        meta:{
            title : 'Contact'
        }
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

export default router
