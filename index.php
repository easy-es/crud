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
				<td> <a href=supp.php?id='.$video['id'].'> supprimer</a></td>
			</tr>';
		}  
		?>
	</tbody>
</table>
