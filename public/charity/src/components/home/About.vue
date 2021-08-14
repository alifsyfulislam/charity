<template>
    <div>
        <div class="about-cs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="title">
                            <h2><span>SINCE 2003</span>Balance Without Compromise</h2>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur assumenda, cum dolore eveniet fuga fugit illum iste laboriosam maxime minus molestiae molestias nemo nulla ratione sed sint sit sunt suscipit!</p>
<!--                        <p> Al-Khair Foundation is a leading faith-based UK charity which provides emergency relief and developmental support in some of the world’s most impoverished areas. With an aid delivery footprint spanning 74 countries, we have alleviated the suffering of over 50 million beneficiaries in one way or another.</p>-->
                        <div class="read-more"><a href="">Learn More </a></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row inner-abt">
                            <div class="col-sm-6">
                                <div class="inner-box-content"><a href=""></a>
                                    <i class="scape-basic-Video-Message wtbx_vc_icon"></i>
                                    <h4>Our Story</h4>
                                    <p>How our journey began</p>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inner-box-content"><a href="https://alkhair.org/about-us/"></a>
                                    <i class="scape-tech-Global-Position wtbx_vc_icon"></i>
                                    <h4>What we do</h4>
                                    <p>Our global projects</p>

                                </div>
                            </div>
                        </div>
                        <div class="row inner-abt">
                            <div class="col-sm-6">
                                <div class="inner-box-content"><a href="#"></a>
                                    <i class="scape-tech-Distance-2 wtbx_vc_icon"></i>
                                    <h4>Vision &amp; Mission</h4>
                                    <p>The words we live by</p>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inner-box-content"><a href="#"></a>
                                    <i class="scape-tech-Inbox-Letter wtbx_vc_icon"></i>
                                    <h4>Who We Are</h4>
                                    <p>AKF through the years</p>

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
        name: "About"
    }
</script>

<style scoped>
    .inner-box-content {
        display: flex;
        flex-wrap: wrap;
        min-height: 173px;
        border: 1px solid #dfe9f2;
        padding: 32px;
        align-items: center;
        border-radius: 6px;
        position: relative;
        -webkit-transition: all 0.5s ease 0s;
        -moz-transition: all 0.5s ease 0s;
        -o-transition: all 0.5s ease 0s;
        -ms-transition: all 0.5s ease 0s;
        transition: all 0.5s ease 0s;
        background: white;
        box-shadow: 0px 0px 25px 10px rgb(104 110 117 / 15%);
        margin-bottom: 30px;
    }
    .inner-box-content a {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
    }
    .inner-abt {
        margin-bottom: 0px;
    }
    .inner-box-content i {
        font-size: 24px;
        line-height: 1em;
        color: #04549c;
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }
    .inner-box-content h4 {
        font-size: 18px;
        color: #212121;
        font-weight: 700;
        width: 100%;
    }
    .about-cs {
        background-color: #f5f8fb;
        padding: 50px 0;
        /*box-shadow: 0px 0px 5px 4px rgb(104 110 117 / 15%);*/
        box-shadow: 0px 0 6px 2px rgb(28 28 28 / 64%);
    }
    .title {
        margin-bottom: 0px;
        position: relative;
    }
    .title h2 {
        color: #212121;
        font-family: 'Montserrat';
        font-weight: 700;
        letter-spacing: 0;
        font-size: 40px;
        text-transform: capitalize;
        margin-top: 0;
    }
    .title h2 span {
        color: #04549c;
        font-size: 11px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        display: block;
        margin-bottom: 20px;
    }
    .read-more a {
        position: relative;
        display: inline-block;
        font-weight: 600;
        line-height: 3.8em;
        font-size: .928571em;
        padding: 0 1em 0 2em;
        border-radius: 6px;
        background-color: #fff;
        box-shadow: 0 8px 40px -5px rgb(9 31 67 / 15%);
        -webkit-transition: all 0.3s cubic-bezier(0.2, 0, 0.3, 1);
        -moz-transition: all 0.3s cubic-bezier(0.2, 0, 0.3, 1);
        -ms-transition: all 0.3s cubic-bezier(0.2, 0, 0.3, 1);
        -o-transition: all 0.3s cubic-bezier(0.2, 0, 0.3, 1);
        transition: all 0.3s cubic-bezier(0.2, 0, 0.3, 1);
        background: linear-gradient(
                270deg
                , rgba(255, 90, 0, 1) 0%, rgba(255, 54, 0, 1) 100%);
        font-size: 13px;
        color: #fff;
        min-width: 150px;
    }
    @media(max-width: 991px){
        .read-more {
            margin-bottom: 30px;
        }
    }
</style>
