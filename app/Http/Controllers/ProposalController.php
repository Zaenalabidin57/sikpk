<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Tanggal_Submisi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProposalController extends Controller
{
    public function create()
    {
        return view('proposal');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Check if current time is within submission period
        $current_time = Carbon::now();
        $submission_period = Tanggal_Submisi::where('start_date', '<=', $current_time)
            ->where('end_date', '>=', $current_time)
            ->first();

        if (!$submission_period) {
            return back()->withErrors(['message' => 'Tidak ada jadwal']);
        }

        // Check if user has already submitted a proposal
        if (Proposal::where('user_id', auth()->id())->exists()) {
            return back()->withErrors(['message' => 'tidak bisa mengirim proposal lagi']);
        }

        // Create the proposal
        $proposal = new Proposal();
        $proposal->user_id = auth()->id();
        $proposal->title = $request->title;
        $proposal->content = $request->content;
        $proposal->status = 'draft'; // Default status
        $proposal->save();

        return redirect()->route('dashboard')->with('success', 'Proposal submitted successfully');
    }

    public function updateStatus(Request $request, Proposal $proposal)
    {
        // Check if user is admin
        if (!auth()->user()->hasRole('admin')) {
            return back()->withErrors(['message' => 'Unauthorized']);
        }

        $request->validate([
            'status' => 'required|in:draft,terkirim,di-ACC,ditolak',
        ]);

        $proposal->status = $request->status;
        $proposal->save();

        return back()->with('success', 'Status updated successfully');
    }

    public function edit(Proposal $proposal)
    {
        // Check if user owns the proposal or is admin
        if (!auth()->user()->hasRole('admin') && auth()->id() !== $proposal->user_id) {
            return back()->withErrors(['message' => 'Unauthorized']);
        }

        return view('proposals.edit', compact('proposal'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        // Check if user owns the proposal or is admin
        if (!auth()->user()->hasRole('admin') && auth()->id() !== $proposal->user_id) {
            return back()->withErrors(['message' => 'Unauthorized']);
        }

        // Validate the request
        $validatedData = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];

        // Add status validation if user is admin
        if (auth()->user()->hasRole('admin')) {
            $validatedData['status'] = 'required|in:draft,terkirim,di-ACC,ditolak';
        }

        $request->validate($validatedData);

        // Update the proposal
        $proposal->title = $request->title;
        $proposal->content = $request->content;
        
        // Update status if user is admin
        if (auth()->user()->hasRole('admin') && $request->has('status')) {
            $proposal->status = $request->status;
        }
        
        $proposal->save();

        return redirect()->route('dashboard')->with('success', 'Proposal updated successfully');
    }

    public function destroy(Proposal $proposal)
    {
        // Check if user owns the proposal or is admin
        if (!auth()->user()->hasRole('admin') && auth()->id() !== $proposal->user_id) {
            return back()->withErrors(['message' => 'Unauthorized']);
        }

        $proposal->delete();
        return redirect()->route('dashboard')->with('success', 'Proposal deleted successfully');
    }
}
