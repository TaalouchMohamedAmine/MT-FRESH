<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use Illuminate\View\View;

class InformationController extends Controller
{
    public function about(): View
    {
        return view('store.about');
    }

    public function contact(): View
    {
        return view('store.contact', ['settings' => BusinessSetting::current()]);
    }
}
