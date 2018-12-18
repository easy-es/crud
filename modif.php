<?php 
require 'Connexion.php';
require 'VideoRepository.php';

$videoRepo = new Videorepository();
var_dump($videoRepo->find(htmlspecialchars($_GET['id'])));	