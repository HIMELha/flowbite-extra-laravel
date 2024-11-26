<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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


function hasAccess($roles, $permissions)
{
    if (!$roles || empty($permissions)) {
        return false;
    }

    $roles = is_array($roles) ? $roles : $roles->pluck('name')->toArray();

    $permissions = is_array($permissions) ? $permissions : [$permissions];

    $rolePermissions = Permission::whereHas('roles', function ($query) use ($roles) {
        $query->whereIn('name', $roles);
    })->pluck('name')->toArray();

    foreach ($permissions as $permission) {
        if (in_array($permission, $rolePermissions)) {
            return true;
        }
    }

    return false;
}