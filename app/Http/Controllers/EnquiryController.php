<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Enquiry::query();

        if ($request->from && $request->to) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        $enquiries = $query->get();

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $enquiry->update([
            'contacted' => $request->contacted,
            'remark' => $request->remark
        ]);

        return back();
    }
}