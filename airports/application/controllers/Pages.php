<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 

class Pages extends CI_Controller {

	public function __construct() {

		parent::__construct();
	
		// load base_url
		$this->load->helper('url');

		$this->load->model('Mainmodel');

	}

	public function index(){
		 $this->load->view('welcome_message');
	}

	public function display(){
			
		$data["Main"] = $this->Mainmodel->getMain();
		$geojson = array( 'type' => 'FeatureCollection', 'features' => array());
		$i = 0;
		if($data["Main"]->num_rows() > 0){
			foreach($data["Main"]->result() as $row){
				  
				$lat = $row->LATITUDE;

				$parts = explode('-', $lat);

			    if(count($parts) == 3){

				  	$parts[2] = substr($parts[2], 0, strlen($parts[2])-1);	


				  	$seconds =(double)$parts[1] * 60 + (double)$parts[2];
				  
				  	$hours =(double)$seconds / 3600;
				  
				  	$latitude =(double)$parts[0] + $hours;
			   }
			   else{
			   		$latitude = $lat;
			   }
			  
			  	$lon = $row->LONGITUDE;

				  $pts = explode('-', $lon);

				  if(count($pts) == 3){
					  $pts[2] = substr($pts[2], 0, strlen($pts[2]));
	  
					  $secs =(double)$pts[1] * 60 + (double)$pts[2];
					  
					  $hrs =(double)$secs / 3600;
					  
					  $longitude =(double)$pts[0] + $hrs;
				 }

				 else{
				 	$longitude = $lon;
				 }

				 $feature = array(
		                    'type' => 'Feature',
		                    "geometry" => array(
		                        'type' => 'Point',
		                        'coordinates' => array( 
		                                        $longitude, $latitude 
		                        )
		                    ),
		                    'properties' => array(
		                        'title' => $row->NAME,
		                        'description' => array(
		                         				 $row->GLOBAL_ID, $row->COUNTRY,
		                         				 $row->STATE, $row->MIL_CODE, $row->LENGTH,
		                         				 $row->WIDTH, $row->COMP_CODE
		                        ) 
		                    )
		   				 );

				 array_push($geojson['features'], $feature);

				 if(++$i == 10){
				 	break;
				 }
				  
			}
				
		}

		$data['geoJson'] = json_encode($geojson, JSON_NUMERIC_CHECK);

		$this->load->view('homepage',$data);

	}

	// public function info() {
	// 	$this->load->view('information');
	// }

}
