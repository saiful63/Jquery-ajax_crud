<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <table class="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>PHP & Ajax CRUD</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          Place : <input type="text" id="place">
          First Name : <input type="text" id="fname">
          Last Name : <input type="text" id="lname">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>
  <div id="mod">
    <div id="mod-form">
      <h2>Edit Form</h2>
      <table  width="100%">
      </table>
      <div id="cls-btn">X</div>
    </div>
  </div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "ajax-load.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); // Load Table Records on Page Load



    $("#save-button").on("click",function(e){
      e.preventDefault();
    var place=$("#place").val();
    var fname=$("#fname").val();
    var lname=$("#lname").val();

    if(fname=="" || lname==""){
       $("#error-message").html("All field are required").slideDown();
       $("#success-message").slideUp();
     }else{

      $.ajax({
      url: "ajax-insert.php",
      type : "POST",
      data : {place : place, first_name : fname , last_name : lname},
      success : function(data){
        if(data == 1){
          loadTable();
          $("#addForm").trigger("reset");
          $("#success-message").html("Data insert success").slideDown();
          $("#error-message").slideUp();
        }else{
           $("#error-message").html("Data insert fail").slideDown();
           $("#success-message").slideUp();
        }
        
      }
    })

  }
 
    })

    //Delete
    $(document).on("click",".del-btn",function(){
      if(confirm("Are you want to delete?")){
      var id=$(this).data("id");
      var element= this;
      
      $.ajax({
         
        url : "ajax-delete.php",
        type : "POST",
        data : {uid : id},
        success : function(data){
        if(data==1){
        $(element).closest("tr").fadeOut();
        }
        else{
          $("#error-message").html("Can't Delete").slideDown();
           $("#success-message").slideUp();
        }
        }

      });
    }
    })

    // //Show Modal Box
    // $(document).on("click",".edit-btn", function(){
    //   $("#modal").show();
    //   var studentId = $(this).data("eid");

    //   $.ajax({
    //     url: "load-update-form.php",
    //     type: "POST",
    //     data: {id: studentId },
    //     success: function(data) {
    //       $("#modal-form table").html(data);
    //     }
    //   })
    // });


   //Edit form for update
   $(document).on("click",".edt-btn",function(){
    var id=$(this).data("id");
    $("#mod").show();
    $.ajax({
      url : "ajax-edit.php",
      type : "POST",
      data : { edit_id : id },
      success : function(data){
         $("#mod-form table").html(data);
      }
    })
   })


    //Hide Modal Box
    $("#cls-btn").on("click",function(){
      $("#mod").hide();
    });

    //Save Update Form
      $(document).on("click","#edit-submit", function(){
        var stuId = $("#edit-id").val();
        var fname = $("#edit-fname").val();
        var lname = $("#edit-lname").val();

        $.ajax({
          url: "ajax-update-form.php",
          type : "POST",
          data : {id: stuId, first_name: fname, last_name: lname},
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
              loadTable();
            }
          }
        })
      });

    // Live Search
     $("#search").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "ajax-live-search.php",
         type: "POST",
         data : {search:search_term },
         success: function(data) {
           $("#table-data").html(data);
         }
       });
     });
  });
</script>

<!--Successfully completed-->
</body>





</html>
