<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use Barryvdh\DomPDF\Facade\Pdf;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Enquiry::with('product');

        if ($request->from && $request->to) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        $enquiries = $query->latest()->get();

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function update(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $enquiry->update([
            'contacted' => $request->contacted,
            'remark' => $request->remark
        ]);

        return back()->with('success', 'Updated');
    }

    public function exportPdf(Request $request)
    {
        $query = Enquiry::with('product');

        if ($request->from && $request->to) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        $enquiries = $query->get();

        $pdf = Pdf::loadView('admin.enquiries.pdf', compact('enquiries'));

        return $pdf->download('enquiries.pdf');
    }
}
