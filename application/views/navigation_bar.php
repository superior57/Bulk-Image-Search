<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="width: 31%; position: fixed;" >
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header"> 
          
          <div style='display: inline-block; margin-left: 10px;'><a id="btnRefresh" class="btn btn-outline-primary" title="Refresh">
                  <i class="fa fa-refresh big"  style=""></i></a></div>
          <div style='display: inline-block; width: 80%'>
            <input id="txtFilter" type="text" class="form-control wy-form" id="" placeholder="Filter..." style="height: 30px; margin-left: 10%; margin-top: 0px; margin-right: 10%; width: 80%; font-size: 12px">
          </div>    
      </li>
      <li >         
          <div id="table_div" >   
            <table id="tbl_condition" class="table table-active" style="color:white;background-color: #333; font-size: 13px; margin-left: 5px;" >
              <thead style="background-color: black;">
                <tr>
                <th width="70%" style="margin: 0px;">Description</th>
                <th width="20%" style="margin: 0px">Code</th>
                <th width="10%" style="margin: 0px">Category</th>
                <th ><a href="javascript:void(0)" title="Add" onclick="add_condition()"><i style="color: white" class="fa fa-plus"></i></a></th>
                </tr>
              </thead>
              <tbody id="tblbody_condition" >
             </tbody>
            </table>
          </div></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<script type="text/javascript">
  $(document).on('click','.ayam',function(){

   var href = $(this).attr('href');
   $('#haha').empty().load(href).fadeIn('slow');
   return false;
 });


</script>
<script type="text/javascript">

  $('.apam').removeClass('active');

</script>
<script>

  var table;
  $(document).ready(function(){
    // get document height and width...
    document_width = $(window).width();
    document_height = $(window).height();
    var tbl_height = parseInt(document_height) - 110;
    $('#table_div').attr("style", "overflow-x: hidden; overflow-y:auto; height: "+tbl_height+"px;");
    $("#txtFilter").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#tbl_condition tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
    });
  })

</script>

<style type="text/css">
  li a.selectedclass
  {
    color: red !important;
    font-weight: bold;
  }

</style>