<?php

$pedidos = json_decode(file_get_contents('pedidos.json'), true);


$errores = [];


foreach ($pedidos as $pedido) {
   
    $suma_items = 0;
    foreach ($pedido['items'] as $item) {
        $suma_items += $item['cantidad'] * $item['precio_unitario'];
    }

  
    if ($suma_items !== $pedido['monto']) {
    
        $errores[] = $pedido['id_pedido'];
    }
}


if (!empty($errores)) {
    file_put_contents('errores.txt', "Pedidos con error (ID de pedido): " . implode(", ", $errores));
    echo "Se han encontrado errores y se han registrado en 'errores.txt'.";
} else {
    echo "Todos los pedidos están correctos.";
}
?>