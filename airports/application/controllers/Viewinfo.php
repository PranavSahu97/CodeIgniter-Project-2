<?php\
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewinfo extends CI_Controller {

	public function __construct() {

		parent::__construct();
	
		//load base_url
		$this->load->helper('url');

		$this->load->model('Mainmodel');

	}

	public function index(){
		 $this->load->view('infopage');
	}

	public function info(){

		$data['description'] = $this->Mainmodel->getMain();

		if($data["description"]->num_rows() > 0){
			foreach($data["description"]->result() as $row){
				$describe = array($row->GLOBAL_ID, $row->COUNTRY,
		                          $row->STATE, $row->MIL_CODE, $row->LENGTH,
		                          $row->WIDTH, $row->COMP_CODE
		                    );
				echo $describe;

			}
		}

		$this->load->view('information');
	}

}
