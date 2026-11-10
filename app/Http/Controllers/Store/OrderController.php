<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function show(string $locale, Order $order): View
    {
        $order->load('items');

        return view('store.confirmation', [
            'order' => $order,
            'settings' => BusinessSetting::current(),
        ]);
    }
}
