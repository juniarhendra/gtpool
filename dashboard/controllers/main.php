<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function Main()
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
		$getLang = "english";
		$this->load->language("content",$getLang);

		$theme['app_name']			= $this->lang->line("app_name_simple");
		$theme['title']				= $this->lang->line("app_name_long") .' &raquo; Dashboard';
		$theme['mainmenu']			= 'Dashboard';
		$theme['subttl']			= 'Home';

		$theme['countUser']			= $this->auth_model->countUser();
		$theme['countComp']			= $this->company_model->count_company();
		$theme['countCompAct']		= $this->company_model->count_company_is_active();
		$theme['countCompNoAct']	= $this->company_model->count_company_is_notactive();

		$getYears = date("Y");
		$getMonth = date("m");
		$theme['countProjNow']		= $this->project_model->show_project_now($getMonth,$getYears);
		$theme['countProjDone']		= $this->project_model->count_project_done();
		$theme['countProjProc']		= $this->project_model->count_project_proc();
		$theme['countProjNowDone']	= $this->project_model->count_project_now_done($getMonth,$getYears);
		$theme['countProjNowProc']	= $this->project_model->count_project_now_proc($getMonth,$getYears);

		$theme['countProjYNow']		= $this->project_model->show_project_years_now($getYears);
		// $theme['countProjPerMYNow'] = $this->project_model->show_project_per_month_years_now($getYears);
		$countProjPerMYNow 			= $this->project_model->show_project_per_month_years_now($getYears);
		foreach ($countProjPerMYNow->result() as $countProjPerMYNowVal) {
			$theme['countProjPerMYNowjan'] = 
			$countProjPerMYNowVal->Jan.','.
			$countProjPerMYNowVal->Feb.','.
			$countProjPerMYNowVal->Mar.','.
			$countProjPerMYNowVal->Apr.','.
			$countProjPerMYNowVal->May.','.
			$countProjPerMYNowVal->Jun.','.
			$countProjPerMYNowVal->Jul.','.
			$countProjPerMYNowVal->Aug.','.
			$countProjPerMYNowVal->Sep.','.
			$countProjPerMYNowVal->Oct.','.
			$countProjPerMYNowVal->Nov.','.
			$countProjPerMYNowVal->Dec;
		}

		$theme['countProjTot']		= $this->project_model->show_project();
		$theme['newProjShow']		= $this->project_model->show_project_limit();
		$theme['yearsNow']			= $getYears;

		$theme['clDbd'] 			= 'active';
		$theme['clUsr'] 			= '';
		$theme['clRef'] 			= '';
		$theme['clGroup'] 			= '';
		$theme['clPm'] 				= '';
		$theme['styUsr'] 			= '';
		$theme['styRef'] 			= '';

		$theme['content'] 			= 'main/home';
		$theme['get'] 				= '';

		$this->load->view('main/index', $theme);
	}

	function search()
	{
		$keyword = $this->input->post('keyword');

		$theme['app_name']		= $this->lang->line("app_name_simple");
		$theme['title']			= $this->lang->line("app_name_long") .' &raquo; Search Project';
		$theme['mainmenu']		= 'Search Project';
		$theme['subttl']		= 'Search Project';

		$view['show']			= $this->project_model->show_project_search($keyword, $keyword, $keyword);
		$theme['countUser']		= $this->auth_model->countUser();

		$theme['keywordSearch'] = $keyword;

		$theme['clDbd'] 		= 'active';
		$theme['clUsr'] 		= '';
		$theme['clRef'] 		= '';
		$theme['clGroup'] 		= '';
		$theme['clPm'] 			= '';
		$theme['styUsr'] 		= '';
		$theme['styRef'] 		= '';

		$theme['sks_msg']		= $this->session->flashdata('sks_msg');
		$theme['err_msg']		= $this->session->flashdata('err_msg');

		$theme['content'] 		= 'main/search';
		$theme['get']			= $view;
		
		$theme['ProjectCode']	= '';
		$theme['CompanyName']	= '';
		$theme['ProjectName']	= '';

		$this->load->view('main/index', $theme);
	}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
