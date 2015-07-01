<?php
/*
 * By calling this php file users can be made to log in on this site
 * After making the users login, it stores their details in session
 */
class Login extends CI_Controller 
{
        public $username;
        public $status;
        public $user_id;
        public $type=0;
        public $url;
      
        function index()
	{
		$this->load->helper('url');
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required|callback_check_details');
                
		$this->load->library('form_validation');
                
		if($this->session->userdata('loggedin')==1)//already done
                {
                    redirect('/all_events');
                }
                else if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('Login_form');
		}
		else
		{

                    if($this->session->userdata("redirect_back") == 1)//anyone wants to get back            
                    {
                        $this->url = $this->session->userdata("redirect_back_url");
                        $this->session->unset_userdata("redirect_back_url");
                        $this->session->unset_userdata("redirect_back");
                        $str = "Location: ".$this->url;
                        header($str);
                    }
                    else 
                    {
                        redirect('/all_events'); //otherwise
                    }
                }
	}
        
        function check_details()
        {
            $username =   $this->input->post('username');
            $this->username = $username;
            $password = $this->input->post('password');
            $query=  $this->db->query("select *  from users where username='$username'");
//            echo $hash;
            if ($query->num_rows()>0)
            {
                foreach($query->result() as $row)
                {
                    if ($this->bcrypt->check_password($password, $row->password))
                    {
                        $this->user_id = $row->user_id;
                        $this->type = $row->type;
                        $this->status=1;
                        $this->session->set_userdata('loggedin',1);
                        $this->session->set_userdata('username',$this->username);
                        $this->session->set_userdata('user_id',$this->user_id);
                        $this->session->set_userdata('type',$this->type);
                        $this->session->set_userdata('full_name',$row->full_name);
                         return TRUE;
                    }

                }
            }
            $this->form_validation->set_message('check_details', 'The username or password is incorrect '.$hash);
            return FALSE;
        }        
}