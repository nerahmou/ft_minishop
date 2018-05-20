<?php

session_start();
require_once 'src/services/users_service.php';
require_once 'src/function.php';
need_install();

$can_disp_msg = true;

function get_articles() {
    $articles =  (($_GET && isset($_GET['category']) && categories_from_name($_GET['category'])))
        ? articles_from_category(categories_from_name($_GET['category']))
        : articles();
    return array_filter($articles, function ($e) {
        if ($_GET && isset($_GET['search']) && !empty($_GET['search'])) {
            return  strpos(strtolower(article_name($e)), strtolower($_GET['search'])) !== false ||
                strpos(strtolower(article_description($e)), strtolower($_GET['search'])) !== false;
        }
        return true;
    });
}

function get_category() {
    if ($_GET && isset($_GET['category']) && categories_from_name($_GET['category']))
        return $_GET['category'];
    return null;
}


//--------------------------------------------------------------
//
// POST add to cart then location to the / page
//
//--------------------------------------------------------------
if (isset($_POST, $_POST['id'])) {
    if (!insert_article(articles_from_id($_POST['id']), $_POST['quantity'])) {
        set_error_message("Quantité superieur au stock disponible : (" . articles_from_id($_POST['id'])['stock'] . ")");
        $can_disp_msg = false;
        header('location: /?' . $_SERVER['QUERY_STRING']);
    } else header('location: /?' . $_SERVER['QUERY_STRING']);
}


include 'public/navbar.php';
html_header(config()['name']);

?>

<h3>Liste des articles : </h3>

<?php if ($can_disp_msg) html_message(); ?>

<h5>Filtrer par:&#160;&#160;&#160;
    <form method="get" style="display: inline">
        <select name="category">
            <option value="all">Toutes</option>
            <?php foreach (categories() as $cat) { ?>
                <option <?php echo $cat === get_category() ? 'selected' : '' ?> value="<?php echo $cat ?>"><?php echo ucfirst($cat) ?></option>
            <?php } ?>
        </select>&#160;&#160;&#160;
        <label for="search">Rechercher: </label>
        <input type="text" name="search" placeholder="Rechercher un mot" value="<?php echo !empty($_GET['search']) ? $_GET['search'] : '' ?>">
        &#160;&#160;&#160;
        <input type="submit" value="Go!">
    </form>
</h5>

<section id="page">
    <?php foreach (get_articles() as $key => $elem) { ?>
    <div class="item">
        <div class="item-container">
            <div class="image-container" style="background-image: url(<?php echo $elem['img'] ?>)"></div>
            <div class="text-container">
                <h2><?php echo $elem['name']; ?></h2>
                <h5>Catégorie(s) : <?php echo implode(', ', article_categories($elem));?></h5>
                <p><?php echo article_description_trunc($elem) ?></p>
                <form method="post" <?php if (!$elem['stock']) echo "style='background-color:red'"?> >
                    <button name="id" value="<?php echo article_id($elem)?>" type="submit" <?php if (!$elem['stock']) echo "disabled"?>><?php if (!$elem['stock']) echo "Produit épuisé";else echo "Ajouter au panier"; ?></button>
                    <input type="number" min="1" name="quantity" value="1">
                    <div class="icon"><img src="https://partage.draftman.fr/icon.svg" alt=""></div>
                </form>

            </div>
        </div>
    </div>
    <?php } ?>
</section>
<?php html_footer() ?>
