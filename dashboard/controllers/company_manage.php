<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_manage extends CI_Controller {

	function Company_manage()
	{
		parent::__construct();
		session_start();
		$this->load->model('main_model');
		$this->load->model('auth_model');
		$this->load->model('company_model');
		$this->load->model('project_model');
		if(!$this->session->userdata('username')) redirect();
		if ($this->auth_model->is_logged_in() == FALSE) redirect('auth');

		$this->load->language("organization","english");
	}
	
	function index()
	{		
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; Company Management';
		$theme['mainmenu']		= 'Referency Management';
		$theme['subttl']		= 'Company Management';

		$theme['lblInputForm']	= 'Input Company';
		$theme['lblInputBtn']	= 'Save';

		$view['show']			= $this->company_model->show_company();
		$theme['countUser']		= $this->auth_model->countUser();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= '';
		$theme['clRef'] 		= 'active';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= '';
		$theme['styRef'] 		= 'display:block;';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'company_manage/index';
		$theme['get']			= $view;

		if (isset($_POST['save'])){
			$nama		= $this->input->post('nama');
			$alamat		= $this->input->post('alamat');
			$telp		= $this->input->post('telp');
			$desk		= $this->input->post('desk');
			$aktif		= $this->input->post('aktif'); if (empty($aktif)) $aktif = 'Not Active';
			$usIdEntry	= $this->session->userdata('userIdAkses');

			$cekNama	= $this->company_model->cek_name_available_entry($nama);

			$this->form_validation->set_rules('nama','Company Name','required|max_length[100]');

			if($cekNama == TRUE){
				$this->session->set_flashdata('err_msg', 'Company Name "'.$nama.'" Sudah Terdaftar..!');
				redirect('company_manage/index');
			}

			if ($this->form_validation->run())
			{
				$tabel		= 'proman_company_ref';
				$fieldId	= 'CompanyId';
				$getLastId	= $this->main_model->getLastId($tabel,$fieldId);
				$id			= $getLastId->row()->$fieldId;
				$idFix		= $id + 1;
				$this->company_model->entry($idFix, $nama, $alamat, $telp, $desk, $aktif, $usIdEntry);
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully add data');
				redirect('company_manage/index');
			}
		}
		
		$theme['CompanyName']			= '';
		$theme['CompanyAddress']		= '';
		$theme['CompanyTelp']			= '';
		$theme['CompanyDescription']	= '';
		$theme['checked'] 				= "";

		$this->load->view('main/index', $theme);
	}

	function up($param)
	{		
		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; Company Management';
		$theme['mainmenu']		= 'Referency Management';
		$theme['subttl']		= 'Update - Company Management';

		$theme['lblInputForm']	= 'Update Company';
		$theme['lblInputBtn']	= 'Update';

		$showupdate 			= $this->company_model->show_company_id($param);
		$theme['countUser']		= $this->auth_model->countUser();

		foreach ($showupdate as $key => $value) {
			$theme['CompanyName']			= $showupdate->row()->CompanyName;
			$theme['CompanyAddress']		= $showupdate->row()->CompanyAddress;
			$theme['CompanyTelp']			= $showupdate->row()->CompanyNoTelp;
			$theme['CompanyDescription']	= $showupdate->row()->CompanyDescription;
			$Active							= $showupdate->row()->CompanyStatusAktif;
			if ($Active == "Active") $theme['checked'] = 'checked="checked"';
			else $theme['checked'] 		= "";
		}

		$view['show']			= $this->company_model->show_company();

		$theme['clDbd'] 		= '';
		$theme['clUsr'] 		= '';
		$theme['clRef'] 		= 'active';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= '';
		$theme['styRef'] 		= 'display:block;';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'company_manage/index';
		$theme['get']			= $view;

		if (isset($_POST['save'])){
			$nama		= $this->input->post('nama');
			$alamat		= $this->input->post('alamat');
			$telp		= $this->input->post('telp');
			$desk		= $this->input->post('desk');
			$aktif		= $this->input->post('aktif'); if (empty($aktif)) $aktif = 'Not Active';
			$usIdEntry	= $this->session->userdata('userIdAkses');

			$cekNama	= $this->company_model->cek_name_available_update($nama,$param);

			$this->form_validation->set_rules('nama','Company Name','required|max_length[100]');

			if($cekNama == TRUE){
				$this->session->set_flashdata('err_msg', 'Company Name "'.$nama.'" Sudah Terdaftar..!');
				redirect('company_manage/index');
			}

			if ($this->form_validation->run())
			{
				$this->company_model->update($nama, $alamat, $telp, $desk, $aktif, $usIdEntry, $param);
				$this->session->set_flashdata('sks_msg', 'Well done! You successfully update data');
				redirect('company_manage/index');
			}
		}
		
		$this->load->view('main/index', $theme);
	}

    function del($param) 
	{	
		if(empty($param)){
			redirect('company_manage/index');
		} else {
			$this->company_model->delete($param);
			$this->session->set_flashdata('sks_msg', 'Well done! You successfully delete data');
			redirect('company_manage/index'); 
		}
    }
	
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
