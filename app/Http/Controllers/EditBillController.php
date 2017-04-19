<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Bill;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\Resolution;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditBillController extends Controller
{
    public function confirm(Request $request, Order $order)
    {
        if(trim($request->bill_number) != null){
            if (Resolution::where('status', true)->first()) {
                $bill = new Bill();
                $bill->order_id = $order->id;
                $bill->resolution_id = Resolution::where('status', true)->first()->id;
                $bill->bill = $request->bill_number;
                $bill->save();
            }
        }
        $order->status = 'Ingresado';
        $order->save();
        Alert::success('Compra finalizada');
        return redirect()->back();
    }
}