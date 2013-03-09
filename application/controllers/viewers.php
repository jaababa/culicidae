<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewers extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		ini_set('memory_limit', '300M');
		error_reporting(E_ALL ^ (E_NOTICE) ^ (E_WARNING));
		date_default_timezone_set('Asia/Hong_Kong');
		$this->load->model('administrator_model', '', TRUE);
		$this->load->model('map_model', '', TRUE);
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('googlemaps');
	}
	function index()
	{
	if ($_POST['year'] == null)
	{
		$this->dengue();
	}
	if (isset($_POST['submit']) && $this->input->post('year') != null && $this->input->post('region') !="0")
	{
		$this->search_data();
	}
	if (isset($_POST['submit']) && $this->input->post('region') == "0")
		{
			$startmonth = $this->input->post('startmonth');
			$endmonth = $this->input->post('endmonth');
			$year = $this->input->post('year');
			$this->dengue($startmonth,$endmonth,$year);
		}
	}
	
	function dengue($startmonth,$endmonth,$year)
	{
		if ($startmonth == null && $endmonth == null && $year== null)
		{

			$startmonth = date('m');
			$endmonth = date('m');
			$year = date('Y');
if ($startmonth == "01")
{
$startmonth = "10";
}
elseif ($startmonth == "02")
{
$startmonth = "11";
}
elseif ($startmonth == "03")
{
$startmonth = "12";
}
elseif ($startmonth == "04")
{
$startmonth = "01";
}
elseif ($startmonth == "05")
{
$startmonth = "02";
}
elseif ($startmonth == "06")
{
$startmonth = "03";
}
elseif ($startmonth == "07")
{
$startmonth = "04";
}
elseif ($startmonth == "08")
{
$startmonth = "05";
}
elseif ($startmonth == "09")
{
$startmonth = "06";
}
elseif ($startmonth == "10")
{
$startmonth = "07";
}
elseif ($startmonth == "11")
{
$startmonth = "08";
}
elseif ($startmonth == "12")
{
$startmonth = "09";
}
		}
		// Load the library
		$config['center'] = '14.56159,121.03351';
		$config['zoom'] = '10';
		$config['geocodeCaching'] = TRUE;
		$config['minifyJS'] = TRUE;
		$this->googlemaps->initialize($config);
		$this->load->model('map_model', '', TRUE);
		$coords = $this->map_model->get_coordinates();
		foreach ($coords as $coordinate) {
			$marker = array(); 
			$marker['position'] = $coordinate->latitude.','.$coordinate->longitude;
			$school_name = $coordinate->school_name;
			$school_id = $coordinate->id;
			$orvitrap = $coordinate->ovitrap;
			$date_submitted = $coordinate->date_submitted;
			$date = explode("-",$date_submitted);
			$date_submit = $date[1]."-".$date[2]."-".$date[0];
			$city = $coordinate->city_name;
			$region_id = $coordinate->ids;
			$marker['title'] = $school_name;
			if ($orvitrap < 20)
				$action = "- Closely monitor the hygienic condition to prevent breeding of mosquitoes; - Conduct weekly inspection to identify breeding / potential breeding places and eliminate such places as far as possible. - Public are advised to check and eliminate any possible breeding places within their premises at a frequency not less than once a week (Please go to Advice to Public for details) ";
			else if ($orvitrap >= 20)
				$action = "- To conduct special operations in addition to the regular weekly program to eliminate all breeding / potential breeding places; - Private pest control contractor might be employed to control the mosquito problem. Other control measures by using larvicides or adulticides might be feasible. ";
			$marker['infowindow_content'] = "<div style='height: auto;width:auto;overflow: hidden;'><h4><b>City : $city <br> <a rel='facebox' href='index.php/viewers/graph_data?id=$school_id&startmonth=$startmonth&endmonth=$endmonth&year=$year&region_id=$region_id'>$school_name</a><br>As of : $date_submit<br>Ovitrap Index : $orvitrap<br> Action to be taken : $action<h4></b></div>";
			
		
			if ($orvitrap == null)
			{
				$orvitrap = "0";
			}
			$datess=date('Y-m-d', time()+((60*60)*-5080));
			$date_prev = $date_submitted;
			if ($orvitrap != "0"  && $orvitrap <="20" && strtotime($datess) <= strtotime($date_prev))
			{
				$marker['icon'] = './assets/images/google_maps_pin_green.png';
			}
			else
			{
				if ($orvitrap != "0"  && $orvitrap < "20" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				else if ($orvitrap <"40" && $orvitrap >="20" && strtotime($datess) <= strtotime($date_prev))
				{
				$marker['icon'] = './assets/images/google_maps_pin_yellow.png';
				}
				else if ($orvitrap <="40" && $orvitrap >="20" && strtotime($datess) >= strtotime($date_prev))
				{
				$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				//<----------------------
				//If 39.9 to 20 Only ----------->			
				/* THIS LINE OF CODE HAS BEEN DELETED
				else if ($orvitrap <="39.9" && $orvitrap >="20" && strtotime($datess) <= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_orange.png';
				}
				else if ($orvitrap <="39.9" && $orvitrap >="20" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				*///<---------------------
				
				//if 40 and Above --------------->
				else if ($orvitrap > "40" && strtotime($datess) <= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_red.png';
				}
				else if ($orvitrap > "40" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				// <-------------
				
				//If Null, Zero and Out of The Cut off
				else if (strtotime($datess) <= strtotime($date_prev) || $orvitrap=="0" || $orvitrap == null)
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
			}
			$this->googlemaps->add_marker($marker);
		}
		// Create the map 
		$data['map'] = $this->googlemaps->create_map();
		$data['regions_info_data'] = $this->map_model->select_region_data();
		$data['region_info'] = $this->map_model->select_region();
		$this->load->view('header_google_maps_markers', $data); 
		$this->load->view('container_google_maps_markers', $data);
	}

    function search_data()
    {
	// Load the library
		$this->load->model('map_model', '', TRUE);
		$startmonth = $this->input->post('startmonth');
		$endmonth = $this->input->post('endmonth');
		$year = $this->input->post('year');
		$this->input->post('cities');
		$zooming = $this->map_model->get_region_data();
		foreach($zooming as $zoom_effect)
		{
			$zoom = $zoom_effect->zoom;
			$region_id = $zoom_effect->id;
		}
		$config['center'] = $zoom_effect->lat.','.$zoom_effect->long;
		$config['zoom'] = $zoom;
		$config['geocodeCaching'] = TRUE;
		$config['minifyJS'] = TRUE;
		$this->googlemaps->initialize($config);
		$coordss = $this->map_model->get_coordinates_by_city();
		foreach ($coordss as $coordinate_city) {
			$marker = array(); 
			$marker['position'] = $coordinate_city->latitude.','.$coordinate_city->longitude;
			$marker['animation'] = 'DROP';
			$school_name = $coordinate_city->school_name;
			$school_id = $coordinate_city->id;
			$orvitrap = $coordinate_city->ovitrap;
			$date_submitted = $coordinate_city->date_submitted;
			$dated = explode("-",$date_submitted);
			$date_submit = $dated[1]."-".$dated[2]."-".$dated[0];
			$city = $coordinate_city->city_name;
			$region_id = $coordinate->ids;
			$marker['title'] = $school_name;
			if ($orvitrap < 20)
				$action = "- Closely monitor the hygienic condition to prevent breeding of mosquitoes; - Conduct weekly inspection to identify breeding / potential breeding places and eliminate such places as far as possible. - Public are advised to check and eliminate any possible breeding places within their premises at a frequency not less than once a week (Please go to Advice to Public for details) ";
			else if ($orvitrap >= 20)
				$action = "- To conduct special operations in addition to the regular weekly program to eliminate all breeding / potential breeding places; - Private pest control contractor might be employed to control the mosquito problem. Other control measures by using larvicides or adulticides might be feasible. ";
			$marker['infowindow_content'] = "<div style='height: auto;width:auto;overflow: hidden;'><h4><b>City : $city <br> <a rel='facebox' href='index.php/viewers/graph_data?id=$school_id&startmonth=$startmonth&endmonth=$endmonth&year=$year&region_id=$region_id'>$school_name</a><br>As of : $date_submit<br>Ovitrap Index : $orvitrap<br> Action to be taken : $action<h4></b></div>";

			if ($orvitrap == null)
			{
				$orvitrap = "0";
			}
			$datess=date('Y-m-d', time()+((60*60)*-5080));
			$date_prev = $date_submitted;
			if ($orvitrap != "0"  && $orvitrap <="20" && strtotime($datess) <= strtotime($date_prev))
			{
				$marker['icon'] = './assets/images/google_maps_pin_green.png';
			}
			else
			{
				if ($orvitrap != "0"  && $orvitrap < "20" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				else if ($orvitrap <"40" && $orvitrap >="20" && strtotime($datess) <= strtotime($date_prev))
				{
				$marker['icon'] = './assets/images/google_maps_pin_yellow.png';
				}
				else if ($orvitrap <="40" && $orvitrap >="20" && strtotime($datess) >= strtotime($date_prev))
				{
				$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				//<----------------------
				//If 39.9 to 20 Only ----------->			
				/* THIS LINE OF CODE HAS BEEN DELETED
				else if ($orvitrap <="39.9" && $orvitrap >="20" && strtotime($datess) <= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_orange.png';
				}
				else if ($orvitrap <="39.9" && $orvitrap >="20" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				*///<---------------------
				
				//if 40 and Above --------------->
				else if ($orvitrap > "40" && strtotime($datess) <= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_red.png';
				}
				else if ($orvitrap > "40" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				// <-------------
				
				//If Null, Zero and Out of The Cut off
				else if (strtotime($datess) <= strtotime($date_prev) || $orvitrap=="0" || $orvitrap == null)
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
			}
			$this->googlemaps->add_marker($marker);
		}
		// Create the map 
		$data['map'] = $this->googlemaps->create_map();
		$data['regions_info_data'] = $this->map_model->select_region_data();
		$data['region_info'] = $this->map_model->select_region();
		$this->load->view('header_google_maps_markers', $data); 
		$this->load->view('container_google_maps_markers', $data);
    }
    function graph_data() {
		error_reporting(E_ALL ^ (E_NOTICE) ^ (E_WARNING));
		$startmonth = $this->input->get('startmonth');
		$endmonth = $this->input->get('endmonth');
		$year = $this->input->get('year');
		$this->input->get('region_id');
		$this->load->model('graph_model');
		$results = null;
		$results = $this->graph_model->get_graph_for($this->input->get('id'),$months,$years);
		$results['query'] = $this->graph_model->select_info($startmonth,$endmonth,$year);
		$results['region_id'] = $this->graph_model->get_region_data_id();
		$this->load->view('graph', $results);
	}
	
	function graph_data_bar() {
		error_reporting(E_ALL ^ (E_NOTICE) ^ (E_WARNING));
		$startmonth = $this->input->get('startmonth');
		$endmonth = $this->input->get('endmonth');
		$year = $this->input->get('year');
		$this->input->get('region_id');
		$this->load->model('graph_model');
		$results = null;
		$results = $this->graph_model->get_graph_for($this->input->get('id'),$months,$years);
		$results['query'] = $this->graph_model->select_info($startmonth,$endmonth,$year);
		$results['region_id'] = $this->graph_model->get_region_data_id();
		$this->load->view('bar_graph', $results);
	}
    
    function footer()
    {
		$this->load->view('server');
	}

	function autocomplete()
	{	
		$this->load->view('auto');
	}
	
	function specific_school_search()
	{
		if ($startmonth == null && $endmonth == null && $year== null)
		{

			$startmonth = date('m');
			$endmonth = date('m');
			$year = date('Y');
if ($startmonth == "01")
{
$startmonth = "10";
}
elseif ($startmonth == "02")
{
$startmonth = "11";
}
elseif ($startmonth == "03")
{
$startmonth = "12";
}
elseif ($startmonth == "04")
{
$startmonth = "01";
}
elseif ($startmonth == "05")
{
$startmonth = "02";
}
elseif ($startmonth == "06")
{
$startmonth = "03";
}
elseif ($startmonth == "07")
{
$startmonth = "04";
}
elseif ($startmonth == "08")
{
$startmonth = "05";
}
elseif ($startmonth == "09")
{
$startmonth = "06";
}
elseif ($startmonth == "10")
{
$startmonth = "07";
}
elseif ($startmonth == "11")
{
$startmonth = "08";
}
elseif ($startmonth == "12")
{
$startmonth = "09";
}
		}
	// Load the library
		$config['onload'] = "google.maps.event.trigger(marker_0, 'click');";
		$this->load->model('map_model', '', TRUE);
		$this->input->post('school_id');
		$coordss = $this->map_model->get_school_info_id();
		foreach ($coordss as $coordinate_citys)
		{
		$config['center'] = $coordinate_citys->latitude.','.$coordinate_citys->longitude;
		}
		$config['zoom'] = '13';
		$config['geocodeCaching'] = TRUE;
		$config['minifyJS'] = TRUE;
		$this->googlemaps->initialize($config);
		$coordss = $this->map_model->get_school_info_id();
		$get_city = $this->map_model->get_region_per_school();
		foreach($get_city as $citys)
		{
			$city = $citys->city_name;
			$region_id = $citys->id;
		}
		foreach ($coordss as $coordinate_city)
		{
			$marker = array(); 
			$marker['position'] = $coordinate_city->latitude.','.$coordinate_city->longitude;
			$school_name = $coordinate_city->school_name;
			$school_id = $coordinate_city->id;
			$orvitrap = $coordinate_city->ovitrap;
			$date_submitted = $coordinate_city->date_submitted;
			$dated = explode("-",$date_submitted);
			$date_submit = $dated[1]."-".$dated[2]."-".$dated[0];
			
			$marker['title'] = $school_name;
			if ($orvitrap < 20)
				$action = "- Closely monitor the hygienic condition to prevent breeding of mosquitoes; - Conduct weekly inspection to identify breeding / potential breeding places and eliminate such places as far as possible. - Public are advised to check and eliminate any possible breeding places within their premises at a frequency not less than once a week (Please go to Advice to Public for details) ";
			else if ($orvitrap >= 20)
				$action = "- To conduct special operations in addition to the regular weekly program to eliminate all breeding / potential breeding places; - Private pest control contractor might be employed to control the mosquito problem. Other control measures by using larvicides or adulticides might be feasible. ";
			$marker['infowindow_content'] = "<div style='height: auto;width:auto;overflow: hidden;'><h4><b>City : $city <br> <a rel='facebox' href='index.php/viewers/graph_data?id=$school_id&startmonth=$startmonth&endmonth=$endmonth&year=$year&region_id=$region_id'>$school_name</a><br>As of : $date_submit<br>Ovitrap Index : $orvitrap<br> Action to be taken : $action<h4></b></div>";
			
			//$marker['infowindow_content'] = "<div style='height: auto;width:auto;overflow: hidden;'><h4><b>City : $city <br> <a rel='facebox' href='graph_data?id=$school_id&startmonth=$startmonth&endmonth=$endmonth&year=$year&region_id=$region_id'>$school_name</a><br>As of : $date_submit<br>Ovitrap Index : $orvitrap<h4></b></div>";
						if ($orvitrap == null)
			{
				$orvitrap = "0";
			}
			$datess=date('Y-m-d', time()+((60*60)*-5080));
			$date_prev = $date_submitted;
			if ($orvitrap != "0"  && $orvitrap <="20" && strtotime($datess) <= strtotime($date_prev))
			{
				$marker['icon'] = './assets/images/google_maps_pin_green.png';
			}
			else
			{
				if ($orvitrap != "0"  && $orvitrap < "20" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				else if ($orvitrap <"40" && $orvitrap >="20" && strtotime($datess) <= strtotime($date_prev))
				{
				$marker['icon'] = './assets/images/google_maps_pin_yellow.png';
				}
				else if ($orvitrap <="40" && $orvitrap >="20" && strtotime($datess) >= strtotime($date_prev))
				{
				$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				//<----------------------
				//If 39.9 to 20 Only ----------->			
				/* THIS LINE OF CODE HAS BEEN DELETED
				else if ($orvitrap <="39.9" && $orvitrap >="20" && strtotime($datess) <= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_orange.png';
				}
				else if ($orvitrap <="39.9" && $orvitrap >="20" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				*///<---------------------
				
				//if 40 and Above --------------->
				else if ($orvitrap > "40" && strtotime($datess) <= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_red.png';
				}
				else if ($orvitrap > "40" && strtotime($datess) >= strtotime($date_prev))
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
				// <-------------
				
				//If Null, Zero and Out of The Cut off
				else if (strtotime($datess) <= strtotime($date_prev) || $orvitrap=="0" || $orvitrap == null)
				{
					$marker['icon'] = './assets/images/google_maps_pin_gray.png';
				}
			}
			$this->googlemaps->add_marker($marker);
		}
		// Create the map 
		$data['map'] = $this->googlemaps->create_map();
		$data['regions_info_data'] = $this->map_model->select_region_data();
		$data['region_info'] = $this->map_model->select_region();
		$this->load->view('header_google_maps_markers', $data); 
		$this->load->view('container_google_maps_markers', $data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
