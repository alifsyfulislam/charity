<template>
    <div>
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
                                    <img :src="item.media ? item.media[0].url : ''" alt="">
                                    <div class="figure-overlay d-flex justify-content-center align-items-center position-absolute w-100 h-100">
                                        <a href="#" class="btn gradient-bg mr-2">Donate Now</a>
                                    </div>
                                </figure>
                                <div class="cause-content-wrap">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <h3 class="entry-title w-100 m-0"><a href="#">{{item.name}}</a></h3>
                                    </header>
                                    <div class="entry-content">
                                        <p class="m-0">
                                            {{item.details}}
                                        </p>
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

                <div class="item-list text-left">
                    <div v-if="causeList">
                        <div v-for="(item, index) in causeList" :key="item.id">
                            <div v-if="index === 0">
                                <div v-if="paginationList.total >= paginationList.per_page" class="col-md-offset-4">
                                    <ul class="pagination">
<!--                                        <li :class="[{disabled:!pagination.prev_page_url}]" class="page-item mx-1">-->
<!--                                            <a @click.prevent="changeCausePage(paginationList.first_page_url)" href="#" class="text-white "><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>-->
<!--                                        </li>-->
                                        <li :class="[{disabled:!pagination.prev_page_url}]" class="page-item mx-1">
                                            <a @click.prevent="changeCausePage(paginationList.prev_page_url)" href="#" class="text-white  "><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                        </li>
<!--                                        <li v-for="n in pagination.last_page" class="page-item mx-1" :key="n">-->
<!--                                            <a @click.prevent="changeCausePage('cause-list?page='+n)" class="text-white" href="#">{{ n }}</a>-->
<!--                                        </li>-->

                                        <li :class="[{disabled:!pagination.next_page_url}]" class="page-item mx-1">
                                            <a @click.prevent="changeCausePage(paginationList.next_page_url)" href="#" class="text-white "><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </li>
<!--                                        <li :class="[{disabled:!pagination.next_page_url}]" class="page-item mx-1">-->
<!--                                            <a @click.prevent="changeCausePage(paginationList.last_page_url)" href="#" class="text-white "><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>-->
<!--                                        </li>-->
                                    </ul>
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

    import axios from 'axios'

    export default {
        name: "CauseList",

        props: ['causes','pagination'],

        components:{
          KProgress
        },

        data(){
            return{
                causeList : '',
                paginationList : ''
            }
        },

        methods:{
            changeCausePage(pageUrl){
                let _that = this;
                _that.getCauseList(pageUrl);
                let collectData = [];
                collectData['cause'] = _that.causeList;
                collectData['pagination'] = _that.paginationList;
                _that.$emit('current-page-info',collectData)
            },
            getCauseList(pageUrl) {
                let _that = this;
                pageUrl = pageUrl == undefined ? 'cause-list?page=1' : pageUrl;
                return axios.get(pageUrl, {
                    params : {
                        isPaginate : 1
                    }
                }).then((response) => {
                    _that.causeList = response.data.cause_list.data;
                    _that.paginationList  = response.data.cause_list;
                    // console.log(_that.causes)
                    // console.log(_that.pagination)
                });
            },


        },

        created() {
            let _that = this;
            _that.causeList = _that.causes
            _that.paginationList = _that.pagination
            // console.log(_that.paginationList)
        }
    }
</script>

<style scoped>

</style>
