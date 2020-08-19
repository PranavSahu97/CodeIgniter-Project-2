<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Mainmodel extends CI_Model {

		public function __construct(){
			$this->load->database();
		}

		public function getMain(){
			

			$query = $this->db->select('a.NAME, a.GLOBAL_ID, a.LATITUDE, a.LONGITUDE, a.COUNTRY, a.STATE, a.MIL_CODE, r.LENGTH, r.WIDTH, r.COMP_CODE')
						  ->from('airportmodel as a')
						  ->where('a.TYPE_CODE =', 'AD')
						  ->join('runwaymodel as r', 'a.GLOBAL_ID = r.AIRPORT_ID', 'LEFT')
						  ->get();



			return $query;
		}

	}

?>