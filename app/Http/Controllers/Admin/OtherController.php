<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherController extends Controller
{
    public function unicode()
    {
		//图标字体
        return view("other/unicode");
    }
	
	
}
