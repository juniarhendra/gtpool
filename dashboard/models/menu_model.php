<?php 
class Menu_model extends CI_Model {

	function Menu_model(){
		parent::__construct();
//		$query = $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'");
	}
	
	function show_menu_all(){
		$query	= "SELECT
					  `MenuId`,
					  `MenuParentId`,
					  `MenuName`,
					  `MenuIsShow`,
					  `MenuIcon`,
					  `MenuOrder`
					FROM `gsfw_menu`";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_menu_all_active(){
		$query	= "SELECT
					  `MenuId`,
					  `MenuParentId`,
					  `MenuName`,
					  `MenuIsShow`,
					  `MenuIcon`,
					  `MenuOrder`
					FROM `gsfw_menu`
					WHERE MenuIsShow = 'Yes'
					ORDER BY MenuOrder ASC";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_menu_parent(){
		$query	= "SELECT
					  `MenuId`,
					  `MenuParentId`,
					  `MenuName`,
					  `MenuIsShow`,
					  `MenuIcon`,
					  `MenuOrder`
					FROM `gsfw_menu`
					WHERE MenuParentId = 0
					AND MenuIsShow = 'Yes'";
		$result	= $this->db->query($query);
		return $result;
    }

	function show_menu_child($param){
		$query	= "SELECT
					  `MenuId`,
					  `MenuParentId`,
					  `MenuName`,
					  `MenuIsShow`,
					  `MenuIcon`,
					  `MenuOrder`
					FROM `gsfw_menu`
					WHERE MenuParentId = '$param'
					AND MenuIsShow = 'Yes'";
		$result	= $this->db->query($query);
		return $result;
    }


/* ================================================================================================================================== */	
}
