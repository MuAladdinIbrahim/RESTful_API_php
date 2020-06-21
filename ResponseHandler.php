<?php

class ResponseHandler
{

	private $db;  //an object from MYSQLHandler class
	private $logger;  //logger object to log response if needed (bonus)


	//$db : an object from MYSQLHandler class
	public function __construct($db, $logger = null)
	{
		$this->db = $db;
		$this->logger = $logger;
	}

	//***********************************************************************************************************
	//use this function for output all success responses
	//it has a log parameters just incase you want to log the response (bonus)
	//$data could be any thing you send but mostlikely it will be an array or a confirmation message	
	//***********************************************************************************************************
	public function output_with_success($data, $sucess_code = 200, $log = null)
	{
		//header("Content-Type:application/json"); //tells browser that output is json
		header("Content-Type:text/json");
		$output = json_encode($data);
		if (!$output) {
			self::output_with_error(400, "Resource not found");
		} else {
			http_response_code($sucess_code);
			echo $output;
		}
		if (is_null($log)) {
			$log->info("SENT");
			exit();
		}
	}

	//***********************************************************************************************************
	//use this function for output and log any error
	//it has a log parameters just incase you want to log the response (bonus)
	//$error message is the text you want to display for the client of your API 	
	//***********************************************************************************************************
	public static function output_with_error($code = 400, $error_msg, $log = null)
	{
		header("Content-Type:text/json");
		http_response_code($code);
		echo json_encode(array("error" => $error_msg));
		if (is_null($log)) {
			$log->info("sent");
			exit();
		}
	}

	//***********************************************************************************************************
	//use this function to handle the GET HTTP Verb
	//$id is the resource_id	
	//***********************************************************************************************************
	public function handle_get($id)
	{
		$users = array();
		$requestHandler = new RequestHandler();
		if ($requestHandler->get__resource_id() == 0) {
			$data = $this->db->selectUsers();
			while ($row = $data->fetch_assoc()) {
				array_push($users, $row);
			}
		} else {
			$data = $this->db->selectUser($id);
		}
		if ($data->num_rows > 0 && $requestHandler->get__resource_id() == 0) {
			self::output_with_success($users);
		} elseif ($data->num_rows > 0) {
			self::output_with_success($data->fetch_assoc());
		} else {
			self::output_with_error(404, "resource not here", $this->logger);
		}
	}
	//***********************************************************************************************************
	//use this function to handle the POST HTTP Verb
	//$params is sent params for a new resource
	//***********************************************************************************************************
	public function handle_post($name, $email, $gender, $receive)
	{
		var_dump("hi");
		if (!$this->db->insertUser($name, $email, $gender, $receive)) {
			self::output_with_success(array("status" => "userAdded"));
		} else {
			self::output_with_error(400, "request not valid", $this->logger);
		}
	}

	//***********************************************************************************************************
	//use this function to handle the PUT HTTP Verb
	//$params is sent params for a new resource
	//$id is the resource_id
	//***********************************************************************************************************
	public function handle_put($id, $name, $email, $gender, $receive)
	{
		if ($this->db->updateUser($id, $name, $email, $gender, $receive)) {
			self::output_with_success(array("status" => "userUpdated"));
		} else {
			self::output_with_error(400, "request not valid", $this->logger);
		}
	}
	//***********************************************************************************************************
	//use this function to handle the GET HTTP Verb
	//$id is the resource_id
	//***********************************************************************************************************
	public function handle_delete($id)
	{
		if ($this->db->deleteUser($id)) {
			self::output_with_success(array("status" => "deleted successfully"));
		} else {
			self::output_with_error(400, "request not valid", $this->logger);
		}
	}
}
