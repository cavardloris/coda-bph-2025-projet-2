<?php

require "managers/AbstractManager.php";
require "managers/PlayerManager.php";

$AngryOwls = new PlayerManager($db);
$teamAngry = $AngryOwls->getTeamRoster(1); 

require "templates/home.phtml";