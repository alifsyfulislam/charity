<template>
    <div id="app">
        <Header/>
        <router-view/>
        <Footer/>
    </div>
</template>

<script>
    import Header from './components/layouts/Header'
    import Footer from './components/layouts/Footer'

    export default {
        name : 'App',
        components:{
            Header,
            Footer
        },
        watch: {
            '$route' (to, from) {
                document.title = to.meta.title || 'Charity'
            }
        },
    }
</script>

<style>

</style>
