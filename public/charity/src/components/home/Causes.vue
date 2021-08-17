<template>
    <div v-if="causeList">
        <div class="our-causes">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading">
                            <h2 class="entry-title">Our Causes</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12" v-for="item in causeList" :key="item.id">
                        <div class="swiper-slide" >
                            <div class="cause-wrap">
                                <figure class="m-0">
                                    <img :src="item.media.length > 0 ? item.media[0].url : ''" alt="">
                                    <div class="figure-overlay d-flex justify-content-center align-items-center position-absolute w-100 h-100">
                                        <a href="#" class="btn gradient-bg mr-2">Donate Now</a>
                                    </div>
                                </figure>
                                <div class="cause-content-wrap">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <h3 class="entry-title w-100 m-0"><a href="#">{{item.name}}</a></h3>
                                    </header>
                                    <div class="entry-content">
                                        <p class="m-0">{{item.details}}</p>
                                    </div>
                                    <div class="fund-raised w-100">
                                        <k-progress
                                                :color="['#ff5a00','#f12711']"
                                                :line-height="15"
                                                active
                                                status="success"
                                                type="line"
                                                :percent="Math.round((item.raised_fund/item.target_fund)*100)" >
                                        </k-progress>
                                        <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="fund-raised-total mt-4">
                                                <span>Raised: {{item.raised_fund}}$</span>
                                            </div>
                                            <div class="fund-raised-goal mt-4">
                                                <span>Target: {{item.target_fund}}$</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import KProgress from 'k-progress';

    export default {
        name: "Causes",
        props: ['causes'],
        components:{
            KProgress
        },
        data(){
            return{
                causeList       : ''
            }
        },
        methods:{

        },
        created() {
            let _that = this;
            _that.causeList = _that.causes
        }
    }
</script>

<style >
    .our-causes {
        /*position: relative;*/
        padding: 50px 0;
        /*background: url(../images/xcause-bg.jpg.pagespeed.ic.0Gi-6Go72e.jpg) no-repeat center;*/
        background-size: cover;
        z-index: 99;
        background: white;
        box-shadow: 0px 0 6px 2px rgb(28 28 28 / 64%);
    }
    .our-causes .cause-content-wrap {
        padding: 15px 30px 15px;
         background-color: #ffffff;
    }

    .swiper-slide{
        box-shadow: 0 10px 25px 0 rgb(104 110 117 / 15%);
    }
</style>
