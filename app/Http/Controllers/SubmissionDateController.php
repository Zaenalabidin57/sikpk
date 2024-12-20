<?php

namespace App\Http\Controllers;

use App\Models\Tanggal_Submisi;
use Illuminate\Http\Request;

class SubmissionDateController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        Tanggal_Submisi::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => true,
        ]);

        return redirect()->back()->with('status', 'Tanggal submisi berhasil disimpan.');
    }

    public function delete($id)
    {
        $submissionDate = Tanggal_Submisi::findOrFail($id);
        $submissionDate->delete();
        
        return redirect()->back()->with('status', 'Jadwal berhasil dihapus.');
    }
}
