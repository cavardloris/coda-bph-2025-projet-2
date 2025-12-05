<?php

class PlayerManager extends AbstractManager
{
public function findAll() : array
{
    $query = $this->db->prepare('SELECT players.*, media.url, media.alt, teams.name FROM players JOIN media ON players.portrait = media.id JOIN teams ON players.team = teams.id');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
}

récupère moi toutes les infos, la photo avec le lien avec media, portrait dans players est l'id de media, faut aussi récupérer, le nom, et aussi le nom de la teams en faisaint un join. n'utilise pas les allias et ne mets pas de commentaire