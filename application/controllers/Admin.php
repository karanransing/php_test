<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	public $createdBy;
	public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') && !$this->session->userdata('user_id'))
        {    
            redirect('/');
        }
        $this->load->model('Admin_model');
        $this->createdBy = $this->session->userdata('user_id');
    }
    
    public function loadDashboard()
    {
        $this->load->view('includes/header');
        $this->load->view('admin/dashboard');
        $this->load->view('alert');
    }

    public function getEmployeeList()
    {   
        $data = $this->input->post();
        $search_keyword = (!empty($data['search_key'])) ? $data['search_key'] :'';
        $empData=$this->Admin_model->getEmployeeList($search_keyword,0);
        $srno=$_POST['start']+1;
        $data=array();
        foreach($empData->result() as $row) 
        {
            if(strtotime($row->created_at) > 0)
            {
                $date = nice_date($row->created_at,'d F Y h:i');
            }
            else
            { 
                $date = "NA";
            }

            if(strtotime($row->dob) > 0)
            {
                $dob = nice_date($row->dob,'d F Y');
            }
            else
            { 
                $dob = "NA";
            }
            if(!empty($row->profile_pic))
            {
                $url = base_url('uploads/'.$row->profile_pic);
                $img_html='<img src="'.$url.'" class="img-thumbnail" alt="Emp Pic" style="max-width:50%;">';
            }
            else
            {   
                $img_html='NA';
            }

            $action_path1 =base_url('admin/editemp/'.$row->id); 
            $action_path2 =base_url('admin/delete/'.$row->id);
            /* href="'.$action_path2.'" */
            $action_html='<a href="'.$action_path1.'" class="btn btn-sm btn-info" data-toggle="tooltip" title="Update Employee Details"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp; <a onclick="deleteEmp('.$row->id.')" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Employee Details"><i class="fa fa-trash" aria-hidden="true"></i></i></a>';

           $data[] = [
                $srno,
                $row->emp_name,
                $row->adddress,
                $row->phone,
                $row->email,
                $dob,
                $img_html,
                $row->created_by,
                $date,
                $action_html
            ];
        
            $srno++;
        }
       $dataCount=count($empData->result());
        $output =[
            "draw"              =>  intval( $_POST['draw']),  
            "recordsTotal"      =>  $dataCount,  
            "recordsFiltered"   =>  $dataCount,  
            "data"              =>  $data  
            
        ];
        echo json_encode($output);
    }

    public function addNew()
    {   
        $this->load->view('includes/header');
        $this->load->view('admin/addnew');
        $this->load->view('alert');
    }
    
    public function saveNew()
    {   
        $redirect_url= base_url('admin/addnew');
        $data =  $this->input->post();
        $this->form_validation->set_rules('emp_email', 'Employee Email', 'required|is_unique[mst_emp_base.email]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {   
            if(!empty($data) && !empty($_FILES['emp_pics']['name']))
            {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg|png|jpeg|gif';
                $config['max_size']             = 100000 /*kilobytes*/;
                $config['remove_spaces'] = FALSE;
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('emp_pics'))
                {
                    $this->session->set_flashdata('error',$this->toastr->error($this->upload->display_errors()));
                    redirect($redirect_url,'refresh');
                }
                else
                { 
                    /* upload successfull */
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    $insertFlag =  $this->Admin_model->saveNew($data,$file_name,$this->createdBy);
                    if($insertFlag)
                    {
                        $this->session->set_flashdata('success','Employee Details Saved Successfully!');
                        redirect($redirect_url,'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('error','Something Went Wrong Unable to Save Employee Details');
                        redirect($redirect_url,'refresh');
                    }
                } 
            }
            else
            {
                $this->session->set_flashdata('error','Form Not submitted Properly');
                redirect($redirect_url,'refresh');
            }
        }
    }
    
    public function DeleteEmployee()
    {
        $data = $this->input->post();
        $result = array();
        if(!empty($data['empId']))
        {
            $deleteFlag=$this->Admin_model->DeleteEmployee($data['empId']);
            if($deleteFlag)
            {
                $result = array('status'=>true,'msg'=>'success');
            }
            else
            {
                $result = array('status'=>false,'msg'=>'Something Went Wrong Unable to Delete Record!');  
            }
        }
        else
        {
            $result = array('status'=>false,'msg'=>'Empty EmployeeId!');
        }
        echo json_encode($result);
    }

    public function editEmp($empId)
    {   
        $empData = $this->Admin_model->getEmployeeList('',$empId);
        $empData = (!empty($empData[0])) ? $empData[0]:$empData;
        $this->load->view('includes/header');
        $this->load->view('admin/updateview',['empData'=>$empData]);
        $this->load->view('alert');
    }
    
    public function updateEmployee()
    {
        $data =  $this->input->post();
        if(!empty($data['emp_id']))
        {   
            $file_name = $data['profile_pic'];
            $redirect_url= base_url('admin/editemp/'.$data['emp_id']);
            if(!empty($_FILES['emp_pics']['name']))
            {    
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg|png|jpeg|gif';
                $config['max_size']             = 100000 /*kilobytes*/;
                $config['remove_spaces'] = FALSE;
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('emp_pics'))
                {
                    $this->session->set_flashdata('error',$this->toastr->error($this->upload->display_errors()));
                    redirect($redirect_url,'refresh');
                }
                else
                { 
                    /* upload successfull */
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    $remove_file = $this->Admin_model->RemoveEmpPics($data['emp_id'],$data['profile_pic']);
                }
                $updateFlag =  $this->Admin_model->updateEmpDetails($data,$file_name,$this->createdBy);
                if($updateFlag)
                {
                    $this->session->set_flashdata('success','Employee Details Updated Successfully!');
                    redirect($redirect_url,'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error','Something Went Wrong Unable to Update Employee Details');
                    redirect($redirect_url,'refresh');
                }
            }
            else
            {
                $updateFlag =  $this->Admin_model->updateEmpDetails($data,$file_name,$this->createdBy);
                if($updateFlag)
                {
                    $this->session->set_flashdata('success','Employee Details Updated Successfully!');
                    redirect($redirect_url,'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error','Something Went Wrong Unable to Update Employee Details');
                    redirect($redirect_url,'refresh');
                }
            } 
        }
        else
        {
            $this->session->set_flashdata('error','Form Not submitted Properly');
            redirect($redirect_url,'refresh');
        }
    }
}
?>