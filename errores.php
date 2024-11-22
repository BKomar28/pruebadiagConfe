<?php

$json_data = file_get_contents('pedidos.json');


$pedidos = json_decode($json_data, true);


$pedidos_con_errores = [];


foreach ($pedidos as $pedido) {
    if ($pedido['estado'] == 'pendiente') {
       
        $pedidos_con_errores[] = $pedido['id_pedido'];
    }
}


$csv_filename = 'pedidos_con_errores.csv';
$csv_file = fopen($csv_filename, 'w');


fputcsv($csv_file, ['id_pedido']);


foreach ($pedidos_con_errores as $id_pedido) {
    fputcsv($csv_file, [$id_pedido]);
}


fclose($csv_file);

echo "El archivo CSV ha sido generado: $csv_filename";
?>