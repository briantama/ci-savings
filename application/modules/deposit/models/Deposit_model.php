<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit_model extends CI_Model{

	function ViewGetDeposit(){
		return $this->db->get('T_Deposit');
	}	
}

?>