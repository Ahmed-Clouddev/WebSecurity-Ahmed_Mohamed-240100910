<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use PHPUnit\Metadata\Test;

class TestController extends Controller
{
    // public function FirstAction(){
    //     $localbooks=["css","js","php"];
    // return view('test', ["name" => "mohamed", "books"=>$localbooks]);
    // }
public function post()
{
    $allposts=[
        ["id" => 1,"title"=>"php","posted_by"=>"Mido"],
        ["id" => 2,"title"=>"css","posted_by"=>"koko"],
        ["id" => 3,"title"=>"gg","posted_by"=>"soso"],
    ];
return view('test', ["posts" => $allposts]);
    }
    
    public function great(){
        return view('test');
    }
}
