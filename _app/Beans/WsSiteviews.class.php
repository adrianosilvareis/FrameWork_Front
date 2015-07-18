<?php

/**
 * WsSiteviews [Beans]
 * 
 * Classe que representa a tabela ws_Siteviews do banco de dados
 * @copyright (c) year, Adriano S. Reis Programador
 */
class WsSiteviews extends Beans {

    private $siteviews_id;
    private $siteviews_date;
    private $siteviews_users;
    private $siteviews_views;
    private $siteviews_pages;

    function __construct() {
        $this->Read = new Read('ws_siteviews');
    }

    function getSiteviews_id() {
        return (int) $this->siteviews_id;
    }

    function getSiteviews_date() {
        return $this->siteviews_date;
    }

    function getSiteviews_users() {
        return $this->siteviews_users;
    }

    function getSiteviews_views() {
        return $this->siteviews_views;
    }

    function getSiteviews_pages() {
        return $this->siteviews_pages;
    }

    function setSiteviews_id($siteviews_id) {
        $this->siteviews_id = $siteviews_id;
    }

    function setSiteviews_date($siteviews_date) {
        $this->siteviews_date = $siteviews_date;
    }

    function setSiteviews_users($siteviews_users) {
        $this->siteviews_users = $siteviews_users;
    }

    function setSiteviews_views($siteviews_views) {
        $this->siteviews_views = $siteviews_views;
    }

    function setSiteviews_pages($siteviews_pages) {
        $this->siteviews_pages = $siteviews_pages;
    }

    /**
     * o ID deve ser o ultimo dado informado
     */
    public function getDados() {
        $this->Dados = array_filter(
                [
                    'siteviews_date' => $this->getSiteviews_date(),
                    'siteviews_users' => $this->getSiteviews_users(),
                    'siteviews_views' => $this->getSiteviews_views(),
                    'siteviews_pages' => $this->getSiteviews_pages(),
                    'siteviews_id' => $this->getSiteviews_id()
                ]
        );
    }

    public function Query($Termos) {
        $this->getDados();
        return parent::Query($Termos);
    }

    public function delete($Termos = null) {
        $this->getDados();
        return parent::delete($Termos);
    }

    public function find() {
        $this->getDados();
        return parent::find();
    }

    public function findAll() {
        $this->getDados();
        return parent::findAll();
    }

    public function getRowCount() {
        $this->getDados();
        return parent::getRowCount();
    }

    public function insert() {
        $this->getDados();
        return parent::insert();
    }

    public function newDados() {
        $this->getDados();
        parent::newDados();
    }

    public function update($Termos = null) {
        $this->getDados();
        return parent::update($Termos);
    }

    /**
     * 
     * @param WsSiteviews $WsSiteviews
     */
    public function setThis($WsSiteviews) {
       $this->setSiteviews_id((int)$WsSiteviews->siteviews_id);
       $this->setSiteviews_date($WsSiteviews->siteviews_date);
       $this->setSiteviews_users($WsSiteviews->siteviews_users);
       $this->setSiteviews_views($WsSiteviews->siteviews_views);
       $this->setSiteviews_pages($WsSiteviews->siteviews_pages);
    }

}
