<template>
    <div>
        <div class="home-page-events">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="upcoming-events">
                            <div class="section-heading">
                                <h2 class="entry-title">Upcoming Events</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12" v-for="item in eventList" :key="item.id">
                                    <div class="event-wrap d-flex flex-wrap justify-content-between">
                                            <figure class="m-0">
                                                <img :src="item.media ? item.media[0].url : ''" alt="">
                                            </figure>
                                            <div class="event-content-wrap">
                                                <header class="entry-header d-flex flex-wrap align-items-center">
                                                    <h3 class="entry-title w-100 m-0"><a href="#">{{item.name}}</a></h3>
                                                    <div class="posted-date">
                                                        <a href="#">{{item.created_at}} </a>
                                                    </div>
                                                    <div class="cats-links">
                                                        <a href="#">{{item.location}}</a>
                                                    </div>
                                                </header>
                                                <div class="entry-content">
                                                    <p class="m-0">{{item.details}}</p>
                                                </div>
                                                <div class=" event_city">
                                                    <span class="city-btn-light">
                                                      <img src="https://www.islamichelp.org.uk/wp-content/uploads/icons/pin-a.svg" alt="icon">
                                                      <p class="city_name">Online</p>
                                                    </span>
                                                </div>
                                                <p class="feature-date normal-text mb-small_event eventdate">
                                                    <span class=" um-color_date">Aug</span>
                                                    <span class="feature-date-text text-black_event">{{item.start_date ? item.start_date.slice(-2):''}}</span>
                                                </p>
                                                <div class="entry-footer">
                                                    <a href="#">Read More</a>
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
    export default {
        name: "Events",

        props:['events'],

        data(){
            return{
                eventList : ''
            }
        },

        created() {
            let _that = this;
            _that.eventList = _that.events;
        }
    }
</script>

<style scoped>
    .event-content-wrap {
        padding: 0 30px;
        height: auto;
    }
    .event-wrap.d-flex.flex-wrap.justify-content-between {
        background: #fff;
        box-shadow: 0 10px 25px 0 rgb(104 110 117 / 15%);
        border-radius: 5px;
        float: left;
    }
    .event-wrap figure {
        width: 100%;
        height: auto;
    }
    .event-content-wrap {
        width: 100%;
        margin-top: 0;
    }
    header.entry-header.d-flex.flex-wrap.align-items-center {
        margin: 10px 0;
    }
    .event_city {
        float: left;
        margin: 15px 0;
    }
    .city-btn-light {
        border-radius: 5px;
        width: 140px;
        height: 40px;
        background: #EFEFF4;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    span.city-btn-light img {
        width: 20px;
    }
    p.city_name {
        font-size: 12px;
        line-height: 30px;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: 700;
        padding-left: 2.98px;
    }

    .city-btn-light p {
        margin: 0;
        margin-left: 5px;
        color: #9496B0;
    }
    .feature-date {
        display: flex;
        flex-direction: column;
        justify-content: right;
        text-align: right;
        margin: 0;
    }
    .entry-footer {
        margin-bottom: 15px;
    }
    .um-color_date {
        color: #F7796A;
        margin-left: 4px;
        font-size: 16px;
        line-height: 30px;
        font-weight: 800;
        margin: 0px;
    }
    .text-black_event {
        color: #101525 !important;
    }
    .feature-date-text {
        font-size: 30px;
        line-height: 44px;
        font-weight: 600;
    }
    .event-wrap figure img {
        display: block;
        width: 100%;
        height: 200px;
    }
</style>
