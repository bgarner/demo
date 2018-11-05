$(document).ready(function(){

    $(".chosen").chosen({
        width:'100%'
    });

    var description_fields = $("textarea");

    $(description_fields).each(function(){
        CKEDITOR.replace(this.name);
    })

})

var getEmptyFields = function(){
    var emptyFields = [];
    // var numberInputs = $("input[type='number']");
    // numberInputs.each(function(index, value){
    //     if($(this).val() == ''){
    //         emptyFields.push($(this).closest('.form-group').find('label').html());
    //     }
    // })

    // var textInputs = $("textarea");
    // textInputs.each(function(index, value){
    //     if($(this).val() == ''){
    //         emptyFields.push($(this).closest('.form-group').find('label').html());
    //     }
    // })

    var textInputs = $("input[type='radio']");
    textInputs.each(function(index, value){
        if($(this).val() == ''){
            emptyFields.push($(this).closest('.form-group').find('label').html());
        }
    })

    console.log(emptyFields);
        
}


$('#store-visit-submit').click(function(e){        
    e.preventDefault();
    getEmptyFields();
    swal({
        title: "Are you sure you want to submit?",
        text: "You will not be able to edit the report!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, submit it!",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        
        if (isConfirm) {
            console.log(isConfirm);
            $("input[name=is_draft]").val(0);
            $("form").submit();
            return true;
        } else {
            return false;
        }
        
    });
    
});