<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function Auth()
	{
		parent::__construct();
		// session_start();
		$this->load->model('auth_model');
		// if(!$this->session->userdata('username')) redirect();
		// if ($this->auth_model->is_logged_in() == FALSE) redirect('auth');
		// else redirect('main/home');

		$this->load->language("organization","english");

	}
	
	function index()
	{

		// $sesslang = array (
		// 	'username'    => $user,
		// 	'password'    => $password,
		// );										
		// $this->session->set_userdata($sesslang);

		$theme['app_name'] 		= $this->lang->line("app_name_simple");
		$theme['app_footer']	= $this->lang->line("app_name_long");
		$theme['title']    		= $this->lang->line("app_name_long") .' &raquo; Dashboard';

		$error_msg 				= $this->session->flashdata('error_msg');
		if(!empty($error_msg)){
			$theme['error_msg_dsp'] = '';
			$theme['error_msg'] 	= $this->session->flashdata('error_msg');
		}else{
			$theme['error_msg_dsp'] = 'hide';
			$theme['error_msg'] 	= '';
		}
		$this->load->view('auth/login', $theme);
	}

	function login()
	{
		if ($this->input->post('login'))
		{
			$user     = $this->input->post('username');
			$password = $this->input->post('password');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('error_msg', "proses login gagal...!");
				redirect('auth');
			}
			else 
			{
				if ($this->auth_model->cek_user($user, $password) == TRUE)
				{
					$getRowAkses	= $this->auth_model->cekAkses($user);
					$newdata 		= array (
						'userIdAkses' 	=> $getRowAkses->row()->UserId,
						'username'    	=> $user,
						'realNameAkses' => $getRowAkses->row()->RealName,
						'deskAkses' 	=> $getRowAkses->row()->Description,
						'password'    	=> $password,
					);										
					$this->session->set_userdata($newdata);
					redirect('main');
				}
				else 
				{
					$this->session->set_flashdata('error_msg',  'Username atau Password salah');
					redirect('auth');
				}
				
			}
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
