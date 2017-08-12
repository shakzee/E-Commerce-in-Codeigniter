<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{
	

	public function index()
	{
		if (checkAdmin()) 
		{
				$data['title'] = "Something her | "."Admin name here | " . SK; 
				$this->load->view('admin/header/header',$data);
				$this->load->view('admin/css/css');
				$this->load->view('admin/navbar/navtop');
				$this->load->view('admin/navbar/navleft');
				$this->load->view('admin/content/home');
				$this->load->view('admin/footer/footer');
				$this->load->view('admin/js/extra');
				$this->load->view('admin/js/js');			
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}


	public function login()
	{
		$this->load->view('header/header');
		$this->load->view('css/css');
		$this->load->view('navbar/navbar');
		$this->load->view('admin/login');
		$this->load->view('footer/footer');
		$this->load->view('js/js');

	}



	public function checkAdmin()
	{
		$data['email'] = $this->input->post('email',TRUE);
		$data['password'] = $this->input->post('password',TRUE);
		if (
				empty($data['email']) || empty($data['password'])
			) 
		{
			customFlash('admin/login','alert-danger','Please check required fields and try again');
		} 
		else
		{
			$adminData = $this->mod_admin->checkAdmin($data);
			if (count($adminData) == 1) 
			{

				$admin_session = array(
						'aId'=>$adminData[0]['aid'],
						'aEmail'=>$adminData[0]['email'],
						'aDate'=>$adminData[0]['adate'],
						'aDp'=>$adminData[0]['adp']
					);
					
					$this->session->set_userdata($admin_session);
					if (!empty($this->session->userdata('aId'))) 
					{
						redirect('admin');
					} 
					else 
					{
						customFlash('admin/login','alert-danger','error','You can\'t login right now please try again.');
					}
					
			} 
			else 
			{
				customFlash('admin/login','alert-danger','Please check your email OR password and try again.');
			}
			

		}
		




	}


	public function newCategory()
	{
		if (checkAdmin()) 
		{
			$data['title'] = "New Category | "."Product's Category | " . SK; 
			$this->load->view('admin/header/header',$data);
			$this->load->view('admin/css/css');
			$this->load->view('admin/navbar/navtop');
			$this->load->view('admin/navbar/navleft');
			$this->load->view('admin/content/addCategory');
			$this->load->view('admin/footer/footer');
			$this->load->view('admin/js/js');	
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}

	public function addCategory()
	{
		if (checkAdmin()) 
		{
			$data['catName'] = $this->input->post('catName',TRUE);
			$data['catDate'] = date('D-M-Y h:i:sa');			
			$data['adminId'] = adminId();
			if (!empty($data['catName'])) 
			{
				$path = realpath(APPPATH.'../assets/images/categories/');
			    $config['upload_path']          = $path;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $this->load->library('upload',$config);
                if (!$this->upload->do_upload('catgoryImage')) 
                {
                	$erro =  $this->upload->display_errors();
					customFlash('admin/newCategory','alert-danger',$erro);
                } 
                else 
                {
                	$filename = $this->upload->data(); 
                	$data['catImage'] =  $filename['file_name'];
                	$retu = $this->mod_admin->addCategory($data);
                	if ($retu) 
                	{
                		customFlash('admin/newCategory','alert-success','Your category ' . $data['catName'] . ' has been successfully inserted.' );
                	} 
                	else 
                	{
                		customFlash('admin/newCategory','alert-danger','Your category ' . $data['catName'] . ' has not been inserted.' );
                	}
                	
                }	
			} 
			else 
			{
				customFlash('admin/newCategory','alert-warning','Please check your required fields and try again.');
			}

                
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}

	public function allCategory()
	{
		if (checkAdmin()) 
		{
			$config = array();
			$config['full_tag_open'] = '<ul class="pagination gmpg">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = FALSE;
			$config['last_link'] = FALSE;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li>';
		    $config['next_tag_close'] = '</li>';
										
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
		    $config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
		    $config['cur_tag_close'] = '</a></li>';
		    $config['num_tag_open'] = '<li>';
		    $config['num_tag_close'] = '</li>';

			$config["base_url"] = site_url('admin/allCategory');
	
			$categories = $this->mod_admin->allCagories();

			$config["total_rows"] = $categories->num_rows();
			$config["per_page"] = 20;//100;
			$config["uri_segment"] = 3;
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['allCategories'] = $this->mod_admin->getAllCategories($config["per_page"],$page);
			$data['links'] = $this->pagination->create_links();
 
			$this->load->view('admin/header/header');
			$this->load->view('admin/css/css');
			$this->load->view('admin/navbar/navtop');
			$this->load->view('admin/navbar/navleft');
			$this->load->view('admin/content/allCategory',$data);
			$this->load->view('admin/footer/footer');
			$this->load->view('admin/js/js');	

		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
	}

	public function editCategory($categoryId = null)
	{
		if (checkAdmin()) 
		{

			if (!empty($categoryId)) 
			{
				$data['category'] = $this->mod_admin->checkCategory($categoryId,adminId());
				if (count($data['category']) == 1) 
				{	
					$this->load->view('admin/header/header');
					$this->load->view('admin/css/css');
					$this->load->view('admin/navbar/navtop');
					$this->load->view('admin/navbar/navleft');
					$this->load->view('admin/content/editCategory',$data);
					$this->load->view('admin/footer/footer');
					$this->load->view('admin/js/js');	
				} 
				else 
				{
					customFlash('admin/allCategory','alert-warning','Category not found.');
				}
				
			} 
			else 
			{
				customFlash('admin/allCategory','alert-danger','Something went wrong please try again.');
			}
			
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}



	public function updateCategory()
	{
		if (checkAdmin()) 
		{
			$data['catName'] = $this->input->post('catName',TRUE);
			$data['adminId'] = adminId();
			$oldimg = $this->input->post('oldimg',TRUE);
			$categoryId = $this->input->post('oldid',TRUE);

			if (!empty($data['catName']) && !empty($categoryId)) 
			{

				if (isset($_FILES['catgoryImage']) && is_uploaded_file($_FILES['catgoryImage']['tmp_name'])) 
				{
					$path = realpath(APPPATH.'../assets/images/categories/');
				    $config['upload_path']          = $path;
	                $config['allowed_types']        = 'gif|jpg|png';
	                $config['max_size']             = 100;
	                $config['max_width']            = 1024;
	                $config['max_height']           = 768;
	                $this->load->library('upload',$config);
	                if (!$this->upload->do_upload('catgoryImage')) 
	                {
	                	$erro =  $this->upload->display_errors();
						customFlash('admin/allCategory','alert-danger',$erro);
	                } 
	                else 
	                {
	                	$filename = $this->upload->data(); 
	                	$data['catImage'] =  $filename['file_name'];
	                }	
				}//image here

					$oldimg = $this->encrypt->decode($oldimg);
					$categoryId = $this->encrypt->decode($categoryId);

                 	$retu = $this->mod_admin->editCategory($data,$categoryId);
                	if ($retu) 
                	{
                		if (!empty($data['catImage'])) 
                		{
                			if (file_exists($path.'/'.$oldimg)) 
                			{
                				unlink($path.'/'.$oldimg);
                			}
                		}

                		customFlash('admin/allCategory','alert-success','Your category ' . $data['catName'] . ' has been successfully updated.' );
                	} 
                	else 
                	{
                		customFlash('admin/allCategory','alert-danger','Your category ' . $data['catName'] . ' has not been updated.' );
                	}
			} 
			else 
			{
				customFlash('admin/allCategory','alert-warning','Please check your required fields and try again.');
			}

                
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}


	public function newProduct()
	{
		if (checkAdmin()) 
		{
			$data['title'] = "New Product | "."Products | " . SK; 
			$data['categories'] = $this->mod_admin->getCategories();
			$this->load->view('admin/header/header',$data);
			$this->load->view('admin/css/css');
			$this->load->view('admin/navbar/navtop');
			$this->load->view('admin/navbar/navleft');
			$this->load->view('admin/content/newProduct',$data);
			$this->load->view('admin/footer/footer');
			$this->load->view('admin/js/js');	
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}

	public function addProduct()
	{
		if (checkAdmin()) 
		{
			$data['catId'] = $this->input->post('category',TRUE);
			$data['productName'] = $this->input->post('productName',TRUE);
			$data['ProductCompany'] = $this->input->post('company',TRUE);

			$data['productDate'] = date('D-M-Y h:i:sa');			
			$data['adminId'] = adminId();
			if (
					!empty($data['catId']) && 
					!empty($data['productName']) &&
					!empty($data['ProductCompany'])
				) 
			{
				$path = realpath(APPPATH.'../assets/images/products/');
			    $config['upload_path']          = $path;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $this->load->library('upload',$config);
                if (!$this->upload->do_upload('productImage')) 
                {
                	$erro =  $this->upload->display_errors();
					customFlash('admin/newProduct','alert-danger',$erro);
                } 
                else 
                {
                	$filename = $this->upload->data(); 
                	$data['productImage'] =  $filename['file_name'];
  					//var_dump($data);              	
   		           	$checkProeuct = $this->mod_admin->checkProduct($data);
   		           	if ($checkProeuct->num_rows() > 0) 
   		           	{
   		           		customFlash('admin/newProduct','alert-warning','Your Product ' . $data['productName'] . ' already exist.' );
   		           	} 
   		           	else 
   		           	{
   		           		$retu = $this->mod_admin->addProduct($data);
	                	if ($retu) 
	                	{
	                		customFlash('admin/newProduct','alert-success','Your Product ' . $data['productName'] . ' has been successfully inserted.' );
	                	} 
	                	else 
	                	{
	                		customFlash('admin/newProduct','alert-danger','Your Product ' . $data['productName'] . ' has not been inserted.' );
	                	}
   		           	}
                }//else here file upload	
			} 
			else 
			{
				customFlash('admin/newProduct','alert-warning','Please check your required fields and try again.');
			}
		} 
		else 
		{
			customFlash('admin/newProduct','alert-danger','Please login first.');
		}
		
	}


	public function allProducts()
	{
		if (checkAdmin()) 
		{
			$config = array();
			$config['full_tag_open'] = '<ul class="pagination gmpg">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = FALSE;
			$config['last_link'] = FALSE;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li>';
		    $config['next_tag_close'] = '</li>';
										
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
		    $config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
		    $config['cur_tag_close'] = '</a></li>';
		    $config['num_tag_open'] = '<li>';
		    $config['num_tag_close'] = '</li>';

			$config["base_url"] = site_url('admin/allProducts');
	
			$producds = $this->mod_admin->getALlProducts();

			$config["total_rows"] = $producds->num_rows();
			$config["per_page"] = 20;//100;
			$config["uri_segment"] = 3;
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['allProducts'] = $this->mod_admin->fetchAllProducts($config["per_page"],$page);
			$data['links'] = $this->pagination->create_links();
 			$data['title'] ="All Products | " . SK; 
			$this->load->view('admin/header/header',$data);
			$this->load->view('admin/css/css');
			$this->load->view('admin/navbar/navtop');
			$this->load->view('admin/navbar/navleft');
			$this->load->view('admin/content/allProducts',$data);
			$this->load->view('admin/footer/footer');
			$this->load->view('admin/js/js');	

		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
	}


	public function editProduct($productId = null)
	{
		if (checkAdmin()) 
		{

			if (!empty($productId)) 
			{
				$data['products'] = $this->mod_admin->checkProductByAdmin($productId,adminId());
				if (count($data['products']) == 1) 
				{	
					$data['categories'] = $this->mod_admin->getCategories();
					$this->load->view('admin/header/header');
					$this->load->view('admin/css/css');
					$this->load->view('admin/navbar/navtop');
					$this->load->view('admin/navbar/navleft');
					$this->load->view('admin/content/editProduct',$data);
					$this->load->view('admin/footer/footer');
					$this->load->view('admin/js/js');	
				} 
				else 
				{
					customFlash('admin/allProducts','alert-warning','Product not found.');
				}
				
			} 
			else 
			{
				customFlash('admin/allProducts','alert-danger','Something went wrong please try again.');
			}
			
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}


	public function updateProduct()
	{
		if (checkAdmin()) 
		{
			$data['productName'] = $this->input->post('productName',TRUE);
			$data['ProductCompany'] = $this->input->post('company',TRUE);
			$data['catId'] = $this->input->post('category',TRUE);

			$data['adminId'] = adminId();
			$oldimg = $this->input->post('oldimg',TRUE);
			$productId = $this->input->post('oldid',TRUE);

			if (
					!empty($data['productName']) && !empty($productId) && 
					!empty($data['ProductCompany']) && !empty($data['catId'])
				) 
			{

				if (isset($_FILES['productImage']) && is_uploaded_file($_FILES['productImage']['tmp_name'])) 
				{
					$path = realpath(APPPATH.'../assets/images/products/');
				    $config['upload_path']          = $path;
	                $config['allowed_types']        = 'gif|jpg|png';
	                $config['max_size']             = 100;
	                $config['max_width']            = 1024;
	                $config['max_height']           = 768;
	                $this->load->library('upload',$config);
	                if (!$this->upload->do_upload('productImage')) 
	                {
	                	$erro =  $this->upload->display_errors();
						customFlash('admin/allProducts','alert-danger',$erro);
	                } 
	                else 
	                {
	                	$filename = $this->upload->data(); 
	                	$data['productImage'] =  $filename['file_name'];
	                }	
				}//image here

					$oldimg = $this->encrypt->decode($oldimg);
					$productId = $this->encrypt->decode($productId);

                 	$retu = $this->mod_admin->editProduct($data,$productId);
                	if ($retu) 
                	{
                		if (!empty($data['productImage'])) 
                		{
                			if (file_exists($path.'/'.$oldimg)) 
                			{
                				unlink($path.'/'.$oldimg);
                			}
                		}

                		customFlash('admin/allProducts','alert-success','Your product ' . $data['ProductCompany'] . ' has been successfully updated.' );
                	} 
                	else 
                	{
                		customFlash('admin/allProducts','alert-danger','Your product ' . $data['ProductCompany'] . ' has not been updated.' );
                	}
			} 
			else 
			{
				customFlash('admin/allProducts','alert-warning','Please check your required fields and try again.');
			}

                
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}


	public function newModel()
	{
		if (checkAdmin()) 
		{
			$data['title'] = "New Model | "."Models | " . SK; 
			$this->load->view('admin/header/header',$data);
			$this->load->view('admin/css/css');
			$this->load->view('admin/navbar/navtop');
			$this->load->view('admin/navbar/navleft');
			$this->load->view('admin/content/newModel');
			$this->load->view('admin/footer/footer');
			$this->load->view('admin/js/js');	
		} 
		else 
		{
			customFlash('admin/login','alert-danger','Please login first.');
		}
		
	}

	public function findproduct()
	{
		if($this->input->is_ajax_request())
		{
			if (empty($this->input->post('prodct',TRUE)))
			{
				echo 'erro here';
				//fc_flash('alert-warning', 'Oops something going wrong please try again', 'admin/allProducts');
			}
			else
			{
				$name = $this->input->post('prodct',TRUE);
				$pname = $this->mod_admin->get_product_name($name);
				echo $data = json_encode($pname);
			}	
		}
		else
		{
			customFlash('admin/allProducts','alert-danger','Direct access not allowed.');
		}
			
	}
	
	public function addModel()
	{
		echo $this->input->post('productId',TRUE);

	}
	public function des()
	{
		$this->session->set_userdata('aId','');
		redirect('admin/login');
	}

}//class ends here..


