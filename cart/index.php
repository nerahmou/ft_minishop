<?php

session_start();

require_once '../src/function.php';

if (isset($_POST, $_POST['delete']))
    drop_article($_POST['delete']);

?>
<h2>Mon panier :</h2>
<?php
if (!empty($_SESSION['cart'])) {
    ?>
    <table style="border: burlywood 3px solid; border-collapse: collapse">
        <tr style="border: burlywood 3px solid;">
            <th>Nom</th>
            <th>Quantité</th>
            <th>Couleur</th>
            <th>Image</th>
            <th></th>
        </tr>
        <?php
        foreach ($_SESSION['cart'] as $line) {
            ?>
            <tr>
                <td style="border: burlywood 3px solid"><?php echo articles_from_id($line['id'])['name'] ?></td>
                <td style="border: burlywood 3px solid"><?php echo $line['quantity'] ?></td>
                <td style="border: burlywood 3px solid"><?php if (empty($line['color'])) echo "Pas de couleur"; else echo $line['color']; ?></td>
                <td style="border: burlywood 3px solid"><img style="width: 50px" src="<?php echo articles_from_id($line['id'])['img']?>"></td>
                <td style="border: burlywood 3px solid">
                    <form method="post">
                        <button name="delete" value="<?php echo $line['id'] ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
}
else
{?><p>Le panier est vide</p><?php ;}?>
