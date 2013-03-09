<?php 
class Administrator extends CI_Controller
{
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
	}
	public function index()
	{
		$this->login();
	}
	function logout()
	{
		$this->session->sess_destroy();
		$this->db->cache_delete_all();
		redirect(base_url(). 'index.php/administrator/','refresh');
		exit();
	}
	//login page
	 function login()
	{
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/login',$data);
	}
	//home page pag tapos mag login
	function login_process()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		if($username == null or $password == null)
		{
			$data['message'] = '<p style="background-color:#faadad; width:58%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="'.base_url().'assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;">Please Fillup all the fields.</span></font>
									</p>';
			$this->load->view('administrator/header',$data);						
			$this->load->view('administrator/login',$data);
		}
		else
		{
			
			$user_information = $this->administrator_model->login_model($username,$password);
			$this->session->set_userdata('user_info',$user_information);
			if($user_information == null)
			{
				$data['message'] = '<p style="background-color:#faadad; width:58%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="'.base_url().'assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;">Invalid Username or Password</span></font>
									</p>';
				$this->load->view('administrator/header',$data);
				$this->load->view('administrator/login',$data);
			}
			else
			{
				redirect(base_url(). 'index.php/administrator/homepage/');
			}
		}
	}
	function homepage()
	{
		$data['user_information'] = $this->session->userdata('user_info');
		$data['region'] = $this->map_model->select_region();
		$data['select_region'] = $this->map_model->select_region_data();
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/search',$data);
	}
	function get_search_data()
	{
		$this->input->post('date');
		$this->input->post('cities');
		$validation = $this->administrator_model->ovitrap_details_validation();
		if ($validation == null)
		{
			echo "<script>alert('No Result Was Found..!')</script>";
			echo "<script>location.href='homepage'</script>";
		}
		else
		{
		$data['user_information'] = $this->session->userdata('user_info');
		$data['region'] = $this->map_model->select_region();
		$data['select_region'] = $this->map_model->select_region_data();
		$this->input->post('date');
		$this->input->post('cities');
		$data['inf'] = $this->administrator_model->search_data();
		$data['city_name'] = $this->map_model->get_region_data();
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/search',$data);
		}
	}
	function update_searched_data()
	{
		for ($i=0;$i<=$_POST['count'];$i++)
			{
				$_POST['school_id'][$i];
				$_POST['id'][$i];
				$_POST['date_submitted'][$i];
				$_POST['total_indeces'][$i];
				$_POST['count'];
				$this->administrator_model->update_ovitrap_indeces();
				echo '<script>alert("Successfully updated the data..!")</script>';
				echo "<script>location.href='homepage'</script>";
			}
	}
	function add_index()
	{
		$data['user_information'] = $this->session->userdata('user_info');
		$data['region'] = $this->map_model->select_region();
		$data['select_region'] = $this->map_model->select_region_data();
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/add_index',$data);
		if (isset($_POST['submit']))
		{
				$_POST['id[]'];
				$this->input->post('date_submitted');
				$this->input->post('cities');
				$_POST['ovitrap_index[]'];
				$_POST['count'];
				$this->administrator_model->insert_ovitrap_index();
				echo "<script>alert('Successfully Created Ovitrap Indeces..')</script>";
				echo "<script>location.href='add_index'</script>";
		}
		
	}
	
	function edit_school()
	{
		$data['school_id'] = $_GET['school'];
		$school_id = $data['school_id'];
		$data['user_information'] = $this->session->userdata('user_info');
		$data['school_info'] = $this->administrator_model->get_school($school_id);
		$data['school_region'] = $this->administrator_model->get_school_region($data['school_info'][0]->regions_data_id);
		$data['region'] = $this->map_model->select_region();
		$data['select_region'] = $this->map_model->select_region_data();
		$school_region = $data['school_region'][0]->regions_name;
		$school_region_id = $data['school_region'][0]->id;
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/edit_school',$data);
	}
	
	function update_school()
	{
		if (isset($_POST['submit']))
		{
				$this->administrator_model->update_school();
				echo "<script>alert('Successfully updated school')</script>";
				echo "<script>location.href='manage_school'</script>";
		}
	}
	
	function add_school()
	{
		$data['user_information'] = $this->session->userdata('user_info');
		$data['region'] = $this->map_model->select_region();
		$data['select_region'] = $this->map_model->select_region_data();
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/add_school',$data);
		if (isset($_POST['submit']))
		{
				$this->administrator_model->insert_school();
				echo "<script>alert('Successfully added school..')</script>";
				echo "<script>location.href='add_school'</script>";
		}
	}
	
	function add_city()
	{
		$data['user_information'] = $this->session->userdata('user_info');
		$data['region'] = $this->map_model->select_region();
		$data['select_region'] = $this->map_model->select_region_data();
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/add_city',$data);
		if (isset($_POST['submit']))
		{
				$this->administrator_model->insert_city();
				echo "<script>alert('Successfully added city..')</script>";
				echo "<script>location.href='add_city'</script>";
		}
	}
	
	function manage_school()
	{
		$data['user_information'] = $this->session->userdata('user_info');
		$data['region'] = $this->map_model->select_region();
		$data['select_region'] = $this->map_model->select_region_data();
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/manage_school',$data);
		if (isset($_POST['submit']))
		{
				$data['schools'] = $this->administrator_model->show_school_city();
				$city_id = $_POST['cities'];
				$data['city'] = $this->administrator_model->get_city($city_id);
				
				$region_id = $_POST['region'];
				$data['region_name'] = $this->administrator_model->get_region($region_id);
				/*
				$fh = fopen("test.txt", "w");
				ob_start();
				var_dump($data);
				$data2 = ob_get_clean();
				fwrite($fh, $region_id);
				fclose($fh);
				*/
				$this->load->view('administrator/header',$data);
				$this->load->view('administrator/list_school_city',$data);
		}
	}
	
	function update_password()
	{
		$data['user_information'] = $this->session->userdata('user_info');
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/update_password',$data);
		//update password
		if ($this->input->post('submit'))
		{
			if ($this->input->post('new_password') == $this->input->post('retype_password'))
			{
				$this->administrator_model->update_password();
				$data['message'] = '<p style="background-color:#faadad; width:58%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="'.base_url().'assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;">Password was successfully updated.</span></font>
									</p>';
				$this->load->view('administrator/header',$data);
				$this->load->view('administrator/update_password',$data);
			}
			else
			{
				echo "<script>alert('mali')</script>";
			}
		}
	}
	function add_user()
	{
		$data['user_information'] = $this->session->userdata('user_info');
		$this->load->view('administrator/header',$data);
		$this->load->view('administrator/add_user',$data);
		//update password
		if ($this->input->post('submit'))
		{
			if ($this->input->post('new_password') == $this->input->post('retype_password'))
			{
				$this->administrator_model->update_password();
				$data['message'] = '<p style="background-color:#faadad; width:58%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="'.base_url().'assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;">Password was successfully updated.</span></font>
									</p>';
				$this->load->view('administrator/header',$data);
				$this->load->view('administrator/add_user',$data);
			}
			else
			{
				echo "<script>alert('mali')</script>";
			}
		}
	}
	function get_region_info_data()
	{
		$region_info = $this->input->get('region');
		$data['select_region']= $this->map_model->get_region($region_info);
		$this->load->view('administrator/city_info_dropdown',$data);
	}
	function get_region_info_data_for_region()
	{
		$region_info = $this->input->get('region');
		$data['select_region']= $this->map_model->get_region($region_info);
		$this->load->view('administrator/city_info_dropdown_for_region',$data);
	}
	function get_school_info_data()
	{
		$city_info = $this->input->get('cities');
		$data['school']= $this->map_model->school_info($city_info);
		$this->load->view('administrator/school_info_dropdown',$data);
	}
	function get_school_data_inserted()
	{
		$data['school_id'] = $this->input->get('school_id');
		$data['month'] = $this->input->get('month-year');
		$this->load->view('administrator/school_info',$data);
	}
	function get_school_info_insert_format()
	{
		$city_info = $this->input->get('cities');
		$data['school']= $this->map_model->school_info($city_info);
		$this->load->view('administrator/school_info_insert_format',$data);
	}
	function javascript()
	{
		$this->load->view('administrator/javascript');
	}
}
?>
