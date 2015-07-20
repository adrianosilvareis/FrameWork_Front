<?php

/**
 * Link.class.php [MODEL]
 * Classe responsavel por organizar o SEO do sistema e realizar a navegação
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Link {

    private $Local;
    private $File;
    private $Link;
    private $Patch;

    /** @var SEO */
    private $Tags;

    /** @var SEO */
    private $Data;

    function __construct() {
        $this->Local = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $this->Local = ($this->Local ? $this->Local : 'index');
        $this->Local = explode('/', $this->Local);
        $this->File = (isset($this->Local[0]) ? $this->Local[0] : 'index');
        $this->Link = (isset($this->Local[1]) ? $this->Local[1] : null);
    }

    public function getTags() {
        $this->Tags = new Seo($this->File, $this->Link);
        $this->Tags = $this->Tags->getTags();
        echo $this->Tags;
    }

    public function getData() {
        $this->Data = new Seo($this->File, $this->Link);
        $this->Data = $this->Data->getData();
        return $this->Data;
    }

    function getLocal() {
        return $this->Local;
    }

    function getPatch() {
        $this->setPatch();
        return $this->Patch;
    }

    //privates

    private function setPatch() {
        if (file_exists(REQUIRE_PATH . '\\' . $this->File . '.php')):
            $this->Patch = REQUIRE_PATH . '\\' . $this->File . '.php';
        elseif (file_exists(REQUIRE_PATH . '\\' . $this->File . '\\' . $this->Link . '.php')):
            $this->Patch = REQUIRE_PATH . '\\' . $this->File . '\\' . $this->Link . '.php';
        else:
            $this->Patch = REQUIRE_PATH . '\\404.php';
        endif;
    }

}
