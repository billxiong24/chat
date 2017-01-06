<?php
$trans = json_decode(file_get_contents("php://input"));
    echo json_encode(array("trans"=>$trans->data, "test"=>"hello world"));
?>
