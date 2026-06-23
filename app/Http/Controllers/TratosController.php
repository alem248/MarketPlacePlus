<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Trato;
use App\Models\TratoMessage;
use Illuminate\Http\Request;

class TratosController extends Controller
{
    // Vista de seguimiento de un trato individual (comprador)
    public function show(Trato $trato)
    {
        abort_if($trato->buyer_id !== auth()->id(), 403);

        $trato->load(['product', 'seller', 'messages.sender']);

        return view('tratos.show', compact('trato'));
    }

    // Lista de tratos del comprador
    public function index()
    {
        $tratos = Trato::where('buyer_id', auth()->id())
            ->with(['product', 'seller'])
            ->latest()
            ->paginate(10);

        return view('tratos.index', compact('tratos'));
    }

    // Vista de detalle de un trato específico para el VENDEDOR
    public function sellerShow(Trato $trato)
    {
        abort_if($trato->seller_id !== auth()->id(), 403);

        $trato->load(['product', 'buyer', 'messages.sender']);

        return view('seller.tratos.show', compact('trato'));
    }

    // Vista "Mis Tratos Directos" del VENDEDOR
    public function sellerIndex(Request $request)
    {
        $status = $request->input('status'); // null = todos

        $query = Trato::where('seller_id', auth()->id())
            ->with(['product', 'buyer'])
            ->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $tratos = $query->paginate(10)->withQueryString();

        // Conteos por estado, siempre sobre todos los tratos (no el filtro actual)
        $counts = Trato::where('seller_id', auth()->id())
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('seller.tratos.index', compact('tratos', 'counts'));
    }

    // Crear un trato desde la página de producto (comprador)
    public function store(Product $product, Request $request)
    {
        abort_if($product->user_id === auth()->id(), 403, 'No puedes iniciar un trato contigo mismo.');

        $existing = Trato::where('buyer_id', auth()->id())
            ->where('product_id', $product->id)
            ->whereNotIn('status', ['cancelado'])
            ->first();

        if ($existing) {
            return redirect()->route('tratos.show', $existing)
                ->with('info', 'Ya tienes un trato activo para este producto.');
        }

        $trato = Trato::create([
            'buyer_id'   => auth()->id(),
            'seller_id'  => $product->user_id,
            'product_id' => $product->id,
            'price'      => $product->price,
            'status'     => 'pedido_realizado',
        ]);

        $message = $request->input('message');
        if ($message) {
            TratoMessage::create([
                'trato_id'  => $trato->id,
                'sender_id' => auth()->id(),
                'body'      => $message,
            ]);
        }

        return redirect()->route('tratos.show', $trato)
            ->with('success', '¡Trato iniciado! El vendedor recibirá tu mensaje.');
    }

    // Vendedor acepta el trato → status: aprobado
    public function accept(Trato $trato)
    {
        abort_if($trato->seller_id !== auth()->id(), 403);
        abort_if(in_array($trato->status, ['recibido', 'cancelado']), 403);

        $trato->update(['status' => 'aprobado']);

        TratoMessage::create([
            'trato_id'  => $trato->id,
            'sender_id' => auth()->id(),
            'body'      => '✅ He aceptado la oferta. ¡Seguimos con el trato!',
        ]);

        return redirect()->route('seller.tratos.show', $trato)
            ->with('success', '¡Oferta aceptada! El trato está aprobado.');
    }

    // Vendedor rechaza el trato → status: cancelado
    public function reject(Trato $trato)
    {
        abort_if($trato->seller_id !== auth()->id(), 403);
        abort_if(in_array($trato->status, ['recibido', 'cancelado']), 403);

        $trato->cancel();

        TratoMessage::create([
            'trato_id'  => $trato->id,
            'sender_id' => auth()->id(),
            'body'      => '❌ He rechazado la oferta. El trato ha sido cancelado.',
        ]);

        return redirect()->route('seller.tratos.index')
            ->with('info', 'Trato rechazado.');
    }

    // Cancelar trato (comprador o vendedor)
    public function cancel(Trato $trato)
    {
        $isParticipant = $trato->buyer_id === auth()->id() || $trato->seller_id === auth()->id();
        abort_if(!$isParticipant, 403);
        abort_if(in_array($trato->status, ['recibido', 'cancelado']), 403);

        $trato->cancel();

        if ($trato->buyer_id === auth()->id()) {
            return redirect()->route('tratos.index')->with('info', 'Trato cancelado.');
        }
        return redirect()->route('seller.tratos.index')->with('info', 'Trato cancelado.');
    }

    // Vendedor confirma que entregó el producto
    public function sellerConfirm(Trato $trato)
    {
        abort_if($trato->seller_id !== auth()->id(), 403);
        abort_if($trato->status !== 'aprobado', 403);

        $trato->update(['seller_confirmed' => true]);

        if ($trato->buyer_confirmed) {
            $trato->update(['status' => 'recibido']);
        }

        return redirect()->route('seller.tratos.show', $trato)
            ->with('success', 'Confirmaste la entrega del producto.');
    }

    // Vendedor deshace su confirmación (solo si el comprador aún no confirmó)
    public function sellerUnconfirm(Trato $trato)
    {
        abort_if($trato->seller_id !== auth()->id(), 403);
        abort_if($trato->status !== 'aprobado', 403);
        abort_if(!$trato->seller_confirmed, 403);
        abort_if($trato->buyer_confirmed, 403); // ya no se puede deshacer si el otro confirmó

        $trato->update(['seller_confirmed' => false]);

        return redirect()->route('seller.tratos.show', $trato)
            ->with('info', 'Confirmación deshecha.');
    }

    // Comprador confirma que recibió el producto
    public function buyerConfirm(Trato $trato)
    {
        abort_if($trato->buyer_id !== auth()->id(), 403);
        abort_if($trato->status !== 'aprobado', 403);

        $trato->update(['buyer_confirmed' => true]);

        if ($trato->seller_confirmed) {
            $trato->update(['status' => 'recibido']);
        }

        return redirect()->route('tratos.show', $trato)
            ->with('success', 'Confirmaste que recibiste el producto.');
    }

    // Comprador deshace su confirmación (solo si el vendedor aún no confirmó)
    public function buyerUnconfirm(Trato $trato)
    {
        abort_if($trato->buyer_id !== auth()->id(), 403);
        abort_if($trato->status !== 'aprobado', 403);
        abort_if(!$trato->buyer_confirmed, 403);
        abort_if($trato->seller_confirmed, 403); // ya no se puede deshacer si el otro confirmó

        $trato->update(['buyer_confirmed' => false]);

        return redirect()->route('tratos.show', $trato)
            ->with('info', 'Confirmación deshecha.');
    }

    // Guardar método de pago (comprador)
    public function updatePayment(Trato $trato, Request $request)
    {
        abort_if($trato->buyer_id !== auth()->id(), 403);

        $request->validate(['payment_method' => 'required|string|max:100']);

        $trato->update(['payment_method' => $request->payment_method]);

        return redirect()->route('tratos.show', $trato)
            ->with('success', 'Método de pago guardado.');
    }

    // Enviar mensaje de chat (comprador o vendedor)
    public function sendMessage(Trato $trato, Request $request)
    {
        $isParticipant = $trato->buyer_id === auth()->id() || $trato->seller_id === auth()->id();
        abort_if(!$isParticipant, 403);
        abort_if($trato->status === 'cancelado', 403, 'No puedes enviar mensajes en un trato cancelado.');

        $request->validate(['body' => 'required|string|max:500']);

        TratoMessage::create([
            'trato_id'  => $trato->id,
            'sender_id' => auth()->id(),
            'body'      => $request->body,
        ]);

        // Cuando el vendedor responde por primera vez, avanza a "en_discusion"
        if ($trato->seller_id === auth()->id() && $trato->status === 'pedido_realizado') {
            $trato->update(['status' => 'en_discusion']);
        }

        if ($trato->seller_id === auth()->id()) {
            return redirect()->route('seller.tratos.show', $trato);
        }
        return redirect()->route('tratos.show', $trato);
    }
}
