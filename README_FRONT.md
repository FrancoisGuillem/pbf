# Contribuer au thème WordPress

Les fichiers du thème sont disponibles dans le dossier `wordpress/wp-content/themes/pbf`.

## Quels fichiers modifier et comment?
WordPress utilise des fichiers template PHP. Concrètement, ils contiennent du code HTML normal dans lequel se trouvent des balises `<?php ... ; ?>` ou `<?= ... ; ?>`. Elles contiennent du code PHP qui va générer du code HTML dynamiquement. Pour afficher une variable disponible en PHP, il faudra utiliser la syntaxe suivante :
```php
<?php echo $ma_variable; ?>
ou de manière plus succincte
<?= $ma_variable; ?>
```

Faites attention à bien mettre les point-virgules, sinon tout explose !

Voici les fichiers principaux à modifier :
* `header.php` : il contient la balise `<head>` et le header du site (navigation, logo). Il ouvre également les balises qui contiendront le contenu des pages. **Attention à ne pas les supprimer !**

* `footer.php` : il ferme les balises des éléments contenant le contenu principal (**à ne surtout pas supprimer**) et le footer du site.

* `archive-participant.php` : il contient le contenu principal de la page listant tous les participants. Dans ce fichier, il y a deux boucles PHP imbriquées : la première pour les catégories, la seconde pour les participants appartenant à la catégorie.

* `template-parts/content-participant-preview.php` : Ce template est utilisé dans les boucles du template précédent pour afficher chaque participant

* `template-parts/content-participant.php` : Contenu de la page qui présente un participant individuel.  

## Ajouter des assets
Les assets personnalisés peuvent être placés dans un des sous-dossiers de répertoire `inc/assets`. Ensuite, vous pouvez utiliser la fonction PHP `get_template_directory_uri()` pour récupérer l'URL des fichiers du thème et ajouter le chemin relatif de la ressource. Par exemple, pour afficher une image :

```php
<img src="<?php echo get_template_directory_uri(); ?>/inc/assets/img/MON_IMAGE.png">
```

## Traduire les éléments d'interface
Quand l'interface contient des mots qui doivent s'afficher différemment selon qu'on est sur la version française ou anglaise, vous pouvez utiliser la syntaxe suivante :
```php
<?php _e("[:fr]Texte en français[:en]Text in english[:]"); ?>
```
