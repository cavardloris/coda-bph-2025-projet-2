<?php

class PlayerPerformanceManager extends AbstractManager
{
    public function findByPlayerId(int $playerId): array
    {
        $query = $this->db->prepare('
            SELECT player_performance.*, games.date, games.winner, games.team_1, games.team_2, teams_1.name AS t1_name, teams_2.name AS t2_name FROM player_performance JOIN games ON player_performance.game = games.id JOIN teams AS teams_1 ON games.team_1 = teams_1.id JOIN teams AS teams_2 ON games.team_2 = teams_2.id WHERE player_performance.player = :playerId ORDER BY games.date DESC
        ');
        
        $query->execute(['playerId' => $playerId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    //pou la partie stats des matchs avoir toutes les infos nécessaires
    public function findByGameId(int $gameId): array
    {
        $query = $this->db->prepare('
            SELECT player_performance.*, players.nickname, teams.name AS team_name
            FROM player_performance
            JOIN players ON player_performance.player = players.id
            JOIN teams ON players.team = teams.id
            WHERE player_performance.game = :gameId
            ORDER BY teams.name, players.nickname
        ');
        
        $query->execute([':gameId' => $gameId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}