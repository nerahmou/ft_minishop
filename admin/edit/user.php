<?php

session_start();
require_once '../../src/function.php';
need_install();
if (!user_is_admin()) header('Location: /');

//EMAIL INCORRECT
if ($_GET && isset($_GET['email']))
    if (!users_from_email($_GET['email'])) header('Location: /admin/');

//--------------------------------------------------------------
//
// POST user edition
//
//--------------------------------------------------------------
if ($_POST && $_GET && isset($_GET['email'])) {
    $user_o = users_from_email($_GET['email']);
    $msg = '';
    if (!is_string($msg = user_is_valid_edit($_GET['email'])) && $msg) {
        $user = user_from_post_edit($user_o);
        users_insert($user);
        set_success_message('Vous avez édité l\'utilisateur ' . ucfirst($user['firstname']) . ' ' . ucfirst($user['lastname']) . '.');
    } else set_error_message($msg);
}

include '../../public/navbar_admin_p.php';
html_header("Edition de l'utilisateur " . ucfirst(users_from_email($_GET['email'])['firstname']) . ' ' . ucfirst(users_from_email($_GET['email'])['lastname']));
html_message();

?>

    <form method="post">
        <label for="lastname">Nom</label><br>
        <input type="text" name="lastname" value="<?php echo users_from_email($_GET['email'])['lastname'] ?>">
        <br>
        <label for="firstname">Prénom</label><br>
        <input type="text" name="firstname" value="<?php echo users_from_email($_GET['email'])['firstname'] ?>">
        <br>
        <label for="email">Email</label><br>
        <input type="email" name="email" value="<?php echo users_from_email($_GET['email'])['email'] ?>">
        <br>
        <label for="email">Rang</label><br>
        <input type="number" name="rank" min="0" max="1" value="<?php echo users_from_email($_GET['email'])['rank'] ?>">
        <br>
        <input type="submit" value="Valider">
    </form>

<?php

html_footer();



