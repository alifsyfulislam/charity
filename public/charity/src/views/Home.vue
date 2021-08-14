<template>
  <div class="home">

    <!--    slider-start-->
    <Slider/>
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


  export default {
    name: 'Home',
    components : {
      Slider,
      DonationBox,
      Causes,
      About,
      Events,
      Service
    }
  }
</script>
