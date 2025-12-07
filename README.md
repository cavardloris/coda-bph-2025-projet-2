# The League - Projet PHP

## Description du Projet

Ce projet est une application web développée en PHP pour la gestion et la visualisation des données d'une ligue sportive (joueurs, équipes, matchs et performances individuelles).

***

## Auteurs du Projet

Ce projet a été réalisé par :
* **Loris**
* **Noa**
* **Arthur**

***

## Configuration de la Base de Données

Pour que l'application fonctionne correctement, vous devez configurer la connexion à votre base de données locale.

1.  **Importation des données :** Importez les fichiers SQL de la structure et des données (disponibles dans `db-league.zip/db/`) dans votre serveur MySQL ou MariaDB.
2.  **Configuration de la connexion :** Les paramètres de connexion actuels sont définis dans le fichier `managers/AbstractManager.php`. Vous devez modifier ces valeurs pour qu'elles correspondent à votre environnement local (votre hôte, nom de base de données, utilisateur et mot de passe).

**Extrait de `managers/AbstractManager.php` à vérifier :**

```php
    public function __construct()
    {
        $host = "localhost"; // À MODIFIER SI NÉCESSAIRE
        $port = "3306"; // À MODIFIER SI NÉCESSAIRE
        $dbname = "projet-the-league"; // À MODIFIER (NOM DE VOTRE DB)
        $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

        $user = "root"; // À MODIFIER (VOTRE UTILISATEUR)
        $password = "demopma"; // À MODIFIER (VOTRE MOT DE PASSE)

        $this->db = new PDO(
            $connexionString,
            $user,
            $password
        );
    }
