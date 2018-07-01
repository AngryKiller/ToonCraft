<button type="button" class="btn btn-primary btn-lg btn-widgets" data-toggle="modal" data-target="#widgetsModal">
  Widgets
</button>
<div class="modal fade" id="widgetsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Widgets</h4>
      </div>
      <div class="modal-body">
<section>
<?php for($i = 0; $i < count($_Widgets_['Widgets']); $i++) { ?>
	
	<?php if((
		$_Widgets_['Widgets'][$i]['type'] != 0 OR isset($_Joueur_)	)
		AND $_Widgets_['Widgets'][$i]['type'] != 2 	
		AND ( $_Widgets_['Widgets'][$i]['type'] != 1 OR !$tousDown ) ){ ?>

	<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $_Widgets_['Widgets'][$i]['titre']; ?></h4>
		</div>
		
		<div class="panel-body <?php if($_Widgets_['Widgets'][$i]['type'] == 1) echo 'players'; ?>">
			<?php if($_Widgets_['Widgets'][$i]['type'] == 0) { ?>
				<ul class="nav nav-pills nav-stacked">
					  <?php
					if($_Joueur_['rang'] == 1)
						echo '<li class="active"><a href="admin.php"><span class="glyphicon glyphicon-cog"></span> Administration </a></li>';
					
					?>
					<li><a href="?&page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><span class="glyphicon glyphicon-pencil"></span> Mon Profil</a></li>
					<li><a href="?&page=token"><span class="glyphicon glyphicon-euro"></span> Acheter des <?php echo $monnaie ?>s</a></li>
					<li><a href="?&action=deco"><span class="glyphicon glyphicon-off"></span> Déconnexion</a></li>
				</ul>
				<label class="label label-info label-sm">J'ai <?php echo $_Joueur_['tokens']; ?> <?php echo $monnaie ?>s</label>
				
				<?php } elseif($_Widgets_['Widgets'][$i]['type'] == 1){ 
					for($j = 0; $j < count($lecture['Json']); $j++)
					{
						if($conEtablie[$j] == true)
						{
							foreach($serveurStats[$j]['joueurs'] as $cle => $element)
							{ 
							?>
								<a href="?&page=profil&profil=<?php echo $serveurStats[$j]['joueurs'][$cle]; ?>" class="icon-player">
								<?php echo '<img src="http://cravatar.eu/helmhead/' .$serveurStats[$j]['joueurs'][$cle]. '/56.png" title="Voir le profil de ' .$serveurStats[$j]['joueurs'][$cle]. '">'; ?>
								</a>
							<?php 
							}
						}					
					}	
				 } elseif($_Widgets_['Widgets'][$i]['type'] == 3) 
				 	echo $_Widgets_['Widgets'][$i]['message']; ?>
		</div>
	</div>

	<?php } ?>

<?php } ?>
</section>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>