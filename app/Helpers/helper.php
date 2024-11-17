<?php 
function responseJson($array, $status, $statusCode){
    return response()->json([
        'status' => $status,
        'data' => $array
    ], $statusCode);
}