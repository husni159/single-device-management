<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'message' => 'Users retrieved successfully.',
            'data' => $users,
        ]);
    }

}
