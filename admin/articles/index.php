<?php

session_start();

require_once '../../src/function.php';

need_install();

if (!user_is_admin()) header('Location: /');

include '../../public/navbar_admin_p.php';
html_header('Administration');
?>

<h4>Articles</h4>
<table style="width:75%">
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Image</th>
        <th>Prix</th>
        <th>Stock</th>
        <th>Catégories</th>
        <th>Action</th>
    </tr>

    <?php foreach (articles() as $val) { ?>
        <tr>
            <td><?php echo article_id($val) ?></td>
            <td><?php echo article_name($val) ?></td>
            <td><?php echo article_description($val) ?></td>
            <td><img src="<?php echo article_img($val) ?>" height="50" alt=""></td>
            <td><?php echo article_price($val) ?></td>
            <td><?php echo article_stock($val) ?></td>
            <td><?php echo implode(', ', article_categories($val)) ?></td>
            <td>
                <a href="/admin/delete/article.php?id=<?php echo article_id($val) ?>">Supprimer</a>
                <a href="/admin/edit/article.php?id=<?php echo article_id($val) ?>">Editer</a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>

<h4>Catégories</h4>
<table style=width:15%>
    <tr>
        <th >Nom</th>
        <th width="25%">Action</th>
    </tr>

    <?php foreach (categories() as $val) { ?>
        <tr>
            <td><?php echo $val ?></td>
            <td><a href="/admin/delete/category.php?name=<?php echo $val ?>">Supprimer</a></td>
        </tr>
    <?php } ?>
</table>
