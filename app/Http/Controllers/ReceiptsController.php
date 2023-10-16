<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiptRequest;
use App\Models\Receipt;
use App\Models\Service;
use Illuminate\Http\Request;

class ReceiptsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('reservation', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReceiptRequest $request)
    {
        $validated = $request->validated();
        $validated['code'] = uniqid();

        if (Receipt::checkForBooking($validated)) {
            $receipt = Receipt::create($validated);
            return redirect()->route('receipts.show', ['receipt' => $receipt]);
        }
        return redirect()->route('receipts.create')->withErrors(['times' => 'The time selected is too short for your service']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt)
    {
        return view('booked', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        $services = Service::all();
        $time = $receipt->reservation_time;
        return view('edit', compact('receipt', 'services', 'time'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receipt $receipt)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'service_id' => ['required', 'exists:services,id'],
            'reservation_time_id' => ['required', 'exists:reservation_times,id']
        ]);

        $receipt->update($validated);
        return redirect()->route('receipts.show', compact('receipt'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        $receipt->delete();
        return redirect()->route('receipts.create');
    }

    public function trackPage()
    {
        return view('track');
    }

    public function track(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required'],
            'code' => ['required']
        ]);

        $receipt = Receipt::query()->where($validated)->first();
        if (!is_null($receipt)) return redirect()->route('receipts.edit',[$receipt]);

        return redirect()->route('receipts.track.page');
    }
}
