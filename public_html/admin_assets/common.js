$(document).ready(function(){
						   
//case date filteration
$("#CaseDateFilter").click(function(){
var case_start = $("#case_start").val();
var case_end   = $("#case_end").val();
                 $.ajax({
						type: "GET",
						url: "/gwc/clients_cases/DateFilterAjax",
						data: "case_start="+case_start+"&case_end="+case_end,
						dataType: "json",
			            contentType: false,
    	                cache: false,
			            processData:false,
						success: function(msg){
							 //notification start
							 window.location.reload();
							 //var notify = $.notify({message:msg.message});
							 //notify.update('type', 'success');
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

$("#CaseUpdateDateFilter").click(function(){
var case_start = $("#case_update_start").val();
var case_end   = $("#case_update_end").val();
                 $.ajax({
						type: "GET",
						url: "/gwc/clients_cases_updates/DateFilterAjax",
						data: "case_update_start="+case_start+"&case_update_end="+case_end,
						dataType: "json",
			            contentType: false,
    	                cache: false,
			            processData:false,
						success: function(msg){
							 //notification start
							 window.location.reload();
							 //var notify = $.notify({message:msg.message});
							 //notify.update('type', 'success');
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


//clear cookies
$("#CaseDateFilterClear").click(function(){
            $.ajax({
						type: "GET",
						url: "/gwc/clients_cases/DateFilterAjaxReset",
						data: "s=1",
						dataType: "json",
			            contentType: false,
    	                cache: false,
			            processData:false,
						success: function(msg){
							 //notification start
							 window.location.reload();
							 //var notify = $.notify({message:msg.message});
							 //notify.update('type', 'success');
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

//clear cookies
$("#CaseUpdateDateFilterClear").click(function(){
            $.ajax({
						type: "GET",
						url: "/gwc/clients_cases_updates/DateFilterAjaxReset",
						data: "s=1",
						dataType: "json",
			            contentType: false,
    	                cache: false,
			            processData:false,
						success: function(msg){
							 //notification start
							 window.location.reload();
							 //var notify = $.notify({message:msg.message});
							 //notify.update('type', 'success');
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
						   
$(".trackCaseLogs").click(function(){
	 var title = $(this).attr("title");

	             $.ajax({
						type: "GET",
						url: "/gwc/caselogs/ajax",
						data: "title="+title,
						dataType: "json",
			            contentType: false,
    	                cache: false,
			            processData:false,
						success: function(msg){
							 //notification start
							 //var notify = $.notify({message:msg.message});
							 //notify.update('type', 'success');
							 //notification end
							},
						error: function(msg){
							 //notification start
							 //var notify = $.notify({message:'Error occurred while processing'});
							 //notify.update('type', 'danger');
							 //notification end
						}
					}); 
				 
});
/*Document Ready Start*/						   
$(".change_status").change(function(){
	  var keys = $(this).attr("id");
	  var id =$(this).val();
	             $.ajax({
						type: "GET",
						url: "/gwc/"+keys+"/ajax/"+id,
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
						url: "/gwc/"+keys+"/image/ajaxAsorting/"+id,
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

//update case update attach
$(".updateAttachDetails").click(function(){
	  var id = $(this).attr("id");
	  var title_en =$("#atitle_en_"+id).val(); 
	  var title_ar =$("#atitle_ar_"+id).val();
	  var doc_date =$("#doc_date_"+id).val();
	             $.ajax({
						type: "GET",
						url: "/gwc/caseAttachUpdates/"+id+"/"+title_en+"/"+title_ar+"/"+doc_date,
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

$(".updateAttachUpdateDetails").click(function(){
	  var id = $(this).attr("id");
	  var title_en =$("#atitle_en_"+id).val(); 
	  var title_ar =$("#atitle_ar_"+id).val();
	  var doc_date =$("#doc_date_"+id).val();
	             $.ajax({
						type: "GET",
						url: "/gwc/caseAttachUpdatesDetails/"+id+"/"+title_en+"/"+title_ar+"/"+doc_date,
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

/*Document Ready End*/
});
