import json

# Load the JSON data
with open('/mnt/data/pedidos.json') as f:
    pedidos = json.load(f)

# Filter the orders with status "pendiente"
pendientes = [pedido for pedido in pedidos if pedido['estado'] == 'pendiente']

# Display the filtered orders
print(pendientes)