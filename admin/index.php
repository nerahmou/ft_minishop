<?php

session_start();
require_once '../src/function.php';
need_install();
if (!user_is_admin()) header('Location: /');


include '../public/navbar_admin.php';
html_header('Administration');

?>

<h4>Utilisateurs</h4>
<table style="width:75%">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach (users() as $val) { ?>
        <tr>
            <td><?php echo $val['lastname'] ?></td>
            <td><?php echo $val['firstname'] ?></td>
            <td><?php echo $val['email'] ?></td>
            <td><?php if ($val['rank']) echo "Administrateur"; else echo "Client"; ?></td>
            <td>
                <a href="/admin/delete/user.php?email=<?php echo $val['email'] ?>">Supprimer</a>
                <a href="/admin/edit/user.php?email=<?php echo $val['email'] ?>">Editer</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php html_footer() ?>
