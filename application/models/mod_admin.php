<?php
class Mod_admin extends CI_Model
{
	
	public function checkAdmin($value)
	{
		return $this->db->get_where('admin',$value)->result_array();
	}	

	public function addCategory($value)
	{
		return $this->db->insert('categories',$value);
	}

	public function allCagories()
	{
		return $this->db->get_where('categories',array('catStatus'=>1));
	}

	public function getAllCategories($limit,$start)
	{
		$this->db->limit($limit, $start);
		$this->db->order_by('cat_id','desc');
		$query = $this->db->select('*')
		->from('categories')
		->where('catStatus',1)
		->get();
		if ($query->num_rows() > 0)
		        {
		            foreach ($query->result() as $row)
		            {
		                $data[] = $row;
		            }
		            return $data;
		        }
		        return false;
	}	


	public function checkCategory($categoryId,$adminId)
	{
		return $this->db->get_where('categories',
				array(
					'cat_id'=>$categoryId,
					'adminId'=>$adminId
				)
		)->result_array();
	}

	public function editCategory($value,$catid)
	{
		$where = array('cat_id' =>$catid,'adminId'=>$value['adminId']);
		 $this->db->where($where);
		 return $this->db->update('categories',$value);
	}

	public function getCategories()
	{
		return $this->db->get_where('categories',array('catStatus'=>1));
	}

	public function checkProduct($value)
	{
		return $this->db->get_where(
				'product',
				array(
						'catId'=>$value['catId'],
						'productName'=>$value['productName']
					)
			);
	}
	public function addProduct($value)
	{
		return $this->db->insert('product',$value);
	}

	public function getALlProducts()
	{
		return $this->db->get_where('product',array('productStatus'=>1));
	}

	public function fetchAllProducts($limit,$start)
	{
		$this->db->limit($limit, $start);
		$this->db->order_by('pId','desc');
		$query = $this->db->select('*')
		->from('product')
		->where('productStatus',1)
		->get();
		if ($query->num_rows() > 0)
		        {
		            foreach ($query->result() as $row)
		            {
		                $data[] = $row;
		            }
		            return $data;
		        }
		        return false;
	}	


	public function checkProductByAdmin($productId,$adminId)
	{
		return $this->db->get_where('product',
				array(
					'pId'=>$productId,
					'adminId'=>$adminId
				)
		)->result_array();
	}

	public function editProduct($value,$productId)
	{
		$where = array('pId' =>$productId,'adminId'=>$value['adminId']);
		 $this->db->where($where);
		 return $this->db->update('product',$value);
	}


	public function get_product_name($value)
	{
		return $this->db->select('*')
		->from('product')
		->like('productName',$value)
		->get()
		->result_array();
	}



}//class ends here