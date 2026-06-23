<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::with(['trato.product', 'trato.seller', 'trato.buyer'])
            ->latest()
            ->paginate(20);

        return view('admin.delivery.index', compact('deliveries'));
    }

    public function show(Delivery $delivery)
    {
        $delivery->load(['trato.product', 'trato.seller', 'trato.buyer']);

        return view('admin.delivery.show', compact('delivery'));
    }

    public function approve(Request $request, Delivery $delivery)
    {
        abort_if($delivery->status !== 'pendiente', 422);

        $request->validate([
            'courier_name'  => 'required|string|max:100',
            'courier_plate' => 'required|string|max:20',
            'courier_phone' => 'nullable|string|max:20',
            'admin_notes'   => 'nullable|string|max:500',
        ]);

        $delivery->update([
            'status'        => 'aprobado',
            'courier_name'  => $request->courier_name,
            'courier_plate' => $request->courier_plate,
            'courier_phone' => $request->courier_phone,
            'admin_notes'   => $request->admin_notes,
        ]);

        return redirect()->route('admin.delivery.show', $delivery)
            ->with('success', 'Delivery aprobado. El vendedor ya puede ver los datos del repartidor.');
    }

    public function reject(Request $request, Delivery $delivery)
    {
        abort_if(!in_array($delivery->status, ['pendiente', 'aprobado']), 422);

        $request->validate([
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $delivery->update([
            'status'      => 'rechazado',
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.delivery.index')
            ->with('success', 'Solicitud de delivery rechazada.');
    }
}
