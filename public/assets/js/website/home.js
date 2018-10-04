//const baseUrl = window.location.origin+"/public/coin-rates-api";
const baseUrl = window.location.origin+"/CoinWrapper-Front-end/public/coin-rates-api";

const app = new Vue({
    el: '#rates',
    data: {
        btc: {
            priceghsformatted: "00.00",
            pctchange: "0.00%"
        },
        eth: {
            priceghsformatted: "00.00",
            pctchange: "0.00%"
        },
        ltc: {
            priceghsformatted: "00.00",
            pctchange: "0.00%"
        }
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
                if(response.data.btc.priceghsformatted != 0 && response.data.eth.priceghsformatted != 0 && response.data.ltc.priceghsformatted != 0){
                    this.btc = response.data.btc;
                    this.eth = response.data.eth;
                    this.ltc = response.data.ltc;
                }
            }).catch( error => { console.log(error); });
        }
    },
    beforeDestroy: function(){
        clearInterval(this.interval);
    }
});