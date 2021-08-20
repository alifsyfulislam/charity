<template>
    <div class="single-page news-page">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Events</h1>
                    </div>
                </div>
            </div>
        </div>
        <PreLoader v-if="isLoading"></PreLoader>
        <div v-else class="news-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <!--                        <div class="">-->
                        <!--                            <form action="" method="GET" class="row feature-event-form mb-5">-->
                        <!--                                <div class="col-md-4 form-border-right form-wraper" style="padding-left: 9px !important;">-->
                        <!--                                    <label class="form-label" for="usr">Event Name</label>-->
                        <!--                                    <input type="text" name="eventkeyword" required="" placeholder="All Events" value="" class="feature-event-date" id="usr">-->
                        <!--                                </div>-->
                        <!--                                <div class="col-md-4 form-border-right form-wraper">-->
                        <!--                                    <label class="form-label" for="usr">Location</label>-->
                        <!--                                    <input type="text" name="eventlocation" required="" placeholder="United Kingdom" value="" class="feature-event-date" >-->
                        <!--                                </div>-->

                        <!--                                <div class="col-md-4 form-wraper">-->
                        <!--                                    <label class="form-label" >Date</label>-->
                        <!--                                    <input type="date" name="eventdate" required="" placeholder="All dates" value="" class="feature-event-date" >-->
                        <!--                                </div>-->

                        <!--                            </form>-->
                        <!--                        </div>-->
                        <!--                        events-->
                        <div class="news-content" v-for="item in events" :key="item.id">
                            <a href="#"><img :src="item.media ? item.media[0].url : ''" alt=""></a>
                            <div class="p-4">
                                <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="header-elements">
                                        <div class="posted-date">{{item.created_at}}</div>
                                        <h2 class="entry-title"><a href="#">{{item.name}}</a></h2>
                                        <div class="post-metas d-flex flex-wrap align-items-center">
                                            <span class="post-author">by <a href="#">Tom Phillips</a></span>
                                        </div>
                                    </div>
                                    <div class="donate-icon">
                                        <a href="#"><img src="../assets/images/xdonate-icon.png.pagespeed.ic.5OLdXDGX0P.png" alt=""></a>
                                    </div>
                                </header>
                                <div class="entry-content">
                                    <p>{{item.details}}</p>
                                </div>
                                <footer class="entry-footer">
                                    <a href="#" class="btn gradient-bg">Read More</a>
                                </footer>
                            </div>
                        </div>
                        <!--                        pagination-->

                        <div class="item-list text-left">
                            <div v-if="events">
                                <div v-for="(item, index) in events" :key="item.id">
                                    <div v-if="index === 0">
                                        <div v-if="pagination.total >= pagination.per_page" class="col-md-offset-4">
                                            <ul class="pagination">

                                                <li :class="[{disabled:!pagination.prev_page_url}]" class="page-item mx-1">
                                                    <a @click.prevent="getEventList(pagination.prev_page_url)" href="#" class="text-white  "><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                                </li>

                                                <li :class="[{disabled:!pagination.next_page_url}]" class="page-item mx-1">
                                                    <a @click.prevent="getEventList(pagination.next_page_url)" href="#" class="text-white "><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="sidebar">

                            <div class="upcoming-events">
                                <h2>Upcoming Events</h2>
                                <ul class="p-0">
                                    <li class="d-flex flex-wrap justify-content-between align-items-center">
                                        <figure><a href="#"><img src="../assets/images/xu-1.jpg.pagespeed.ic.P2iHiexB-i.jpg" alt=""></a></figure>
                                        <div class="entry-content">
                                            <h3 class="entry-title"><a href="#">Fundraiser for Kids</a></h3>
                                            <div class="post-metas d-flex flex-wrap align-items-center">
                                                <span class="posted-date"><a href="#">Aug 25, 2018</a></span>
                                                <span class="event-location"><a href="#">Ball Room New York</a></span>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex flex-wrap justify-content-between align-items-center">
                                        <figure><a href="#"><img src="../assets/images/xu-2.jpg.pagespeed.ic.XthRm7BZjy.jpg" alt=""></a></figure>
                                        <div class="entry-content">
                                            <h3 class="entry-title"><a href="#">The childrens</a></h3>
                                            <div class="post-metas d-flex flex-wrap align-items-center">
                                                <span class="posted-date"><a href="#">Aug 25, 2018</a></span>
                                                <span class="event-location"><a href="#">Ball Room New York</a></span>
                                            </div>
                                            <p>Consectetur adipiscing elit. Mauris tempus vestib ulum.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex flex-wrap justify-content-between align-items-center">
                                        <figure><a href="#"><img src="../assets/images/xu-3.jpg.pagespeed.ic.fmXtFfxrWH.jpg" alt=""></a></figure>
                                        <div class="entry-content">
                                            <h3 class="entry-title"><a href="#">Bring water </a></h3>
                                            <div class="post-metas d-flex flex-wrap align-items-center">
                                                <span class="posted-date"><a href="#">Aug 25, 2018</a></span>
                                                <span class="event-location"><a href="#">Ball Room New York</a></span>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured-cause">
                                <h2>Featured Causes</h2>
                                <div class="cause-wrap">
                                    <figure class="m-0 position-relative">
                                        <a href="#"><img src="../assets/images/xcause-3.jpg.pagespeed.ic.NFC0pYYQ9n.jpg" alt=""></a>
                                    </figure>
                                    <div class="cause-content-wrap">
                                        <header class="entry-header d-flex flex-wrap align-items-center">
                                            <h3 class="entry-title w-100 m-0"><a href="#">Bring water to the childrens</a></h3>
                                        </header>
                                        <div class="entry-content">
                                            <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum
                                                mauris.</p>
                                        </div>
                                        <div class="fund-raised w-100">
                                            <div class="fund-raised-bar-3 barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div>
                                                <span class="fill" data-percentage="83"></span>
                                            </div>
                                            <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="fund-raised-total mt-4">
                                                    Raised: $56 880
                                                </div>
                                                <div class="fund-raised-goal mt-4">
                                                    Goal: $70 000
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
    </div>
</template>

<script>
    import PreLoader from '../components/layouts/PreLoader'
    import axios from 'axios'
    export default {
        name: "Events",

        components:{
            PreLoader
        },

        data(){
            return{
                isLoading : true,
                events : '',
                pagination:{
                    from: '',
                    to: '',
                    first_page_url: '',
                    last_page: '',
                    last_page_url: '',
                    next_page_url:'',
                    prev_page_url: '',
                    path: '',
                    per_page: 5,
                    total: ''
                },
            }
        },

        methods:{
            getEventList(pageUrl) {
                let _that = this;
                pageUrl = pageUrl == undefined ? 'event-list?page=1' : pageUrl;
                return axios.get(pageUrl, {
                    params : {
                        isPaginate : 1
                    }
                }).then((response) => {
                    _that.isLoading = false;
                    _that.events = response.data.event_list.data;
                    _that.pagination  = response.data.event_list;
                });
            },
        },

        async created() {
            await this.getEventList()
        }
    }
</script>

<style >
    .margin-b-big {
        margin-bottom: 71px;
    }
    .feature-event-form {
        background: #ffffff;
        box-shadow: 0 6px 3px 0 rgb(151 154 158 / 48%);
        border-radius: 0 5px 5px 5px;
        padding: 24px 13px ;
        margin-left: 0;
        position: relative;
        z-index: 3;
        width: 100%;
        border: 12px solid #ff5800;
    }
    .form-border-right {
        border-right: 4px solid rgb(255 86 0);

    }
    .form-wraper .form-label {
        color: #9496B0;
        font-size: 12px;
        line-height: 18px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 800;
    }
    .feature-event-form input {
        text-indent: 10px;
    }
    .feature-event-date {
        border: none;
        background: transparent;
        border-bottom: 1px solid #ff5800;
        border-radius: 0;
        color: #795548;
        font-size: 16px;
        font-weight: 400;
        line-height: 35px;
        padding: 0;
        width: 100%;
    }
    input[type="date"]:after {
        background-image: url(https://www.islamichelp.org.uk/wp-content/uploads/2020/04/datepicker.png);
        font-weight: 900;
        content: "";
        color: #555;
        padding: 0 5px;
        background-repeat: no-repeat;
        width: 14px;
        font-weight: 900;
        content: "";
        padding: 0 5px;
        height: 8px;
    }
</style>
