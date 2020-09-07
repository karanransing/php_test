 <div class="container">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <form method="post" name="search"  id="search">
            <div class="col-md-6">
              <input type="text" name="search_keyword" id="search_keyword" placeholder="Enter Employee Name" class="form-control" value="<?php echo set_value('search_keyword');?>">
            </div>
            <div class="col-md-6">
              <center>
                <button type="button" class="form-control btn btn-success" onclick="searchEmployee()">Search</button>
              </center>
            </div>
          </form>
        </div>
      </div>
      <br>
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url('admin/addnew');?>" class="btn btn-sm btn-success pull-right">Add New Employee</a>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee Master</h4>
                          <div class="table-responsive">
                            <table id="datatableUser" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                      <th>Sr.No</th>
                                      <th>Employee Name</th>
                                      <th>adddress</th>
                                      <th>Mobile Number</th>
                                      <th>Email</th>
                                      <th>DOB</th>
                                      <th>Profile Pic</th>
                                      <th>Created By</th>
                                      <th>Created On</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
 </div>
 <script>
    $(document).ready(function()
    {
      loadTable();
    });//document

  function loadTable()
  {
    if ($.fn.DataTable.isDataTable("#datatableUser")) {
      $('#datatableUser').DataTable().clear().destroy();
    }
      
    var dataTable = $('#datatableUser').DataTable({  
     "processing":true,  
     "serverSide":true,  
     "order":[],
     "searching": false,
     "ajax":{  
          url: "<?php echo base_url('admin/getemployeelist')?>",
          type:"POST"
       }
    });
  }  

function deleteEmp(empId)
{
  if(empId)
  {
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this record!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: 'red',
      confirmButtonText: 'Yes, I am sure!',
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
      function(isConfirm){
      if (isConfirm){
        /* ajax functionality to */
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/deleteemployee'); ?>",
            data:{'empId':empId},
            datatype:"json",
            success: function (mydata)
            { 
              var obj = jQuery.parseJSON(mydata);
              if(obj.status==true)
              {
                swal("Deleted!", "Record Deleted successfully!", "success");
                loadTable();
              }
              else
              {
                swal("Error", "Something Went Wrog Unable to Delete Record!", "error");
              }
            },
            error: function (error) 
            { 
              swal("Error", "Ajax Call Error!", "error");
            }
        });
      }
      else
      {
        swal("Cancelled", "Your record is safe :)", "error");
        e.preventDefault();
      }
    });
  }
  else
  {
    toastr.info('Something Went Wrong Empty Emp Id', 'Delete Employee', { "progressBar": true });
    return false;
  }
}

function searchEmployee()
{
    var search_key = $('#search_keyword').val();
    if(search_key)
    {
      if ($.fn.DataTable.isDataTable("#datatableUser")) {
        $('#datatableUser').DataTable().clear().destroy();
      }  
      var dataTable = $('#datatableUser').DataTable({  
       "processing":true,  
       "serverSide":true,  
       "order":[],
       "searching": false,
       "ajax":{  
            url: "<?php echo base_url('admin/getemployeelist')?>",
            type:"POST",
            data:{'search_key':search_key}
         }
      });
    }
    else
    {
      swal("Empty Search Keyword", "Please Enter Employee Name for Search", "error");
      return false;
    }
}
</script>