<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_manage extends CI_Controller {

	function User_manage()
	{
		parent::__construct();
		session_start();
		$this->load->model('main_model');
		$this->load->model('auth_model');
		$this->load->model('company_model');
		$this->load->model('project_model');
		$this->load->model('user_model');
		$this->load->model('group_model');
		$this->load->model('menu_model');
		if(!$this->session->userdata('username')) redirect();
		if ($this->auth_model->is_logged_in() == FALSE) redirect('auth');

		$this->load->language("organization","english");
	}
	
	function index()
	{		
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; User Management';
		$theme['mainmenu']		= 'User';
		$theme['subttl']		= 'User Management';

		$theme['lblInputForm']	= 'Input User';
		$theme['lblListData']	= 'List User';
		$theme['lblInputBtn']	= 'Save';

		$view['show']			= $this->user_model->show_user();
		$theme['grupCombo'] 	= $this->group_model->show_group_user();
		$theme['countUser']		= $this->auth_model->countUser();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= 'active';
		$theme['clRef'] 		= '';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= 'display:block;';
		$theme['styRef'] 		= '';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'user_manage/index';
		$theme['get']			= $view;

		if (isset($_POST['save'])){
			$namalengkap	= $this->input->post('namalengkap');
			$username		= $this->input->post('username');
			$password_1		= $this->input->post('password_1');
			$password_2		= $this->input->post('password_2');
			$desk			= $this->input->post('desk');
			$aktif			= $this->input->post('aktif');
			$grupuser 		= $this->input->post('grupuser');

			$cekUsername	= $this->user_model->cek_username($username);

			$this->form_validation->set_rules('namalengkap','Real Name','required');
			$this->form_validation->set_rules('username','Username','required|min_length[4]|max_length[25]');
			$this->form_validation->set_rules('password_1','Password','required|min_length[4]|max_length[25]');
			$this->form_validation->set_rules('password_2','Password Again','required|matches[password_1]');

			if($cekUsername == TRUE){
				$this->session->set_flashdata('err_msg', 'Username "'.$username.'" Sudah Terdaftar..!');
				redirect('user_manage/index');
			}

			if ($this->form_validation->run())
			{
				$tabel		= 'gsfw_user';
				$fieldId	= 'UserId';
				$getLastId	= $this->main_model->getLastId($tabel,$fieldId);
				$id			= $getLastId->row()->$fieldId;
				$idFix		= $id + 1;

				$entryUser = $this->user_model->entry($idFix, $namalengkap, $username, $password_1, $desk, $aktif);
				if ($entryUser) {
					$this->group_model->entry_user_group($idFix,$grupuser);
				}

				$this->session->set_flashdata('sks_msg', 'Well done! You successfully add data');
				redirect('user_manage/index');
			}
		}
		
		$theme['RealName']		= '';
		$theme['UserName']		= '';
		$theme['password_1']	= '';
		$theme['password_2']	= '';
		$theme['displayPasswd']	= '';
		$theme['reqPasswd']		= 'required';
		$theme['Description']	= '';
		$theme['GroupIdUp'] 	= '';
		$theme['checked'] 		= "";
		$theme['readonly']		= 'data-toggle="popover" data-placement="top" data-content="Isi dengan UserName..."';

		$this->load->view('main/index', $theme);
	}

	function up($param)
	{		
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; User Management';
		$theme['mainmenu']		= 'User';
		$theme['subttl']		= 'User Management';

		$theme['lblInputForm']	= 'Update User';
		$theme['lblListData']	= 'List User';
		$theme['lblInputBtn']	= 'Update';

		$view['show']			= $this->user_model->show_user();
		$theme['grupCombo'] 	= $this->group_model->show_group_user();
		$theme['countUser']		= $this->auth_model->countUser();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= 'active';
		$theme['clRef'] 		= '';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= 'display:block;';
		$theme['styRef'] 		= '';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'user_manage/index';
		$theme['get']			= $view;

		if (isset($_POST['save'])){
			$namalengkap	= $this->input->post('namalengkap');
			$username		= $this->input->post('username');
			// $password_1		= $this->input->post('password_1');
			// $password_2		= $this->input->post('password_2');
			$desk			= $this->input->post('desk');
			$aktif			= $this->input->post('aktif');
			$grupuser 		= $this->input->post('grupuser');

			$this->form_validation->set_rules('namalengkap','Real Name','required');
			// $this->form_validation->set_rules('password_1','Password','required|min_length[4]|max_length[25]');
			// $this->form_validation->set_rules('password_2','Password Again','required|matches[password_1]');

			if ($this->form_validation->run())
			{
				$updateUser =  $this->user_model->update($param, $namalengkap, $desk, $aktif);
				if ($updateUser) {
					$updateUserGroup = $this->group_model->update_user_group($grupuser,$param);
				}
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully update data');
				redirect('user_manage/index');
			}
		}

		$showupdate 			= $this->user_model->show_user_id($param);
		$theme['countUser']		= $this->auth_model->countUser();

		foreach ($showupdate as $key => $value) {
			$theme['RealName']		= $showupdate->row()->RealName;
			$theme['UserName']		= $showupdate->row()->UserName;
			$theme['password_1']	= '';
			$theme['password_2']	= '';
			$theme['displayPasswd']	= 'none';
			$theme['reqPasswd']		= '';
			$theme['Description']	= $showupdate->row()->Description;
			$Active					= $showupdate->row()->Active;
			$theme['GroupIdUp']		= $showupdate->row()->GroupId;
			if ($Active == "Yes") $theme['checked'] = 'checked="checked"';
			else  $theme['checked'] = "";
			$theme['readonly']		= 'id="readonlyinput" readonly="readonly"';
		}

		$this->load->view('main/index', $theme);
	}

	function uppasswd()
	{
		$param					= $this->session->userdata('userIdAkses');
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; User Management';
		$theme['mainmenu']		= 'User';
		$theme['subttl']		= 'User Management';

		$theme['lblInputForm']	= 'Update Password';
		$theme['lblInputBtn']	= 'Update';

		$theme['countUser']		= $this->auth_model->countUser();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= 'active';
		$theme['clRef'] 		= '';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= 'display:block;';
		$theme['styRef'] 		= '';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'user_manage/uppasswd';
		$theme['get']			= '';

		if (isset($_POST['save'])){
			$password_1		= $this->input->post('password_1');
			$password_2		= $this->input->post('password_2');

			$this->form_validation->set_rules('password_1','Password','required|min_length[4]|max_length[25]');
			$this->form_validation->set_rules('password_2','Password Again','required|matches[password_1]');

			if ($this->form_validation->run())
			{
				$updatePassword =  $this->user_model->update_password($param, $password_1);
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully update data');
				redirect('user_manage/uppasswd');
			}
		}

		$showupdate 			= $this->user_model->show_user_id($param);
		$theme['countUser']		= $this->auth_model->countUser();

		foreach ($showupdate as $key => $value) {
			$theme['password_1']	= '';
			$theme['password_2']	= '';
		}

		$this->load->view('main/index', $theme);
	}

	function profile()
	{
		$param					= $this->session->userdata('userIdAkses');
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; Profile Management';
		$theme['mainmenu']		= 'My Profile';
		$theme['subttl']		= 'Profile Management';

		$theme['grupCombo'] 	= $this->group_model->show_group_user();
		$theme['countUser']		= $this->auth_model->countUser();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= 'active';
		$theme['clRef'] 		= '';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= 'display:block;';
		$theme['styRef'] 		= '';

		$theme['content'] 		= 'user_manage/profile';
		$theme['get']			= '';

		$showupdate 			= $this->user_model->show_user_id($param);
		$theme['countUser']		= $this->auth_model->countUser();

		foreach ($showupdate as $key => $value) {
			$theme['userId']		= $param;
			$theme['RealName']		= $showupdate->row()->RealName;
			$theme['UserName']		= $showupdate->row()->UserName;
			$theme['Description']	= $showupdate->row()->Description;
			$Active					= $showupdate->row()->Active;
			$theme['GroupName']		= $showupdate->row()->GroupName;
			if ($Active == "Yes") $theme['checked'] = 'Active';
			else  $theme['checked'] = "Not Active";
		}

		$this->load->view('main/index', $theme);
	}

    function del($param) 
	{	
		if(empty($param)){
			redirect('user_manage/index');
		} else {
			$deleteUserGroup =  $this->group_model->delete_user_group($param);
			if ($deleteUserGroup) {
				$this->user_model->delete($param);
			}
			$this->session->set_flashdata('sks_msg', 'Well done! You successfully delete data');
			redirect('user_manage/index'); 
		}
    }
	
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
