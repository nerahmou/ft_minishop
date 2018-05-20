<?php

session_start();
require_once '../src/function.php';

need_install();
include '../public/navbar_cart.php';
html_header('Mon panier');
if (isset($_POST, $_POST['delete']))
    drop_article($_POST['delete']);
if (isset($_POST, $_POST['order'])) {
    order_insert(new_order(user_get_firstname(), $_SESSION['cart'], get_total()));
    set_success_message("Commande Validé !");
}

?>

<?php echo get_success_message() ?>

<?php if (!empty($_SESSION['cart'])) { ?>
    <table style="width: 75%;">
        <tr >
            <th>Nom</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Couleur</th>
            <th>Image</th>

            <th></th>
        </tr>
        <?php foreach ($_SESSION['cart'] as $line) { ?>
            <tr>
                <td ><?php echo articles_from_id($line['id'])['name'] ?></td>
                <td ><?php echo $line['quantity'] ?></td>
                <td ><?php echo number_format(articles_from_id($line['id'])['price'] , 0 , "." , " " ) . " " . config()['currency']?></td>
                <td ><?php if (!empty($line['color'])) echo $line['color']; ?></td>
                <td >
                    <img style="width: 50px" src="<?php echo articles_from_id($line['id'])['img']; ?>">
                </td >
                <td >
                    <form method="post">
                        <button name="delete" value="<?php echo $line['id'] ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="5">Total</td>
            <td ><?php echo number_format(get_total() , 0 , "." , " " ) . " " . config()['currency']?> </td>
        </tr>
    </table>
    <?php if (user_is_connected()) { ?>
        <form method="post" style="text-align: center; margin-top: 10px">
            <button type="submit" name="order">Valider la commande</button>
        </form>
    <?php }
    else
        echo "Vous devez vous connecter pour valider le panier";
} else {
    echo "<p>Le panier est vide</p>";
} ?>