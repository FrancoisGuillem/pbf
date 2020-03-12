# WordPress x Paris Beer Festival

Ce projet contient un plugin WordPress pour le site du Paris Beer Festival et le thème correspondant.

## Que fait le plugin ?
Il définit deux types de contenus personnalisés :
-  Les **participants** : en plus du titre et du texte de présentation, ils possèdent une adresse et des liens réseaux sociaux.
- Les évènements (**event**) : en plus de leur titre et leur description, ils ont une liste de participants, un horaire et éventuellement une adresse si l'évènement a lieu ailleurs que chez l'organisateur principal.

## Et le Thème?
Le thème est basé sur un thème Boostrap basique avec les modifications suivantes:
- Une page spéciale pour la liste des évènements. Elle contient un filtre qui permet de n'afficher que les évènements d'un jour donné. (`archive-participant.php`)
- Une page spéciale pour la liste des participants. Elle les trie par catégorie. (`archive-event.php`)
- Une page participant qui affiche en plus des informations du participant les évènements qu'il organise. (`single-participant.php`)

Les fonctions php personnalisées utilisées dans ces fichiers sont définies dans le fichier `inc/pbf_functions.php`. Le css personnalisé se trouve soit directement dans les fichiers ci-dessus, soit à la fin du fichier `style.css`.

## Tester en local
Le plus simple pour tester en local le plugin et le thème est d'utiliser `docker-compose`. Cela permet de configurer en 10 secondes une base de données, un serveur web et WordPress de façon compartimentée. Aucun risque de casser quelque chose sur votre ordinateur ! Si vous ne l'avez pas déjà fait, installez d'abord docker.

Il vous faudra configurer les variables d'environnement suivantes:

| Nom de variables | Valeur |
|-|-|
|MYSQL_ROOT_PASSWORD| mot de passe MySQL maitre |
|WORDPRESS_DB_USER| utilisateur base de données |
|WORDPRESS_DB_PASSWORD| mot de passe de l'utilisateur |
GMAP_API_KEY| Clée permettant d'utiliser l'API de Google Maps. [Vous pouvez en obtenir une ici](https://developers.google.com/maps/documentation/embed/get-api-key) |

Vous pouvez rentrer n'importe quoi pour les trois premières variables. Par contre, la dernière doit être configurée correctement si vous voulez tester le géocodage des adresses et l'affichage des cartes (mais ce n'est pas obligatoire).

#### Sur Windows

Vous pouvez utiliser le menu "Modifier les variables d'environnement" (Pour le trouver facilement, cherchez "variable" dans le champ de recherche de la barre de tache). Vous devrez ensuite redémarrer.

#### Sur Mac et Linux
Pour les enregistrer une bonne fois pour toutes, vous pouvez modifier le fichier "~/.bashrc" et rajouter les lignes

```bash
export MYSQL_ROOT_PASSWORD=motdepasseroot
export WORDPRESS_DB_USER=monutilisateur
export WORDPRESS_DB_PASSWORD=motdepasse
export GMAP_API_KEY=XXXXXXXX
```

Pour prendre en compte les modifications sans redémarrer, vous pouvez lancer dans un terminal la commande suivante:
```bash
source ~/.bashrc
```

Une fois les variables d'environnement définies, clonez ce dépot puis dans un terminal mettez vous dans le dossier du projet puis lancez la commande :
```bash
docker-compose up -d
```

Maintenant dans un navigateur, ouvrez la page `http://localhost:8000` pour procéder à l'installation de Wordpress en local. Dans la page des extensions, activez tous les plugins disponibles, puis dans les thèmes activez le thème "pbf".

## Développer en local
Pour développer en local vous avez besoin de nodejs en version supérieure ou égale à 10 ainsi que `gulp-cli` installé en global (`npm i gulp-cli -g`).

Un fois nodejs et gulp-cli d'installé, mettez-vous dans le dossier du projet et lancez la commande suivante pour installer les dépendances :

```bash
npm install
```

Pour commencer à travailler, toujours dans le répertoire du projet, lancer la commande :

```bash
npm run dev
```

Cela lancera la compilation des assets puis un watcher pour recompiler les fichiers `.scss` ainsi qu'un serveur à l'adresse `http://localhost:3000` avec live reload à chaque modification des fichiers `.scss` et `.php`