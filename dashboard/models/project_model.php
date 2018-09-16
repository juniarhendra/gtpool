<?php 
class Project_model extends CI_Model {

	function Project_model(){
		parent::__construct();
//		$query = $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'");
	}
	
	function show_project(){
		$query	= "SELECT 
					  `ProjectId`,
					  `ProjectCode`,
					  `ProjectName`,
					  `ProjectCompanyId`,
					  `CompanyName`,
					  `ProjectDescription`,
					  `ProjectStatus`,
					  `ProjectCreationDate`,
					  `ProjectLastUpdate`,
					  `ProjectUserEntry`,
					  `UserName` 
					FROM
					  `proman_project` 
					  LEFT JOIN `gsfw_user` 
					    ON `UserId` = ProjectUserEntry 
					  LEFT JOIN `proman_company_ref` 
					    ON `CompanyId` = `ProjectCompanyId`
					ORDER BY ProjectCreationDate DESC";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_project_limit(){
		$query	= "SELECT 
					  `ProjectId`,
					  `ProjectCode`,
					  `ProjectName`,
					  `ProjectCompanyId`,
					  `CompanyName`,
					  `ProjectDescription`,
					  `ProjectStatus`,
					  `ProjectCreationDate`,
					  `ProjectLastUpdate`,
					  `ProjectUserEntry`,
					  `UserName` 
					FROM
					  `proman_project` 
					  LEFT JOIN `gsfw_user` 
					    ON `UserId` = ProjectUserEntry 
					  LEFT JOIN `proman_company_ref` 
					    ON `CompanyId` = `ProjectCompanyId`
					ORDER BY ProjectCreationDate DESC
					LIMIT 0,6";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_project_now($month,$getYears){
		$query	= "SELECT 
					  `ProjectId`,
					  `ProjectCode`,
					  `ProjectName`,
					  `ProjectCompanyId`,
					  `CompanyName`,
					  `ProjectDescription`,
					  `ProjectStatus`,
					  `ProjectCreationDate`,
					  `ProjectLastUpdate`,
					  `ProjectUserEntry`,
					  `UserName` 
					FROM
					  `proman_project` 
					  LEFT JOIN `gsfw_user` 
					    ON `UserId` = ProjectUserEntry 
					  LEFT JOIN `proman_company_ref` 
					    ON `CompanyId` = `ProjectCompanyId`
					WHERE  MONTH(ProjectLastUpdate) = '$month'
					AND  YEAR(ProjectLastUpdate) = '$getYears'
					ORDER BY ProjectCreationDate DESC";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_project_years_now($getYears){
		$query	= "SELECT 
					  `ProjectId`,
					  `ProjectCode`,
					  `ProjectName`,
					  `ProjectCompanyId`,
					  `CompanyName`,
					  `ProjectDescription`,
					  `ProjectStatus`,
					  `ProjectCreationDate`,
					  `ProjectLastUpdate`,
					  `ProjectUserEntry`,
					  `UserName` 
					FROM
					  `proman_project` 
					  LEFT JOIN `gsfw_user` 
					    ON `UserId` = ProjectUserEntry 
					  LEFT JOIN `proman_company_ref` 
					    ON `CompanyId` = `ProjectCompanyId`
					WHERE  YEAR(ProjectLastUpdate) = '$getYears'
					ORDER BY ProjectCreationDate DESC";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_project_per_month_years_now($getYears){
		$query	= "SELECT DISTINCT
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '1') AS `Jan`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '2') AS `Feb`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '3') AS `Mar`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '4') AS `Apr`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '5') AS `May`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '6') AS `Jun`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '7') AS `Jul`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '8') AS `Aug`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '9') AS `Sep`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '10') AS `Oct`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '11') AS `Nov`,
						(SELECT COUNT(ProjectCode) FROM `proman_project` WHERE MONTH(ProjectLastUpdate ) = '12') AS `Dec`
					FROM `proman_project` 
					WHERE YEAR(ProjectLastUpdate ) = '2015'
					ORDER BY ProjectCreationDate DESC";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_project_page($num, $offset){
		$this->db->select('
			proman_project.CompanyId,
			proman_project.CompanyName,
			proman_project.CompanyAddress,
			proman_project.Description,
			proman_project.CompanyCreationDate,
			proman_project.CompanyLastUpdate,
			proman_project.CompanyUserEntry
		');
		$this->db->from('proman_project');
		$this->db->limit($num, $offset);
		$this->db->order_by('proman_project.CompanyId','desc');

		$result = $this->db->get();
		return $result;
    }

	function count_project(){
		$query	= "SELECT * FROM proman_project ORDER BY CompanyId";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function count_project_done(){
		$query	= "SELECT ProjectId FROM proman_project WHERE ProjectStatus = 'Done'";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function count_project_proc(){
		$query	= "SELECT ProjectId FROM proman_project WHERE ProjectStatus = 'Processing'";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function count_project_now_done($getMonth,$getYears){
		$query	= "SELECT ProjectId 
				FROM proman_project 
				WHERE ProjectStatus = 'Done' 
				AND  MONTH(ProjectLastUpdate) = '$getMonth'
				AND  YEAR(ProjectLastUpdate) = '$getYears'";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function count_project_now_proc($getMonth,$getYears){
		$query	= "SELECT ProjectId 
				FROM proman_project 
				WHERE ProjectStatus = 'Processing' 
				AND  MONTH(ProjectLastUpdate) = '$getMonth'
				AND  YEAR(ProjectLastUpdate) = '$getYears'";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function cek_kode_available_entry($kode){
		$query	= "SELECT ProjectCode FROM proman_project WHERE ProjectCode = '$kode'";
		$result	= $this->db->query($query);
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

	function cek_kode_available_update($kode,$param){
		$query	= "SELECT ProjectCode FROM proman_project WHERE ProjectCode = '$kode' AND ProjectId <> '$param'";
		$result	= $this->db->query($query);
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

	function show_project_id($param){
		$query	= "SELECT * FROM proman_project WHERE ProjectId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_project_search($param_1,$param_2,$param_3){
		$query	= "SELECT 
					  `ProjectId`,
					  `ProjectCode`,
					  `ProjectName`,
					  `ProjectCompanyId`,
					  `CompanyName`,
					  `ProjectDescription`,
					  `ProjectStatus`,
					  `ProjectCreationDate`,
					  `ProjectLastUpdate`,
					  `ProjectUserEntry`,
					  `UserName` 
					FROM
					  `proman_project` 
					  LEFT JOIN `gsfw_user` 
					    ON `UserId` = ProjectUserEntry 
					  LEFT JOIN `proman_company_ref` 
					    ON `CompanyId` = `ProjectCompanyId`
					WHERE `ProjectCode` LIKE '%$param_1%'
					OR (`ProjectName` LIKE '%$param_2%')
					OR (`CompanyName` LIKE '%$param_3%')
					ORDER BY ProjectCreationDate DESC";
		$result	= $this->db->query($query);
		return $result;
    }

	function delete($param){
		$query	= "DELETE FROM proman_project WHERE ProjectId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function entry($idFix, $kode, $pekerjaan, $company, $desk, $status, $usIdEntry){
		$query	= "INSERT INTO `proman_project`(
					`ProjectId`,
					`ProjectCode`,
					`ProjectName`,
					`ProjectCompanyId`,
					`ProjectDescription`,
					`ProjectStatus`,
					`ProjectCreationDate`,
					`ProjectLastUpdate`,
					`ProjectUserEntry`) 
					VALUES (
						'$idFix',
						'$kode',
						'$pekerjaan',
						'$company',
						'$desk',
						'$status',
						NOW(),
						NOW(),
						'$usIdEntry'
					)";
		$result	= $this->db->query($query);
		return $result;
    }

	function update($kode, $pekerjaan, $company, $desk, $status, $usIdEntry, $param){
		$query	= "UPDATE `proman_project` SET 
						`ProjectCode` 			= '$kode',
						`ProjectName` 			= '$pekerjaan',
						`ProjectCompanyId` 		= '$company',
						`ProjectDescription` 	= '$desk',
						`ProjectStatus` 		= '$status',
						`ProjectLastUpdate` 	= NOW(),
						`ProjectUserEntry` 		= '$usIdEntry'
					WHERE `ProjectId` = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

/* ================================================================================================================================== */	
}
