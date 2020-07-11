<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawal_model extends CI_Model{

	function ViewGetWithdrawal(){
		return $this->db->get('T_Withdrawal');
	}	
}

?>