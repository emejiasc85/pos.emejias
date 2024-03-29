<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\ProductPresentation;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateProductPresentationsController extends Controller
{

    public function create()
    {
    	return view('product_presentations.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, ['name' => 'required|unique:product_presentations,name']);
    	$new = ProductPresentation::create($request->all());
    	Alert::success('Presentación agregada correctamente');
    	return redirect()->route('product.presentations.index');
    }
}
