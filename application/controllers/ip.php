<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php
require(APPPATH.'/libraries/REST_Controller.php');

class IP extends REST_Controller
{

	public function mine_get()
	{
		$this->response(array('CLIENT_IP' => $this->input->server('REMOTE_ADDR')),201);
	}
	
	public function report_get()
	{
		
	}
	public function report_post()
	{
		$ip = "none";
		if (!isset($this->input->post('ip'))){
			$ip = $this->input->post('ip');
		}
		$this->response(array('RECIVED_HOST' => $this->input->post('host'),'RECIVED_IP' => $ip),201);
	}
}