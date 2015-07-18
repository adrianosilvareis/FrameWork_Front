<?php

/**
 * WsSiteviewsAgent [Beans]
 * 
 * Classe que representa a tabela ws_siteviews_agent do banco de dados
 * @copyright (c) year, Adriano S. Reis Programador
 */
class WsSiteviewsAgent extends Beans {

    private $agent_id;
    private $agent_name;
    private $agent_views;

    function __construct() {
        $this->Read = new Read('ws_siteviews_agent');
    }

    function getAgent_id() {
        return (int) $this->agent_id;
    }

    function getAgent_name() {
        return $this->agent_name;
    }

    function getAgent_views() {
        return $this->agent_views;
    }

    function setAgent_id($agent_id) {
        $this->agent_id = $agent_id;
    }

    function setAgent_name($agent_name) {
        $this->agent_name = $agent_name;
    }

    function setAgent_views($agent_views) {
        $this->agent_views = $agent_views;
    }

    //implements
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

    public function getDados() {
        $this->Dados = array_filter(
                [
                    'agent_name' => $this->getAgent_name(),
                    'agent_views' => $this->getAgent_views(),
                    'agent_id' => $this->getAgent_id()
                ]
        );
    }

    /**
     * 
     * @param WsSiteviewsAgent $object
     */
    public function setThis($object) {
        var_dump($object);
        $this->setAgent_id((int)$object->agent_id);
        $this->setAgent_name($object->agent_name);
        $this->setAgent_views($object->agent_views);
    }

}
