<?php

session_start();
require_once '../../src/function.php';

html_header('Administration');
if (!empty($_GET['id'])) {
    valid_order(orders_from_id($_GET['id']));
    $_GET['id']="";
}
?>
<li><a href="../">Retour</a></li>
<h4>Commandes</h4>
<table style="width:75%">
    <tr>
        <th>Id</th>
        <th>Client</th>
        <th>Total</th>
        <th>Date de commande</th>
        <th>Action</th>
    </tr>

    <?php foreach (orders() as $val) { ?>
        <tr>
            <td><?php echo order_id($val) ?></td>
            <td><?php echo order_shopper($val) ?></td>
            <td><?php echo number_format($val['total'], 2, ".", " ") . " " . config()['currency']?></td>
            <td><?php echo order_date($val) ?></td>
            <td>
                <?php if (!$val['is_validate']) { ?>
                 <a href="/admin/orders?id=<?php echo order_id($val) ?>">Valider</a>
                <?php } else echo "<a>Commande validé</a>" ?>
                | <a href="/admin/orders/order_details.php?id=<?php echo order_id($val) ?>">Detail commande</a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>

