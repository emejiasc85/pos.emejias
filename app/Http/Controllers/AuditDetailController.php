<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Audit;
use EmejiasInventory\Entities\auditDetail;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Entities\Stock;
use Illuminate\Http\Request;

class AuditDetailController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return ("hola");
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Audit $audit) {
        $data = $request->all();
        $data = array_where($data, function ($value, $key) {
            return is_string($value);
        });

        if (empty($data)) {
            $products = [];
        } else {
            $products = Product::name($request->get('name'))
                ->id($request->get('id'))
                ->make($request->get('make_id'))
                ->group($request->get('product_group_id'))
                ->presentation($request->get('product_presentation_id'))
                ->unit($request->get('unit_measure_id'))
                ->barcode($request->get('barcode'))
                ->orderBy('id', 'DESC')
                ->get();

        }
        return view('audit.details.create', compact('audit', 'products'));
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Audit $audit) {
        $rules = [
            'product_id' => 'required|exists:products,id',
        ];
        $this->validate($request, $rules);
       $stocks = Stock::select('stocks.id')->leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->order($request->get('order_id'))
            ->product($request->get('name'))
            ->productId($request->get('id'))
            ->dueDate($request->get('from_due'), $request->get('to_due'))
            ->stock($request->get('simbol'), $request->get('stock'))
            ->where('status', true)
            ->where('product_id', $request->input('product_id'))
            //->OrderBy('id', 'DESC')
           
            ->paginate();
//Stock::where('id',);

foreach ($stocks as $key => $value) {
    echo $value->id." ";
}
        $data = array_add($request->all(), 'audit_id', $audit->id);
        $data = array_add($data, 'stock_id', $audit->id);
        dd($data, $stocks);
        $new_detail = auditDetail::create($data);
        $audit->sumTotals();
        $audit->save();
        Alert::success('Producto Agregado correctamente');
        return redirect($audit->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function show(auditDetail $auditDetail) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(auditDetail $auditDetail) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, auditDetail $auditDetail) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EmejiasInventory\Entities\auditDetail  $auditDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(auditDetail $auditDetail) {
        //
    }
}
