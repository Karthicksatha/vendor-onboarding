<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorApplication;
use App\Models\VendorStatusLog;

class VendorReviewController extends Controller
{
    public function approve($id)
    {
        $vendor = VendorApplication::findOrFail($id);

        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($vendor->status != 'submitted') {
            abort(403);
        }

        $from = $vendor->status;

        $vendor->update([
            'status' => 'approved'
        ]);

        VendorStatusLog::create([
            'vendor_id' => $vendor->id,
            'acted_by' => auth()->id(),
            'from_status' => $from,
            'to_status' => 'approved'
        ]);

        return back()->with('success', 'Application Approved');
    }

    public function reject(Request $request, $id)
    {
        $vendor = VendorApplication::findOrFail($id);

        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($vendor->status != 'submitted') {
            abort(403);
        }

        $from = $vendor->status;

        $vendor->update([
            'status' => 'rejected'
        ]);

        VendorStatusLog::create([
            'vendor_id' => $vendor->id,
            'acted_by' => auth()->id(),
            'from_status' => $from,
            'to_status' => 'rejected',
            'remarks' => $request->remarks
        ]);

        return back()->with('success', 'Application Rejected');
    }

    public function sendBack(Request $request, $id)
    {
        $vendor = VendorApplication::findOrFail($id);

        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($vendor->status != 'submitted') {
            abort(403);
        }

        $from = $vendor->status;

        $vendor->update([
            'status' => 'sent_back'
        ]);

        VendorStatusLog::create([
            'vendor_id' => $vendor->id,
            'acted_by' => auth()->id(),
            'from_status' => $from,
            'to_status' => 'sent_back',
            'remarks' => $request->remarks
        ]);

        return back()->with('success', 'Application Sent Back');
    }

   
}
