<template>
    <div class="donate-box">

        <div class="container">
            <div class="row quick-donation">
                <div class="col-lg-3"><h3 class="bb-dashed clr-white fs20 mt-0 mb-3 pt-2">Quick Donate</h3></div>
<!--                option-key="id"-->
                <div class="col-lg-3">
<!--                    <vue-single-select-->
<!--                            v-model="searchNameQuery"-->
<!--                            :options="causeNameList"-->
<!--                            option-label="name"-->
<!--                            :max-results="10"-->
<!--                            :value="searchNameQuery"-->
<!--                    ></vue-single-select>-->
                    <Select2 v-model="searchNameQuery"
                             :options="causeNameList"
                             :settings="{ settingOption: searchNameQuery, settingOption: searchNameQuery }"
                             @change="myChangeEvent($event)"
                             @select="mySelectEvent($event)"
                    />


                </div>
                <div class="col-lg-3">
                    <div class="input_donation variable_amount currency mb-sm-0 mb-3">
                        <input placeholder="Amount" autocomplete="off" type="text" class="donation_amount form-control mb-0" name="don[donation_amount]" value="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="add-to-cart-donation theme-btn red">Donate Now</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import VueSingleSelect from "vue-single-select";
    import Select2 from 'v-select2-component';

    import axios from 'axios'

    export default {
        name: "DonationBox",

        props: ['causes'],

        components:{
            // VueSingleSelect,
            Select2
        },

        data(){
            return{
                causeList           : '',
                searchNameQuery     : '',
                causeNameList       : ''
            }
        },

        methods:{
            autoSuggestionList() {
                let _that = this;
                console.log(_that.searchNameQuery)
                _that.causeNameList = _that.causeList.map(({id,name})=> {
                    return {
                        id,
                        text : name
                    }
                });
                // return _that.causeList.map(({name})=> name)
            },
            getCauseList() {
                let _that = this;
                return axios.get(`cause-list`, {
                    params : {
                        isSuggestion : 1
                    }
                }).then((response) => {
                    _that.isLoading = false;
                    _that.causeList = response.data.cause_list;
                    console.log(_that.causes)
                });
            },
            myChangeEvent(val){
                console.log(val);
            },
            mySelectEvent({id, text}){
                console.log({id, text})
            }

        },

        created() {
            let _that = this;
            _that.causeList = _that.causes
            _that.autoSuggestionList();
            _that.getCauseList();
        }
    }
</script>

<style >
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
        position: absolute;
        top: 0px;
        right: 1px;
        width: 20px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 42px!important;
    }
    span.select2.select2-container.select2-container--default {
        width: 100% !important;
    }
    span.select2.select2-container.select2-container--default.select2-container--above.select2-container--focus {
        width: 100% !important;
    }
    span.select2-selection.select2-selection--single {
        height: 42px;
    }
    .donate-box {
        background-color: #f5f8fb;
        padding: 50px 0;
        box-shadow: 0px 0 6px 2px rgb(28 28 28 / 64%);
    }
    .quick-donation {
        padding: 80px 4px 75px;
        background: #1e3263;
        box-shadow: 0 15px 55px -5px rgb(9 31 67 / 10%);
        border-radius: 5px;
        background-color: rgba(255,255,255,1);
        display: flex;
        top: -30px;
        align-items: normal;
        justify-content: center;
        z-index: 99;
        width: 100%;
        font-family: 'Montserrat', sans-serif;
        margin: 0;
    }

    .quick-donation h3 {
        min-width: 260px;
        color: #212121 !important;
        font-size: 26px;
        border: 0;
        text-align: center;
        position: relative;
    }
    label.select {
        width: 100%;
    }
    label.select {
        position: relative;
        display: block;
    }
    .quick-donation .donation_amount, .quick-donation .form-control {
        width: 100%;
        text-overflow: ellipsis;
    }


    label.select select {
        padding: 7px;
        margin: 0;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        background: #fff;
        color: #888;
        outline: 0;
        display: block;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        cursor: pointer;
        width: 100%;
        height: auto;
        border: 1px dashed #ccc;
        box-shadow: 0 0 0 1px rgb(223 233 242);
        border: 1px solid #dfe9f2 !important;
    }
    .form-control {
        box-shadow: 0 0 0 1px rgb(223 233 242);
        border: 1px solid #dfe9f2 !important;
        color: #212121;
        font-family:'Montserrat', sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.9;
        letter-spacing: -0.02px;
        border-radius: 6px;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px dashed #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        border-radius: 0;
        background-color: #E3EFFE !important;
    }
    label.select:after {
        content: "\f107";
        color: #aaa;
        right: 8px;
        padding: 0 0 2px;
        border-bottom: 1px solid #ddd;
        position: absolute;
        pointer-events: none;
        top: 50%;
        transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        font: normal normal normal 14px/1 FontAwesome;
    }
    .form-control:focus {
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: 0 0 0 2px rgb(4 84 156);
        box-shadow: 0 0 0 2px rgb(4 84 156);}
    .variable_amount .donation_amount {
        width: 100%;
        max-width: 100%;
        padding-left: 20px !important;
        padding: 5px 5px;
        height: auto;
        margin-bottom: 10px;
    }
    input[type=text] {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 2px;
        outline: 0;
        color: #333;
        font-weight: 400;
        padding: 2px 5px;
        height: 25px;
        font-family: 'Montserrat', sans-serif;
    }
    .input_donation .donation_amount {
        padding-left: 18px;
    }
    .donation_amount {
        border: 1px solid #ccc;
        border-radius: 2px;
        outline: 0;
        color: #333;
        font-weight: 400;
        padding: 2px 5px;
        max-width: 150px;
        z-index: 9;
        position: relative;
        font-size: 16px;
        font-family: 'Montserrat', sans-serif;
    }
    .quick-donation .donation_amount, .quick-donation .form-control {
        height: 42px;
        color: #000;
    }
    input.donation_amount {
        width: calc(100% - 40px);
    }
    .input_donation input, .input_donation select {
        border: 1px solid #e1e1e1;
        width: 100%;
        height: 35px;
        font-size: 13px;
        font-weight: 300;
        outline: none !important;
        box-shadow: 0 0 0 1px rgb(223 233 242);
        border: 1px solid #dfe9f2 !important;
        background-color: #E3EFFE !important;
        font-family: 'Montserrat', sans-serif;
    }
    .currency:before {
        color: #101525;
        content: '£';
        display: block;
        font-size: 15px;
        font-weight: 500;
        height: 36px;
        left: 1px;
        line-height: 38px;
        position: absolute;
        text-align: right;
        top: 10px;
        width: 24px;
        z-index: +1;
    }
    button.add-to-cart-donation.theme-btn.red {
        color: #fff !important;
        background: #F97866 !important;
        background: #F97866 !important;
        border-radius: 20px;
        -webkit-box-shadow: none;
        box-shadow: none;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-size: 15px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        line-height: 1;
        margin: auto;
        padding: 10px 40px;
        text-align: center;
        text-decoration: none;
        text-transform: none;
        -webkit-transition: .2s;
        transition: .2s;
        width: auto;
        border-radius: 5px !important;
        height: 42px !important;
        text-align: center;
        border: none;
        float: right;
        margin-right: 30px;
    }
    @media (max-width: 1370px) {
        .quick-donation {
            padding: 35px 4px 25px;
        }
    }
    @media (max-width: 992px) {
        button.add-to-cart-donation.theme-btn.red {
            margin-right: 0;
        }
    }
</style>
