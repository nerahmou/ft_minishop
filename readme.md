# FT_MINISHOP

## Partie utilisateurs

 - Doit pouvoir se créer
 - Doit pouvoir se supprimé

Model de l'objet: 
    
	 lastName: String (min 2 chars)
	 firstName: String (min 2 chars)
	 email: String (email, unique)
	 password: String (sha512)
	 rank: Int default 0 => 0 = user, 1 = admin
    

## Articles et catégories

Un article peut avoir plusieurs catégories et une catégorie peut avoir plusieurs articles.

### Article (son model)

    name: String (min 5 chars)
    description: String (min 10 chars)
    img: String (url)
    id: String (unique)
    price: Float (min 0)
    stock: Integer (min 0)
    categories: List<Category> default other
    color?: List<String> (optional)

### Catégorie

Une catégorie est simplement un nom, sera stocké sous forme d'une liste.
Si on supprime une catégorie automatiquement, les articles qui contiennent cette catégorie ne l'auront plus. Si ces articles n'ont plus de catégorie la catégorie passera à 'other'.

## Le pannier

 - Peut s'utiliser sans être connecté
 - L'utilisateur doit être connecté pour valider le panier
 - Doit afficher les articles, leurs prix et leur quantités

Model de l'objet pannier:

    articles:<ArticleWanted>

Model de l'objet ArticleWanted:

    article: Article
    quantity: Int

## Administration

 - Créer/Supprimer des articles
 - Créer/supprimer des catégories
 - Acheminer les commandes (baisser le stock de l'article du coup)
