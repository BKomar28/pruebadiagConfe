<?php
// Cargar el archivo JSON
$pedidos = json_decode(file_get_contents('pedidos.json'), true);

// Filtrar los pedidos con estado "pendiente"
$pendientes = array_filter($pedidos, function($pedido) {
    return $pedido['estado'] === 'pendiente';
});

// Mostrar los pedidos pendientes
foreach ($pendientes as $pedido) {
    echo "Pedido ID: " . $pedido['id_pedido'] . "<br>";
    echo "Cliente: " . $pedido['cliente'] . "<br>";
    echo "Fecha: " . $pedido['fecha'] . "<br>";
    echo "Monto: " . $pedido['monto'] . "<br>";
    echo "Items:<br>";
    foreach ($pedido['items'] as $item) {
        echo "- " . $item['producto'] . " (Cantidad: " . $item['cantidad'] . ", Precio unitario: " . $item['precio_unitario'] . ")<br>";
    }
    echo "<br>";
}
?>