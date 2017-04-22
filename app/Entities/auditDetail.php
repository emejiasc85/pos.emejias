<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class auditDetail extends Model {
    protected $fillable = [
        'audit_id',
        'product_id',
        'stock_id',
        'audited_stock',
        'status',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function audit() {
        return $this->belongsTo(Audit::class);
    }
    public function stock() {

        return $this->belongsTo(Stock::class);
    }

}
