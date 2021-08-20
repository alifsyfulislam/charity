<template>
    <div>
        <PreLoader v-if="isLoading"></PreLoader>
        <div v-else class="featured-cause">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading">
                            <h2 class="entry-title">Featured Cause</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6" v-for="item in causes" :key="item.id">
                        <div class="cause-wrap d-flex flex-wrap justify-content-between">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <figure class="m-0">
                                        <img :src="item.media ? item.media[0].url : ''" alt="">
                                    </figure>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="cause-content-wrap">
                                        <header class="entry-header d-flex flex-wrap align-items-center">
                                            <h3 class="entry-title w-100 m-0"><a href="#">{{item.name}}</a></h3>
                                            <div class="posted-date">
                                                <a href="#">{{item.created_at}}</a>
                                            </div>
                                            <div class="cats-links">
                                                <a href="#">{{item.location}}</a>
                                            </div>
                                        </header>
                                        <div class="entry-content">
                                            <p class="m-0">{{item.details}}</p>
                                        </div>
                                        <div class="entry-footer mt-5">
                                            <a href="#" class="btn gradient-bg mr-2">Donate Now</a>
                                        </div>
                                    </div>
                                </div>
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
</template>

<script>
    import PreLoader from '../layouts/PreLoader'
    import KProgress from 'k-progress';

    import axios from 'axios'

    export default {
        name: "FeatureList",

        components:{
            PreLoader,
            KProgress
        },

        data(){
            return{
                isLoading : true,
                causes : ''
            }
        },

        methods:{
            getFeatureList(){
                let _that = this;
                return axios.get(`cause-list`, {
                    params : {
                        isFeatured : 1
                    }
                }).then((response) => {
                    _that.isLoading = false;
                    _that.causes = response.data.cause_list;
                    // console.log(_that.causes)
                });
            }
        },
        async created() {
            await this.getFeatureList()
        }
    }
</script>

<style scoped>

</style>
