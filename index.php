<?php
session_start();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query  = parse_url($actual_link);
if (isset(parse_url($actual_link)["query"])) {
  $query  = parse_url($actual_link)["query"];
  parse_str($query, $params);
} else {
  $params["page"]="main";
}

require_once('database/connexion.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Site LOG'it !</title>
        <meta charset="utf-8">
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700,900,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <body>


        <!-- BACKGROUND HEADER -->
        <div id="bg-header"></div>


        <!--- WRAPPER -->

        <div id="wrapper">

            <!-- BACKGROUND HEADER -->

            <div id="header">
                <a href="index.php" id="logo">
                    <svg width="120px" height="150px" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 595.3 841.9" style="enable-background:new 0 0 595.3 841.9;" xml:space="preserve">
                        <style type="text/css">
                            .st0{fill:url(#XMLID_2_);}
                        </style>
                        <linearGradient id="XMLID_2_" gradientUnits="userSpaceOnUse" x1="258.7758" y1="200.9743" x2="323.7758" y2="489.9743">
                            <stop  offset="0" style="stop-color:#55C4F1"/>
                            <stop  offset="1" style="stop-color:#0075B6"/>
                        </linearGradient>
                        <path id="XMLID_6_" class="st0" d="M245.6,187.3c-67.6,20.8-105.4,92.5-84.6,160s195.4,199.3,195.4,199.3s70.1-207.1,49.3-274.7
                                                           S313.2,166.5,245.6,187.3z M305.1,380.4c-39.6,12.2-81.6-10-93.8-49.6c-12.2-39.6,10-81.6,49.6-93.8s81.6,10,93.8,49.6
                                                           C366.9,326.2,344.7,368.2,305.1,380.4z"/>
                    </svg>
                </a>
                <h1 id="typo"><span>LOG</span>'IT</h1>

                <div id="login">
                    <a href="?page=proprio_connexion">Se connecter Propriétaire </a>|<a href="?page=locataire_connexion">Se connecter Locataire </a><i class="fa fa-users fa-2x"></i>
                </div>
            </div>

            <!-- PARTIE PRINCIPALE DE LA PAGE QUI CHANGE -->

            <main>
                <!-- PARTIE RECHERCHE FIXE -->
                <?php
                    include 'FC_recherche.php';

//			J'appelle la fonction qui va changer le coeur de la page
                    		
                    include("$params[page].php");
                ?>
            </main>

            <!-- FIN DE SEARCH ZONE -->

        </div>

        </div>

    <!-- FIN DU WRAPPER -->


    <div id="footer">
        FOOTER
    </div>
    </body>
</html>