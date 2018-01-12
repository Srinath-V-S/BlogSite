<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function about(){
      $title = "Welcome to About Page";
      return view('Pages.about')->with('title',$title);
    }
    public function index(){
      $title = "Welcome to BlogSite";
      return view('Pages.index')->with('title',$title);
    }

    public function services(){

      $data  = array(
        'title' => 'Services',
        'services' => ['Web Dev','SEO','Android','Big Data','Human Psychology','Bio informatics'],
      );
      return view('Pages.services')->with($data);
    }

}
