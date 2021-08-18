<template>
    <div>
        <div class="home-page-icon-boxes">
            <div class="container">
                <div class="row">
                    <div  class="coL-12">
                        <div  class="section-heading mb-5 ml-4">
                            <h2  class="entry-title">Our Services</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0" v-for="item in serviceList" :key="item.id">
                        <div class="icon-box ">
                            <figure class="d-flex justify-content-center">
                                <img :src="item.media ? item.media[0].url : ''" alt="">
                                <!--                                hover-->
                                <img :src="item.media ? item.media[0].url : ''" alt="">
                            </figure>
                            <header class="entry-header">
                                <h3 class="entry-title">{{item.name}}</h3>
                            </header>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Service",
        props:['services'],
        data(){
            return{
                serviceList : ''
            }
        },
        created() {
            let _that = this;
            _that.serviceList = _that.services;
        }

    }
</script>

<style scoped>

</style>
