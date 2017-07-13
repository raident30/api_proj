<?php

require_once 'APIWrapper.class.php';

class Database 
{
    public $mysqli;

    private $return_data = array();

    public function __construct($host, $user, $password, $database)
    {
        $this->mysqli = new mysqli($host, $user, $password, $database);
    }

    public function query($query)
    {
        return $this->mysqli->query($query);
    }

    public function fetch_all($query)
    {
        $results     = $this->query($query);
        $return_data = array();
        while($row = $results->fetch_assoc())
        {
           $return_data[] = $row;
        }
        return $return_data;
    }

    public function fetch($query)
    {
        return $this->query($query)->fetch_assoc();
    }

    public function insert_array($data = [], $table = "")
    {   
        $fields_construct = "(";
        $values_construct = "(";

        foreach ($data as $key => $val) {
            $values_construct .= "'".$val."',";
            $fields_construct .= "`".$key."`,";
        }

        $values_construct = rtrim($values_construct, ",") . ")";
        $fields_construct = rtrim($fields_construct, ",") . ")";

        $final_query = "INSERT INTO `{$table}` " . $fields_construct . " VALUES " . $values_construct . ";";

        if($this->query($final_query))
            return TRUE;

        return FALSE;
    }

    public function escape_string($string)
    {
        return mysqli_real_escape_string($this->mysqli, $string);
    }

    public function insert_id()
    {
        return $this->mysqli->insert_id;
    }

}