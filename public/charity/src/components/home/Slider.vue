<template>
    <div>
        <div class="owl-slider hero-content-wrap">
            <carousel
                    :items="1"
                    :interval="7000"
                    :dots="false"
                    :nav="true"
                    :loop="true"
                    :autoplay="true"
                    :navText="[
                                    `<i class='fas fa-chevron-left slider-icon' aria-hidden='true'></i>`,
                                    `<i class='fas fa-chevron-right slider-icon' aria-hidden='true'></i>`,
                                ]"
            >
                <div
                        class="carousel-item-slug"
                        :style="{
              backgroundImage:
                'url(' + require('../../assets/images/xhero.jpg.pagespeed.ic.UlXoS3GVLR.jpg') + ')',
            }"
                >
                    <div class="carousel-static">
                        <div class="hero-content-overlay position-absolute w-100 h-100">
                            <div class="container h-100">
                                <div class="row h-100">
                                    <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-start">
                                        <header class="entry-header">
                                            <h1>Donate</h1>
                                            <h4>4 a better world</h4>
                                        </header>
                                        <div class="entry-content mt-4">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestibulum mauris quis aliquam. Integer accumsan sodales odio, id tempus ullamcorper</p>
                                        </div>
                                        <footer class="entry-footer d-flex flex-wrap align-items-center mt-5">
                                            <a href="#" class="btn gradient-bg mr-2">Donate Now</a>
                                            <a href="#" class="btn orange-border">Read More</a>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                        class="carousel-item-slug"
                        :style="{
              backgroundImage:
                'url(' + require('../../assets/images/xhero.jpg.pagespeed.ic.UlXoS3GVLR.jpg') + ')',
            }"
                >
                    <div class="carousel-static">
                        <div class="hero-content-overlay position-absolute w-100 h-100">
                            <div class="container h-100">
                                <div class="row h-100">
                                    <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-start">
                                        <header class="entry-header">
                                            <h1>Donate</h1>
                                            <h4>4 a better world</h4>
                                        </header>
                                        <div class="entry-content mt-4">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestibulum mauris quis aliquam. Integer accumsan sodales odio, id tempus ullamcorper</p>
                                        </div>
                                        <footer class="entry-footer d-flex flex-wrap align-items-center mt-5">
                                            <a href="#" class="btn gradient-bg mr-2">Donate Now</a>
                                            <a href="#" class="btn orange-border">Read More</a>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </carousel>
        </div>
    </div>
</template>

<script>
    import carousel from "vue-owl-carousel";
    export default {
        name: "Slider",

        components:{
            carousel,
        },

        data(){
          return{
              slide: 0,
              sliding: null
          }
        },

        methods : {
            onSlideStart(slide) {
                this.sliding = true
            },
            onSlideEnd(slide) {
                this.sliding = false
            }
        }
    }
</script>

<style>
    .fa-chevron-right:before {
        margin: 17px 24px;
        color: #ffffff;
        font-size: 25px;
        position: absolute;
    }
    .fa-chevron-left:before {
        margin: 17px 22px;
        color: #ffffff;
        font-size: 25px;
        position: absolute;
    }
    i.fas.fa-chevron-right.slider-icon {

        width: 60px;
        height: 60px;
        /* margin-top: -35px; */
        border-radius: 50%;
        background: linear-gradient(
                270deg
                ,rgba(255,90,0,1) 0%,rgba(255,54,0,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff5a00', endColorstr='#ff3600',GradientType=1 );
        transition: all .35s;
        position: relative;
        margin: auto;
        z-index: 10;
        cursor: pointer;
        right: 15px;
        bottom: 50%;
    }
    i.fas.fa-chevron-left.slider-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: -moz-linear-gradient(180deg,rgba(255,90,0,1) 0%,rgba(255,54,0,1) 100%);
        background: -webkit-gradient(linear,left top,right top,color-stop(0%,rgba(255,90,0,1)),color-stop(100%,rgba(1255,54,0,1)));
        background: -webkit-linear-gradient(
                180deg
                ,rgba(255,90,0,1) 0%,rgba(255,54,0,1) 100%);
        background: -o-linear-gradient(180deg,rgba(255,90,0,1) 0%,rgba(255,54,0,1) 100%);
        background: -ms-linear-gradient(180deg,rgba(255,90,0,1) 0%,rgba(255,54,0,1) 100%);
        background: linear-gradient(
                270deg
                ,rgba(255,90,0,1) 0%,rgba(255,54,0,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff5a00', endColorstr='#ff3600',GradientType=1 );
        transition: all .35s;

        position: relative;
        bottom: 50%;
        z-index: 10;
        cursor: pointer;
        left: 15px;
    }
    .owl-theme .owl-nav [class*="owl-"] {
        color: #666;
    }
    .owl-theme .owl-nav [class*="owl-"]:hover {
        color: #ffffff;
    }
    .owl-slider .owl-carousel .owl-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        text-align: inherit;
        padding: 0 10px;
    }
    .owl-slider .owl-carousel .owl-nav .owl-prev,
    .owl-slider .owl-carousel .owl-nav .owl-next {
        background: transparent;
        font-weight: bold;
        font-size: 50px;
    }
    .carousel-item-slug {
        width: 100%;
        height: 600px;
        background: no-repeat 100% 100%;
        background-size: cover;
    }
    .owl-carousel .owl-item img {
        /*height: 250px;*/
        width: auto;
    }
    .carousel-static {
        height: 150px;
        width: 100%;
        display: flex;
        align-items: flex-end;
        justify-content: center;
    }

    @media (max-width: 1370px) {
        .carousel-item-slug {
            width: 100%;
            height: 450px;
            background: no-repeat 100% 100%;
            background-size: cover;
        }
        i.slider-icon {
            display: none;
        }
    }
    @media (max-width: 640px) {
        .carousel-item-slug {
            height: 300px !important;
            width: auto;
        }
        .carousel-static {
            height: 150px;
        }
    }
    @media (max-width: 450px) {
        .btn {
            padding: 14px 20px;
            border: 2px solid #262626;
            border-radius: 24px;
            font-size: 14px;
            font-weight: 600;
            line-height: 1;
            color: #262626;
            outline: none;
        }
    }


</style>
