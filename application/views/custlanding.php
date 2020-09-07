<div class="container">
    <div class="login-content">
        <div class="login-logo">
       </div>
       <div class="login-form">
        <form method="post" action="<?php echo base_url('validateotp');?>">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="number" placeholder="Enter Mobile No." name="mobile" class="form-control form_element" required="" id="mobile" value="<?php echo set_value('mobile');?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="password" placeholder="Enter Password." name="password" class="form-control form_element" required="" id="password">
            </div>
          </div>

          <div class="col-md-12 text-center" id="show_sendotpbtn">
            <div class="form-group">
              <input type="button" name="proceed" value="Login" class="action_button form-control btn" style="color: white;background-color:#000000" onclick="validateLogin()">
            </div>
          </div>
        </div>
        </form>
      </div> 
    </div>
</div>
<script>
    $(document).ready(function() {
      
    });
  function validateLogin()
  {
    var mobile = $('#mobile').val();
    var password = $('#password').val();

    if(mobile && password)
    {
      if(mobile.length>10 || mobile.length<10)
      {
        toastr.error('Error','Invalid Mobile No!');
        return false;
      }
      else
      {
        /* functionality to send OTP */
        var $action = "<?php echo site_url('/validatelogin'); ?>";
        $.ajax({
            url: $action,
            type: "post",
            data: {'mobile': mobile,'password':password},
            dataType: "json",
            success: function (result)
            {
              if(result.status)
              {
                toastr.success(result.msg);
                window.location.href=result.redirect;
              } 
              else
              {
                toastr.error("Something went wrong Unable to Validate Login Details! Please Try Again!");
                return false;
              }
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
              toastr.error("ajax call error");
              return false;
            }
        });   
      }
    }
    else
    {
      toastr.error('Error','Mobile No and Password Cannot be Empty!');
      return false;
    }
  }
</script>
</body>
</html>