<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    //
    public function index()
    {

        $query = User::where('status', '=', 1);
        $query->orderBy('id', 'desc');

        $data = $query->get()->toArray();
dd($data);

        exit;
    }
}
