<?php

class PlayerManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT players.*, media.url, media.alt, teams.name FROM players JOIN media ON players.portrait = media.id JOIN teams ON players.team = teams.id ORDER BY players.id ASC');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $query = $this->db->prepare('
        SELECT players.*, media.url, media.alt, teams.name AS team_name FROM players JOIN media ON players.portrait = media.id JOIN teams ON players.team = teams.id WHERE players.id = :id');

        $query->execute([':id' => $id]);
        $player = $query->fetch(PDO::FETCH_ASSOC);
        return $player ?: null;
    }
    public function getByTeamName(string $teamName): array{
        $query = $this->db->prepare('
            SELECT players.*, media.url, media.alt, teams.name AS team_name 
            FROM players 
            JOIN media ON players.portrait = media.id 
            JOIN teams ON players.team = teams.id 
            WHERE teams.name = :teamName
        ');

        $query->execute(['teamName' => $teamName]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findRandom(int $limit): array
    {
        $query = $this->db->prepare('
            SELECT players.*, media.url, media.alt, teams.name AS team_name 
            FROM players 
            JOIN media ON players.portrait = media.id 
            JOIN teams ON players.team = teams.id 
            ORDER BY RAND() 
            LIMIT :limit
        ');

        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    //Fonction pour la partie équipe, récupère suicant l'id de l'équipe
    public function getByTeamId(int $teamId): array
    {
        $query = $this->db->prepare('
            SELECT players.*, media.url, media.alt 
            FROM players 
            JOIN media ON players.portrait = media.id 
            WHERE players.team = :teamId
        ');
        $query->execute(['teamId' => $teamId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
