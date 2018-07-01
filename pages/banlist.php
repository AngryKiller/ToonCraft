<div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
    <div class="container">
        <h1> Ban-List </h1>
        <br/>
        <p> Liste des joueurs bannis </p>
    </div>
</div>
<div class="container">
    <table class="table">
        <tr>
            <th>Pseudo</th>
            <th>Date</th>
            <th>Source</th>
            <th>Durée</th>
            <th>Raison</th>
        </tr>
        <?php
						foreach($banlist[0] as $cle => $element)
						{
							echo '<tr>';
							if(!is_string($element))
								foreach($banlist[0][$cle] as $cle2 => $element2)
								{
									echo '<td>'. $element2 .'</td>';
								}
							else
								echo '<td>'.$banlist[0][$cle].'</td><td>Date inconnue</td><td>(Unknown)</td><td>?</td><td>Banni par un admin</td>';
							echo '</tr>';
						}
						?>
    </table>
</div>