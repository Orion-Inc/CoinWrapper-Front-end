const baseUrl = "http://app100.localhost/CoinWrapper-Front-end/public/rates-api";

const app = new Vue({
    el: '#rates',
    data: {
        btc:[],
        eth:[],
        ltc:[]
    },
    mounted() {
        this.getRates(baseUrl);

        this.interval = setInterval(function () {
            this.getRates(baseUrl);
        }.bind(this), 30000); 
    },
    methods:{
        getRates(url){
            axios.get(url).then((response) => {
                this.btc = response.data.btc;
                this.eth = response.data.eth;
                this.ltc = response.data.ltc;
            }).catch( error => { console.log(error); });
        }
    },
    beforeDestroy: function(){
        clearInterval(this.interval);
    }
});