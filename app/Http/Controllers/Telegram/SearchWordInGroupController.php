<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchWordInGroupController extends Controller
{

    public function index() {

        return view('telegram.search-word-group');

    }

    public function search(Request $request) {

        return view('telegram.search-word-group');

    }
}
