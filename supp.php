<?php 
require 'Connexion.php';
require 'VideoRepository.php';
require 'Video.php';

$videoRepo = new Videorepository();
$videoId = htmlspecialchars($_POST['id']);	
$type = htmlspecialchars($_POST['type']);

if (isset($_POST['id']) && isset($_POST['type'])) {
    if ($type == 0) {
        echo $videoId;
        $videoRepo->delete($videoId);
    } else {
        $videoRepo->softDelete($videoId);
        echo 'softDelete';
    }
    
} else { echo 'pas rentré';}