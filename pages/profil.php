<?php
	$getprofil = $_GET['profil'];
	if(isset($_Joueur_) AND $_GET['profil'] == $_Joueur_['pseudo'])
	{
	?>
    <div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
        <div class="container">
            <h1> Profil de <?php echo htmlspecialchars($getprofil); ?> </h1>
            <br/> </div>
    </div>
    <div class="container">
        <div class="categories-edit">
            <ul class="nav nav-tabs" id="modifProfil">
                <li class="col-md-4 active"><a href="#infos" data-toggle="tab">Mes infos</a></li>
                <li class="col-md-4"><a href="#autres" data-toggle="tab">Autres</a></li>
                <li class="col-md-4"><a href="#serveur" data-toggle="tab">Serveur</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="infos">
                <h3 class="header-bloc header-form">Général</h3>
                <form class="form-horizontal" method="post" action="?&action=changeProfil" role="form">
                    <div class="form-group">
                        <div class="row">
                            <label for="pseudo" class="col-md-4 control-label">Pseudo</label>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <?php echo $_Joueur_['pseudo']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 control-label">Mot de Passe</label>
                            <div class="col-md-6 changer-mdp-champ">
                                <input type="password" class="form-control" name="mdpAncien" placeholder="Ancien Mot de Passe">
                                <br/> </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4 control-label">Nouveau</label>
                            <div class="col-md-6 changer-mdp-champ">
                                <input type="password" class="form-control" name="mdpNouveau" placeholder="Nouveau Mot de Passe">
                                <br/> </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4 control-label">Confirmation</label>
                            <div class="col-md-6 changer-mdp-champ">
                                <input type="password" class="form-control" name="mdpConfirme" placeholder="Confirmez-le">
                                <br/> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="inputPassword3" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="inputPassword3" name="email" value="<?php echo $joueurDonnees['email']; ?>"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-5">
                                <button type="submit" class="btn btn-primary validerChange">Valider mes changements</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="autres">
                <h3 class="header-bloc header-form">Autres données personnelles</h3>
                <form class="form-horizontal" method="post" action="?&action=changeProfilAutres" role="form">
                    <div class="form-group">
                        <label for="pseudo" class="col-sm-4 control-label">Skype</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="skype" placeholder="Votre nom d'utilisateur Skype" value="<?php if($joueurDonnees['skype'] != 'inconnu') echo $joueurDonnees['skype']; ?>"> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Age</label>
                        <div class="col-sm-6">
                            <input type="number" name="age" class="form-control" placeholder="17" value="<?php if($joueurDonnees['age'] != 'inconnu') echo $joueurDonnees['age']; ?>"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-5">
                            <button type="submit" class="btn btn-primary validerChange">Valider champs facultatifs</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="serveur">
                </br> Sa arrive mon choux sa arrive ..
                <br /> </div>
            <hr> </div>
        <?php
	}
	?>
            <?php
	if(!isset($_Joueur_) AND $_GET['profil'] != $_Joueur_['pseudo'])
	{?>
                <div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
                    <div class="container">
                        <h1> Profil de <?php echo htmlspecialchars($getprofil); ?> </h1>
                        <br/> </div>
                </div>
                <?php }; ?>
                    <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6 unite-bloc">
                                        <h3 class="header-bloc">Statistiques</h3>
                                        <div class="corp-bloc profil-bloc">
                                            <table class="table">
                                                <tr>
                                                    <td>Statut</td>
                                                    <td>
                                                        <?php echo $serveurProfil['status']; ?>
                                                    </td>
                                                </tr>
                                                </tr>
                                                <td>Âge</td>
                                                <td>
                                                    <?php echo $joueurDonnees['age']; ?>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>Pseudo</td>
                                                    <td>
                                                        <?php echo htmlspecialchars($getprofil); ?>
                                                    </td>
                                                </tr>
                                                <td>Grade Site</td>
                                                <td>
                                                    <?php echo $gradeSite; ?>
                                                </td>
                                                </tr>
                                                <td>Inscription</td>
                                                <td>
                                                    <?php echo 'Le '.date('d/m/Y', $joueurDonnees['anciennete']).' &agrave; '.date('H:i:s', $joueurDonnees['anciennete']); ?>
                                                </td>
                                                </tr>
                                                <td>Email</td>
                                                <td>
                                                    <?php echo $joueurDonnees['email']; ?>
                                                </td>
                                                </tr>
                                                <td>Skype</td>
                                                <td>
                                                    <?php echo $joueurDonnees['skype']; ?>
                                                </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="footer-bloc"> </div>
                                    </div>
                                    <div class="col-md-6 unite-bloc"> <img src="http://api.craftmywebsite.fr/skin/skin.php?u=<?php echo htmlspecialchars($getprofil); ?>&s=1024" style="width: 100%;" alt="none" />
                                        <div class="footer-bloc"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(function () {
                            $('#modifProfil a:first').tab('show')
                        })
                    </script>
    </div>