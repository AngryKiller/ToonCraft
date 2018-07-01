<div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
    <div class="container">
        <h1> Voter </h1>
        <br/>
        <p> Voter pour le serveur permet d'améliorer son référencement !.
            <br/> Les votes sont récompensés par des items <strong>In-Game</strong>.</p>
        <hr>
        <?php if(!isset($_Joueur_)) echo '	<center>
	<h4 style="color: white;">Veuillez vous connecter pour voter:</h4>
	<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Connexion</a>
	</center>'; ?>
    </div>
</div>
<div class="container">
    <?php
				if(isset($_GET['erreur']))
				{
					if($_GET['erreur'] == 1)
					{
						?>
        <div class="alert alert-danger">Vous devez encore attendre
            <?php echo $_GET['time']; ?> avant de pouvoir voter sur ce site !<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                <script>
                    $(".alert").alert()
                </script>
        </div>
        <?php
					}
					if($_GET['erreur'] == 2)
					{
						?>
            <div class="alert alert-danger">Vous devez vous connecter si vous voulez gagner une récompense...<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                <script>
                    $(".alert").alert()
                </script>
            </div>
            <?php
					}
				}
				elseif(isset($_GET['success']))
				{
					?>
                <div class="alert alert-success">Votre récompense arrive, si vous n'avez pas vu de fenêtre s'ouvrir pour voter, la fenêtre à dû s'ouvrir derrière votre navigateur, validez le vote et profitez de votre récompense In-Game !<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                    <script>
                        $(".alert").alert()
                    </script>
                </div>
                <?php
				}
				?>
                    <h3 class="header-bloc">Voter pour votre serveur :</h3>
                    <div class="corp-bloc">
                        <form action="?&action=voter" method="post">
                            <ul class="nav nav-tabs">
                                <?php 
                if(!isset($jsonCon) OR empty($jsonCon))
                    echo '<p>Veuillez relier votre serveur à votre site à votre serveur avec JsonAPI depuis le panel pour avoir les liens de votes !</p>';
                
                for($i = 0; $i < count($jsonCon); $i++) { ?>
                                    <li <?php if($i==0 ) echo 'class="active"'; ?>>
                                        <a href="#voter<?php echo $i; ?>" data-toggle="tab">
                                            <?php echo $lecture['Json'][$i]['nom']; ?>
                                        </a>
                                    </li>
                                    <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <?php for($i = 0; $i < count($jsonCon); $i++) { ?>
                                    <div class="tab-pane<?php if($i == 0) echo ' active'; ?>" id="voter<?php echo $i; ?>">
                                        <?php $k = 0; for($j = 0; $j < count($liensVotes); $j++) { if($i == $liensVotes[$j]['serveur']) {?>
                                            <button type="submit" class="btn btn-primary bouton-vote" name="site" onclick="window.open('<?php echo $liensVotes[$j]['lien']; ?>','Fiche','toolbar=no,status=no,width=1350 ,height=900,scrollbars=yes,location=no,resize=yes,menubar=yes')" value="<?php echo $j + 1; ?>">
                                                <?php echo $liensVotes[$j]['titre']; ?>
                                            </button>
                                            <?php	} else{ $k++;	 } }
                        if($k == $j)    echo '</br><p>Aucun lien de vote n\'est disponible pour ce serveur...</p>';
                    ?>
                                    </div>
                                    <?php } ?>
                            </div>
                        </form>
                    </div>
                    <div class="footer-bloc"> </div>
                    <h3 class="header-bloc">Top voteurs</h3>
                    <div class="corp-bloc">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pseudo</th>
                                    <th>Votes</th>
                                </tr>
                            </thead>
                            <?php for($i = 0; $i < count($topVoteurs) AND $i < 10; $i++) { ?>
                                <tr>
                                    <td>
                                        <?php echo $i ?>
                                    </td>
                                    <td><img src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $topVoteurs[$i]['pseudo']; ?>&s=30&v=front" alt="none" /> <strong><?php echo $topVoteurs[$i]['pseudo']; ?></strong></td>
                                    <td>
                                        <?php echo $topVoteurs[$i]['nbre_votes']; ?>
                                    </td>
                                </tr>
                                <?php }?>
                        </table>
                    </div>
</div>