<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_manage extends CI_Controller {

	function Project_manage()
	{
		parent::__construct();
		session_start();
		$this->load->model('auth_model');
		$this->load->model('company_model');
		$this->load->model('project_model');
		$this->load->model('main_model');
		if(!$this->session->userdata('username')) redirect();
		if ($this->auth_model->is_logged_in() == FALSE) redirect('auth');

		$this->load->language("organization","english");
	}
	
	function index()
	{		
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; Project Management';
		$theme['mainmenu']		= 'Project Management';
		$theme['subttl']		= 'Project Management';

		$theme['lblInputForm']	= 'Input Project';
		$theme['lblListData']	= 'List Project';
		$theme['lblInputBtn']	= 'Save';

		$view['show']			= $this->project_model->show_project();
		$view['compAct']		= $this->company_model->show_company_is_active();
		$theme['countUser']		= $this->auth_model->countUser();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= '';
		$theme['clRef'] 		= '';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= 'active';
		$theme['styUsr'] 		= '';
		$theme['styRef'] 		= '';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'project_manage/index';
		$theme['get']			= $view;

		if (isset($_POST['save'])){
			$kode		= $this->input->post('kode');
			$company 	= $this->input->post('company');
			$pekerjaan	= $this->input->post('pekerjaan');
			$status		= $this->input->post('status');
			$desk		= $this->input->post('desk');
			$usIdEntry	= $this->session->userdata('userIdAkses');

			$cekKode	= $this->project_model->cek_kode_available_entry($kode);

			$this->form_validation->set_rules('kode','Project Code','required');
			$this->form_validation->set_rules('company','Company Name','required');
			$this->form_validation->set_rules('pekerjaan','Project Name','required');
			$this->form_validation->set_rules('status','Status Project','required');
			$this->form_validation->set_rules('desk','Project Description','required');

			if($cekKode == TRUE){
				$this->session->set_flashdata('err_msg', 'Project Code "'.$kode.'" Sudah Terdaftar..!');
				redirect('project_manage/index');
			}

			if ($this->form_validation->run())
			{
				$tabel		= 'proman_project';
				$fieldId	= 'ProjectId';
				$getLastId	= $this->main_model->getLastId($tabel,$fieldId);
				$id			= $getLastId->row()->$fieldId;
				$idFix		= $id + 1;
				$this->project_model->entry($idFix, $kode, $pekerjaan, $company, $desk, $status, $usIdEntry);
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully add data');
				redirect('project_manage/index');
			}
		}
		
		$theme['ProjectCode']			= '';
		$theme['CompanyName']			= '';
		$theme['ProjectName']			= '';
		$theme['ProjectDescription']	= '';
		$theme['ProjectStatusProc'] 	= '';
		$theme['ProjectStatusDone'] 	= '';

		$this->load->view('main/index', $theme);
	}

	function up($param)
	{		
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; Project Management';
		$theme['mainmenu']		= 'Project Management';
		$theme['subttl']		= 'Update - Project Management';

		$theme['lblInputForm']	= 'Update Project';
		$theme['lblListData']	= 'List Project';
		$theme['lblInputBtn']	= 'Update';

		$view['show']			= $this->project_model->show_project();
		$view['compAct']		= $this->company_model->show_company_is_active();
		$theme['countUser']		= $this->auth_model->countUser();

		$showupdate 			= $this->project_model->show_project_id($param);

		foreach ($showupdate as $key => $value) {
			$theme['ProjectCode']			= $showupdate->row()->ProjectCode;
			$theme['CompanyIdUp']			= $showupdate->row()->ProjectCompanyId;
			$theme['ProjectName']			= $showupdate->row()->ProjectName;
			$theme['ProjectDescription']	= $showupdate->row()->ProjectDescription;
			$ProjectStatus					= $showupdate->row()->ProjectStatus;
			if ($ProjectStatus == 'Processing'){
				$theme['ProjectStatusProc'] = 'selected';
				$theme['ProjectStatusDone'] = '';
			}else if ($ProjectStatus == 'Done'){
				$theme['ProjectStatusProc'] = '';
				$theme['ProjectStatusDone'] = 'selected';
			}

		}

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= '';
		$theme['clRef'] 		= '';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= 'active';
		$theme['styUsr'] 		= '';
		$theme['styRef'] 		= '';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'project_manage/index';
		$theme['get']			= $view;

		if (isset($_POST['save'])){
			$kode		= $this->input->post('kode');
			$company 	= $this->input->post('company');
			$pekerjaan	= $this->input->post('pekerjaan');
			$status		= $this->input->post('status');
			$desk		= $this->input->post('desk');
			$usIdEntry	= $this->session->userdata('userIdAkses');

			$cekKode	= $this->project_model->cek_kode_available_update($kode,$param);

			$this->form_validation->set_rules('kode','Project Code','required');
			$this->form_validation->set_rules('company','Company Name','required');
			$this->form_validation->set_rules('pekerjaan','Project Name','required');
			$this->form_validation->set_rules('status','Status Project','required');
			$this->form_validation->set_rules('desk','Project Description','required');

			if($cekKode == TRUE){
				$this->session->set_flashdata('err_msg', 'Project Code "'.$kode.'" Sudah Terdaftar..!');
				redirect('project_manage/index');
			}

			if ($this->form_validation->run())
			{
				$this->project_model->update($kode, $pekerjaan, $company, $desk, $status, $usIdEntry, $param);
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully update data');
				redirect('project_manage/index');
			}
		}

		$this->load->view('main/index', $theme);
	}

	function detail($id)
	{
		$theme['app_name']	= $this->lang->line("app_name_simple");
		$theme['title']		= $this->lang->line("app_name_long") .' &raquo; Project Management';
		$theme['mainmenu']	= 'Project Management';
		$theme['subttl']	= 'Project Management';
		$theme['content']	= 'project_manage/detail';
		$view['show']		= $this->project_model->show_project_id($id);
		$theme['get']		= $view;

		$this->load->view('main/index', $theme);
	}

	
    function del($param) 
	{	
		if(empty($param)){
			redirect('project_manage/index');
		} else {
			$this->project_model->delete($param);
			$this->session->set_flashdata('sks_msg', 'Well done! You successfully delete data');
			redirect('project_manage/index'); 
		}
    }
	
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
