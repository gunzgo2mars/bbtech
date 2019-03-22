<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With");
header('Content-type: Application/json');

require('../../module/data_controller.php');

$req = json_decode(file_get_contents('php://input'), true);

if(isset($req['payload_data'])) {

    $data_controller = new DataController();

    $res = $data_controller->createData($req['payload_data']);

    echo json_encode($res);


} else {

    echo json_encode(array(

        "title" => "Error Params",
        "message" => "Data not receive from client.",
        "error" => true
    ));

}

?>