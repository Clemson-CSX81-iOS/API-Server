<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php
require(APPPATH.'/libraries/REST_Controller.php');

class IP extends REST_Controller
{

	public function server_get()
	{
		print_r($_SERVER);
	}

	public function mine_get()
	{
		$this->response(array('CLIENT_IP' => $this->input->server('REMOTE_ADDR')),201);
	}
	
	public function records_get()
	{
		$jsonObj = read_file('./data.json');
		if ($jsonObj) {
			$jsonObj = json_decode($jsonObj,true);
			$this->response($jsonObj,201);
		}
		else
			$this->response(array('MESSAGE'=>'No records on server'),201);
	}
	
	public function records_delete(){
		if ($this->delete('check')){
			$this->response(array('MESSAGE'=>'Records deleted'),201);
		}
		$this->response(array('MESSAGE'=>$_SERVER),202);
	}
	
	public function records_post(){
		// if ($this->post('check')){
			// $this->response(array('MESSAGE'=>'Records deleted'),201);
		// }
		$this->response(array('MESSAGE'=>$_SERVER),202);
	}
	
	public function report_post()
	{
		$host =  $this->post('host');
		$user = $this->post('user');
		
		$ip = $this->input->server('REMOTE_ADDR');
		if ($this->post('ip')){
			$ip = $this->post('ip');
		}
		
		$response = array('RECIVED_HOST' => $host,'HOST_IP' => $ip, 'USER' => $user);
		
		$jsonObj = read_file('./data.json');
		if ($jsonObj) {
			$jsonObj = json_decode($jsonObj,true);
		}
		
		$jsonObj[$user] = $response;
		
		$success = write_file('./data.json',json_encode($jsonObj));
		
		$response['SUCCESS'] = (!$success) ? "NO" : "YES";
		$response['INFO'] = $this->input->server('REDIRECT_SCRIPT_URI');
		
		$this->response($response,201);
	}
}