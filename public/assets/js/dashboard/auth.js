var input = document.querySelector("#phonenumber");
window.intlTelInput(input, {
    autoPlaceholder: "off",
    initialCountry: "gh",
    nationalMode: true,
    onlyCountries: ['gh'],
    placeholderNumberType: "MOBILE",
    separateDialCode: true,
    utilsScript: window.location.origin+"/CoinWrapper-Front-end/node_modules/intl-tel-input/build/js/utils.js"
});