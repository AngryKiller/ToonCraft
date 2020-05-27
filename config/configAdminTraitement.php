<?php 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTheme'] == true) 
{
    $ecritureTheme['Pied']['facebook'] = htmlspecialchars($_POST['facebook']);
    $ecritureTheme['Pied']['twitter'] = htmlspecialchars($_POST['twitter']);
    $ecritureTheme['Pied']['youtube'] = htmlspecialchars($_POST['youtube']);
    $ecritureTheme['Pied']['discord'] = htmlspecialchars($_POST['discord']);
    $ecritureTheme['All']['money'] = htmlspecialchars($_POST['money']);
    $ecritureTheme['All']['atout1_nom'] = htmlspecialchars($_POST['atout1_nom']);
    $ecritureTheme['All']['atout2_nom'] = htmlspecialchars($_POST['atout2_nom']);
    $ecritureTheme['All']['atout3_nom'] = htmlspecialchars($_POST['atout3_nom']);
    $ecritureTheme['All']['atout1_text'] = htmlspecialchars($_POST['atout1_text']);
    $ecritureTheme['All']['atout2_text'] = htmlspecialchars($_POST['atout2_text']);
    $ecritureTheme['All']['atout3_text'] = htmlspecialchars($_POST['atout4_text']);
    $ecriture = new Ecrire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml', $ecritureTheme);
}
?>