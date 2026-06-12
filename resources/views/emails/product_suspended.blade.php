<!DOCTYPE html>
<html>
<body>
    <h2>Aviso de suspensión de producto</h2>
    <p>Hola, <strong>{{ $product->user->name }}</strong>.</p>
    
    <p>Lamentamos informarte que tu producto <strong>{{ $product->title }}</strong> ha sido suspendido por un administrador.</p>
    
    <div style="background-color: #f8d7da; padding: 15px; border-radius: 5px; border: 1px solid #f5c6cb;">
        <p><strong>Motivo de la suspensión:</strong></p>
        <p>{{ $product->suspension_reason }}</p>
    </div>

    <p>Puedes revisar los detalles entrando a tu panel de vendedor.</p>
    <p>Atentamente,<br>El equipo de soporte.</p>
</body>
</html>