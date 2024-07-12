<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index(): \Illuminate\View\View
    {
        $jokers = [];
        $jokers = DB::select("SELECT * FROM joker");
        return view('home.index', ['title' => 'Home', 'jokers' => $jokers, 'a' => 0]);
    }

    public function contact(): \Illuminate\View\View
    {
        return view('home.contact', ['title' => 'Contact']);
    }

    public function users(): \Illuminate\View\View
    {
        $users = [];
        $users = DB::select("SELECT * FROM users");
        dump($users);

        return view('home.users', ['title' => 'Users', 'users' => $users, 'a' => 0]);
    }
}
