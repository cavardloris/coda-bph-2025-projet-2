<?php

class TeamManager extends AbstractManager
{
    // Récupère toutes les équipes avec leur logo
    public function findAll(): array
    {
        $query = $this->db->prepare('
            SELECT teams.*, media.url, media.alt FROM teams JOIN media ON teams.logo = media.id ORDER BY teams.name ASC
        ');
        
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById(int $id): ?array
    {
        $query = $this->db->prepare('SELECT * FROM teams WHERE id = :id');
        $query->execute(['id' => $id]);
        $team = $query->fetch(PDO::FETCH_ASSOC);
        
        return $team ?: null;
    }
}