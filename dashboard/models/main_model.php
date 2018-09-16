<?php 
class Main_model extends CI_Model {

	function Main_model(){
		parent::__construct();
//		$query = $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY'");
	}

	function getLastId($tabel,$fieldId){
		$result = $this->db->query("select max($fieldId) as $fieldId from $tabel");
		return $result;
	}

	function cekExist($cekTabel,$cekField,$cekParm){
		$result = $this->db->query("select $cekField from $cekTabel where $cekField = '$cekParm'");
		return $result->num_rows();
	}

	function hapusData($tabel,$fieldId,$s){
		$result = $this->db->query("delete from $tabel where $fieldId = '$s'");
		return $result;
	}

/* ================================================================================================================================== */	
}
