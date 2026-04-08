<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorStatusLog extends Model
{
     protected $fillable = [

        'vendor_id',
        'acted_by',
        'from_status',
        'to_status',
        'remarks'
    ];

    public function vendor()
    {
        return $this->belongsTo(VendorApplication::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'acted_by');
    }
}
