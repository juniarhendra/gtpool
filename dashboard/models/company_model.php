<?php 
class Company_model extends CI_Model {

	function Company_model(){
		parent::__construct();
//		$query = $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'");
	}
	
	function show_company(){
		$query	= "SELECT
					  `CompanyId`,
					  `CompanyName`,
					  `CompanyAddress`,
					  `CompanyNoTelp`,
					  `CompanyDescription`,
					  `CompanyStatusAktif`,
					  `CompanyCreationDate`,
					  `CompanyLastUpdate`,
					  `UserName`
					FROM `proman_company_ref`
					LEFT JOIN `gsfw_user` ON `UserId` = CompanyUserEntry
					ORDER BY CompanyName";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_company_page($num, $offset){
		$this->db->select('
			proman_company_ref.CompanyId,
			proman_company_ref.CompanyName,
			proman_company_ref.CompanyAddress,
			proman_company_ref.CompanyDescription,
			proman_company_ref.CompanyCreationDate,
			proman_company_ref.CompanyLastUpdate,
			proman_company_ref.CompanyUserEntry
		');
		$this->db->from('proman_company_ref');
		$this->db->limit($num, $offset);
		$this->db->order_by('proman_company_ref.CompanyId','desc');

		$result = $this->db->get();
		return $result;
    }

	function count_company(){
		$query	= "SELECT CompanyId FROM proman_company_ref";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function count_company_is_active(){
		$query	= "SELECT CompanyId FROM proman_company_ref WHERE CompanyStatusAktif = 'Active'";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function count_company_is_notactive(){
		$query	= "SELECT CompanyId FROM proman_company_ref WHERE CompanyStatusAktif = 'Not Active'";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function show_company_is_active(){
		$query	= "SELECT
					  `CompanyId`,
					  `CompanyName`,
					  `CompanyAddress`,
					  `CompanyNoTelp`,
					  `CompanyDescription`,
					  `CompanyStatusAktif`,
					  `CompanyCreationDate`,
					  `CompanyLastUpdate`,
					  `UserName`
					FROM `proman_company_ref`
					LEFT JOIN `gsfw_user` ON `UserId` = CompanyUserEntry
					WHERE CompanyStatusAktif = 'Active'
					ORDER BY CompanyName";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_company_is_notactive(){
		$query	= "SELECT
					  `CompanyId`,
					  `CompanyName`,
					  `CompanyAddress`,
					  `CompanyNoTelp`,
					  `CompanyDescription`,
					  `CompanyStatusAktif`,
					  `CompanyCreationDate`,
					  `CompanyLastUpdate`,
					  `UserName`
					FROM `proman_company_ref`
					LEFT JOIN `gsfw_user` ON `UserId` = CompanyUserEntry
					WHERE CompanyStatusAktif = 'Not Active'
					ORDER BY CompanyName";
		$result	= $this->db->query($query);
		return $result;
    }

	function cek_name_available_entry($nama){
		$query	= "SELECT * FROM proman_company_ref WHERE CompanyName = '$nama'";
		$result	= $this->db->query($query);
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

	function cek_name_available_update($nama,$param){
		$query	= "SELECT * FROM proman_company_ref WHERE CompanyName = '$nama' AND CompanyId <> '$param'";
		$result	= $this->db->query($query);
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

	function show_company_id($param){
		$query	= "SELECT
					  `CompanyId`,
					  `CompanyName`,
					  `CompanyAddress`,
					  `CompanyNoTelp`,
					  `CompanyDescription`,
					  `CompanyStatusAktif`,
					  `CompanyCreationDate`,
					  `CompanyLastUpdate`,
					  `UserName`
					FROM `proman_company_ref`
					LEFT JOIN `gsfw_user` ON `UserId` = CompanyUserEntry
					WHERE CompanyId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function delete($param){
		$query	= "DELETE FROM proman_company_ref WHERE CompanyId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function entry($idFix, $nama, $alamat, $telp, $desk, $aktif, $usIdEntry){
		$query	= "INSERT INTO `proman_company_ref`(
					`CompanyId`,
					`CompanyName`,
					`CompanyAddress`,
					`CompanyNoTelp`,
					`CompanyDescription`,
					`CompanyStatusAktif`,
					`CompanyCreationDate`,
					`CompanyLastUpdate`,
					`CompanyUserEntry`)
					VALUES (
						'$idFix',
						'$nama',
						'$alamat',
						'$telp',
						'$desk',
						'$aktif',
						NOW(),
						NOW(),
						'$usIdEntry'
					)";
		$result	= $this->db->query($query);
		return $result;
    }

	function update($nama, $alamat, $telp, $desk, $aktif, $usIdEntry, $param){
		$query	= "UPDATE proman_company_ref SET
						CompanyName			= '$nama',
						CompanyAddress		= '$alamat',
						CompanyNoTelp		= '$telp',
						CompanyDescription	= '$desk',
						CompanyStatusAktif	= '$aktif',
						CompanyLastUpdate	= NOW(),
						CompanyUserEntry 	= '$usIdEntry'
				   WHERE CompanyId	= '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

/* ================================================================================================================================== */	
}
