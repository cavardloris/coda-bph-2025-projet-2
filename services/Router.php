<?php

class Router
{
    public function handleRequest(): void
    {

        $route = $_GET['route'] ?? 'home';
        $controller = new PageController();
        if ($route === "les-players") {
            $controller->lesPlayers();
        } 
        elseif ($route === "les-teams") {
            $controller->lesTeams();
        }
        elseif ($route === "les-matchs") {
            $controller->lesMatchs();
        }
        elseif ($route === "team") {
            $controller->team();
        }
        elseif ($route === "player") {
            $controller->player();
        }
        elseif ($route === "match") {
            $controller->match();
        }
        else {
            $controller->home();
        }
    }
}