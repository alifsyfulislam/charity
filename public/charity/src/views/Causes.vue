<template>
    <div class="single-page causes-page">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Causes</h1>
                    </div>
                </div>
            </div>
        </div>

        <FeatureList/>

        <CauseList v-if="causes && pagination" :causes="causes" :pagination="pagination" @current-page-info="getStatusFromChild"/>
    </div>
</template>

<script>
    import FeatureList from '../components/cause/FeatureList'
    import CauseList from '../components/cause/CauseList'

    import axios from 'axios'

    export default {
        name: "Causes",

        components:{
            FeatureList,
            CauseList
        },

        data(){
            return{
                isLoading : false,
                causes : '',
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
            getCauseList(pageUrl) {
                let _that = this;
                pageUrl = pageUrl == undefined ? 'cause-list?page=1' : pageUrl;
                return axios.get(pageUrl, {
                    params : {
                        isPaginate : 1
                    }
                }).then((response) => {
                    _that.isLoading = false;
                    _that.causes = response.data.cause_list.data;
                    _that.pagination  = response.data.cause_list;
                });
            },

            getStatusFromChild(data){
                let _that = this;
                data['cause'] = _that.causes
                data['pagination'] = _that.pagination
            }
        },
        async created() {
            await this.getCauseList();
        }
    }
</script>

<style scoped>
    .our-causes .cause-content-wrap {
        padding: 15px 30px 15px;
        background-color: #ffffff;
    }

    .swiper-slide{
        box-shadow: 0 10px 25px 0 rgb(104 110 117 / 15%);
    }
</style>
