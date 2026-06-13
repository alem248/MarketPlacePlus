<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use App\Models\Trato;
use Illuminate\Http\Request;

class ComprobantesController extends Controller
{
    /**
     * Lista todos los comprobantes del comprador autenticado.
     */
    public function index()
    {
        $comprobantes = Comprobante::where('buyer_id', auth()->id())
            ->with(['product', 'seller'])
            ->latest()
            ->get();

        return view('comprobantes.index', compact('comprobantes'));
    }

    /**
     * Genera el comprobante a partir de un trato ya recibido.
     * Solo el comprador puede generarlo, y solo una vez por trato.
     */
    public function store(Trato $trato)
    {
        // Solo el comprador del trato puede generar el comprobante
        abort_if($trato->buyer_id !== auth()->id(), 403);

        // Solo se puede generar si el trato fue recibido
        abort_if($trato->status !== 'recibido', 403);

        // Si ya existe, redirige directamente a Mis Comprobantes
        if (Comprobante::where('trato_id', $trato->id)->exists()) {
            return redirect()->route('comprobantes.index')
                ->with('info', 'Este comprobante ya fue generado anteriormente.');
        }

        // Normaliza el método de pago: quita números y deja solo el nombre del método
        $raw    = $trato->payment_method ?? '';
        $method = $this->normalizarMetodoPago($raw);

        // Código de transacción único: TRT-00001-2026
        $code = 'TRT-' . str_pad($trato->id, 5, '0', STR_PAD_LEFT) . '-' . date('Y');

        Comprobante::create([
            'trato_id'         => $trato->id,
            'buyer_id'         => $trato->buyer_id,
            'seller_id'        => $trato->seller_id,
            'product_id'       => $trato->product_id,
            'price'            => $trato->price,
            'payment_method'   => $method,
            'transaction_code' => $code,
            'is_active'        => true,
        ]);

        return redirect()->route('comprobantes.index')
            ->with('success', '¡Comprobante generado correctamente!');
    }

    /**
     * Normaliza el método de pago: solo conserva el nombre del método,
     * eliminando cualquier número (para no guardar datos de tarjetas).
     */
    private function normalizarMetodoPago(string $raw): string
    {
        if (empty($raw)) {
            return 'No especificado';
        }

        $lower = strtolower(trim($raw));

        if (str_contains($lower, 'yape'))          return 'Yape';
        if (str_contains($lower, 'plin'))          return 'Plin';
        if (str_contains($lower, 'tarjeta'))       return 'Tarjeta';
        if (str_contains($lower, 'visa'))          return 'Tarjeta';
        if (str_contains($lower, 'mastercard'))    return 'Tarjeta';
        if (str_contains($lower, 'efectivo'))      return 'Efectivo';
        if (str_contains($lower, 'transferencia')) return 'Transferencia Bancaria';
        if (str_contains($lower, 'bcp'))           return 'Transferencia Bancaria';
        if (str_contains($lower, 'interbank'))     return 'Transferencia Bancaria';
        if (str_contains($lower, 'bbva'))          return 'Transferencia Bancaria';

        // Si no coincide con ningún patrón conocido, quita dígitos y devuelve el texto limpio
        return trim(preg_replace('/\d+/', '', $raw)) ?: 'No especificado';
    }
}
