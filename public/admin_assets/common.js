$(document).ready(function(){

/*Document Ready Start*/						   
$(".change_status").change(function(){
	  var keys = $(this).attr("id");
	  var id =$(this).val();
	             $.ajax({
						type: "GET",
						url: "/admin/"+keys+"/ajax/"+id,
						data: "id="+id,
						dataType: "json",
			            contentType: false,
    	                cache: false,
			            processData:false,
						success: function(msg){
							 //notification start
							 var notify = $.notify({message:msg.message});
							 notify.update('type', 'success');
							 //notification end
							},
						error: function(msg){
							 //notification start
							 var notify = $.notify({message:'Error occurred while processing'});
							 notify.update('type', 'danger');
							 //notification end
						}
					}); 
  });
  //change asorting
  $(".update_asorting").change(function(){
	  var keys = $(this).attr("alt");
	  var id   = $(this).attr("id");
	  var val  = $(this).val();
	  
	             $.ajax({
						type: "GET",
						url: "/admin/"+keys+"/image/ajaxAsorting/"+id,
						data: "val="+val,
						dataType: "json",
			            contentType: false,
    	                cache: false,
			            processData:false,
						success: function(msg){
						    //notification start
							 var notify = $.notify({message:msg.message});
							 notify.update('type', 'success');
							 //notification end
							},
						error: function(msg){
							//notification start
							 var notify = $.notify({message:'Error occurred while processing'});
							 notify.update('type', 'danger');
							 //notification end
						}
					}); 
  });

/*Document Ready End*/
});
