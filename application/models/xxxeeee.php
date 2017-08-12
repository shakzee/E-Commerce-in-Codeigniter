<?php
class Mod_admin extends CI_Model
{

	public function checkAdmin($data)
	{
		return $this->db->get_where('admin',$data);
	}
}
