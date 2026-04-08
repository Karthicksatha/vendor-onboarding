<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorApplication;

class ReportController extends Controller
{
    public function index()
    {
        $report = VendorApplication::selectRaw(
            'status, count(*) as total'
        )->groupBy('status')->get();

        return view('reports.index', compact('report'));
    }
}
