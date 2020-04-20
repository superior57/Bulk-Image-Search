<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>


<html>
<head>
  <style type="text/css">
      .un {text-decoration: none; }
        #loader {
        position: fixed;
        left: 65%;
        top: 50%;
        z-index: 1;
        margin: -75px 0 0 -75px;
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        width: 100px;
        height: 100px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
      }

      @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
      .border-image {

      }
      .border-image:hover {
/*          border: solid 2px #ffe57a;
*/        cursor: pointer; 
          box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.25); 
      }
      .border-down{
        border: solid 2px #00c0ef;
      }

  </style>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/AdminLTE.min.css" />

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sweetalert2.css" />
  <link href="<?php echo base_url();?>assets/test/js-image-slider.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/fancybox/jquery.fancybox.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-toastr/toastr.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-toastr/toastr-rtl.css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />

  <script src="<?php echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script> 
  <script src="<?php echo base_url();?>assets/js/dist/sweetalert2.js"></script>
  <script src="<?php echo base_url();?>assets/test/js-image-slider.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap-toastr/toastr.js"></script> 
  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>   
  <script src="<?php echo base_url();?>assets/fancybox/jquery.fancybox.js"></script>

  <!----- display width and height get  ------->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery 2.1.3 -->
  <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/blockUI/jquery.blockUI.js"></script> 

  <meta charset="UTF-8">
   <!-- Bootstrap 3.3.2 --> 
</head>

<body id="main_body" class="skin-red" onload="on_loading()"  >
  <div id="loader"  style="display: none;  text-align: center; position: fixed;"></div>
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
      
      <!-- Logo -->
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation" style="background-color: #337ab7; margin-left:0px; position: fixed; width: 100%;">
         <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu-left" style="vertical-align: middle; margin-top: 10px; margin-left: 50px">
          <ul class="nav navbar-nav" style="width: 90%">
            <li>
              <div class="input-group" style="z-index:1">
                <input type=file id="browseFolder" style="display:none;width: 20%" webkitdirectory directory multiple="false">
                <input name="txtDirectory" id="txtDirectory"  style="height: 30px; width: 350px; font-size: 12px" type="text" class="form-control" placeholder="FolderName..." value="uploads/">
                  <button id="btnDirectory" style="height: 30px" class="btn btn-default" >
                  <i class="glyphicon glyphicon">Save</i>
                  </button>&nbsp;&nbsp;&nbsp;
              </div>
            </li>
            <li>

              <select name="cmbCondition" id="cmbCondition" style="height: 30px; border: 0px; font-size: 12px" class="form-control" id="sel1">
                  <option value="0">description&code</option>  
                  <option value="2">code</option>  
                  <option value="1">description</option>                                                  
                </select>
            </li>&nbsp;&nbsp;&nbsp;&nbsp;            
            <li>
                <label style="color: white; margin-top: 5px; margin-left: 10px; font-size: 12px"><input name="chbTransparent" id="chbTransparent" class="" type="checkbox" size="10px" > &nbsp;Transparent</label>
            </li>
            <li>              
                           
            </li>
            <li>
              <div class="input-group" style="z-index:1">
                <label style="color: white; margin-top: 5px; margin-left: 10px; font-size: 12px"><input name="chbSize" id="chbSize" class="" type="checkbox" size="10px" > &nbsp;Custom size :</label> &nbsp;&nbsp;
              <input name="txt_size_width" id="txt_size_width" style="height: 27px; width: 80px; font-size: 12px" type="text" placeholder="width" disabled="true">&nbsp;&nbsp;
              <label style="color: white; width: 20px; margin-top: 5px">X</label>&nbsp;
              <input name="txt_size_height" id="txt_size_height" style="height: 27px; width: 80px; font-size: 12px" type="text"  placeholder="height" disabled="true"></div>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <?php $this->load->view('navigation_bar');?>      

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 31%;">

      
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">               
             </div><!-- /.box-header -->
             <div class="box-body">
              <!-- Main content -->
              <section class="content" >
                <!-- Your Page Content Here -->
                <?php $this->load->view('content'); ?>
              </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
<!-- REQUIRED JS SCRIPTS -->




<script type="text/javascript">

 
    var save_method; //for save method string
    var table;
    var path_dir = "<?php echo $save_dir; ?>";
    var selected_id = "";
    var g_description = "";
    var g_code = "";
    var g_category = "";
    var select_image = "";
    var document_width = "";
    var document_height = "";


    $(document).ready(function() {

      table = document.getElementById('tbl_condition');
        get_condition();
       $('#txtDirectory').val(path_dir);
       $('#chbSize').change(function(){

        var check = document.getElementById("chbSize").checked;
        if (check)
        {
          $('#txt_size_width').attr('disabled', false);
          $('#txt_size_height').attr('disabled', false);
        }
        else{
          $('#txt_size_width').attr('disabled', true);
          $('#txt_size_height').attr('disabled', true);
        }

     });

       $(function() {

      $('#btnDirectory').on('click', function(event) {
          var directory = $('#txtDirectory').val();
        if ( path_dir == directory ) {          
          $('#txtDirectory').focus();
          return;
        }
        $.ajax({
          url : "<?php echo base_url().('welcome/save_dir')?>",
          type: "POST",
          data: { 'dir' : directory },
          dataType: "JSON",
          success: function(data)
          {
              path_dir = data.dirName;
              $('#txtDirectory').val(path_dir);
              toastr.success("Success! Saved Directory.");   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            toastr.error("Failed! Can not save directory.");
          }
        });
      });


      var getHighlightRow = function() {
        return $('table > tbody > tr.highlight');
      }
      $('#cmbCondition').on('change', function(event)
        {
          if ( selected_id != "" ) {
            image_search(g_description, g_code, g_category, "1");
          }
        });

      $('#btnRefresh').on('click', function(event){
        reload_table();
      });

      $('#chbTransparent').on('click', function(event)
        {
          if ( selected_id != "" ) {
            image_search(g_description, g_code, g_category, "1");
          }
        });
      $('#txt_size_height').on('change', function(event){
        if ( selected_id != "" ) {
            image_search(g_description, g_code, g_category, "1");
          }
      });

    });


        $('#tbl_condition tbody').on('click', 'tr', function () {
         var trlst = $('#tbl_condition tbody').find('tr');          

          var id = $(this).attr('id');
          selected_id = id;


          var text = $(this).html();
          var temp = text.split('<td>');
          var description = "";
          var code = "";
          var category = "";          

          description = temp[1].replace('</td>', '');
          code = temp[2].replace('</td>', '');
          category = temp[3].replace('</td>', '');

          description = description.replace('<br>', '');
          category = category.replace('<br>', '');
          g_description = description;
          g_code = code;
          g_category = category;

          var value = $('#txtFilter').val().toLowerCase();
          $.each(trlst, function(index, item) {
            if ($(this).text().toLowerCase().indexOf(value) > -1)
            {              
              var lastStyle = $(item).attr('style');
              $(item).removeAttr('style');
               var newStyle = "background-color:#333;";
              if ( lastStyle == "color:red" || lastStyle == "background-color:#333;color:red" || lastStyle == "background-color:#5f5f5f;color:red" )
                  newStyle += "color:red";

              $(item).attr('style', newStyle);

            }  
          
          });
          var style = $(this).attr('style');
          if ( style == "color:red" || style == "background-color:#333;color:red" ) 
            style = "background-color:#5f5f5f;color:red";
          else
            style = "background-color:#5f5f5f";
          $(this).attr('style', style);
          on_first();

    });
    });

  function get_condition()
  {

    $.ajax({
        url : "<?php echo base_url().('welcome/ajax_get_condition')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

          var table_body = "";           
          for (var i = 0; i < data.length; i ++) {

              var i_description = data[i]['description'];
              var i_code = data[i]['code'];
              var i_category = data[i]['category'];
              if ( i_description.length > 20 ) {
                i_description = insert(i_description, 18, "<br/>");            
              }
              if (i_category.length > 8) {
                i_category = insert(i_category, 8, "<br/>");
              }
              var is_file = data[i]['is_file'];
              var row = "";
              if (is_file == "true") {
                row = row = "<tr style='color:red' id='"+i+"'><td >"+i_description+"</td><td>"+data[i]['code']+"</td><td>"+i_category+"</td><td><a  href='javascript:void(0)' data-toggle='tooltip' title='Edit' onclick='edit_condition("+data[i]['id']+")'><i style='color: #70b6de'class='fa fa-pencil'></i></a<br/><br/><br/><a  href='javascript:void(0)' data-toggle='tooltip' title='Delete' onclick='delete_condition("+data[i]['id']+")'><i style='color: #058bff' class='fa fa-trash'></i></a></td></tr>";

              }
              else
              {
                row = row = "<tr style='' id='"+i+"'><td >"+i_description+"</td><td>"+data[i]['code']+"</td><td>"+i_category+"</td><td><a  href='javascript:void(0)' data-toggle='tooltip' title='Edit' onclick='edit_condition("+data[i]['id']+")'><i style='color: #70b6de'class='fa fa-pencil'></i></a<br/><br/><br/><a  href='javascript:void(0)' data-toggle='tooltip' title='Delete' onclick='delete_condition("+data[i]['id']+")'><i style='color: #058bff' class='fa fa-trash'></i></a></td></tr>";

              }               
              table_body += row;
                             
              
            }     
            $('#tblbody_condition').append(table_body);    
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });
  }

    function on_loading() {
    }

    function insert(str, index, value) {
      return str.substr(0, index) + value + str.substr(index);
    }


    function add_condition()
    {
      save_method = 'add';
      $('#txtDescription').val("");
      $('#txtCode').val("");
      $('#txtCategory').val("");

      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add New Condition'); // Set Title to Bootstrap modal title
    }

    function edit_condition(id)
    {
      save_method = 'update';
      // $('#form').reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('welcome/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
          $('[name="id"]').val(data.id);
          $('[name="txtDescription"]').val(data.description);
          $('[name="txtCode"]').val(data.code);
          $('[name="txtCategory"]').val(data.category);
          
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Condition'); // Set title to Bootstrap modal title
            
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
    }



    function reload_table()
    {
      $('#tbl_condition tbody').empty();
      get_condition(); //reload table
      var id = parseInt(selected_id) + 1;     
      var row = table.rows[id];
      var style = $(row).attr("style");
      var newStyle = "background-color:#5f5f5f;";
      if ( style == "color:red" )
        newStyle += "color:red";
      $(row).attr("style", newStyle);
    }


      function save()
    {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo base_url().('welcome/ajax_add')?>";
      }
      else
      {
        url = "<?php echo base_url().('welcome/ajax_update')?>";
      }

      if ( $('#txtDescription').val() == "" ) {
        $('#txtDescription').focus();
        return;
      }
      if ( $('#txtCode').val() == "" ) {
        $('#txtCode').focus();
        return;
      }
      if ( $('#txtCategory').val() == "" ) {
        $('#txtCategory').focus();
        return;
      }


       $.ajax({
        url : url,
        type: "POST",
        data: {'txtDescription' :  $('#txtDescription').val(),
               'txtCode' :  $('#txtCode').val(),
                'txtCategory' :  $('#txtCategory').val(),
                'id' : $('#id').val() },
        dataType: "JSON",
        success: function(data)
        {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
               swal(
                'Good job!',
                'Data has been save!',
                'success'
                )
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
              alert('Error adding / update data');
            }
          });
     }

     function edit_directory()
     {
        $('#txtDirectory').val(path_dir);
     }

     function delete_condition(id)
     {
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm: false
      }).then(function(isConfirm) {

     // ajax delete data to database
     $.ajax({
      url : "<?php echo site_url('welcome/ajax_delete')?>/"+id,
      type: "POST",
      dataType: "JSON",
      data : { 'description' : g_description.replace( '\n', ""), 'code' : g_code },
      success: function(data)
      {

               //if success reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
               swal(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                );
               $('#imageDisplay').empty();  
              $('#lblTotal').text("0");
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
              alert('Error adding / update data');
            }
          });

     
         
       })
      
    }
    
     function image_search(description, code, category, page_no)
    { 
        $.blockUI({ message : '<h3><img src="<?php echo base_url();?>source/ldcyd5lxlvtlppe3.gif" width="100px" height="100px" /><br />Just a moment...</h3>', css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5,
            cursor : 'wait',
            color: '#fff' 
        }, onOverlayClick: $.unblockUI }); 
  
        $.ajax({ url: 'wait.php', cache: false }); 

        $('#main_body').attr("style", "pointer-events : none;");

        var size_width = "";
        var size_height = "";
        var transparent = document.getElementById("chbTransparent").checked;
        var condition = $('#cmbCondition').val();
        var customSize = document.getElementById("chbSize").checked;
        // console.log(customSize);
        if (condition == "0")
          condition = description + " " + code;
        if (condition == "1")
          condition = description;
        if (condition == "2") 
          condition = code;
        if ( document.getElementById("chbSize").checked ) {
          size_width = $('#txt_size_width').val();
          size_height = $('#txt_size_height').val(); 

        }  

        var size_con = $('#cmbSize').val();
        g_description = description;
        g_code = code;
        g_category = category;  
        condition = condition.replace( '\n', "");
        var temp_condition = condition+"_"+size_width+"_"+size_height+"_"+transparent+"_"+page_no;

        console.log(temp_condition);
        $.ajax({
        url : "<?php echo site_url('welcome/image_search')?>/"+"1",
        type: "POST",
        dataType: "JSON",
        data : {'condition' : condition,
                'customSize' : customSize,
                'size_height' : size_height,
                'size_width' : size_width,
                'category' : category,
                'size_con' : size_con,
                'code' : code,
                'transparent' : transparent,
                'page_no' : page_no,
                'temp_condition' : temp_condition},
        success: function(data)
        { 
           var total = data['total'];
           var image_detail = data['images'];
           $('#lblTotal').text(total);
           var start = 0; 
           var end = total;
           $('#imageDisplay').empty();                   
           if ( parseInt(page_no) % 2 == 0 ) {
               var start = parseInt(total) - 1; 
               var end = 0;
                for ( var i = start; i >= end; i -- ){
                      var image_url = image_detail[i]['url'];
                      var filetype = image_detail[i]['filetype'];
                      var filename = image_detail[i]['filename'];
                      var width = image_detail[i]['width'];
                      var height = image_detail[i]['height'];
                      var class_border = "border-image img-fluid";
                      var dataUrl = image_detail[i]['dataUrl'];
                      var filename_re = image_detail[i]['title'];
                      if ( filename_re.length > 36 ) {
                         filename_re = insert(filename_re, 33, "<br>");
                         filename_re = filename_re.split("<br>");
                         filename_re = filename_re[0];
                         filename_re = insert(filename_re, filename_re.length, "...");
                      }
                      // if ( is_download == "1" )
                      //     class_border = "border-down";
                      $('#imageDisplay').append("<a class='d-block mb-4' style='display: inline-block'><div filetype='"+filetype+"' filename = '"+filename+"'' url='"+image_url+"' onmouseenter='on_imageOver(this)' onmouseout='on_out(this)' ondblclick='on_image_doubleClick(this)' class='"+class_border+"' style='width: 265px;  margin-left: 5px; margin-right: 5px; margin-top: 5px; margin-bottom: 5px;'><img src='"+image_url+"' style='width: 265px; height: 160px; min-width: 50px; max-height: 200px;min-height: 50px' data-atf='1'jsaction='load:str.tbn'><div id='size_"+image_url+"' style='background-color: white; color: white; transition: 100  '> &nbsp&nbsp "+width+" x "+height+"</div></div><div><label style='cursor: pointer' onclick='go_href(this)' name = "+dataUrl+" >"+filename_re+"</label></div></a>");
                }}else {
             for ( var i = start; i < end; i ++ ){
                  var image_url = image_detail[i]['url'];
                  var filetype = image_detail[i]['filetype'];
                  var filename = image_detail[i]['filename'];
                  var width = image_detail[i]['width'];
                  var height = image_detail[i]['height'];
                  var class_border = "border-image img-fluid";
                  var dataUrl = image_detail[i]['dataUrl'];
                  var filename_re = image_detail[i]['title'];
                  if ( filename_re.length > 36 ) {
                     filename_re = insert(filename_re, 33, "<br>");
                     filename_re = filename_re.split("<br>");
                     filename_re = filename_re[0];
                     filename_re = insert(filename_re, filename_re.length, "...");

                  }
                    // console.log(filename_re);                                
                  // if ( is_download == "1" )
                  //     class_border = "border-down";
                  $('#imageDisplay').append("<a class='d-block mb-4' style='display: inline-block'><div filetype='"+filetype+"' filename = '"+filename+"'' url='"+image_url+"' onmouseenter='on_imageOver(this)' onmouseout='on_out(this)' ondblclick='on_image_doubleClick(this)' class='"+class_border+"' style='width: 265px;  margin-left: 5px; margin-right: 5px; margin-top: 5px; margin-bottom: 5px;'><img src='"+image_url+"' style='width: 265px; height: 160px; min-width: 50px; max-height: 200px;min-height: 50px' data-atf='1'jsaction='load:str.tbn'><div id='size_"+image_url+"' style='background-color: white; color: white; transition: 100  '> &nbsp&nbsp "+width+" x "+height+"</div></div><div><label style='cursor: pointer' onclick='go_href(this)' name = "+dataUrl+" >"+filename_re+"</label></div></a>");
            }}
           // $('#loader').hide();    
           $(document).ajaxStop($.unblockUI);
           $('#main_body').attr("style", "");           

         },
         error: function (jqXHR, textStatus, errorThrown)
         {       
          $(document).ajaxStop($.unblockUI); 
          // $('#loader').attr("style", "display: none;  text-align: center; position: fixed;");    
          $('#main_body').attr("style", "");
          $('#imageDisplay').empty();  
          $('#lblTotal').text("0");
        }
          });

       
   

    }
    function go_href(element)
    {
        var url = $(element).attr('name');
       window.open(url,"_blank");
    }
    function on_imageOver(element) {
      var url = $(element).attr('url');
      var id = "size_" + url;

      document.getElementById(id).style.background = "grey";

    }
    function on_out(element)
    {
        var url = $(element).attr('url');
      var id = "size_" + url;

      document.getElementById(id).style.background = "white";
    }

    function openModal() {
        document.getElementById('myModal').style.display = "block";
      }

      function closeModal() {
        document.getElementById('myModal').style.display = "none";
      }
      var slideIndex = 1;
      function plusDivs(n) {
        showDivs(slideIndex += n);
      }

      function currentDiv(n) {
        showDivs(slideIndex = n);
      }

  </script>

  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Condition Form</h3>
        </div>
        <div class="modal-body">
          <form action="#" id="form" style="font-size: 13px">
            <input type="hidden" value="" name="id" id="id" /> 
            <div class="form-body">
              <div class="form-group">
                <label class="col-form-label">Description</label>                
                <input style="font-size: 13px" id="txtDescription" name="txtDescription" placeholder="description" class="form-control" type="text">
              </div>
              <div class="form-group">
                <label class="col-form-label">Code</label>
                  <input style="font-size: 13px" id="txtCode" name="txtCode" placeholder="code" class="form-control" type="text">
              </div>
              <div class="form-group">
                <label class="col-form-label">Category</label>
                  <input style="font-size: 13px" id="txtCategory" name="txtCategory" placeholder="category" class="form-control" type="text">
              </div>             
            </div>
          </form>
        </div>
        <div class="modal-footer" style="">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div><!-- /.modal-dialog -->
  </div>
 
</body>
</html>