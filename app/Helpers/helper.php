<?php 

function responseJson($array, $status, $statusCode){
    return response()->json([
        'status' => $status,
        'data' => $array
    ], $statusCode);
}

function saveImage($image, $filePath)
{
    if (!file_exists(public_path($filePath))) {
        mkdir(public_path($filePath), 0755, true);
    }

    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

    $image->move(public_path($filePath), $imageName);

    return $filePath . '/' . $imageName;
}