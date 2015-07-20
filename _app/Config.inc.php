<?php

//CONFIGURACAO DO BANCO ####################
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "wsphp");

//AUTO LOAD DE CALSSES ####################
function __autoload($Class_name) {

    $cDir = ['Conn', 'Helpers', 'Beans', 'Models', 'library'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . "\\{$dirName}\\{$Class_name}.class.php") && !is_dir(__DIR__ . "\\{$dirName}\\{$Class_name}.class.php")):
            require_once(__DIR__ . "\\{$dirName}\\{$Class_name}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possivel inclur {$Class_name}.class.php", E_USER_ERROR);
        die;
    endif;
}

//DEFINE SERVIDOR DE E-MAIL ####################
define('MAILUSER', 'adriano@tommasi.com.br');
define('MAILHOST', 'mail.ita.locaweb.com.br');
define('MAILPASS', 'tommasi0000');
define('MAILPORT', '587');

//DEFINE IDENTIDADE DO SITE ####################
define('SITENAME', 'Cidade Online');
define('SITEDESC', 'Este site foi desenvolvido por Adriano Reis em treinamento por Robson v. Leite UPINSIDE ');

//DEFINE A HOME DO SITE #########################
define('HOME', 'http://localhost:1989/FrameWork_Front');
define('THEME', 'cidadeonline');
define('INCLUDE_PATH', HOME . '/themes/' . THEME);
define('REQUIRE_PATH', 'themes\\' . THEME);

//TRATAMENTO DE ERROS #####################
//CSS Constantes :: Mensagens de Erro
define("WS_ACCEPT", 'accept');
define("WS_INFOR", 'infor');
define("WS_ALERT", 'alert');
define("WS_ERROR", 'error');

//ES ERROR :: Exibe os erros lançados :: FRONT
function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: Personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: {$ErrLine} ::</b> {$ErrMsg} <br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\">{$ErrMsg}</span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
