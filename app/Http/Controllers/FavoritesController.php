<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
         $reply->favorite();

         return back();
    }

}
