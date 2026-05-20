<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class peopleController extends Controller
{
    public function index()
    {
        $title = "People";
        $users = User::latest()->get();

        return view('people', compact('title', 'users'));
    }
}