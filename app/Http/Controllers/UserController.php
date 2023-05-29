<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $model                  =  new User();
        $model->name            =  $request->name;
        $model->surname         =  $request->surname;
        $model->phone           =  $request->phone;
        $model->pasport         =  $request->pasport;
        $model->carta           =  $request->carta;
        $model->carta_time      =  $request->carta_time;
        $model->save();
        return $model;
       // return redirect()->route('user')->with(['message' => 'successfully']);
    }
}
