<!DOCTYPE html>
<?php
require_once './_app/Config.inc.php';
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <!--[if lt IE 9]>
            <script src="../../_cdn/html5.js"></script>
         <![endif]-->        

        <?php
        $Link = new Link;
        $Link->getTags();
        ?>
        
        <title>Cidade Online - Eventos, Promoções e Novidades!</title>

        <meta name="description" content="Descrição do site AQUI">
        <meta name="keywords" content="Frases Chave Aqui"> 
        <meta name="author" content="UPINSIDE TECNOLOGIA">
        <meta name="robots" content="index, follow">

        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/reset.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style.css">
        <link rel="stylesheet" href="<?= HOME; ?>/_cdn/shadowbox/shadowbox.css">
        <link href='http://fonts.googleapis.com/css?family=Baumans' rel='stylesheet' type='text/css'>


    </head>
    <body>

        <?php
        require(REQUIRE_PATH . '/inc/header.inc.php');
        
        if(!require($Link->getPatch())):
            WSErro('Erro ao incluir arquivo de navegação!', WS_ERROR, true);
        endif;

        require(REQUIRE_PATH . '/inc/footer.inc.php');
        ?>

    </body>

    <script src="<?= HOME ?>/_cdn/jquery.js"></script>
    <script src="<?= HOME ?>/_cdn/jcycle.js"></script>
    <script src="<?= HOME ?>/_cdn/jmask.js"></script>
    <script src="<?= HOME ?>/_cdn/shadowbox/shadowbox.js"></script>
    <script src="<?= HOME ?>/_cdn/_plugins.conf.js"></script>
    <script src="<?= HOME ?>/_cdn/_scripts.conf.js"></script>

</html><!--NTk4Nw==-->