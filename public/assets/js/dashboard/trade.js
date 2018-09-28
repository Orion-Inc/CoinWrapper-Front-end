const coinRatesURL = window.location.origin+"/CoinWrapper-Front-end/public/coin-rates-api";
const exchangeRatesURL = window.location.origin+"/CoinWrapper-Front-end/public/exchange-rates-api";


const app = new Vue({
    el: '#dashboard',
    data: {
        exchangeRate:"",
        btc:{},
        eth:{},
        ltc:{},
        coin: "",
        selectedTradeTypeText:"Buy",
        selectedCoinName:"",
        selectedCoinSName:"",
        selectedCoinUSD: 0.00,
        selectedCoinGHS: 0.00,
        CoinUSD: 0.00,
        CoinGHS: 0.00,
        selectedCoin: false,
        changeRate: false,
        amountToTrade: 0.00,
        tradeAmountGHS: 0.00,
        tradeAmountUSD: 0.00,
        tradeFee: 0.00,
    },
    mounted() {
        this.getRates(coinRatesURL);
        this.getExchangeRate(exchangeRatesURL,'GHS');
    },
    watch: {
        selectedCoinName: function () {
            this.selectedCoin = true;

            this.calculateTradeAmount(this.amountToTrade);
        }
    },
    methods:{
        changeTradeType: function (event) {
            this.selectedTradeTypeText = event.target.value;
        },
        selectCoin: function (event) {
            var coin =  event.target.value;

            this.coin = coin;
            this.selectedCoinSName = coin.toUpperCase();
            this.selectedCoinName = app.$data[coin].coinname;
            this.selectedCoinUSD = app.$data[coin].priceusdformatted;
            this.selectedCoinGHS = app.$data[coin].priceghsformatted;
            this.CoinUSD = app.$data[coin].priceusd;
            this.CoinGHS = app.$data[coin].priceghs;
        },
        changeExchangeRate: function () {
            if(this.changeRate == true){
                this.changeRate = false;
                this.getExchangeRate(exchangeRatesURL,'GHS');
            }else{
                this.changeRate = true
            }
        },
        tradeAmount: function () {
            var amount = 0;
        
            amount = parseFloat(event.target.value);
            this.amountToTrade = amount;

            this.calculateTradeAmount(amount);
        },
        calculateTradeAmount: function (amount) {
            var tradeFee = 0;
            var amountGHS = 0;
            var amountUSD = 0;

            tradeFee = parseFloat(amount * 0.01);
            
            amountGHS = amount * parseFloat(this.CoinGHS);
            amountUSD = amount * parseFloat(this.CoinUSD);
            

            this.tradeFee = tradeFee.toFixed(2);
            this.tradeAmountGHS = amountGHS.toFixed(2);
            this.tradeAmountUSD = amountUSD.toFixed(2);
        },
        getRates(url){
            axios.get(url).then((response) => {
                if(response.data.btc.price != 0 && response.data.eth.price != 0 && response.data.ltc.price != 0){
                    this.btc = response.data.btc;
                    this.eth = response.data.eth;
                    this.ltc = response.data.ltc;
                }
            }).catch( error => { console.log(error); });
        },
        getExchangeRate(url,currency){
            axios.get(url,{params: {currency: currency}}).then((response) => {
                if(response.data.rate != 0){
                    this.exchangeRate = response.data.rate;
                }
            }).catch( error => { console.log(error); });
        }
    }
});