<?php

session_start();
require_once '../../src/function.php';

html_header('Administration');
?>
<li><a href="../">Retour</a></li>
<h4>Commandes</h4>
<table style="width:75%">
    <tr>
        <th>Id</th>
        <th>Client</th>
        <th>Total</th>
        <th>Action</th>
    </tr>

    <?php foreach (orders() as $val) { ?>
        <tr>
            <td><?php echo order_id($val) ?></td>
            <td><?php echo order_shopper($val) ?></td>
            <td><?php echo number_format($val['total'], 2, ".", " ") . " " . config()['currency']?></td>
            <td>

            </td>
            <td>
                <a href="/admin/delete/article.php?id=<?php echo article_id($val) ?>">Valider</a> |
                <a href="/admin/delete/article.php?id=<?php echo article_id($val) ?>">Detail commande</a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>

