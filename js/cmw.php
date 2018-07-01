<?php 
	if(isset($_Joueur_))
	{
		?>
    <script>
        setInterval(ajax_alerts, 10000);

        function ajax_alerts() {
            var url = '<?php echo $_Serveur_['
            General ']['
            url ']; ?>?action=get_alerts';
            $.post(url, function (data) {
                alerts.innerHTML = data;
                ajax_new_alerts();
            });
        }

        function ajax_new_alerts() {
            var url = '<?php echo $_Serveur_['
            General ']['
            url ']; ?>?action=new_alert';
            $.post(url, function (donnees) {
                if (donnees > 0) {
                    var message = "Vous avez ";
                    message += donnees;
                    message += " nouvelles alertes";
                    toastr["success"](message, "Message Système")
                    toastr.options = {
                        "closeButton": true
                        , "debug": false
                        , "newestOnTop": false
                        , "progressBar": true
                        , "positionClass": "toast-bottom-left"
                        , "preventDuplicates": false
                        , "onclick": null
                        , "showDuration": "1000"
                        , "hideDuration": "1000"
                        , "timeOut": "5000"
                        , "extendedTimeOut": "1000"
                        , "showEasing": "swing"
                        , "hideEasing": "linear"
                        , "showMethod": "fadeIn"
                        , "hideMethod": "fadeOut"
                    }
                }
            });
        }
    </script>
    <?php }
	if(isset($_Joueur_['rang']) AND $_Joueur_['rang'] == 1)
	{
		?>
        <script>
            setInterval(ajax_signalement, 10000);

            function ajax_signalement() {
                var url = '<?php echo $_Serveur_['
                General ']['
                url ']; ?>?action=get_signalement';
                $.post(url, function (signalement) {
                    if (signalement > 0) {
                        signalement.innerHTML = signalement;
                        var message = "Il y'a ";
                        message += signalement;
                        message += ' nouveaux signalements !';
                        toastr["error"](message, "Message système")
                        toastr.options = {
                            "closeButton": true
                            , "debug": true
                            , "newestOnTop": false
                            , "progressBar": true
                            , "positionClass": "toast-top-left"
                            , "preventDuplicates": false
                            , "onclick": null
                            , "showDuration": "1000"
                            , "hideDuration": "1000"
                            , "timeOut": "5000"
                            , "extendedTimeOut": "1000"
                            , "showEasing": "swing"
                            , "hideEasing": "linear"
                            , "showMethod": "fadeIn"
                            , "hideMethod": "fadeOut"
                        }
                    }
                });
            }
        </script>
        <?php 
	}
	?>
            <?php if(urldecode($_GET['ActivateSuccess'])){ ?>
                <script>
                    function ActivateSuccess() {
                        Snarl.addNotification({
                            title: 'Succès'
                            , text: 'Votre compte vient d\'être activé avec succès.'
                            , icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
                        });
                    }
                    window.onload = ActivateSuccess;
                    window.setTimeout("location=('index.php');", 8000);
                </script>
                <?php } elseif(urldecode($_GET['WaitActivate'])) { ?>
                    <script>
                        function WaitActivate() {
                            Snarl.addNotification({
                                title: 'Info'
                                , text: 'Un mail vient de vous être envoyé pour l\'activation de votre compte. Vérifiez dans les Courriers indésirables.'
                                , icon: '<i class="fa fa-info-circle" aria-hidden="true"></i>'
                            });
                        }
                        window.onload = WaitActivate;
                        window.setTimeout("location=('index.php');", 8000);
                    </script>
                    <?php } elseif(urldecode($_GET['ActivateImpossible'])) { ?>
                        <script>
                            function ActivateImpossible() {
                                Snarl.addNotification({
                                    title: 'Erreur'
                                    , text: 'Votre compte ne peut être activé.'
                                    , icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
                                });
                            }
                            window.onload = ActivateImpossible;
                            window.setTimeout("location=('index.php');", 8000);
                        </script>
                        <?php } elseif(urldecode($_GET['MessageEnvoyer'])) { ?>
                            <script>
                                function MessageEnvoyer() {
                                    Snarl.addNotification({
                                        title: 'Succès'
                                        , text: 'Votre commentaire vient d\'être envoyé.'
                                        , icon: '<i class="fa fa-comment" aria-hidden="true"></i>'
                                    });
                                }
                                window.onload = MessageEnvoyer;
                            </script>
                            <?php } elseif(urldecode($_GET['MessageTropLong'])) { ?>
                                <script>
                                    function MessageTropLong() {
                                        Snarl.addNotification({
                                            title: 'Erreur'
                                            , text: 'Votre commentaire est trop long.'
                                            , icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
                                        });
                                    }
                                    window.onload = MessageTropLong;
                                </script>
                                <?php } elseif(urldecode($_GET['MessageTropCourt'])) { ?>
                                    <script>
                                        function MessageTropCourt() {
                                            Snarl.addNotification({
                                                title: 'Erreur'
                                                , text: 'Votre commentaire est trop court.'
                                                , icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
                                            });
                                        }
                                        window.onload = MessageTropCourt;
                                    </script>
                                    <?php } elseif(urldecode($_GET['NotOnline'])) { ?>
                                        <script>
                                            function NotOnline() {
                                                Snarl.addNotification({
                                                    title: 'Erreur'
                                                    , text: 'Vous n\'êtes pas connecté.'
                                                    , icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
                                                });
                                            }
                                            window.onload = NotOnline;
                                        </script>
                                        <?php } elseif(urldecode($_GET['NewsNotExist'])) { ?>
                                            <script>
                                                function NewsNotExist() {
                                                    Snarl.addNotification({
                                                        title: 'Erreur'
                                                        , text: 'Cette nouveauté n\'existe pas.'
                                                        , icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
                                                    });
                                                }
                                                window.onload = NewsNotExist;
                                            </script>
                                            <?php } elseif(urldecode($_GET['LikeExist'])) { ?>
                                                <script>
                                                    function LikeExist() {
                                                        Snarl.addNotification({
                                                            title: 'Erreur'
                                                            , text: 'Votre mention j\'aime est déjà existante.'
                                                            , icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
                                                        });
                                                    }
                                                    window.onload = LikeExist;
                                                </script>
                                                <?php } elseif(urldecode($_GET['LikeAdd'])) { ?>
                                                    <script>
                                                        function LikeAdd() {
                                                            Snarl.addNotification({
                                                                title: 'Succès'
                                                                , text: 'Votre mention j\'aime vient d\'être envoyée.'
                                                                , icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
                                                            });
                                                        }
                                                        window.onload = LikeAdd;
                                                    </script>
                                                    <?php } elseif(urldecode($_GET['SuppressionCommentaire'])) { ?>
                                                        <script>
                                                            function SuppressionCommentaire() {
                                                                Snarl.addNotification({
                                                                    title: 'Succès'
                                                                    , text: 'Votre commentaire vient d\'être supprimé.'
                                                                    , icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
                                                                });
                                                            }
                                                            window.onload = SuppressionCommentaire;
                                                        </script>
                                                        <?php } elseif(urldecode($_GET['SuppressionImpossible'])) { ?>
                                                            <script>
                                                                function SuppressionImpossible() {
                                                                    Snarl.addNotification({
                                                                        title: 'Erreur'
                                                                        , text: 'Le commentaire ne peut être supprimé.'
                                                                        , icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
                                                                    });
                                                                }
                                                            </script>
                                                            <?php } ?>