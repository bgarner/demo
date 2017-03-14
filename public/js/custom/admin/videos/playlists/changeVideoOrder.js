function updateVideoOrder(data){
	// console.log("made it over here");
	// console.log(data);

	for(var i=0;i<data.length;i++){
        var obj = data[i];
        for(var key in obj){
            var attrName = key;
            var attrValue = obj[key];

            console.log("pos:"+ i + ", name:" + attrName + ", value:"+ attrValue);

			$.ajax({
			    url: '/admin/playlistorder/' + attrValue ,
			    type: 'PATCH',
			    data: {
			  		order: i
			    }
			});
        }
    }

}
