<?php

class RequestHandler {
    private $__method;
    private $__parameters = array();
    private $__resource;
    private $__resource_id;
    private $__resource_name;
    private $__resource_lname;
    private $__resource_gender;
    private $__resource_receive;
    private $__allowed_methods= array("GET","POST","DELETE","PUT");
    
    
    function get__method() {
        return $this->__method;
    }

    function get__parameters() {
        return $this->__parameters;
    }

    function get__resource() {
        return $this->__resource;
    }

    function get__resource_id() {
        return $this->__resource_id;
    }
    function get__resource_name() {
        return $this->__resource_name;
    }
    function get__resource_gender() {
        return $this->__resource_gender;
    }
    function get__resource_email() {
        return $this->__resource_email;
    }
    function get__resource_recieve() {
        return $this->__resource_receive;
    }
 

    public function __construct() {
        $this->__method = $_SERVER["REQUEST_METHOD"];
        $url_pieces = explode("/",$_SERVER["REQUEST_URI"]);

        $this->__resource = isset($url_pieces[2])?$url_pieces[2]:"";
        $this->__resource_id = isset($url_pieces[3])&&is_numeric($url_pieces[3])?$url_pieces[3]:0;
        $this->__resource_name = isset($url_pieces[4])?$url_pieces[4]:"notset";
        $this->__resource_email = isset($url_pieces[5])?$url_pieces[5]:"notset";
        $this->__resource_gender = isset($url_pieces[6])?$url_pieces[6]:"notset";
        $this->__resource_receive = isset($url_pieces[7])&&is_numeric($url_pieces[7])?$url_pieces[7]:-1;

        
        if($this->__method == "POST" || $this->__method=="GET"|| $this->__method=="DELETE"||$this->__method=="PUT"){
            $this->__parameters = json_decode(file_get_contents("php://input"),true);
        }  
    }

     //***********************************************************************************************************
    //this function should output or return the request elements (resource, method, parameters and resource id)
	//if $output is false the function should returns otherwise it should echo the response in JSON formats
	//***********************************************************************************************************
    public function scan($output=true){
       
     
        
    }
	//***********************************************************************************************************
    //this function should validate the request 
	//if $output is false the function should returns the result otherwise it should echo the results in JSON formats
	//$correct_resource : The resource which the service should accepts, "items" in this example. 
	//***********************************************************************************************************
    public function validate($correct_resource,$output = true){
        if($this->__resource !== $correct_resource || !is_numeric($this->__resource_id)){
            ResponseHandler::output_with_error(404,"resource not found");
         } elseif(!in_array($this->__method,$this->__allowed_methods)){
             ResponseHandler::output_with_error(405,"method not valid");
         } else {
            return true;
        }
    }
    
    

}
