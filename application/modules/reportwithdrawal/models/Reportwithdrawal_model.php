<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportwithdrawal_model extends CI_Model{

	function ViewGetReportWithdrawal(){
		return $this->db->get('T_Withdrawal');
	}	
}

?>