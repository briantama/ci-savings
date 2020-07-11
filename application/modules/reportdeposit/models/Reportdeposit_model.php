<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportdeposit_model extends CI_Model{

	function ViewGetReportDeposit(){
		return $this->db->get('T_Deposit');
	}	
}

?>