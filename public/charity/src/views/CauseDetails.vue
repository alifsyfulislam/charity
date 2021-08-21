<template>
    <div>
        <PreLoader v-if="isLoading"/>
        <div v-else>

        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import PreLoader from '../components/layouts/PreLoader'
    export default {
        name: "CauseDetail",

        components: {PreLoader},

        data(){
            return{
                isLoading : true,
                causeInfo : {
                    // id : '',
                    slug : ''
                },
            }
        },
        methods :{
            getCauseDetails(cause_slug){
                let _that = this;
                return axios.get(`cause-details/${_that.causeInfo.slug}`)
                    .then((response)=>{
                        _that.isLoading = false
                        console.log(response)
                    })
            }
        },

        async created() {
            if (this.$route.params.slug){
                // this.causeInfo.id = this.$route.params.id
                this.causeInfo.slug = this.$route.params.slug
                await this.getCauseDetails(this.causeInfo.slug)
            }
        }
    }
</script>

<style scoped>

</style>
