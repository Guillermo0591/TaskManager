<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($name)
    {
        $users = User::where('name', 'like', '%'.$name.'%');

        return response()->json($users);
    }

}
