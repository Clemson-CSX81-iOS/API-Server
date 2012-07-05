<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php
require(APPPATH.'/libraries/REST_Controller.php');

class IP extends REST_Controller
{

	public function mine_get()
	{
		$this->response(array('CLIENT_IP' => $this->input->server('REMOTE_ADDR')),201);
	}
	
	public function report_post()
	{
		$this->response(array('RECIVED_IP' => $this->input->post('ip')),201);
	}
}