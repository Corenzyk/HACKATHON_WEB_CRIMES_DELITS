<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home(){
        return view('home');
    }
    
    public function cartes(){
        return view('cartes');
    }
    
    public function statistiques(){
        return view('statistiques');
    }

    public function recherches(){
        return view('recherches');
    }
}
