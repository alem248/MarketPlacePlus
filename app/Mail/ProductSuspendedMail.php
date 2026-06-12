<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductSuspendedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product;

    // Recibimos el producto aquí
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Aviso importante: Tu producto ha sido suspendido',
        );
    }

    public function content(): Content
    {
        return new Content(
            // Asegúrate que esta ruta coincida exactamente con tu archivo .blade.php
            view: 'emails.product_suspended', 
        );
    }
}