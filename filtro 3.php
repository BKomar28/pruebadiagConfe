<?php

$pedidos = json_decode(file_get_contents('pedidos.json'), true);


$pendientes = array_filter($pedidos, function($pedido) {
    return $pedido['estado'] === 'pendiente';
});


$total_monto = 0;
$total_productos = 0;

$csv_data = [];


$csv_data[] = ['id_pedido', 'cliente', 'fecha', 'monto', 'total_productos'];


foreach ($pendientes as $pedido) {
    $total_items = 0;


    foreach ($pedido['items'] as $item) {
        $total_items += $item['cantidad'];
    }


    $csv_data[] = [
        $pedido['id_pedido'],
        $pedido['cliente'],
        $pedido['fecha'],
        $pedido['monto'],
        $total_items
    ];


    $total_monto += $pedido['monto'];
    $total_productos += $total_items;
}


$csv_data[] = ['Total', '', '', $total_monto, $total_productos];


$filename = 'pedidos_pendientes.csv';
$fp = fopen($filename, 'w');


foreach ($csv_data as $row) {
    fputcsv($fp, $row);
}


fclose($fp);

echo "Archivo CSV generado con éxito: $filename";
?>
