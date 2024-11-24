<?php

function responseJson($array, $status, $statusCode)
{
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

function deleteOldImage($image)
{
    if ($image && file_exists(public_path($image))) {
        try {
            unlink(public_path($image));
            return true;
        } catch (Exception $e) {
            \Log::error("Error deleting image: " . $e->getMessage());
            return false;
        }
    }

    return false;
}


function fileExists($filePath)
{
    if (file_exists(public_path($filePath))) {
        return true;
    } else {
        return false;
    }
}
