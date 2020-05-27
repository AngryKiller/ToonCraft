<div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
    <div class="container">
        <h1> <?php echo $_Serveur_['General']['name'] ?> </h1>
        <br/>
        <p>
            <?php echo $_Serveur_['General']['description'] ?>
        </p>
        <?php if(!empty($_Theme_['All']['home_button'])){ ?>
            <a href="<?php echo $_Theme_['All']['home_button_link'] ?>" class="btn btn-lg btn-success">
                <?php echo $_Theme_['All']['home_button'] ?>
            </a>
            <?php }; ?>
    </div>
</div>
<center>
    <?php if(!empty($_Serveur_['General']['ipTexte'])){ ?>
        <div class="ipserveuranim"><span class="ipserveur label label-primary"><?php echo $_Serveur_['General']['ipTexte'] ?></span></div>
        <br/>
        <br/>
        <br/>
        <?php };?>
            <div class="container">
                <div class="container">
                    <div class="col-md-4">
                        <div class="icone"> <img src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/swords.png" /> </div>
                        <h1> <?php echo $_Theme_['All']['atout1_nom'] ?> </h1>
                        <p>
                            <?php echo $_Theme_['All']['atout1_text'] ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="icone"> <img src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/diamond.png" /> </div>
                        <h1> <?php echo $_Theme_['All']['atout2_nom'] ?> </h1>
                        <p>
                            <?php echo $_Theme_['All']['atout2_text'] ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="icone"> <img src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/chest.png" /> </div>
                        <h1> <?php echo $_Theme_['All']['atout3_nom'] ?> </h1>
                        <p>
                            <?php echo $_Theme_['All']['atout3_text'] ?>
                        </p>
                    </div>
                </div>
            </div>
</center>
<div class="news">
    <center>
        <h1 class="title">Informations</h1></center>
    <div class="newsbg shadow" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/newsbg.png">
        <div class="container">
            <?php
// RÉSUMÉ BRUT d'un texte (HTML ou non) : en fonction du NOMBRE de CARACTERES
function texte_resume_brut($texte, $nbreCar)
{
  $texte 				= trim(strip_tags($texte));
  if(is_numeric($nbreCar))
  {
    $PointSuspension	= '...';
    $texte			.= ' ';
    $LongueurAvant		= strlen($texte);
    if ($LongueurAvant > $nbreCar) {
      $texte = substr($texte, 0, strpos($texte, ' ', $nbreCar));
      if ($PointSuspension!='') {
        $texte	.= $PointSuspension;
      }
    }
  }
  return $texte;
}

if (isset($news)){
  $i = 0;
  if (count($news) > 6)
    $m = 6;
  else
      $m = count($news);
  while ($i < $m){
    if ($i < count($news))
      $id = count($news)-$i;
    $titre = $news[$i]['titre'];
    $auteur = $news[$i]['auteur'];
    $date = date('d/m/Y', $news[$i]['date']).' &agrave; '.date('H:i', $news[$i]['date']);
    $full = $news[$i]['message'];
    $message = texte_resume_brut($full, 100);
      			$getCountCommentaires = $accueilNews->countCommentaires($news[$i]['id']);
						$countCommentaires = $getCountCommentaires->rowCount();

						$getcountLikesPlayers = $accueilNews->countLikesPlayers($news[$i]['id']);
						$countLikesPlayers = $getcountLikesPlayers->rowCount();
						$namesOfPlayers = $getcountLikesPlayers->fetchAll();

						$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
    ?>
                <div class="col-md-4 col-sm-6 center-block">
                    <div class="panel panel-default shadow panel-news">
                        <div class="panel-heading" style="border-bottom: 1px solid #EEE; font-family: Raleway, Helvetica, sans-serif;">
                            <h4><?php echo $titre;?></h4> </div>
                        <div class="panel-body body-news">
                            <?php echo $message;?>
                        </div>
                        <div class="panel-footer">
                            <button data-toggle="modal" data-target="#news<?php echo $i;?>" class="btn btn-primary" type="button"> Lire la suite </button> <small style="float: right;">
              Le <?php echo $date;?><br>
              <small>par <?php echo $auteur; ?></small> </small>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="news<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo $titre; ?></h4> </div>
                            <div class="modal-body">
                                <?php echo $full;?>
                            </div>
                            <div class="modal-footer">
                                <?php
								if(isset($_Joueur_)) {
									$reqCheckLike = $accueilNews->checkLike($_Joueur_['pseudo'], $news[$i]['id']);
									$getCheckLike = $reqCheckLike->fetch();
									$checkLike = $getCheckLike['pseudo'];
									if($_Joueur_['pseudo'] == $checkLike) {
										echo '<div style="float: right;">';
									} else {
										echo '
										<a href="?&action=likeNews&id_news='.$news[$i]['id'].'"><i class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></i> J\'aime !</a>';
									}
								} else {
									echo '<div style="float: right;">';
								}
								
								if($countLikesPlayers != 0) {
									echo '&nbsp;&nbsp;<a href="#" class="tooltips2 pull-right"><i class="glyphicon glyphicon-thumbs-up"></i> '.$countLikesPlayers;
						
									echo '</span></a></div>';
								}
								?>
                                    <hr>
                                    <center>
                                        <h3 class="ticket-commentaire-titre"><B><?php echo $countCommentaires." Commentaires"; ?></B></h3></center>
                                    <?php
									while($newsComments = $getNewsCommentaires->fetch()) {
										if(isset($_Joueur_)) {
											
											$getCheckReport = $accueilNews->checkReport($_Joueur_['pseudo'], $newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$checkReport = $getCheckReport->rowCount();

											$getCountReportsVictimes = $accueilNews->countReportsVictimes($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$countReportsVictimes = $getCountReportsVictimes->rowCount();
										}
										?>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="ticket-commentaire">
                                                    <div class="left-ticket-commentaire" style="text-align:left;"> <span class="img-ticket-commentaire">
															<img src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $newsComments['pseudo']; ?>&s=1024&v=front" width="32" height="32" alt="none" />
															
														</span> <span class="desc-ticket-commentaire">
															<span class="ticket-commentaire-auteur"><?php echo '<B> - '.$newsComments['pseudo'].'</B>'; ?>
															</span> <span class="ticket-commentaire-date"><?php echo '<B>Le '.date('d/m', $newsComments['date_post']).' à '.date('H:i:s', $newsComments['date_post']).'</B>'; ?>
															</span>
                                                        <?php if(isset($_Joueur_)) { ?> <span class="ticket-commentaire-action pull-right">
																	<span style="color: red;"><?php if($newsComments['nbrEdit'] != "0"){echo 'Nombre d\'édition: '.$newsComments['nbrEdit'].' | ';}if($countReportsVictimes != "0"){echo '<B>'.$countReportsVictimes.' Signalement</B> |';} ?></span>
                                                            <div class="dropdown"> <a type="button" class="btn btn-info collapsed" data-toggle="dropdown" style="font-size: 10px;">Action <b class="caret"></b></a>
                                                                <ul class="dropdown-menu">
                                                                    <?php if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {
																				echo '<li><a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'-'.$newsComments['id'].'-edit">Editer</a></li>';
																				echo '<li><a href="?&action=delete_news_commentaire&id_comm='.$newsComments['id'].'&id_news='.$news[$i]['id'].'&auteur='.$newsComments['pseudo'].'">Supprimer</a></li>';
																			}
																			if($newsComments['pseudo'] != $_Joueur_['pseudo']) {
																				if($checkReport == "0") {
																					echo '<li><a href="?&action=report_news_commentaire&id_news='.$news[$i]['id'].'&id_comm='.$newsComments['id'].'&victime='.$newsComments['pseudo'].'">Signaler</a></li>';
																				} else {
																					echo '<li><a href="#">Déjà report</a></li>';
																				}
																			} ?>
                                                                </ul>
                                                            </div>
                                                            </span>
                                                            <?php } ?>
                                                                </span>
                                                    </div>
                                                    <br>
                                                    <div class="right-ticket-commentaire" style="text-align:left;">
                                                        <?php echo $newsComments['commentaire']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                            <?php
										if(isset($_Joueur_)) { ?>
                                                <form action="?&action=post_news_commentaire&id_news=<?php echo $news[$i]['id']; ?>" method="post">
                                                    <textarea name="commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required></textarea>
                                                    <center>
                                                        <h4><B>Minimum de 6 caractères<br>Maximum de 255 caractères</B></h4></center>
                                                    </br>
                                                    <center>
                                                        <div class="btn-container">
                                                            <button type="submit" class="btn btn-success">Commenter</button>
                                                        </div>
                                                    </center>
                                                </form>
                                                <?php } else { ?>
                                                    <center>
                                                        <div class="alert alert-danger">Veuillez-vous connecter pour mettre un commentaire.</div>
                                                    </center>
                                                    <center><a data-toggle="modal" data-target="#ConnectionSlide" class="btn danger-btn">Connexion</a></center>
                                                    <?php } ?>
                                                        <?php if(isset($_Joueur_)) {
								$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
								while($newsComments = $getNewsCommentaires->fetch()) {
									$reqEditCommentaire = $accueilNews->editCommentaire($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
									$getEditCommentaire = $reqEditCommentaire->fetch();
									$editCommentaire = $getEditCommentaire['commentaire'];
									if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {  ?>
                                                            <div class="modal fade" id="news<?php echo $news[$i]['id'].'-'.$newsComments['id'].'-edit'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-support">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <center>
                                                                                <h4 class="modal-title" id="myModalLabel">Edition du commentaire</h4></center>
                                                                        </div>
                                                                        <form action="?&action=edit_news_commentaire&id_news=<?php echo $news[$i]['id'].'&auteur='.$newsComments['pseudo'].'&id_comm='.$newsComments['id']; ?>" method="post">
                                                                            <div class="modal-body">
                                                                                <textarea name="edit_commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required>
                                                                                    <?php echo $editCommentaire; ?>
                                                                                </textarea>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <center>
                                                                                    <h4><B>Minimum de 6 caractères <br> Maximum de 255 caractères</B></h4></center>
                                                                                </br>
                                                                                <center>
                                                                                    <div class="btn-container">
                                                                                        <button type="submit" class="btn btn-success">Valider la modification</button>
                                                                                    </div>
                                                                                </center>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php }
									}
								} ?>
                                                                <hr> <small style="float: left;">
              <img src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $news[$i]['auteur']; ?>&s=1024&v=front" width="32" height="32">
              Le <?php echo $date;?> par <?php echo $auteur;?>
            </small>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>



                <?php $i++;
  }
}
?>
        </div>
    </div>
</div>