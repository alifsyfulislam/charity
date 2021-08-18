<template>
  <div class="home">

    <PreLoader v-if="isLoading"/>

    <div v-else>
      <!--    slider-start-->
      <Slider v-if="sliders" :sliders="sliders"/>
      <!--    slider-end-->

      <!--    donation-start-->
      <DonationBox v-if="causes" :causes="causes"/>
      <!--    donation-end-->

      <!--    causes-start-->
      <Causes v-if="causes" :causes="causes"/>
      <!--    causes-end-->

      <!--    about-start-->
      <About v-if="abouts" :abouts="abouts"/>
      <!--    about-end-->

      <!--    events-start-->
      <Events/>
      <!--    events-end-->

      <!--    service-start-->
      <Service/>
      <!--    service-start-->
    </div>


  </div>
</template>

<script>

  import Slider from '../components/home/Slider'
  import DonationBox from '../components/home/DonationBox'
  import Causes from '../components/home/Causes'
  import About from '../components/home/About'
  import Events from '../components/home/Events'
  import Service from '../components/home/Service'
  import PreLoader from '../components/layouts/PreLoader'

  import axios from 'axios'


  export default {
    name: 'Home',
    components : {
      PreLoader,
      Slider,
      DonationBox,
      Causes,
      About,
      Events,
      Service
    },
    data (){
      return{
        isLoading   : true,
        sliders     : '',
        causes      : '',
        abouts      : ''
      }
    },
    methods : {
      getSliderList() {
        let _that = this;
        return axios.get(`slider-list`, {
          params : {
            isVisitor :1
          }
        }).then((response) => {
          _that.sliders = response.data.slider_list;
          console.log(_that.sliders)
        });
      },
      getCauseList() {
        let _that = this;
        return axios.get(`cause-list`, {
          params : {
            isVisitor :1
          }
        }).then((response) => {
          _that.isLoading = false;
          _that.causes = response.data.cause_list;
          console.log(_that.causes)
        });
      },

      getAboutList() {
        let _that = this;
        return axios.get(`about-list`, {
          params : {
            isVisitor :1
          }
        }).then((response) => {
          _that.abouts = response.data.about_list;
          console.log(_that.abouts)
        });
      }
    },
    async created (){
      await this.getSliderList()
      await this.getCauseList()
      await this.getAboutList()
    },
  }
</script>
