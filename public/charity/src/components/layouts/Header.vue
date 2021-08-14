<template>
    <div>
        <VueScrollFixedNavbar>
            <header class="site-header">
                <div class="nav-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="site-branding d-flex align-items-center">
                                    <router-link class="d-block" :to="{ name: 'Home'}" rel="home">
                                        <img class="d-block" src="../../assets/images/xfoot-logo.png.pagespeed.ic.QzKNgHQNJQ.png" alt="logo">
                                    </router-link>
                                </div>
                                <nav class="site-navigation d-flex justify-content-end align-items-center" :class="menuSwitch ? 'show' : ''">
                                    <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                        <li class="current-menu-item"><a href="#">Home</a></li>
                                        <li><a href="#">Causes</a></li>
                                        <li><a href="#">Gallery</a></li>
                                        <li><a href="#">Events</a></li>
                                        <li><a href="#">Contact</a></li>
                                        <li><a href="#" class="menu-btn btn gradient-bg mr-2">Donate Now</a></li>
                                    </ul>
                                </nav>
                                <div class="hamburger-menu d-lg-none" :class="menuSwitch ? 'open' : ''" @click="openResponsiveMenu">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </VueScrollFixedNavbar>
    </div>
</template>

<script>
    import { VueScrollFixedNavbar } from "vue-scroll-fixed-navbar";
    export default {
        name: "Header",

        components:{
            VueScrollFixedNavbar
        },

        data(){
            return{
                menuSwitch : false
            }
        },

        methods: {
            openResponsiveMenu(){
                let _that = this;
                _that.menuSwitch = !_that.menuSwitch
            }
        },

        created() {

        }
    }
</script>

<style scoped>
    header.site-header {
        background: white;
        box-shadow: 0 0.25rem 0.25rem rgb(139 139 139 / 89%), inset 0 -1px 5px rgb(219 219 219 / 50%);
    }
    a.menu-btn {
        padding: 12px 20px 12px;
        margin-top: 4px;
        width: 150px;
    }
</style>
