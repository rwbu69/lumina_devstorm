<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function show(Order $order): Response
    {
        return response('OrderController@show order_id='.$order->id.' (TODO)', 200);
    }
}
