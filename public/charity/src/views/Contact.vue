<template>
    <div class="single-page contact-page">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Contact</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-page-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <div class="entry-content">
                            <h2>Get In touch with us</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris. Lorem ipsum
                                dolor sit amet, conse ctetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus
                                vestib ulum mauris quis aliquam. Integer accu msan sodales odio, id tempus velit ullamc.</p>
                            <ul class="contact-social d-flex flex-wrap align-items-center">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                            <ul class="contact-info p-0">
                                <li><i class="fa fa-phone"></i><span>+45 677 8993000 223</span></li>
                                <li><i class="fa fa-envelope"></i><span><a href="https://preview.colorlib.com/cdn-cgi/l/email-protection"
                                                                           class="__cf_email__"
                                                                           data-cfemail="d9b6bfbfb0babc99adbcb4a9b5b8adbcf7bab6b4">[email&#160;protected]</a></span></li>
                                <li><i class="fa fa-map-marker"></i><span>Main Str. no 45-46, b3, 56832, Los Angeles, CA</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="contact-form">
                            <input type="text" v-model="formData.subject" placeholder="Name">

                            <input type="email" v-model="formData.email" placeholder="Email">

                            <textarea rows="15" v-model="formData.body" cols="6" placeholder="Messages" style="resize: none"></textarea>

                            <div>
                                <select hidden v-model="formData.status">
                                    <option value="" disabled>Select A Status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>

                            <div>
                                <input class="btn gradient-bg" type="button" value="Contact us" @click="getVisitorEmail">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-gmap">
                            <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d637.8359850588105!2d90.3759997094355!3d23.816125249040272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c6d49afca627%3A0x9e7d16fdf9d88c06!2sMadina%20Nagar%20Masjid!5e0!3m2!1sen!2sbd!4v1629125303092!5m2!1sen!2sbd"
                                    width="600"
                                    height="450"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Contact",

        data(){
            return{
                formData : {
                    subject : '',
                    email : '',
                    body : '',
                    status : 0
                },
                success_msg : '',
                error_msg : ''
            }
        },

        methods:{
            getVisitorEmail(){
                let _that = this;
                // console.log(this.formData)
                axios.post('new-contact',{
                    subject : _that.formData.subject,
                    email: _that.formData.email,
                    body: _that.formData.body,
                    status: _that.formData.status
                }).then((response)=>{
                    console.log(response)
                    _that.formData.subject = ''
                    _that.formData.email = ''
                    _that.formData.body = ''
                    if (response.data.status == 200){
                        _that.success_msg = "email success!"
                    } else{
                        _that.success_msg = "email error!"
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
