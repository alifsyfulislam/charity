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
                                        <li :class="menuSelection == 1 ? 'current-menu-item' : ''" @click="menuLiActive(1)">
                                            <router-link :to="{ name: 'Home'}">
                                                Home
                                            </router-link>
                                        </li>
                                        <li :class="menuSelection == 2 ? 'current-menu-item' : ''" @click="menuLiActive(2)">
                                            <router-link :to="{ name: 'Causes'}">
                                                Causes
                                            </router-link>
                                        </li>
                                        <li :class="menuSelection == 3 ? 'current-menu-item' : ''" @click="menuLiActive(3)">
                                            <router-link :to="{ name: 'Gallery'}">
                                                Gallery
                                            </router-link>
                                        </li>
                                        <li :class="menuSelection == 4 ? 'current-menu-item' : ''" @click="menuLiActive(4)">
                                            <router-link :to="{ name: 'Events'}">
                                            Events
                                        </router-link>
                                        </li>
                                        <li><a href="#">Contact</a></li>
                                        <li><a href="#" class="menu-btn btn gradient-bg-2 mr-2">Donate Now</a></li>
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

        <div class="totop">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </div>
    </div>
</template>

<script>
    import $ from 'jquery'

    $(window).scroll(function() {
        let scroll = $(window).scrollTop();
        // Scroll to top
        if (scroll) {
            $('.header').addClass('fixed-header');
        } else {
            $('.header').removeClass('fixed-header');
        }

        if (scroll > 250) {
            $('.totop').css('bottom', '60px');
        } else {
            $('.totop').css('bottom', '-50px');
        }
    });

    $(document).on('click', '.totop', function(){
        $('html,body').animate({
            scrollTop: 0
        }, 1000);
    });

    import { VueScrollFixedNavbar } from "vue-scroll-fixed-navbar";
    export default {
        name: "Header",

        components:{
            VueScrollFixedNavbar
        },

        data(){
            return{
                menuSwitch : false,
                menuSelection : 1
            }
        },

        methods: {
            openResponsiveMenu(){
                let _that = this;
                _that.menuSwitch = !_that.menuSwitch
            },
            menuLiActive(item){
                console.log(item)
                let _that = this;
                _that.menuSelection = item
            }
        },

        created() {

        }
    }
</script>

<style>
    header.site-header {
        background: white;
        box-shadow: 0 0.25rem 0.25rem rgb(139 139 139 / 89%), inset 0 -1px 5px rgb(219 219 219 / 50%);
    }
    a.menu-btn {
        width: 150px;
    }

    a.menu-btn:hover{
        color: #ffffff;
        height: auto;
    }
    .gradient-bg-2 {
        border-radius: 24px;
        border-color: transparent;
        background: -moz-linear-gradient(180deg, rgba(255, 90, 0, 1) 0%, rgba(255, 54, 0, 1) 100%);
        background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 90, 0, 1)), color-stop(100%, rgba(1255, 54, 0, 1)));
        background: -webkit-linear-gradient(180deg, rgba(255, 90, 0, 1) 0%, rgba(255, 54, 0, 1) 100%);
        background: -o-linear-gradient(180deg, rgba(255, 90, 0, 1) 0%, rgba(255, 54, 0, 1) 100%);
        background: -ms-linear-gradient(180deg, rgba(255, 90, 0, 1) 0%, rgba(255, 54, 0, 1) 100%);
        background: linear-gradient(270deg, rgba(255, 90, 0, 1) 0%, rgba(255, 54, 0, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5a00', endColorstr='#ff3600', GradientType=1);
        color: #fff !important;
    }
    .btn:focus, .btn.focus {
        outline: 0;
        box-shadow: none!important;
    }
    .totop {
        position: fixed;
        bottom: -55px;
        right: 10px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        /*background: #2E9EDF;*/
        background : linear-gradient(270deg, rgba(255, 90, 0, 1) 0%, hsl(13deg 100% 50%) 100%);
        color: #fff;
        text-align: center;
        cursor: pointer;
        font-size: 25px;
        line-height: 35px;
        box-shadow: 0 0 5px rgba(255,255,255,0.3);
        transition: all 0.4s;
        z-index: 999;
    }

    .totop:hover {
        color: #fff;
        background: linear-gradient(270deg, rgba(255, 90, 0, 1) 0%, hsl(13deg 100% 50%) 100%);;
    }

    .totop:hover i {
        animation: toTopFromBottom 0.3s forwards;
    }

    @keyframes toTopFromBottom {
        49% {
            transform: translateY(-100%);
        }
        50% {
            opacity: 0;
            transform: translateY(100%);
        }
        51% {
            opacity: 1;
        }
    }

</style>
