<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Closure;

class PageController extends Controller
{
  public function home()
  {
    $persons = ['Tim', 'John', 'Peter'];
    return view('welcome', compact('persons'));
  }

  public function bot()
  {
    return view('bot');
  }

  public function updates(Request $reqest)
  {
    return $reqest->text;
  }
}
