<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TravelPackageController extends Controller
{
    public function index(Request $request) {
        // $items = TravelPackage::all();
        return view('pages.admin.travel-package.index',[
            // 'items' => $items
        ]);
    }

}
