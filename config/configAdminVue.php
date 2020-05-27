<?php include('theme/'.$_Serveur_['General']['theme'].'/config/configTheme.php');
?>
<div class="col-xs-12 text-center">
    <div class="panel panel-default cmw-panel">
        <div class="panel-heading cmw-panel-header">
            <h3 class="panel-title"><strong>Configuration du thème</strong></h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="?&action=configTheme"> <!-- ATTENTION AUX DEVELOPPEURS DE THEME : 
                -> Le système est concue pour qu'il n'y est qu'un seul FORM, et c'est celui de cette action ! Donc merci de ne pas créer d'autres form et de tout garder dans ce form avec cette action et en POST ! 
                -> Le fichier de traitement est configAdminTraitement.php il ne peux ni être renommer ni déplacé ! 
                -->
                <div class="row">
                    <label class="control-label">Facebook (URL de votre page Facebook)</label>
                    <input type="text" class="form-control" name="facebook" value="<?php echo $_Theme_['Pied']['facebook']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Twitter (URL de votre compte Twitter)</label>
                    <input type="text" class="form-control" name="twitter" value="<?php echo $_Theme_['Pied']['twitter']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Youtube (URL de votre page Youtube)</label>
                    <input type="text" class="form-control" name="youtube" value="<?php echo $_Theme_['Pied']['youtube']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Discord (URL de votre serveur Discord)</label>
                    <input type="text" class="form-control" name="discord" value="<?php echo $_Theme_['Pied']['discord']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">ATOUT 1 (Nom)</label>
                    <input type="text" class="form-control" name="atout1_nom" value="<?php echo $_Theme_['All']['atout1_nom']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">ATOUT 2 (Nom)</label>
                    <input type="text" class="form-control" name="atout2_nom" value="<?php echo $_Theme_['All']['atout2_nom']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">ATOUT 3 (Nom)</label>
                    <input type="text" class="form-control" name="atout3_nom" value="<?php echo $_Theme_['All']['atout3_nom']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">ATOUT 1 (Texte)</label>
                    <input type="text" class="form-control" name="atout1_text" value="<?php echo $_Theme_['All']['atout1_text']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">ATOUT 2 (Texte)</label>
                    <input type="text" class="form-control" name="atout2_text" value="<?php echo $_Theme_['All']['atout2_text']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">ATOUT 3 (Texte)</label>
                    <input type="text" class="form-control" name="atout4_text" value="<?php echo $_Theme_['All']['atout4_text']; ?>">
                </div>
                <br/>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>