<?php

class PlayerManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT players.*, media.url, media.alt, teams.name FROM players JOIN media ON players.portrait = media.id JOIN teams ON players.team = teams.id');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $query = $this->db->prepare('
        SELECT players.*, media.url, media.alt, teams.name AS team_name FROM players JOIN media ON players.portrait = media.id 
        JOIN teams ON players.team = teams.id WHERE players.id = $id');

        $query->execute([':id' => $id]);
        $player = $query->fetch(PDO::FETCH_ASSOC);
        return $player ?: null;
    }
}