<template>
    <div>
        <footer class="site-footer">
            <div class="footer-widgets">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="foot-about">
                                <h2><a class="foot-logo" href="#"><img src="../../assets/images/xlogo.png.pagespeed.ic.jje9n1Rfdy.png" alt=""></a></h2>
                                <p>Lorem ipsum dolor sit amet, con sectetur adipiscing elit. Mauris temp us vestib ulum mauris.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <ul class="d-flex flex-wrap align-items-center">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                            <h2>Useful Links</h2>
                            <ul>
                                <li><a href="#">Privacy Polticy</a></li>
                                <li><a href="#">Donate</a></li>
                                <li><a href="#">Causes</a></li>
                                <li><a href="#">Events</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                            <div class="foot-latest-news">
                                <h2>Latest Events</h2>
                                <ul>
                                    <li>
                                        <h3><a href="#">A new cause to help</a></h3>
                                        <div class="posted-date">MArch 12, 2018</div>
                                    </li>
                                    <li>
                                        <h3><a href="#">We love to help people</a></h3>
                                        <div class="posted-date">MArch 12, 2018</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                            <div class="foot-contact">
                                <h2>Contact</h2>
                                <ul>
                                    <li><i class="fa fa-phone"></i><span>+45 677 8993000 223</span></li>
                                    <li><i class="fa fa-envelope"></i><span><a href="https://preview.colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a9c6cfcfc0cacce9ddccc4d9c5c8ddcc87cac6c4">[email&#160;protected]</a></span></li>
                                    <li><i class="fa fa-map-marker"></i><span>Main Str. no 45-46, b3, 56832, Los Angeles, CA</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <p class="m-0">
                                Copyright &copy;{{currentYear}} All rights reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        name: "Footer",

        data (){
            return{
                currentYear : ''
            }
        },

        methods : {
            getFullYear(){
                let _that = this;
                _that.currentYear = new Date().getFullYear()
                return _that.currentYear
            }
        },

        created() {
            this.getFullYear();
        }
    }
</script>

<style scoped>

</style>
