<template>
  <div class="home">

    <!--    slider-start-->
    <Slider v-if="sliders" :sliders="sliders"/>
    <!--    slider-end-->

    <!--    donation-start-->
    <DonationBox/>
    <!--    donation-end-->

    <!--    causes-start-->
    <Causes/>
    <!--    causes-end-->

    <!--    about-start-->
    <About/>
    <!--    about-end-->

    <!--    events-start-->
    <Events/>
    <!--    events-end-->

    <!--    service-start-->
    <Service/>
    <!--    service-start-->


  </div>
</template>

<script>

  import Slider from '../components/home/Slider'
  import DonationBox from '../components/home/DonationBox'
  import Causes from '../components/home/Causes'
  import About from '../components/home/About'
  import Events from '../components/home/Events'
  import Service from '../components/home/Service'

  import axios from 'axios'


  export default {
    name: 'Home',
    components : {
      Slider,
      DonationBox,
      Causes,
      About,
      Events,
      Service
    },
    data (){
      return{
        sliders : ''
      }
    },
    methods : {
      getSliderList() {
        let _that = this;
        return axios.get(`/slider-list`, {
          params : {
            isVisitor :1
          }
        }).then((response) => {
          _that.sliders = response.data.slider_list;
          console.log(_that.sliders)
        });
      },
      getB() {
        console.log(3)
      }
    },
    async created (){
      await this.getSliderList()
      console.log(2)
      await this.getB()
    },
  }
</script>
