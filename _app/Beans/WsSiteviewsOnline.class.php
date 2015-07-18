<?php

/**
 * WsSiteviewsOnline [Beans]
 * 
 * Classe que representa a tabela ws_siteviews_online do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsSiteviewsOnline extends Beans{

    private $online_id;
    private $online_session;
    private $online_startview;
    private $online_endview;
    private $online_ip;
    private $online_url;
    private $online_agent;
    private $agent_name;

    function __construct() {
        $this->Read = new Read('ws_siteviews_online');
    }

    //get e set
    function getOnline_id() {
        return (int) $this->online_id;
    }

    function getOnline_session() {
        return $this->online_session;
    }

    function setOnline_session($online_session) {
        $this->online_session = $online_session;
    }

    function getOnline_startview() {
        return $this->online_startview;
    }

    function getOnline_endview() {
        return $this->online_endview;
    }

    function getOnline_ip() {
        return $this->online_ip;
    }

    function getOnline_url() {
        return $this->online_url;
    }

    function getOnline_agent() {
        return $this->online_agent;
    }

    function getAgent_name() {
        return $this->agent_name;
    }

    function setOnline_id($online_id) {
        $this->online_id = $online_id;
    }

    function setOnline_startview($online_startview) {
        $this->online_startview = $online_startview;
    }

    function setOnline_endview($online_endview) {
        $this->online_endview = $online_endview;
    }

    function setOnline_ip($online_ip) {
        $this->online_ip = $online_ip;
    }

    function setOnline_url($online_url) {
        $this->online_url = $online_url;
    }

    function setOnline_agent($online_agent) {
        $this->online_agent = $online_agent;
    }

    function setAgent_name($agent_name) {
        $this->agent_name = $agent_name;
    }

    //private
    public function getDados() {
        $this->Dados = array_filter(
                [
                    'online_startview' => $this->getOnline_startview(),
                    'online_endview' => $this->getOnline_endview(),
                    'online_ip' => $this->getOnline_ip(),
                    'online_url' => $this->getOnline_url(),
                    'online_agent' => $this->getOnline_agent(),
                    'agent_name' => $this->getAgent_name(),
                    'online_session' => $this->getOnline_session(),
                    'online_id' => $this->getOnline_id()
                ]
        );
        return $this->Dados;
    }

    /**
     * 
     * @param WsSiteviewsOnline $object
     */
    public function setThis($object) {
        $this->setOnline_id($object->online_id);
        $this->setOnline_session($object->online_session);
        $this->setOnline_startview($object->online_startview);
        $this->setOnline_endview($object->online_endview);
        $this->setOnline_ip($object->online_ip);
        $this->setOnline_url($object->online_url);
        $this->setOnline_agent($object->online_agent);
        $this->setAgent_name($object->agent_name);
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
}
