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
        }
    }
</script>

<style>

</style>
