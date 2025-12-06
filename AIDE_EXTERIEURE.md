public function getTeamRoster(int $teamId): array
{
    $query = $this->db->prepare('
        SELECT 
            -- Infos Joueur
            p.nickname, 
            p.firstName, 
            
            -- Infos Portrait (pm = Player Media)
            pm.url AS portrait_url, 
            pm.alt AS portrait_alt, 
            
            -- Infos Équipe
            t.name AS team_name,
            
            -- Infos Logo de l\'Équipe (tm = Team Media)
            tm.url AS logo_url 
            
        FROM players p 
        
        -- Jointure 1: Photo du joueur
        JOIN media pm ON p.portrait = pm.id 
        
        -- Jointure 2: Nom de l\'équipe
        JOIN teams t ON p.team = t.id 
        
        -- Jointure 3: URL du Logo de l\'équipe (Nécessite la jointure du logo dans teams à media)
        JOIN media tm ON t.logo = tm.id 
        
        WHERE p.team = :teamId
        LIMIT 3 -- On limite à 3 joueurs pour correspondre à la maquette
    ');
    
    $query->execute([':teamId' => $teamId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
} Code suggéré par Gemini pour obtenir plus simplement les infos pour les equipes (pas de prompt donné)