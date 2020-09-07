<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function checkLeadExist($mobile)
    {
        $this->db->select('id');
        $this->db->from('mst_lead');
        $this->db->where('mst_lead.mobile_no',$mobile);
        $this->db->limit(1);
        $resultData = $this->db->get();
        $resultArray = $resultData->result_array();
        if(!empty($resultArray) && !empty($resultArray[0]['id']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function saveNew($data,$file_name,$created_by)
    {
        $inputdata = array(
        'emp_name'=>$data['emp_name'],
        'adddress'=>$data['address'],
        'email'=>$data['emp_email'],
        'phone'=>$data['phone'],
        'dob'=>$data['dob'],
        'profile_pic'=>(!empty($file_name)) ? $file_name :null,
        'created_by'=>$created_by,
        'created_at'=>date('Y-m-d h:i:s'),
        'updated_by'=>$created_by,
        'updated_at'=>date('Y-m-d h:i:s'),
        );
        
        $flag = $this->db->insert('mst_emp_base',$inputdata);
        if($flag)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateEmpDetails($data,$file_name,$created_by)
    {
        $inputdata = array(
        'emp_name'=>$data['emp_name'],
        'adddress'=>$data['address'],
        //'email'=>$data['emp_email'],
        'phone'=>$data['phone'],
        'dob'=>$data['dob'],
        'profile_pic'=>(!empty($file_name)) ? $file_name :null,
        'updated_by'=>$created_by,
        'updated_at'=>date('Y-m-d h:i:s'),
        );
        $this->db->where('mst_emp_base.id',$data['emp_id']);
        $flag = $this->db->update('mst_emp_base',$inputdata);
        if($flag)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function DeleteEmployee($empId)
    {   
        $profilePic ='';
        if($empId)
        {   
            $this->db->select('mst_emp_base.profile_pic');
            $this->db->from('mst_emp_base');
            $this->db->where('mst_emp_base.id',$empId);
            $query = $this->db->get();
            $resultData = $query->result_array();
            if($resultData[0]['profile_pic'])
            {
                $profilePic = $resultData[0]['profile_pic'];
            }
            $this->db->where('mst_emp_base.id',$empId);
            $deleteFlag = $this->db->delete('mst_emp_base');
            if($deleteFlag)
            {
               $removePics = $this->RemoveEmpPics($empId,$profilePic);
                return $removePics;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        } 
    }

    public function RemoveEmpPics($empId,$file_name)
    {
        if($empId)
        {   
            if(!empty($file_name))
            {
                unlink('uploads/'.$file_name);
                return true;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    public function getEmployeeList($search_keyword,$empId)
    {   
        if($empId)
        {
          $this->db->select('mst_emp_base.*');
          $this->db->from('mst_emp_base');
          $this->db->where('mst_emp_base.id',$empId);
          $query = $this->db->get();  
          $ressultData = $query->result_array();
          return $ressultData;
        }
        else
        {
            $this->db->select('mst_emp_base.id,mst_emp_base.emp_name,mst_emp_base.adddress,mst_emp_base.email,mst_emp_base.phone,mst_emp_base.dob,mst_emp_base.profile_pic,created_at,mst_user.name as created_by');
            $this->db->from('mst_emp_base');
            if($search_keyword)
            {
               $this->db->like('mst_emp_base.emp_name',$search_keyword); 
            }
            $this->db->join('mst_user','mst_user.id=mst_emp_base.created_by','inner join');
            $this->db->order_by('mst_emp_base.created_at', 'DESC');
            $resultData = $this->db->get();
            return $resultData;
        }
    }
    
    
}
?>