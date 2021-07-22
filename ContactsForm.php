
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Manager</title>
    <!--External StyleSheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- External StyleSheets -->


</head>
<body>

<!-- modal -->
<center>
<div style="padding:10px 10px">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Create New Contact</button>
</div>
</center>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="form1" id="form1" method="post"  enctype="multipart/form-data" >

      <?php

            if(isset($_REQUEST['attach']) && !isset($_REQUEST['sendreset'])){	
              $str ='';	
              if(!is_dir("attachTemp"))
                mkdir("attachTemp");
              
              $name = $_FILES["browse"]["name"];
              $tmp_name = $_FILES["browse"]["tmp_name"];	
              $desti = "attachTemp/".$name;		
              
                
              move_uploaded_file($tmp_name, $desti) ;
              $file_content = file_get_contents($desti);
              $str = trim(str_replace("\r\n",",",$file_content),",");
              $_SESSION['str'] = $str;
              echo "<script>window.open('PrintCsv.php');
              </script>";
            unlink($desti);	

            }

    ?>   
          <div class="form-group">
            <label for="contact_name" class="col-form-label">Type Name</label>
            <input type="text" class="form-control" name="name" id="contact_name" required>
          </div>
          <div class="form-group">
            <label for="contact_phone" class="col-form-label">Phone</label>
            <input type="tel" class="form-control" name="phone" id="contact_phone" pattern="[1-9]{1}[0-9]{9}" required>
          </div>
          <div class="form-group">
            <label>Date of Joining</label>
            <div class="input-group date" id="contact_datetimepicker"
                data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input"
                    data-toggle="datetimepicker" data-target="#contact_datetimepicker"
                    name="date_time" id="data_time" required />
                <div class="input-group-append" data-target="#contact_datetimepicker"
                    data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
          </div>
          <div class="form-group" style="padding:10px 10px">
            <label for="exampleFormControlFile1">Choose File</label>
            <input type="file" class="form-control-file" name="browse" id="filename">
          </div>
          <div style="padding:10px 10px">
          <button type="submit" id="savebtn" class="btn btn-primary" onclick="return attach_file();">Save</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id = "close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- modal -->




    <!-- External Scripts -->
    <script src="./assets/js/jquery.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous"></script>
    <!-- External Scripts -->



<script>

var file_name;

function attach_file(){		
  // file_name = document.form1.browse.value ;
   file_name= document.getElementById("filename").value;
   file_name = file_name.substring(file_name.lastIndexOf("\\") + 1, file_name.length);

  alert('The file "' + file_name +  '" has been selected.');
        

	
  t = (/[.]/.exec(file_name)) ? /[^.]+$/.exec(file_name) : "undefined";    // 
  alert(t);
	
	if( (t == 'undefined')){
		alert("Give CSV or txt file ");
		return;	
	}
	
	
	if( (t != 'csv') && (t != 'txt')){
		alert("Give CSV or txt file ");
		document.getElementById("filename").innerHTML ='';
		return;	
	}
            $('#exampleModal').modal('hide');
            var datapass=$("#form1").serializeArray();
            console.log(datapass);
            datapass.push({"name":"filefrom","value":"MAIN"});
            $.ajax({
                    url: "ajax_handler.php",
                    type: "POST",
                    data: datapass,
                    success: function(d) {
                        if(d==1){
                          alert("success");
                        }     
                }
            });

document.form1.action = "ContactsForm.php?attach=true&sendUI=true";
document.form1.submit();

}

</script>
</body>
</html>