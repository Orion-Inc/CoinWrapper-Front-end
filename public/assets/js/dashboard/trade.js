const coinRatesURL = window.location.origin+"/CoinWrapper-Front-end/public/coin-rates-api";
const exchangeRatesURL = window.location.origin+"/CoinWrapper-Front-end/public/exchange-rates-api";

const app = new Vue({
    el: '#dashboard',
    data: {
        defaultExchangeRate:"",
        userExchangeRate:"",
        btc:{},
        eth:{},
        ltc:{},
        coin: "",
        coins: [
            { text: 'Bitcoin', value: 'btc' },
            { text: 'Ethereum', value: 'eth' },
            { text: 'Litecoin', value: 'ltc' }
        ],
        paymentMethodsOptions: [
            { text: 'Bank Transfer', value: 'bank' },
            { text: 'Mobile Money', value: 'momo' }
        ],
        banks: [
            { text: 'Access Bank (Ghana) Limited', value: 'Access Bank (Ghana) Limited' },
            { text: 'ADB Bank Limited', value: 'ADB Bank Limited' },
            { text: 'Bank of Africa Ghana Ltd', value: 'Bank of Africa Ghana Ltd' },
            { text: 'Bank of Baroda (Ghana) Limited', value: 'Bank of Baroda (Ghana) Limited' },
            { text: 'Barclays Bank of Ghana Ltd', value: 'Barclays Bank of Ghana Ltd' },
            { text: 'CAL Bank Limited', value: 'CAL Bank Limited' },
            { text: 'Consolidated Bank Ghana Limited', value: 'Consolidated Bank Ghana Limited' },
            { text: 'Ecobank Ghana Limited', value: 'Ecobank Ghana Limited' },
            { text: 'Energy Commercial Bank Ltd', value: 'Energy Commercial Bank Ltd' },
            { text: 'FBNBank (Ghana) Ltd', value: 'FBNBank (Ghana) Ltd' },
            { text: 'Fidelity Bank Limited', value: 'Fidelity Bank Limited' },
            { text: 'First Atlantic Bank Ltd', value: 'First Atlantic Bank Ltd' },
            { text: 'First National Bank (Ghana) Ltd', value: 'First National Bank (Ghana) Ltd' },
            { text: 'GCB Bank Limited', value: 'GCB Bank Limited' },
            { text: 'GN Bank Limited', value: 'GN Bank Limited' },
            { text: 'Guaranty Trust Bank (Ghana) Limited', value: 'Guaranty Trust Bank (Ghana) Limited' },
            { text: 'Republic Bank (Ghana) Ltd', value: 'Republic Bank (Ghana) Ltd' },
            { text: 'National Investment Bank Ltd', value: 'National Investment Bank Ltd' },
            { text: 'Prudential Bank Limited', value: 'Prudential Bank Limited' },
            { text: 'Societe General (Ghana) Limited', value: 'Societe General (Ghana) Limited' },
            { text: 'Stanbic Bank Ghana Ltd', value: 'Stanbic Bank Ghana Ltd' },
            { text: 'Standard Chartered Bank (Ghana) Limited', value: 'Standard Chartered Bank (Ghana) Limited' },
            { text: 'United Bank for Africa (Ghana) Ltd.', value: 'United Bank for Africa (Ghana) Ltd.' },
            { text: 'Universal Merchant Bank Ltd', value: 'Universal Merchant Bank Ltd' },
            { text: 'Zenith Bank (Ghana) Limited', value: 'Zenith Bank (Ghana) Limited' },
            { text: 'Premium Bank Ltd', value: 'Premium Bank Ltd' },
            { text: 'OmniBank Ghana Limited', value: 'OmniBank Ghana Limited' },
            { text: 'Heritage Bank Limited', value: 'Heritage Bank Limited' },
            { text: 'GHL Bank Limited', value: 'GHL Bank Limited' },
            { text: 'ARB Apex Bank Ltd', value: 'ARB Apex Bank Ltd' }
        ],
        mobileNetworks: [
            { text: 'MTN GH', value: 'MTN GH' },
            { text: 'Vodafone GH', value: 'Vodafone GH' },
            { text: 'AirtelTigo', value: 'AirtelTigo' }
        ],
        timeoutOptions: [
            { text: '15 minutes', value: '15' },
            { text: '30 minutes', value: '30' },
            { text: '1 hour', value: '60' }
        ],
        selectedTradeTypeText:"Buy",
        selectedCoinName:"",
        selectedCoinSName:"Coin",
        selectedCoinUSD: 0.00,
        selectedCoinGHS: 0.00,
        selectedCurrency: "GHS",
        CoinUSD: 0.00,
        CoinGHS: 0.00,
        selectedCoin: false,
        changeRate: false,
        amountToTrade: 0.00,
        tradeAmountGHS: 0.00,
        tradeAmountUSD: 0.00,
        tradeFee: 0.00,
        tradeFeeGHS: 0.00,
        tradeFeeUSD: 0.00,
        minAmount: 0.00,
        minAmountGHS: 0.00,
        minAmountUSD: 0.00,
        totalTradeAmount: 0.00,
        totalTradeAmountGHS: 0.00,
        totalTradeAmountUSD: 0.00,
        paymentMethods: [
            {
                type: "",
            }
        ],
        selectedTimeout: false,
        paymentTimeout: "",
        verifiedUsers: true,
        maxCount: 350,
        remainingCount: 350,
        tradeTerms: ""
    },
    mounted() {
        this.getRates(coinRatesURL);
        this.getExchangeRate(exchangeRatesURL,'USD','GHS');
    },
    watch: {
        selectedCoinName: function () {
            this.selectedCoin = true;
            this.setExchangeRate();
            this.calculateTradeAmount(this.amountToTrade);
            this.calculateMinTradeAmount(this.minAmount);
            this.calculateTotalTradeAmount();
        },
        userExchangeRate: function () {
            this.setExchangeRate();
            this.calculateTradeAmount(this.amountToTrade);
            this.calculateMinTradeAmount(this.minAmount);
        },
        amountToTrade: function () {
            this.calculateTotalTradeAmount();
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
            this.CoinGHS = app.$data[coin].priceusd * this.defaultExchangeRate;
        },
        changeExchangeRate: function () {
            if(this.changeRate == false){
                this.changeRate = true;
            }
        },
        revertExchangeRate: function (params) {
            if(this.changeRate == true){
                this.userExchangeRate = this.defaultExchangeRate;
                this.changeRate = false;
            }
        },
        setExchangeRate: function () {
            this.CoinGHS = this.CoinUSD * this.userExchangeRate;
        },
        tradeAmount: function () {
            var amount = 0;
            amount = parseFloat(event.target.value);

            this.amountToTrade = amount;
            this.calculateTradeAmount(amount);
        },
        minTradeAmount: function () {
            var amount = 0;
            amount = parseFloat(event.target.value);

            this.minAmount = amount;
            this.calculateMinTradeAmount(this.minAmount);
        },
        calculateTradeAmount: function (amount) {
            var tradeFee = 0;
            var amountGHS = 0;
            var amountUSD = 0;
            
            var CoinGHS = parseFloat(this.CoinGHS);
            var CoinUSD = parseFloat(this.CoinUSD);


            switch (this.coin) {
                case 'btc':
                tradeFee = parseFloat(1 * 0.007);
                    break;
            
                default:
                tradeFee = parseFloat(1 * 0.01);
                    break;
            }
            
            amountGHS = amount * CoinGHS;
            amountUSD = amount * CoinUSD;
            
            this.tradeFee = tradeFee;
            this.tradeFeeGHS = (tradeFee * CoinGHS).toFixed(2);
            this.tradeFeeUSD = (tradeFee * CoinUSD).toFixed(2);

            this.tradeAmountGHS = amountGHS.toFixed(2);
            this.tradeAmountUSD = amountUSD.toFixed(2);
        },
        calculateTotalTradeAmount: function () {
            var totalTradeAmount = 0;
            var CoinGHS = parseFloat(this.CoinGHS);
            var CoinUSD = parseFloat(this.CoinUSD);
            var amount = this.amountToTrade;
            var tradeFee = this.tradeFee;

            totalTradeAmount = tradeFee + amount;

            this.totalTradeAmount = totalTradeAmount;
            this.totalTradeAmountGHS = (totalTradeAmount * CoinGHS).toFixed(2);
            this.totalTradeAmountUSD = (totalTradeAmount * CoinUSD).toFixed(2);
        },
        calculateMinTradeAmount: function (amount) {
            var CoinGHS = parseFloat(this.CoinGHS);
            var CoinUSD = parseFloat(this.CoinUSD);

            this.minAmountGHS = (amount * CoinGHS).toFixed(2);
            this.minAmountUSD = (amount * CoinUSD).toFixed(2);
        },
        addPaymentMethod: function () {
            this.paymentMethods.push({
                type: ""
            })
        },
        removePaymentMethod: function (index) {
            this.paymentMethods.splice(index,1);
        },
        textareaLength: function() {
            this.remainingCount = this.maxCount - this.tradeTerms.length;
        },
        selectPaymentTimeout: function (event) {
            var index = event.target.selectedIndex;

            this.selectedTimeout = true;
            this.paymentTimeout = event.target[index].text;
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
        getExchangeRate(url,$from,$to){
            axios.get(url,
                {params: {
                    from: $from,
                    to: $to
                }
            }).then((response) => {
                if(response.data.rate != 0){
                    this.defaultExchangeRate = response.data.rate;
                    this.userExchangeRate = response.data.rate;
                }
            }).catch( error => { console.log(error); });
        },
        getCarrierNetwork(network){
            var index = '';
            return this.mobileNetworks[index].text;
        },
        getBank(bank){
            var index = '';
            return this.banks[index].text;
        },
        toNumberFormat(x){
            var number = Number(x);
        
            return number.toLocaleString('en-EG');
        }
    }
});

var postAdForm = $("#post-ad-form");
var postAdWizard = $('#post-ad-wizard');

var $validator = postAdForm.validate({
    messages: {
        "coin-name": {
            required: "Please Select A Coin."
        },
        "exhange-rate": {
            required: "Enter Preferred Exchange Rate."
        },
        "amount": {
            required: "Please Enter Amount To Trade."
        },
        "min-amount": {
            required: "Enter Minimum Trade Amount."
        },
        "terms-of-trade": {
            required: "Please Type The Terms of This Trade."
        },
        "payment-method": {
            required: "Select At Least One Payment Method."
        },
        "payment-timeout": {
            required: "Please Select Trade Payment Duration."
        }
    }
});

postAdWizard.bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function(tab, navigation, index) {
        var $valid = postAdForm.valid();
        if(!$valid) {
            $validator.focusInvalid();
            return false;
        }
    },
    'onTabClick': function(tab, navigation, index) {
        var $valid = postAdForm.valid();
        if(!$valid) {
            $validator.focusInvalid();
            return false;
        }
    }
});