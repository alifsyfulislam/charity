<template>
    <div class="single-page portfolio">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Portfolio</h1>
                    </div>
                </div>
            </div>
        </div>
        <PreLoader v-if="isLoading"/>
        <div v-else class="portfolio-wrap">
            <div class="container">
                <div class="row portfolio-container">
                    <div class="col-12 col-md-6 col-lg-4 portfolio-item" v-for="item in galleries" :key="item.id">
                        <div class="portfolio-cont">
                            <a href="#"><img :src="item.media ? item.media[0].url : ''" alt=""></a>
                            <h3 class="entry-title"><a href="#">{{item.name}}</a></h3>
                            <h4>{{item.created_at}}</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-50">
                        <button href="#" :class="visibleItem > 8? 'hide' : 'show'" class="btn gradient-bg load-more-btn" @click="getMoreGalleryItem">Load More</button>
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
        name: "Gallery",

        components:{
            PreLoader
        },

        data(){
            return{
                isLoading : true,
                visibleItem : 0,
                galleries : ''
            }
        },

        methods:{
            getGelleryList() {
                let _that = this;
                _that.visibleItem +=3 ;
                return axios.get(`gallery-list`, {
                    params : {
                        isVisibleItem : _that.visibleItem,
                    }
                }).then((response) => {
                    _that.isLoading = false;
                    _that.galleries = response.data.gallery_list;
                });
            },
            getMoreGalleryItem(){
                let _that = this;
                _that.visibleItem +=3 ;
                return axios.get(`gallery-list`, {
                    params : {
                        isVisibleItem : _that.visibleItem,
                    }
                }).then((response) => {
                    _that.galleries = response.data.gallery_list;
                });
            }
        },

        async created() {
            await this.getGelleryList()
        }
    }
</script>

<style scoped>
    .hide{
        display: none;
    }

    .show{
        display: block;
    }
</style>
