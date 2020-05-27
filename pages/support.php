<style type="text/css">
    .ribbon-wrapper-green {
        width: 85px;
        height: 88px;
        overflow: hidden;
        position: absolute;
        top: -3px;
        right: -3px;
    }
    
    .ribbon-green {
        font: bold 15px Sans-Serif;
        color: #333;
        text-align: center;
        text-shadow: rgba(255, 255, 255, 0.5) 0px 1px 0px;
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        position: relative;
        padding: 7px 0;
        left: -5px;
        top: 15px;
        width: 120px;
        background-color: #BFDC7A;
        background-image: -webkit-gradient(linear, left top, left bottom, from(#BFDC7A), to(#8EBF45));
        background-image: -webkit-linear-gradient(top, #BFDC7A, #8EBF45);
        background-image: -moz-linear-gradient(top, #BFDC7A, #8EBF45);
        background-image: -ms-linear-gradient(top, #BFDC7A, #8EBF45);
        background-image: -o-linear-gradient(top, #BFDC7A, #8EBF45);
        color: #6a6340;
        -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3);
    }
    
    .ribbon-green:before,
    .ribbon-green:after {
        content: "";
        border-top: 3px solid #6e8900;
        border-left: 3px solid transparent;
        border-right: 3px solid transparent;
        position: absolute;
        bottom: -3px;
    }
    
    .ribbon-green:before {
        left: 0;
    }
    
    .ribbon-green:after {
        right: 0;
    }
</style>
<div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
    <div class="container">
        <h1> Support </h1>
        <br/>
        <p> Notre support est basé sur un système de <strong>Tickets</strong>.
            <br/> Vous pouvez ouvrir un ticket ou en consulter un existant et même y répondre !
            <br/> Grâce à ce système, les joueurs peuvent se répondre entre eux pour un maximum d'efficacité. </p>
        <br/>
        <?php if(!empty($email) || !empty($skype)){ ?>
            <hr>
            <br/>
            <p> Vous pouvez également nous contacter à l'aide des coordonnées suivantes </p>
            <br/>
            <?php if(!empty($email)) { ?> <a href="mailto:<?php echo $email ?>" class="btn btn-lg btn-info"><i class="fa fa-envelope-o"></i> <?php echo $email ?> </a>
                <br/>
                <br/>
                <?php }; ?>
                    <?php if(!empty($skype)) { ?> <a href="skype:<?php echo $skype ?>?add" class="btn btn-lg btn-info"><i class="fa fa-skype"></i> <?php echo $skype ?> </a>
                        <?php }; ?>
                            <?php }; ?>
    </div>
</div>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><h4 style="color: white;"><center>Tickets</center></h4></h3></div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { echo '<th style="text-align: center;">Visuel</th>'; } ?>
                    <th>Pseudo</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th style="width: 20px;text-align: center;">Statut </th>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['closeTicket'] == true){ echo '<th style="width: 20px;text-align: center;">Modification</th>'; } ?>
                </tr>
                <?php $j = 0;
                while($tickets = $ticketReq->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <?php if($tickets['ticketDisplay'] == 0 OR $tickets['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) {
                            if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { ?>
                                <td class="align-middle">
                                    <?php if($tickets['ticketDisplay'] == "0") {
                                        echo '<span><i class="glyphicon glyphicon-eye-open"></i> Public</span>';
                                    } else {
                                        echo '<span ><i class="glyphicon glyphicon-eye-close"></i> Privé</span>';
                                    } ?>
                                </td>
                            <?php } ?>

                            <td class="text-center align-middle">
                                <?php
                                $Img = new ImgProfil($tickets['auteur'], 'pseudo');
                                ?>
                                <a href="index.php?&page=profil&profil=<?php echo $tickets['auteur'] ?>"><img class="icon-player-topbar" src="<?=$Img->getImgToSize(32, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" /> <?php echo $tickets['auteur'] ?></a>
                            </td>

                            <td class="text-center align-middle">
                                <?php echo $tickets['titre'] ?>​
                            </td>

                            <td class="text-center align-middle">
                                <?php echo $tickets['jour']. '/' .$tickets['mois']. ' à ' .$tickets['heure']. ':' .$tickets['minute']; ?>
                            </td>

                            <td class="text-center align-middle">
                                <a class="btn btn-primary btn-sm" data-toggle="modal" href="#" data-target="#<?php echo $tickets['id']; ?>Slide">
                                    Voir <i class="fa fa-eye"></i>
                                </a>
                            </td>

                            <td class="text-center align-middle">
                                <?php
                                $ticketstatus = $tickets['etat'];
                                if($ticketstatus == "1"){
                                    echo '<button class="btn btn-success">Résolu <span class="glyphicon glyphicon-ok"></span></button>';
                                } else {
                                    echo '<button class="btn btn-danger">Non Résolu <span class="glyphicon glyphicon-remove"></span></button>';
                                }
                                ?>
                            </td>

                            <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['closeTicket'] == true) { ?>
                                <td style="text-align: center;">
                                    <form class="form-horizontal default-form" method="post" action="?&action=ticketEtat&id=<?php echo $tickets['id']; ?>">
                                        <?php if($tickets['etat'] == 0){
                                            echo '<button type="submit" name="etat" class="btn btn-warning" value="1" />Fermer le ticket</button>';
                                        }else{
                                            echo '<button type="submit" name="etat" class="btn btn-warning" value="0" />Ouvrir le ticket</button>';
                                        } ?>
                                    </form>
                                </td>
                            <?php }
                        } ?>
                    </tr>

                    <?php if($tickets['ticketDisplay'] == "0" OR $tickets['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { ?>
                        <!-- Modal -->
                        <div class="modal fade" id="<?php echo $tickets['id']; ?>Slide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-support">
                                <div class="modal-content">

                                    <div class="modal-header" style="background-color: #0c84e4;">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel" style="color: white;" ><?php echo $tickets['titre']; ?></h4>
                                        <?php
                                        $ticketstatus = $tickets['etat'];
                                        if($ticketstatus == "1"){
                                            echo '<div class="ribbon-wrapper-green"><div class="ribbon-green">Résolu !</div></div>';
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </div>

                                    <div class="modal-body">
                                        <p class="corp-ticket" style="text-overflow: clip; word-wrap: break-word;"><?php
                                            unset($message);
                                            $message = espacement($tickets['message']);
                                            $message = BBCode($message, $bddConnection);
                                            echo $message;
                                            $Img = new ImgProfil($tickets['auteur'], 'pseudo');
                                            ?></p>
                                        <p class="text-right">Ticket de : <img src="<?=$Img->getImgToSize(16, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="none" /> <?php echo $tickets['auteur']; ?></p>
                                        <br>
                                        <hr>

                                        <?php
                                        $commentaires = 0;
                                        if(isset($ticketCommentaires[$tickets['id']]))
                                        {
                                            echo '<h3 class="ticket-commentaire-titre"><center>' .count($ticketCommentaires[$tickets['id']]). ' Commentaires</center></h3>';
                                            for($i = 0; $i < count($ticketCommentaires[$tickets['id']]); $i++)
                                            {
                                                $get_idComm = $bddConnection->prepare('SELECT id FROM cmw_support_commentaires WHERE auteur LIKE :auteur AND id_ticket LIKE :id_ticket');
                                                $get_idComm->bindParam(':auteur', $ticketCommentaires[$tickets['id']][$i]['auteur']);
                                                $get_idComm->bindParam(':id_ticket', $tickets['id']);
                                                $get_idComm->execute();
                                                $req_idComm = $get_idComm->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="ticket-commentaire">
                                                            <div class="left-ticket-commentaire">
                                                                <?php
                                                                $Img = new ImgProfil($ticketCommentaires[$tickets['id']][$i]['auteur'], 'pseudo');
                                                                ?>
                                                                <span class="img-ticket-commentaire"><img src="<?=$Img->getImgToSize(32, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="none" /></span>
                                                                <span class="desc-ticket-commentaire">
													<span class="ticket-commentaire-auteur"><?php echo $ticketCommentaires[$tickets['id']][$i]['auteur']; ?></span>
													<span class="ticket-commentaire-date"><?php echo 'Le ' .$ticketCommentaires[$tickets['id']][$i]['jour']. '/' .$ticketCommentaires[$tickets['id']][$i]['mois']. ' à ' .$ticketCommentaires[$tickets['id']][$i]['heure']. ':' .$ticketCommentaires[$tickets['id']][$i]['minute']; ?></span>
													<?php if(isset($_Joueur_) && (($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['deleteMemberComm'] == true) OR ($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['editMemberComm'] == true))) { ?>
                                                        <span class="dropdown" style="padding-left: 40%">
								                                <a type="button" class="btn btn-warning collapsed" data-toggle="dropdown">Action <b class="caret"></b></a>
								                                <ul class="dropdown-menu">
									                                <?php if($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['deleteMemberComm'] == true) {
                                                                        echo '<li><a href="?&action=delete_support_commentaire&id_comm='.$req_idComm['id'].'&id_ticket='.$tickets['id'].'&auteur='.$ticketCommentaires[$tickets['id']][$i]['auteur'].'">Supprimer</a></li>';
                                                                    } if($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['editMemberComm'] == true) {
                                                                        echo '<li><a href="#editComm-'.$req_idComm['id'].'" data-toggle="modal" data-target="#editComm-'.$req_idComm['id'].'" >Editer</a></li>';
                                                                    }?>
								                                </ul>
							                             </span>
                                                    <?php } ?>
												</span>

                                                            </div>
                                                            <div class="right-ticket-commentaire"><div style="text-overflow: clip; word-wrap: break-word;">
                                                                    <?php unset($message);
                                                                    $message = espacement($ticketCommentaires[$tickets['id']][$i]['message']);
                                                                    $message = BBCode($message, $bddConnection);
                                                                    echo $message;  ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <?php
                                            }
                                        }
                                        else
                                            echo '<h3 class="ticket-commentaire-titre">0 Commentaire</h3>';
                                        ?>



                                    </div>
                                    <?php
                                    if($tickets['etat'] == "0"){
                                        echo '<form action="?&action=post_ticket_commentaire" method="post"><div class="modal-footer">
												<input type="hidden" name="id" value="'.$tickets['id'].'" /><div class="row">
												<div class="col-md-12 text-center">
												<div class="dropdown" style="display: inline">
											  	<a href="#" role="button" id="font" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											   	 <i style="text-decoration:none;" class="fas fa-smile"></i>
											  	</a>
												<div class="dropdown-menu borderrond" aria-labelledby="font">
													<div class="topheaderdante" style="width: 500px">
														<p class="topheadertext">Clique pour ajouter un smiley!</p>
													</div>';
                                        $smileys = getDonnees($bddConnection);
                                        for($i = 0; $i < count($smileys['symbole']); $i++)
                                        {
                                            echo '<a class="dropdown-item" style="display: inline; padding: 0; white-space: normal;" href="javascript:insertAtCaret(\'ticket'.$tickets['id'].'\',\' '.$smileys['symbole'][$i].' \')"><img src="'.$smileys['image'][$i].'" alt="'.$smileys['symbole'][$i].'" title="'.$smileys['symbole'][$i].'" /></a>';
                                        }
                                        echo '
												</div>
											</div>
												<a href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en gras\', \'ce texte sera en gras\', \'b\')" style="text-decoration: none;" title="gras"><i class="fas fa-bold" aria-hidden="true"></i></a>
												<a href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en italique\', \'ce texte sera en italique\', \'i\')" style="text-decoration: none;" title="italique"><i class="fas fa-italic"></i></a>
												<a href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en souligné\', \'ce texte sera en souligné\', \'u\')" style="text-decoration: none;" title="souligné"><i class="fas fa-underline"></i></a>
												<a href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en barré\', \'ce texte sera barré\', \'s\')" style="text-decoration: none;" title="barré"><i class="fas fa-strikethrough"></i></a>
												<a href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en aligné à gauche\', \'ce texte sera aligné à gauche\', \'left\')" style="text-decoration: none" title="aligné à gauche"><i class="fas fa-align-left"></i></a>
												<a href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en centré\', \'ce texte sera centré\', \'center\')" style="text-decoration: none" title="centré"><i class="fas fa-align-center"></i></a>
												<a href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en aligné à droite\', \'ce texte sera aligné à droite\', \'right\')" style="text-decoration: none" title="aligné à droite"><i class="fas fa-align-right"></i></a>
												<a href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en justifié\', \'ce texte sera justifié\', \'justify\')" style="text-decoration: none" title="justifié"><i class="fas fa-align-justify"></i></a>
												<div class="dropdown">
												  	<a href="#" role="button" id="font" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												   	 <i class="fas fa-text-height"></i>
												  	</a>
													<div class="dropdown-menu" aria-labelledby="font">
												   		<a class="dropdown-item" href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en taille 2\', \'ce texte sera en taille 2\', \'font=2\')"><span style="font-size: 2em;">2</span></a>
												   		<a class="dropdown-item" href="javascript:ajout_text(\'ticket'.$tickets['id'].'\', \'Ecrivez ici ce que vous voulez mettre en taille 5\', \'ce texte sera en taille 5\', \'font=5\')"><span style="font-size: 5em;">5</span></a>
												  	</div>
												</div>
											</div><div class="col-md-12">
												<textarea name="message" id="ticket'.$tickets['id'].'" class="form-control" rows="3" cols="60"></textarea>
												</br></div></div>
										  </div>
										  <button type="submit" class="btn btn-primary">Commenter</button>
											</form>';
                                    } else {
                                        echo '<div class="modal-footer">
											<form action="" method="post">
												<textarea style="text-align: center;"name="message" class="form-control" rows="2" placeholder="Ticket résolu ! Merci de contacter un administrateur pour réouvrir votre ticket." disabled></textarea>
											</form>
										  </div>';
                                    }
                                    ?>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <?php if($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['editMemberComm'] == true) {
                            if(!empty($ticketCommentaires[$tickets['id']]))
                            {
                                for($i = 0; $i < count($ticketCommentaires[$tickets['id']]); $i++) {
                                    $get_idComm = $bddConnection->prepare('SELECT id FROM cmw_support_commentaires WHERE auteur LIKE :auteur AND id_ticket LIKE :id_ticket');
                                    $get_idComm->bindParam(':auteur', $ticketCommentaires[$tickets['id']][$i]['auteur']);
                                    $get_idComm->bindParam(':id_ticket', $tickets['id']);
                                    $get_idComm->execute();
                                    $req_idComm = $get_idComm->fetch(PDO::FETCH_ASSOC); ?>
                                    <div class="modal fade" id="editComm-<?php echo $req_idComm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editComm">
                                        <form method="POST" action="?&action=edit_support_commentaire&id_comm=<?php echo $req_idComm['id']; ?>&id_ticket=<?php echo $tickets['id']; ?>&auteur=<?php echo $ticketCommentaires[$tickets['id']][$i]['auteur']; ?>">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title text-center" id="editComm">Edition du commentaire</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-lg-12 text-center">
                                                            <div class="row">
                                                                <textarea name="editMessage" class="form-control" rows="3" style="resize: none;"><?php echo $ticketCommentaires[$tickets['id']][$i]['message']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col-lg-12 text-center">
                                                            <div class="row">
                                                                <button type="submit" class="btn btn-primary">Valider !</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php }
                            }
                        }
                    }
                    $j++; } ?>
            </table>
            </br>
            <div class="TicketFormButton">
                <?php
					if(!isset($_Joueur_)) 
						echo '<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-user"></span> Se connecter pour ouvrir un ticket</a>'; 
					else 
					{
				?> <a data-toggle="collapse" data-parent="#ticketCree" href="#ticketCreation" class="btn btn-info">Ouvrir un ticket !</a> </div>
        </div>
    </div>
    <div class="panel-group" id="ticketCree">
        <div class="panel panel-default">
            <div id="ticketCreation" class="panel-collapse collapse">
                <div class="panel-body">
                    <form action="" method="post" onSubmit="envoie_ticket();">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="control-label">Sujet</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fas fa-eye"></i></div>
                                                <input type="text" id="titre_ticket" class="form-control" name="titre" placeholder="Sujet">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleSelect1">Visibilité</label>
                                        <?php
                                        if(!isset($_Serveur_["support"]["visibilite"]) || $_Serveur_["support"]["visibilite"] == "both" ){ ?>
                                            <select class="form-control" id="vu_ticket" name="ticketDisplay">
                                                <option value="0">Publique</option>
                                                <option value="1">Privée</option>
                                            </select>
                                        <?php } else {?>
                                            <select class="form-control" id="vu_ticket" name="ticketDisplay">
                                                <?php if($_Serveur_["support"]["visibilite"] == "prive"){ ?>
                                                    <option value="1">Privée</option>
                                                <?php } else {?>
                                                    <option value="0">Publique</option>
                                                <?php }?>
                                            </select>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <div class="dropdown" style="display: inline">
                                        <a href="#" role="button" id="font" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i style="text-decoration:none;" class="fas fa-smile"></i>
                                        </a>
                                        <div class="dropdown-menu borderrond" aria-labelledby="font">
                                            <div class="topheaderdante" style="width: 500px">
                                                <p class="topheadertext">Clique pour ajouter un smiley!</p>
                                            </div>
                                            <?php
                                            $smileys = getDonnees($bddConnection);
                                            for($i = 0; $i < count($smileys['symbole']); $i++)
                                            {
                                                echo '<a class="dropdown-item" style="display: inline; padding: 0; white-space: normal;" href="javascript:insertAtCaret(\'message_ticket\',\' '.$smileys['symbole'][$i].' \')"><img src="'.$smileys['image'][$i].'" alt="'.$smileys['symbole'][$i].'" title="'.$smileys['symbole'][$i].'" /></a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <a href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en gras', 'ce texte sera en gras', 'b')" style="text-decoration: none;" title="gras"><i class="fas fa-bold" aria-hidden="true"></i></a>
                                    <a href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en italique', 'ce texte sera en italique', 'i')" style="text-decoration: none;" title="italique"><i class="fas fa-italic"></i></a>
                                    <a href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en souligné', 'ce texte sera en souligné', 'u')" style="text-decoration: none;" title="souligné"><i class="fas fa-underline"></i></a>
                                    <a href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en barré', 'ce texte sera barré', 's')" style="text-decoration: none;" title="barré"><i class="fas fa-strikethrough"></i></a>
                                    <a href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en aligné à gauche', 'ce texte sera aligné à gauche', 'left')" style="text-decoration: none" title="aligné à gauche"><i class="fas fa-align-left"></i></a>
                                    <a href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en centré', 'ce texte sera centré', 'center')" style="text-decoration: none" title="centré"><i class="fas fa-align-center"></i></a>
                                    <a href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en aligné à droite', 'ce texte sera aligné à droite', 'right')" style="text-decoration: none" title="aligné à droite"><i class="fas fa-align-right"></i></a>
                                    <a href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en justifié', 'ce texte sera justifié', 'justify')" style="text-decoration: none" title="justifié"><i class="fas fa-align-justify"></i></a>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="font" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-text-height"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="font">
                                            <a class="dropdown-item" href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en taille 2', 'ce texte sera en taille 2', 'font=2')"><span style="font-size: 2em;">2</span></a>
                                            <a class="dropdown-item" href="javascript:ajout_text('message_ticket', 'Ecrivez ici ce que vous voulez mettre en taille 5', 'ce texte sera en taille 5', 'font=5')"><span style="font-size: 5em;">5</span></a>
                                        </div>
                                    </div>
                                    <!--<a href="javascript:ajout_text('message', 'Ecrivez ici ce que vous voulez mettre en rouge', 'ce texte sera en rouge', 'color=red')" class="redactor_color_link" style="background-color: rgb(255, 0, 0);"></a>-->
                                </div>
                                <label for="message_ticket">Description détaillée</label>
                                <textarea class="form-control" id="message_ticket" name="message" placeholder="Description détaillée de votre problème" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success champ valider pull-right">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script>
    var nbEnvoie = 0
    function envoie_ticket()
    {
        if(nbEnvoie>0)
            return false;
        else
        {
            var data_titre = document.getElementById("titre_ticket").value;
            var data_message = document.getElementById("message_ticket").value;
            var data_vu = document.getElementById("vu_ticket").value;
            $.ajax({
                url  : 'index.php?action=post_ticket',
                type : 'POST',
                data : 'titre=' + data_titre + '&message=' + data_message + '&ticketDisplay=' + data_vu,
                dataType: 'html',
                success: function() {
                    sleep(1);
                }
            });
            nbEnvoie++;
            return true;
        }
    }
</script>