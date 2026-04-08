<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorApplication;
use App\Models\VendorStatusLog;
use App\Http\Requests\VendorApplicationRequest;
use Symfony\Component\HttpKernel\Log\Logger;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
        $data['user_id'] = auth()->id();
       
        $query = VendorApplication::query();

        if ($request->business_name) {
            $query->where('business_name', 'like', '%' . $request->business_name . '%');

        }

        if ($request->account_number) {
            // $searchHash = hash('sha256', $request->account_number, config('app.key'));
            
            $query->where('account_number','like', '%' . $request->account_number . '%');
            // $query->where('account_number', $searchHash);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $vendors = $query->latest()->paginate(10);

        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorApplicationRequest  $request)
    {
        // $data = $request->validate([
        //     'business_name' => 'required',
        //     'business_type' => 'required',
        //     'contact_person_name' => 'required',
        //     'contact_email' => 'required|email',
        //     'contact_mobile' => 'required',
        //     'company_pan' => 'required',
        //     'gst_number' => 'nullable',
        //     'address' => 'required',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'pincode' => 'required',
        //     'account_holder_name' => 'required',
        //     'account_number' => 'required',
        //     'ifsc_code' => 'required',
        // ]);
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['status'] = 'draft';

        VendorApplication::create($data);

        return redirect()->route('vendors.index')
            ->with('success', 'Application created as Draft');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendor = VendorApplication::findOrFail($id);

        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = VendorApplication::findOrFail($id);

        if ($vendor->user_id != auth()->id()) {
            abort(403);
        }

        if (!in_array($vendor->status, ['draft', 'sent_back'])) {
            abort(403);
        }

        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorApplicationRequest  $request, string $id)
    {
        $vendor = VendorApplication::findOrFail($id);

        $vendor->update($request->validated());

        return redirect()->route('vendors.index')
            ->with('success', 'Application updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function submit($id)
    {
        $vendor = VendorApplication::findOrFail($id);

        if ($vendor->user_id != auth()->id()) {
            abort(403);
        }

        if (!in_array($vendor->status, ['draft', 'sent_back'])) {
            abort(403);
        }

        $from = $vendor->status;

        $vendor->update([
            'status' => 'submitted'
        ]);

        VendorStatusLog::create([
            'vendor_id' => $vendor->id,
            'acted_by' => auth()->id(),
            'from_status' => $from,
            'to_status' => 'submitted'
        ]);

        return redirect()->route('vendors.index')
            ->with('success', 'Application submitted for review');
    }

    public function history($id)
    {
        $logs = VendorStatusLog::where('vendor_id', $id)
            ->with('user')
            ->latest()
            ->get();

        return view('vendors.status-history', compact('logs'));
    }
}
