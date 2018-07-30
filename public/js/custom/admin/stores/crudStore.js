$("#add-store").click(function(){
	$("#add-store-modal").modal('show').on('shown.bs.modal', function () {
            $(".chosen").chosen({
                    width:'100%'
                });
        });
});