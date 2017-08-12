<?php
	function customFlash($url,$class,$message){
		$ci = & get_instance();
		$ci->load->helper('url');
		$ci->load->library('session');
		$ci->session->set_flashdata('class',$class);
		$ci->session->set_flashdata('error',$message);
		redirect($url);

	}

	 function checkFlash()
	{
		$ci = & get_instance();
		$ci->load->library('session');
		if ($ci->session->flashdata('class')) {
			$data['class'] = $ci->session->flashdata('class');
			$data['error'] = $ci->session->flashdata('error');
			$ci->load->view('errors/flashdata',$data);
		} 
	}

	 function checkAdmin()
	{
		$ci = & get_instance();
		$ci->load->library('session');
		if ($ci->session->userdata('aId')) 
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		} 
	}
	function adminId()
	{
		$ci = & get_instance();
		$ci->load->library('session');
		if ($ci->session->userdata('aId')) 
		{
			return $ci->session->userdata('aId');
		}
		else
		{
			return FALSE;
		} 
	}

?>