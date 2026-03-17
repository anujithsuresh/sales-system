<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'date',
        'product_id',
        'category_name',
        'amount',
        'name',
        'address',
        'quantity',
        'mobile',
        'contacted',
        'remark'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
