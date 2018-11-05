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
    
    var emptyFields = '';
    var numberFields = $("input[type='number'].form-field");
    
    numberFields.each(function(index, value){
        if($(this).val() == ''){
            emptyFields += $(this).closest('.form-group').find('label').html() + "\n";
        }
    })


    var textFields = $("textarea.form-field");
    textFields.each(function(index, value){
        var textData = CKEDITOR.instances[this.name].getData();
        if(textData == ''){
            console.log(this.name);
            emptyFields += $(this).closest('.form-group').find('label').html() + "\n";
        }
    })

    // console.log( CKEDITOR.instances['field_4'].getData());
    
    if($("input[name='field_3']:checked").val() == undefined){
        emptyFields += $("input[name='field_3']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_7']:checked").val() == undefined){
        emptyFields += $("input[name='field_7']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_8']:checked").val() == undefined){
        emptyFields += $("input[name='field_8']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_9']:checked").val() == undefined){
        emptyFields += $("input[name='field_9']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_13']:checked").val() == undefined){
        emptyFields += $("input[name='field_13']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_14']:checked").val() == undefined){
        emptyFields += $("input[name='field_14']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_22']:checked").val() == undefined){
        emptyFields += $("input[name='field_22']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_23']:checked").val() == undefined){
        emptyFields += $("input[name='field_23']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_29']:checked").val() == undefined){
        emptyFields += $("input[name='field_29']").closest('.form-group').find('label').html() + "\n";
    }
    if($("input[name='field_30']:checked").val() == undefined){
        emptyFields += $("input[name='field_30']").closest('.form-group').find('label').html() + "\n";
    }
    
    return emptyFields;
}


$('#store-visit-submit').click(function(e){        
    e.preventDefault();
    var storeNumber = $("#storeSelect").val();
    // if(storeNumber == '') {
    //     swal("Oops!", "Store Number cannot be empty", "error"); 
    //     $(window).scrollTop(0);
    //     return false;
    // }
    var emptyFields = getEmptyFields();
    var text = "You will not be able to edit the report!";

        
    if(emptyFields.length > 1){

        text += "\nThe following fields are still empty : \n" + emptyFields;

        
    }
    swal({
        title: "Are you sure you want to submit?",
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, submit it!",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        
        if (isConfirm) {
            $("input[name=is_draft]").val(0);
            $("form").submit();
            return true;
        } else {
            return false;
        }
        
    });
    
});