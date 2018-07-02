<div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
    <div class="container">
        <h1> Boutique </h1>
        <br/>
        <p> La boutique vous permet d'acheter du contenu <strong>In-Game</strong> grâce a une monnaie virtuelle nommée le
            <?php echo $monnaie ?>. </p>
        <br/>
        <?php if(isset($_Joueur_)) { ?>
            <hr>
            <h3 class="text-center" style="color: white;">Bonjour <?php echo $_Joueur_['pseudo']; ?></h3>
            <h4 class="text-center" style="color: white;">Vous avez <strong><?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' <img style="width: 25px;" src="./theme/default/img/jeton.png" />'; ?></h4></strong>
            <center><a href="?&page=token" class="btn btn-success btn-lg">Acheter des <?php echo $monnaie ?>s</a>
                <a href="?&page=panier" class="btn btn-warning btn-lg"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Panier ( <?php echo $_Panier_->compterArticle().($_Panier_->compterArticle()>1 ? ' articles' : ' article') ?>)</a>
            </center>
            <?php } else { ?>
                <hr>
                <center>
                    <h4 style="color: white;">Veuillez vous connecter pour accéder a la boutique:</h4> <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-user"></span> Connexion</a> </center>
                <?php } ?>
    </div>
</div>
</div>
</br>
</br>
<div class="container">
    <h3><center>Choissiez votre catégorie :</center></h3>
    <div class="nav-center">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <?php
						$j = 0;
						while($j < count($categories))
						{
						$categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']);
						?>
                    <li><a href="#categorie-<?php echo $categories[$j]['titre']; ?>" data-toggle="tab"><h4 style="color: black;"><center><strong><?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); ?><?php echo $categories[$j]['titre']; ?></strong></center></h4></a></li>
                    <?php $j++; } ?>
            </ul>
            </center>
            <div class="tab-content">
                <?php
						$j = 0;
						while($j < count($categories))
						{
						$categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']);
						?>
                    <div id="categorie-<?php echo $categories[$j]['titre']; ?>" class="tab-pane">
                        <?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); ?>
                            <div class="panel-body">
                                <?php if($categories[$j]['message'] == ""){ ?>
                                    <?php } else { ?>
                                        <p>
                                            <div class="alert alert-dismissable alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <center>
                                                    <?php echo $categories[$j]['message']; ?>
                                                </center>
                                            </div>
                                        </p>
                                        <?php } ?>
                                            <div class="row">
                                                <?php
										for($i = 1; $i <= count($offresTableau); $i++)
										{
											if($offresTableau[$i]['categorie'] == $categories[$j]['id'])
											{
												echo '
												<div class="col-md-4 panel panel-default" style="margin-left: 10px;width: 30%;">
													<div class="panel-body">
															<h3 class="titre-offre"><center>'. $offresTableau[$i]['nom'] .'</center></h3>
															<div class="offre-description">' .$offresTableau[$i]['description']. '</div>
														</div>
														';
															if(isset($_Joueur_)) {echo '<a href="?&page=boutique&offre=' .$offresTableau[$i]['id']. '" class="btn btn-primary btn-block btn-shop">Acheter !</a>';}
															else { echo'<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block btn-shop"><span class="glyphicon glyphicon-user"></span> Se connecter</a>'; }
												echo '
															<span class="label label-success label-shop">Prix: ' .$offresTableau[$i]['prix']. ' <img width="25" height="25" src="./theme/ToonCraft/img/jeton.png" /></span>
                                                            <br>
															<br>
														
												</div>		';
											}
										}
									?> </div>
                            </div>
                    </div>
                    <?php $j++; } ?>
            </div>
        </div>
    </div>
    <?php
if(isset($_GET['offre']))
{
?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Achat de: <?php echo $infosOffre['offre']['nom']; ?></h4> </div>
                    <div class="modal-body">
                        <p> <em>"<?php echo $infosOffre['offre']['description']; ?>"</em>
                            <br /> Vous obtiendrez ce grade sur
                            <?php echo $infosCategories['serveur']; ?>.
                                <br />
                                <?php
				$enLigne = false;
				if($infosCategories['serveurId'] == -2 OR $infosCategories['serveurId'] == -1)
					for($i = 0; $i < count($lecture['Json']); $i++)
					{
						if($enligne[$i])
						{
							echo 'Vous êtes connecté sur le serveur:<br /> "'. $lecture['Json'][$i]['nom'] .'"';
							$enLigne = true;
						}
						
					}
				else
					if($enligne[$infosCategories['serveurId']])
					{
						echo 'Vous êtes connecté sur le serveur:<br /> "'. $lecture['Json'][$infosCategories['serveurId']]['nom'] .'"';
						$enLigne = true;
					}
					
				if(!$enLigne AND $infosCategories['connection'])
					echo 'Vous n\'êtes pas connecté sur le serveur !';
				?>
                                    <br />
                                    <br /> Cette offre contient:
                                    <br/>
                                    <blockquote>
                                        <?php
				if(isset($infosOffre['action']))
					for($i = 0; $i < count($infosOffre['action']); $i++)
					{
						?> <strong><?php echo $infosOffre['action'][$i]['methode'] . $infosOffre['action'][$i]['commande_valeur']; ?></strong>
                                            <br/>
                                            <?php
					}
				else
					echo 'Cette offre est un don sans contrepartie...';
				?>
                                    </blockquote>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <?php 	if(($enLigne AND $infosCategories['connection']) OR !$infosCategories['connection']) { ?>
                            <form action="index.php" method="GET" class="form-inline">
                            <input type="hidden" name="action" value="addOffrePanier"/>
                            <input type="hidden" name="offre" value="<?php echo $_GET['offre']; ?>"/>
                            <label for="quantite" class="form-control mb-1 mr-sm-1">Quantité: </label>
                            <input type="number" class="form-control mb-1 mr-sm-1" id="quantite" min="0" name="quantite" value="1" />
                            <button type="submit" class="btn btn-success mb-2">Ajouter au panier</button>
                            </form><?php } else{ ?>
                            Connectez vous sur le serveur voulu... <?php }
                        ?>
                    </div><button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 100%;
border-radius: 0px;">Annuler</button>
                </div>
            </div>
        </div>
        <?php

$modal = true;
$idModal = 'myModal';

}
?>
</div>
</div>