<?php 
class User_model extends CI_Model {

	function User_model(){
		parent::__construct();
//		$query = $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'");
	}
	
	function show_user(){
		$query	= "SELECT
					  `UserId`,
					  `RealName`,
					  `UserName`,
					  `Password`,
					  `Description`,
					  `NoPassword`,
					  `Active`,
					  `ForceLogout`
					FROM `gsfw_user`";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_user_page($num, $offset){
		$this->db->select('
			gsfw_user.CompanyId,
			gsfw_user.CompanyName,
			gsfw_user.CompanyAddress,
			gsfw_user.CompanyDescription,
			gsfw_user.CompanyCreationDate,
			gsfw_user.CompanyLastUpdate,
			gsfw_user.CompanyUserEntry
		');
		$this->db->from('gsfw_user');
		$this->db->limit($num, $offset);
		$this->db->order_by('gsfw_user.CompanyId','desc');

		$result = $this->db->get();
		return $result;
    }

	function count_user(){
		$query	= "SELECT * FROM gsfw_user ORDER BY UserId";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function cek_username($nama){
		$query	= "SELECT * FROM gsfw_user WHERE UserName = '$nama'";
		$result	= $this->db->query($query);
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

	function show_user_id($param){
		$query	= "SELECT 
					  gu.`UserId`,
					  gu.`RealName`,
					  gu.`UserName`,
					  gu.`Password`,
					  gu.`Description`,
					  gu.`NoPassword`,
					  gu.`Active`,
					  gu.`ForceLogout`,
					  gr.`GroupId`,
					  ga.`GroupName`
					FROM
					  `gsfw_user` gu 
					  LEFT JOIN `gsfw_group_user` gr 
					    ON gr.`UserId` = gu.`UserId` 
					  LEFT JOIN `gsfw_group_access` ga 
					    ON ga.`GroupId` = gr.`GroupId`
					WHERE gu.`UserId` = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function delete($param){
		$query	= "DELETE FROM gsfw_user WHERE UserId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function entry($idFix, $namalengkap, $username, $password_1, $desk, $aktif){
		$query	= "INSERT INTO gsfw_user VALUES ('$idFix', '$namalengkap', '$username', MD5('$password_1'), '$desk', 'No', $aktif, 'No')";
		$result	= $this->db->query($query);
		return $result;
    }

	function update($param, $namalengkap, $desk, $aktif){
		$query	= "UPDATE gsfw_user SET
						RealName	= '$namalengkap',
						Description	= '$desk',
						Active 		= '$aktif'
				   WHERE UserId	= '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function update_password($param, $password){
		$query	= "UPDATE gsfw_user SET
						Password	= MD5('$password')
				   WHERE UserId	= '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

/* ================================================================================================================================== */	
}
