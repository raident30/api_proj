<?php

require_once 'Database.php';
require_once 'APIWrapper.class.php';

class RestTest extends APIWrapper
{
    private $db;
    private $host     = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "local";

    public function __construct($request) {
        parent::__construct($request);

        $this->db = new Database($this->host, $this->username, $this->password, $this->database);
    }

    protected function insert_vehicle(){
        $response_array = [];
        $clean_data = $this->_escapeData($_POST);

        $clean_data['created_at'] = date('Y-m-d H:i:s');

        $result = $this->db->insert_array($clean_data, "vehicles");

        $response_array = $clean_data;

        $response_array['id'] = $this->db->insert_id();

        echo json_encode($response_array);
    }

    private function _escapeData($data){
        $clean_data = Array();
        foreach ($data as $k => $v) {
            $clean_data[$k] = $this->db->escape_string(trim(strip_tags($v)));
        }
        return $clean_data;
    }    
 }