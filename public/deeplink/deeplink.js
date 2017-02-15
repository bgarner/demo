$( document ).ready(function() {

    localStorage.removeItem('userStoreNumber');
    localStorage.removeItem('userStoreName');

    var urlParams = new URLSearchParams(window.location.search);
    var storeNum = urlParams.get('store');

    if(storeNum.length < 4){
        storeNum = "0"+storeNum;
<<<<<<< HEAD
<<<<<<< HEAD
=======
        console.log("added a zero: " + storeNum);
>>>>>>> 37530f4b7... deep link adds 0 to 3 digit store numbers
=======
>>>>>>> 5a88096de... removed the console log
    }

    var store = (function () {
        $.ajax({
            'async': false,
            'global': false,
            'url': STORE_API_DOMAIN + "/store/" + storeNum,
            'dataType': "json",
            'success': function (data) {
                store = data;
            }
        }).done(function(){
            if(Object.keys(store).length > 0){
                localStorage.setItem('userStoreNumber', store.store_number);
                localStorage.setItem('userStoreName', store.store_number + " " + store.name);
            }
            window.location = "/";            
        });
    })(); 
});