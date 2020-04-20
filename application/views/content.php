
<div id = "haha">  

<!-- 2. Create links -->

<div id="div_content" align="right"  style="height:60px; cursor: pointer;" >
	<nav aria-label="Page navigation example">
	  <ul class="pagination pg-blue">
	  	 <li id="li_first" class="page-item">
	      <a  class="page-link" onclick="on_first()"><label id="lbl_first" style="max-height: 10px">First</label></a>
	    </li>
	    <li id="li_previous" class="page-item">
	      <a  class="page-link" onclick="on_previous(this)"><label id="lbl_previous" style="max-height: 10px">Previous</label></a>
	    </li>
	    <li id="li_1" class="page-item active"><a onclick="on_pagination(this)" class="page-link" id="1"><label id="lbl_1" style="max-height: 10px">1</label></a></li>
	    <li id="li_2" class="page-item"><a onclick="on_pagination(this)" class="page-link" id="2"><label id="lbl_2" style="max-height: 10px;">2</label></a></li>
	    <li id="li_3" class="page-item "><a id="3" onclick="on_pagination(this)" class="page-link"><label id="lbl_3" style="max-height: 10px">3</label></a></li>
	    <li id="li_4" class="page-item "><a id="4" onclick="on_pagination(this)" class="page-link"><label id="lbl_4" style="max-height: 10px">4</label></a></li>
	    <li id="li_5" class="page-item"><a id="5" onclick="on_pagination(this)" class="page-link"><label id="lbl_5" style="max-height: 10px">5</label></a></li>
	    <li id="li_6" class="page-item "><a id="6" onclick="on_pagination(this)" class="page-link"><label id="lbl_6" style="max-height: 10px">6</label></a></li>
	    <li id="li_7" class="page-item "><a id="7" onclick="on_pagination(this)" class="page-link"><label id="lbl_7" style="max-height: 10px">7</label></a></li>
	    <li id="li_8" class="page-item "><a id="8" onclick="on_pagination(this)" class="page-link"><label id="lbl_8" style="max-height: 10px">8</label></a></li>
	    <li id="li_9" class="page-item "><a id="9" onclick="on_pagination(this)" class="page-link"><label id="lbl_9" style="max-height: 10px">9</label></a></li>
	    <li id="li_next" class="page-item">
	      <a class="page-link" onclick="on_next(this)" ><label id="lbl_next" style="max-height: 10px">Next</label></a>
	    </li>
	  </ul>
	</nav></div>

<form name="sendcontent" id="sendcontent" method="post" action="<?=base_url()?>welcome/send">
<div class="portlet box">
	<div class="portlet-body">
			<div class="action">	
				<div class="pull-left" style="height:35px">	
				<h4>Result images : <label id="lblTotal">0</label></h4>			
				</div>				
				<div style="clear: both;">			
				
				</div>
			</div>	
			<div id="imageDisplay" class="contain" style="width: 100%; margin-left:5%">	

			</div>		
			
		</div>
	</div>
</div>


<script type="text/javascript">
 $(document).ready(function() {
 	
 });

 var selected_li_id = "li_1";

 function on_image_doubleClick(element)
 {
  	var image = $(element).attr('url');
  	// $('#div_content').attr("style", "cursor : wait");
  	var fileType = $(element).attr('filetype');
  	var filename = $(element).attr('filename');
  	

    var	url = "<?php echo base_url().('welcome/download')?>";
    console.log(url);
 	$.ajax({
        url : url,
        type: "POST", 
        data: {'image' : image, 'directory' : path_dir, 'code' : g_code, 'category' : g_category, 'filetype' : fileType, 'filename' : filename},
        dataType: "JSON",
        success: function(data)
        {
        	$('#div_content').attr("style", "");
              toastr.options = {
			  "debug": false,
			  "positionClass": "toast-top-right",
			  "onclick": null,
			  "fadeIn": 300,
			  "fadeOut": 1000,
			  "timeOut": 5000,
			  "extendedTimeOut": 1000
				}
				console.log(data['fileName']);
              toastr.success(data['fileName'], 'Success! Image download.');
		    var id = parseInt(selected_id) + 1;			
			var row = table.rows[id];
			$(row).attr("style", "background-color:#5f5f5f;color:red");

             },
             error: function (jqXHR, textStatus, errorThrown)
             {
              toastr.error('Error! Can not Image download.');
            }
          });


	 }
	 function on_first()
	 {
 		for (var i = 1; i < 10; i ++){
 			$('#lbl_' + i).text(i);
 		}
 		page_id = "1" ; 	

	 	$('#' + selected_li_id).attr("class", "page-item");
	 	selected_li_id = "li_" + page_id;
	 	$('#' + selected_li_id).attr("class", "page-item active"); 	
	 	page_id = $('#lbl_'+page_id).text();
	 	image_search(g_description, g_code, g_category, page_id);
	 	var value = $('#txtFilter').val().toLowerCase();          
           $("#tbl_condition tbody tr").filter(function() {
            
            $('#tbl_condition').toggle($('#tbl_condition').text().toLowerCase().indexOf(value) > -1)
          });
	 }
	 function on_pagination(element)
	 {
	 	var page_id = $(element).attr('id');
	 	search(page_id);
	 }
	 function on_next(element)
	 {
	 	var pre_id = get_id(selected_li_id);
	 	var page_id = parseInt(pre_id) + 1;
	 	search(page_id);
	 }
	 function on_previous(element)
	 {
	 	var pre_id = get_id(selected_li_id);
	 	var page_id = parseInt(pre_id) - 1;
	 	search(page_id);
	 }
	 function get_id(li_id)
	 {
	 	var id = li_id.split("_");	 	
	 	return id[1];
	 }
	 function search(page_id)
	 {
	 	var cur = $('#lbl_' + page_id ).text();
	 	if (cur == "")
	 		return;
	 	if (selected_id == "")
	 		return; 
	 	if ( page_id == "9" ) {
	 		var firstTxt = parseInt($('#lbl_9').text()) - 4;
	 		for (var i = 1; i < 10; i ++){
	 			$('#lbl_' + i).text(firstTxt + ( i - 1) );
	 		}
	 		page_id = parseInt(page_id) - 4;
	 	}
	 	if ( page_id == "1" ) {
		 	var current = parseInt($('#lbl_' + page_id).text());
		 	if (current != "1")
		 	{
		 		var firstTxt = parseInt($('#lbl_1').text()) - 4;
		 		for (var i = 1; i < 10; i ++){
		 			$('#lbl_' + i).text(firstTxt + ( i - 1) );
		 		}
		 		page_id = parseInt(page_id) + 4;
		 	}		 				
	 	}
	 	if ( page_id == "0" ) {
	 		for (var i = 1; i < 10; i ++){
	 			$('#lbl_' + i).text(i);
	 		}
	 		page_id = "1" ;

	 	}	 	

	 	$('#' + selected_li_id).attr("class", "page-item");
	 	selected_li_id = "li_" + page_id;
	 	$('#' + selected_li_id).attr("class", "page-item active"); 	
	 	page_id = $('#lbl_'+page_id).text();
	 	image_search(g_description, g_code, g_category, page_id);
	 }

</script>
	



