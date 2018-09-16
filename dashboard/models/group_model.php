<?php 
class Group_model extends CI_Model {

	function Group_model(){
		parent::__construct();
//		$query = $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'");
	}
	
	function show_group_user(){
		$query	= "SELECT
					`GroupId`,
					`GroupName`,
					`Description`,
					`UnitappId`
					FROM `gsfw_group_access`";
		$result	= $this->db->query($query);
		return $result;
    }

	function count_group_user(){
		$query	= "SELECT * FROM gsfw_group_access ORDER BY GroupId";
		$result	= $this->db->query($query);
		return $result->num_rows();
    }

	function cek_group_available_entry($group){
		$query	= "SELECT * FROM gsfw_group_access WHERE GroupName = '$group'";
		$result	= $this->db->query($query);
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

	function cek_group_available_update($group,$param){
		$query	= "SELECT * FROM gsfw_group_access WHERE GroupName = '$group' AND GroupId <> '$param'";
		$result	= $this->db->query($query);
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

	function show_group_user_id($param){
		$query	= "SELECT
					`GroupId`,
					`GroupName`,
					`Description`,
					`UnitappId`
					FROM `gsfw_group_access`
					WHERE GroupId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_menu_checked($param){
		$query	= "SELECT
					  `GroupMenuMenuId`
					FROM `gsfw_group_menu`
					WHERE `GroupMenuGroupId` = '$param'
					GROUP BY GroupMenuMenuId";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_menu_checked_loop($groupId,$menuId){
		$query	= "SELECT
					  COUNT(`GroupMenuMenuId`) total
					FROM `gsfw_group_menu`
					WHERE `GroupMenuGroupId` = '$groupId'
					AND `GroupMenuMenuId` = '$menuId'";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_menu_checked_null(){
		$query	= "SELECT
					  `GroupMenuMenuId`
					FROM `gsfw_group_menu`
					WHERE `GroupMenuGroupId` = '0'";
		$result	= $this->db->query($query);
		return $result;
    }

	function delete_menu_checked($param){
		$query	= "DELETE FROM gsfw_group_menu WHERE GroupMenuGroupId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function delete($param){
		$query	= "DELETE FROM gsfw_group_access WHERE GroupId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function entry($idFix, $group, $desk){
		$query	= "INSERT INTO `gsfw_group_access` (
					`GroupId`,
					`GroupName`,
					`Description`)
					VALUES (
						'$idFix',
						'$group',
						'$desk'
					)";
		$result	= $this->db->query($query);
		return $result;
    }

	function entryGroupMenu($idFix, $menu){
		$query	= "INSERT INTO `gsfw_group_menu` (
					`GroupMenuGroupId`,
					`GroupMenuMenuId`)
					VALUES (
						'$idFix',
						'$menu'
					)";
		$result	= $this->db->query($query);
		return $result;
    }

	function update($param, $group, $desk){
		$query	= "UPDATE gsfw_group_access SET
						GroupName	= '$group',
						Description	= '$desk'
				   WHERE GroupId	= '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function entry_user_group($param,$grupuser){
		$query	= "INSERT INTO `gsfw_group_user` (
					`UserId`,
		            `GroupId`)
					VALUES (
						$param,
						$grupuser
					)";
		$result	= $this->db->query($query);
		return $result;
    }

	function update_user_group($grupuser,$param){
		$query	= "UPDATE `gsfw_group_user` SET
						`GroupId`	= '$grupuser'
				   WHERE `UserId`	= '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

	function delete_user_group($param){
		$query	= "DELETE FROM gsfw_group_user WHERE UserId = '$param'";
		$result	= $this->db->query($query);
		return $result;
    }

/* ================================================================================================================================== */	
}
