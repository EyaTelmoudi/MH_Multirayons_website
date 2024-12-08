<h2>Mes commandes</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Total</th>
        <th>Statut</th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= $order['order_date'] ?></td>
            <td><?= $order['total_price'] ?> €</td>
            <td><?= $order['status'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
