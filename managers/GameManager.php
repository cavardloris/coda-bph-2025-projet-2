<?php

class GameManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('
            SELECT games.*, 
                t1.name AS t1_name, m1.url AS t1_photo, m1.alt AS t1_alt,
                t2.name AS t2_name, m2.url AS t2_photo, m2.alt AS t2_alt
            FROM games
            JOIN teams t1 ON games.team_1 = t1.id
            JOIN media m1 ON t1.logo = m1.id
            JOIN teams t2 ON games.team_2 = t2.id
            JOIN media m2 ON t2.logo = m2.id
            ORDER BY games.date DESC
        ');
        
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById(int $id): ?array
    {
        $query = $this->db->prepare('
            SELECT games.*, 
                t1.name AS t1_name, m1.url AS t1_photo, m1.alt AS t1_alt,
                t2.name AS t2_name, m2.url AS t2_photo, m2.alt AS t2_alt
            FROM games
            JOIN teams t1 ON games.team_1 = t1.id
            JOIN media m1 ON t1.logo = m1.id
            JOIN teams t2 ON games.team_2 = t2.id
            JOIN media m2 ON t2.logo = m2.id
            WHERE games.id = :id
        ');

        $query->execute(['id' => $id]);
        $game = $query->fetch(PDO::FETCH_ASSOC);
        
        return $game ?: null;
    }
}