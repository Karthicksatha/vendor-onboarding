<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
class VendorApplication extends Model
{
   protected $fillable = [

        'user_id',

        'business_name',
        'business_type',

        'contact_person_name',
        'contact_email',
        'contact_mobile',

        'company_pan',
        'gst_number',

        'address',
        'city',
        'state',
        'pincode',

        'account_holder_name',
        'account_number',
        'ifsc_code',

        'status'
    ];

     /*
    |--------------------------------
    | Relationships
    |--------------------------------
    */

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(VendorStatusLog::class,'vendor_id');
    }

    /*
    |--------------------------------
    | Encrypt Account Number
    |--------------------------------
    */

    public function setAccountNumberAttribute($value)
    {
        $this->attributes['account_number'] =
        Crypt::encryptString($value);
    }

    public function getAccountNumberAttribute($value)
    {
        $value = Crypt::decryptString($value);

        return $this->maskAccount($value);
    }

    /*
    |--------------------------------------------------------------------------
    | Sensitive Field Accessors
    |--------------------------------------------------------------------------
    */

    public function getCompanyPanAttribute($value)
    {
        return $this->maskPan($value);
    }

    public function getGstNumberAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return $this->maskGst($value);
    }

    public function getContactMobileAttribute($value)
    {
        return $this->maskMobile($value);
    }

    /*
    |--------------------------------------------------------------------------
    | Masking Logic
    |--------------------------------------------------------------------------
    */

    private function canViewFull()
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $user->role === 'admin' || $user->id === $this->user_id;
    }

    private function maskPan($pan)
    {
        if ($this->canViewFull()) {
            return $pan;
        }

        return substr($pan,0,5) . '****' . substr($pan,-1);
    }

    private function maskGst($gst)
    {
        if ($this->canViewFull()) {
            return $gst;
        }

        return substr($gst,0,7) . '****' . substr($gst,-3);
    }

    private function maskMobile($mobile)
    {
        if ($this->canViewFull()) {
            return $mobile;
        }

        return substr($mobile,0,2) . 'XXXX' . substr($mobile,-4);
    }

    private function maskAccount($account)
    {
        if ($this->canViewFull()) {
            return $account;
        }

        return 'XXXXXXXX' . substr($account,-4);
    }
}
