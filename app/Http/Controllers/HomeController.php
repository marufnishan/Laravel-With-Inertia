<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){

        $name = Member::find(2);

        $company =  $name->company;

        //$name = 'Maruf';
        return Inertia::render('Home',['name'=>$name->Name,'company'=>$company]);
    }
}
