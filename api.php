<?php
require_once 'RestTest.php';

try {
    $API = new RestTest($_REQUEST['request']);
    $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}