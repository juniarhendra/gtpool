<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_manage extends CI_Controller {

	function Group_manage()
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
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; Group User Management';
		$theme['mainmenu']		= 'User';
		$theme['subttl']		= 'Group User Management';

		$theme['lblInputForm']	= 'Input Group User';
		$theme['lblListData']	= 'List Group User';
		$theme['lblInputBtn']	= 'Save';

		$view['show']			= $this->group_model->show_group_user();
		$view['showMenuActive'] = $this->menu_model->show_menu_all_active();

		$theme['countUser']		= $this->auth_model->countUser();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= '';
		$theme['clGroup'] 		= 'active';
		$theme['clRef'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= 'display:block;';
		$theme['styRef'] 		= '';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'group_manage/index';
		$theme['get']			= $view;

		if (isset($_POST['save'])){
			$group			= $this->input->post('group');
			$desk			= $this->input->post('desk');
			$menu			= $this->input->post('menu');

			$cekGroup		= $this->group_model->cek_group_available_entry($group);

			$this->form_validation->set_rules('group','Group Name','required');

			if($cekGroup == TRUE){
				$this->session->set_flashdata('err_msg', 'Group Name "'.$group.'" Sudah Terdaftar..!');
				redirect('group_manage/index');
			}

			if ($this->form_validation->run())
			{
				$tabel		= 'gsfw_group_access';
				$fieldId	= 'GroupId';
				$getLastId	= $this->main_model->getLastId($tabel,$fieldId);
				$id			= $getLastId->row()->$fieldId;
				$idFix		= $id + 1;

				$entryGroup =  $this->group_model->entry($idFix, $group, $desk);
				if ($entryGroup) {
					if (!empty($menu)) {
						for ($i=0; $i < sizeof($menu); $i++) { 
							$this->group_model->entryGroupMenu($idFix, $menu[$i]);
						}
					}
				}
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully add data');
				redirect('group_manage/index');
			}
		}
		
		$theme['GroupName']		= '';
		$theme['Description']	= '';

		$this->load->view('main/index', $theme);
	}

	function up($param)
	{
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; Group User Management';
		$theme['mainmenu']		= 'User';
		$theme['subttl']		= 'Group User Management';

		$theme['lblInputForm']	= 'Update Group User';
		$theme['lblListData']	= 'List Group User';
		$theme['lblInputBtn']	= 'Update';

		$view['show']			= $this->group_model->show_group_user();
		$view['showMenuActive'] = $this->menu_model->show_menu_all_active();
		$view['param'] 			= $param;

		$theme['countUser']		= $this->auth_model->countUser();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= '';
		$theme['clGroup'] 		= 'active';
		$theme['clRef'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= 'display:block;';
		$theme['styRef'] 		= '';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'group_manage/update';
		$theme['get']			= $view;

		if (isset($_POST['save'])){
			$group			= $this->input->post('group');
			$desk			= $this->input->post('desk');
			$menu			= $this->input->post('menu');

			$cekGroup		= $this->group_model->cek_group_available_update($group,$param);

			$this->form_validation->set_rules('group','Group Name','required');

			if($cekGroup == TRUE){
				$this->session->set_flashdata('err_msg', 'Group Name "'.$group.'" Sudah Terdaftar..!');
				redirect('group_manage/update');
			}

			if ($this->form_validation->run())
			{
				$updateGroup =  $this->group_model->update($param, $group, $desk);
				if ($updateGroup) {
					$delMenuChecked = $this->group_model->delete_menu_checked($param);
					if (!empty($menu)) {
						for ($i=0; $i < sizeof($menu); $i++) {
							$this->group_model->entryGroupMenu($param, $menu[$i]);
						}
					}
				}
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully update data');
				redirect('group_manage/index');
			}
		}

		$showupdate 			= $this->group_model->show_group_user_id($param);
		$theme['countUser']		= $this->auth_model->countUser();

		foreach ($showupdate as $key => $value) {
			$theme['GroupName']		= $showupdate->row()->GroupName;
			$theme['Description']	= $showupdate->row()->Description;
		}

		$this->load->view('main/index', $theme);
	}

    function del($param) 
	{	
		if(empty($param)){
			redirect('group_manage/index');
		} else {
			$delMenuChecked = $this->group_model->delete_menu_checked($param);
			if ($delMenuChecked) {
				$this->group_model->delete($param);
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully delete data');
			}else{
				$this->session->set_flashdata('err_msg', 'Cannot Delete Group Name..!');
			}
			redirect('group_manage/index'); 
		}
    }
	
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
