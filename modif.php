<?php 
require 'Connexion.php';
require 'VideoRepository.php';
require 'Video.php';

$videoRepo = new Videorepository();
$video = $videoRepo->find(htmlspecialchars($_GET['id']));	

if(isset($_POST['titre']) && !empty($_POST['titre']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['publication']) && !empty($_POST['publication'])) {
	$video = new Video();
	$video->setTitle($_POST['title']);
	$video->setVideoId($_POST['videoId']);
	$video->setDescription($_POST['description']);
	$video->setPublication($_POST['publication']);
	$videoRepository = new videoRepository();
	$videoRepository->save($video); 
}
?>
<form action='#' method='POST'>
	<input type="hidden" name="videoId" value="<?php echo $video['videoid'] ?>">
	<div>
		<label>titre <input type="text" name="titre" value="<?php echo $video['title'] ?>"></label>
	</div>
	<input type="text" name="prout" value="pardon">
	<div>
		<label> description <textarea  name="description" ><?php echo $video['description'] ?></textarea></label>
	</div>
	<div>
		<label>publication <input type="text" name="publication" value="<?php echo $video['publication'] ?>"></label>
	</div> 
	<input type="submit"  value="envoyer"> 
</form>