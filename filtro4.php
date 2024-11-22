<?php

$pedidos = json_decode(file_get_contents('pedidos.json'), true);


$completados = array_filter($pedidos, function($pedido) {
    return $pedido['estado'] === 'completado';
});


$monto_por_cliente = [];


foreach ($completados as $pedido) {
    $cliente = $pedido['cliente'];
    $monto = $pedido['monto'];


    if (isset($monto_por_cliente[$cliente])) {
        $monto_por_cliente[$cliente] += $monto;
    } else {

        $monto_por_cliente[$cliente] = $monto;
    }
}


$cliente_max_monto = array_keys($monto_por_cliente, max($monto_por_cliente))[0];


$cliente_info = null;
foreach ($completados as $pedido) {
    if ($pedido['cliente'] === $cliente_max_monto) {
        $cliente_info = [
            'cliente' => $pedido['cliente'],
            'monto_total' => $monto_por_cliente[$cliente_max_monto],
            'pedidos' => array_filter($completados, function($p) use ($cliente_max_monto) {
                return $p['cliente'] === $cliente_max_monto;
            })
        ];
        break;
    }
}


$filename = 'max_cliente.json';
file_put_contents($filename, json_encode($cliente_info, JSON_PRETTY_PRINT));

echo "Archivo JSON generado con éxito: $filename";
?>