<div class="container">
  <div class="row">
     <div class="col-md-12">
      <a href="<?php echo site_url('admin/dashboard');?>" class="btn btn-warning pull-right">Back</a>
    </div>
  </div>
  <form method="post" name="update_emp"  id="update_emp" action="<?php echo base_url('admin/updateemployee');?>" enctype="multipart/form-data">
  	<div class="row">
     <div class="col-md-12">
       <div class="col-md-offset-4 col-md-4">
         <span class="text-center heading_text"><b><u>Update Employee Details</u></b>
         </span>
       </div>
     </div>
   </div><br>
   <div class="row">
    <div class="col-md-12 error">
      <?php echo validation_errors();?>
    </div>
   </div>
   <div class="row level_2_no">
    <div class="col-md-12">
      <div class="col-md-offset-4 col-md-4">
        <span class="text-center question_text"><b>Employee Name</b></span>
      </div>
      <div class="col-md-offset-4 col-md-4">
        <input type="text" name="emp_name" id="emp_name" placeholder="Enter Employee Name" class="form-control" value="<?php if(!empty($empData['emp_name'])){echo $empData['emp_name'];} else { echo set_value('emp_name');} ?>">

        <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $empData['id']?>">
        <input type="hidden" name="profile_pic" id="profile_pic" value="<?php echo $empData['profile_pic']?>">
      </div>
    </div>
  </div>
  <br>
  <div class="row level_1">
    <div class="col-md-12">
      <div class="col-md-offset-4 col-md-4">
        <span class="text-center question_text"><b>Address</b></span>
      </div>
      <div class="col-md-offset-4 col-md-4">
        <input type="text" name="address" id="address" placeholder="Enter Employee Address" class="form-control" value="<?php if(!empty($empData['adddress'])) { echo $empData['adddress'];} else { echo set_value('adddress');}?>">      
      </div>
    </div>
  </div>
  <br>
   <div class="row level_1">
    <div class="col-md-12">
      <div class="col-md-offset-4 col-md-4">
        <span class="text-center question_text"><b>Email</b></span>
      </div>
      <div class="col-md-offset-4 col-md-4">
       <input type="email" name="emp_email" id="emp_email" placeholder="Enter Employee Email" class="form-control" value="<?php if(!empty($empData['email'])){echo $empData['email'];}else{ echo set_value('emp_email');}?>" readonly>
      </div>
    </div>
  </div>
  <br>
  <div class="row level_1" id="m">
    <div class="col-md-12">
      <div class="col-md-offset-4 col-md-4">
        <span class="text-center question_text"><b>Phone</b></span>
      </div>
      <div class="col-md-offset-4 col-md-4">
        <input type="text" name="phone" id="phone" placeholder="Enter Phone Number" class="form-control" value="<?php if(!empty($empData['phone'])){echo $empData['phone'];}else{ echo set_value('phone');}?>">
      </div>
    </div>
  </div>
  <br>

  <div class="row level_1" >
    <div class="col-md-12">
      <div class="col-md-offset-4 col-md-4">
        <span class="text-center question_text"><b>DOB</b></span>
      </div>
      <div class="col-md-offset-4 col-md-4">
        <input type="text" name="dob" id="dob" placeholder="Select DOB" class="form-control" value="<?php if(!empty($empData['dob'])){echo $empData['dob'];}else{ echo set_value('dob');}?>">
      </div>
    </div>
  </div>
  <br>
  <div class="row level_2_no">
    <div class="col-md-12">
      <div id="profile_pic_div" class="<?php if(empty($empData['profile_pic'])){ echo 'show_me';}else{ echo 'hide_me';}?>">
        <div class="col-md-offset-4 col-md-4">
          <span class="text-center question_text"><b>Profile Picture</b></span>
          <a onclick="ShowRightDiv(1)" class="btn btn-sm btn-danger">Remove</a>
        </div>
        <div class="col-md-offset-4 col-md-4">
          <input type="file" name="emp_pics" id="emp_pics">
        </div>
      </div>

      <div id="choose_file_div" class="<?php if(!empty($empData['profile_pic'])){ echo 'show_me';}else{ echo 'hide_me';}?>">
        <div class="col-md-offset-4 col-md-4">
          <span class="text-center question_text"><b>Profile Picture</b></span>
        </div>
        <div class="col-md-offset-4 col-md-4">
          <img src="<?php echo base_url('uploads/'.$empData['profile_pic']);?>" class="img-thumbnail" alt="Emp Pic" style="max-width:50%;">
          <a onclick="ShowRightDiv(2)" class="btn btn-sm btn-danger">Remove</a>
        </div>
      </div>

    </div>
  </div>
  <br>
  <div class="row level_2_no">
   <div class="col-md-12">
    <div class="col-md-offset-4 col-md-4">
      <center>
        <button value="" class="form-control btn btn-success" class="form-control submit_new">Update</button>
     </center>
   </div>
 </div>
</div>
</form>
</div>	
<script>
  $(document).ready(function() {
     $('#dob').Zebra_DatePicker({
        format: 'Y-m-d',
        direction:-1
    });
  });

  $("#update_emp").validate({
    rules: 
    {
      emp_name:"required",
      address:"required",
      emp_email:
      {
        required:true,
        email:true
      },
      phone:
      {
        required:true,
        number:true,
        minlength:10,
        maxlength:10
      },
      dob:"required",
      emp_pics:
      {
        extension: "jpg,png,jpeg,gif",
        filesize_max: 10000000
      }
   },
   messages: 
   {  
      emp_name:"Enter Employee Name",
      address:"Enter Employee Name",
      emp_email:
      {
        required:"Enter Email",
        email:"Invlaid Email"
      },
      phone:
      {
        required:"Enter Phone No",
        number:"Invalid Phone No",
        minlength:"Invalid Phone No",
        maxlength:"Invalid Phone No"
      },
      dob:"Select DOB",
      emp_pics:
      {
        extension: "Allowd Extention are jpg,png,jpeg,gif",
        filesize_max: 10000000
      }
   }
 });
 jQuery.validator.addMethod("filesize_max", function (value, element, param) {
    var isOptional = this.optional(element),
            file;

    if (isOptional) {
        return isOptional;
    }

    if ($(element).attr("type") === "file") {
        if (element.files && element.files.length) {
            file = element.files[0];
            return (file.size && file.size <= param);
        }
    }
    return false;
  }, "File size is too large.");
  
  $('.submit_new').click(function(){ 
    if($("#update_emp").valid)
    {
      $("#update_emp").submit();
    }
  }); 

  function ShowRightDiv(flag) 
  {
    if(flag==1)
    {
      $('#choose_file_div').css('display','block');
      $('#profile_pic_div').css('display','none');
    }

    else if(flag==2)
    {
      $('#choose_file_div').css('display','none');
      $('#profile_pic_div').css('display','block');
    }
  }
</script>
</body>
</html>