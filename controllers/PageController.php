<?php

class PageController extends AbstractController
{
    public function home(): void
    {
        $playerManager = new PlayerManager();
        $gameManager = new GameManager();
        $angryOwlsPlayers = $playerManager->getByTeamName('Angry Owls');
        $featuredPlayers = $playerManager->findRandom(3);
        $games = $gameManager->findAll();
        $lastMatch = $games[0] ?? null;
        $this->render("home", ["angryOwlsPlayers" => $angryOwlsPlayers,
            "featuredPlayers" => $featuredPlayers,
            "lastMatch" => $lastMatch
        ]);
    }

    public function lesMatchs(): void
    {
        $manager = new GameManager();
        $games = $manager->findAll();

        $this->render("les-matchs", ["games" => $games]);
    }

    public function lesPlayers(): void
    {
        $manager = new PlayerManager();
        $players = $manager->findAll();
        $this->render("les-players", ["players" => $players]);
    }
    public function lesTeams(): void
    {
        $manager = new TeamManager();
        $teams = $manager->findAll();
        $this->render("les-teams", ["teams" => $teams]);
    }
    public function team(): void
    {

        $id = (int)$_GET['id'];

        $teamManager = new TeamManager();
        $playerManager = new PlayerManager();
        $team = $teamManager->getById($id);
        $players = $playerManager->getByTeamId($id);
        $this->render("team", [
            "team" => $team,
            "players" => $players
        ]);
    }

    public function player(): void
    {
        $id = (int)$_GET['id'];
        $playerManager = new PlayerManager();
        $perfManager = new PlayerPerformanceManager();
        $player = $playerManager->getById($id);
        $performances = $perfManager->findByPlayerId($id);
        $teammates = $playerManager->getByTeamId($player['team']);
        $this->render("player", [
            "player" => $player,
            "performances" => $performances,
            "teammates" => $teammates
        ]);
    }
    public function match(): void
    {
        $id = (int)$_GET['id'];

        $gameManager = new GameManager();
        $perfManager = new PlayerPerformanceManager();

        // 1. Infos du match (Noms des équipes, Logos, Date...)
        $game = $gameManager->getById($id);

        // 2. Les stats des joueurs pour ce match
        $stats = $perfManager->findByGameId($id);

        $this->render("match", [
            "game" => $game,
            "stats" => $stats
        ]);
    }
}
