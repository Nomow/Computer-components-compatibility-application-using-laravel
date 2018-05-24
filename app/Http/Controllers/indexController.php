<?php

namespace App\Http\Controllers;

class indexController extends Controller
{
    public function index()
    {

        $data = ['title' => 'saliec pats savu datoru'];
        return view('index', $data);

    }
    public function about()
    {
        $data = ['title' => 'Par mums '];
        return view('about', $data);
    }

}
