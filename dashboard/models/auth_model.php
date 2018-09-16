<?php 
class Auth_model extends CI_Model {

	function Auth_model(){
		parent::__construct();
//		$query = $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'");
	}
	
	function is_logged_in() {
        if ($this->session) {
            $user     = $this->session->userdata('username');
            $password = $this->session->userdata('password');
			
            if ($this->cek_user($user, $password) == TRUE) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
    }
	
	function cek_user($user, $password) {
	 	$getpassword = md5($password);
		$query  = "SELECT * FROM gsfw_user WHERE UserName = '$user' AND Password = '$getpassword'";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
	
	function update_pass()
	{
		$username	 = $this->session->userdata('username');
		$passbaru 	 = $this->input->post('passwd1');
		$getpassword = md5($passbaru);
		
		$query = "UPDATE gsfw_user SET Password = '$getpassword' WHERE UserName = '$username'";
		return $this->db->query($query);
	}
	
	function cekAkses($username)
	{
		$query  = "SELECT * FROM gsfw_user WHERE UserName = '$username'";
		$result = $this->db->query($query);
		return $result;
	}

	function countUser()
	{
		$query  = "SELECT * FROM gsfw_user";
		$result = $this->db->query($query);
		return $result;
	}

/* ================================================================================================================================== */	
}
