$('select').on('change', function() {
 // alert( this.value ); // or $(this).val()

  switch(this.value){
  	case "giftcard":
  		$("#prodcutfields").hide();
  		$("#giftcardfields").show();
  		break;

  	case "product":
  		$("#giftcardfields").hide();
  		$("#prodcutfields").show();
  		break;
  		
  	default:
  		$("#giftcardfields").hide();
  		$("#prodcutfields").hide();
  		break;
  }

});