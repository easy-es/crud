<?php
require 'Connexion.php';
require 'VideoRepository.php';
require 'ErrorHandler.php';

$videoRepository = new VideoRepository();
//$e = new ErrorHandler();
//$e->attach($videos);
//set_error_handler([$e, 'error']);

$videos = $videoRepository->findAll();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/crud.js"></script>
    </head>
  <body>
	<table>
		<thead>
			<tr>
				<th>titre</th>
				<th> date publication </th>
				<td>modifier </td>
				<td>supprimer </td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($videos as $key => $video) {
				echo '
				<tr>
					<td>'.$video['title'].'</td> 
					<td>'.$video['publication'].'</td>
					<td> <a href=modif.php?id='.$video['id'].'> modifier</a></td>
					<td> <button type="button" class="supp" data-id ='.$video['id'].' data-type=0> supprimer</button></td>
				</tr>';
			}  
		?>
		</tbody>
	</table>
</body>
</html>
