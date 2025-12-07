<?php

abstract class AbstractController
{
    // Cette fonction permet d'afficher les templates et de leur passer des données
    protected function render(string $template, array $data = []): void
    {
        // On extrait les données (ex: ['games' => $games] devient la variable $games)
        extract($data);
        require "templates/layout.phtml";
    }
}