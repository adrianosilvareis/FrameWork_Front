<?php

/**
 * WsUsers.class.php [Beans]
 * 
 * Representa a tabela ws_users do branco de dados;
 * 
 * @copyright (c) 2015, Adriano Reis AdrianoReis
 */
class WsUsers extends Beans {

    private $user_id;
    private $user_name;
    private $user_lastname;
    private $user_email;
    private $user_password;
    private $user_registration;
    private $user_lastupdate;
    private $user_level;

    function __construct() {
        $this->Read = new Read('ws_users');
    }

    public function getDados() {
        $this->Dados = array_filter([
            'user_name' => $this->getUser_name(),
            'user_lastname' => $this->getUser_lastname(),
            'user_email' => $this->getUser_email(),
            'user_password' => $this->getUser_password(),
            'user_registration' => $this->getUser_registration(),
            'user_lastupdate' => $this->getUser_lastupdate(),
            'user_level' => $this->getUser_level(),
            'user_id' => $this->getUser_id()
        ]);
        
        return $this->Dados;
    }

    /**
     * 
     * @param WsUser $object
     */
    public function setThis($object) {
        $this->setUser_id($object->user_id);
        $this->setUser_name($object->user_name);
        $this->setUser_lastname($object->user_lastname);
        $this->setUser_email($object->user_email);
        $this->setUser_password($object->user_password);
        $this->setUser_registration($object->user_registration);
        $this->setUser_lastupdate($object->user_lastupdate);
        $this->setUser_level($object->user_level);
    }

    function getUser_id() {
        return (int)$this->user_id;
    }

    function getUser_name() {
        return $this->user_name;
    }

    function getUser_lastname() {
        return $this->user_lastname;
    }

    function getUser_email() {
        return $this->user_email;
    }

    function getUser_password() {
        return $this->user_password;
    }

    function getUser_registration() {
        return $this->user_registration;
    }

    function getUser_lastupdate() {
        return $this->user_lastupdate;
    }

    function getUser_level() {
        return (int)$this->user_level;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setUser_name($user_name) {
        $this->user_name = $user_name;
    }

    function setUser_lastname($user_lastname) {
        $this->user_lastname = $user_lastname;
    }

    function setUser_email($user_email) {
        $this->user_email = $user_email;
    }

    function setUser_password($user_password) {
        $this->user_password = $user_password;
    }

    function setUser_registration($user_registration) {
        $this->user_registration = $user_registration;
    }

    function setUser_lastupdate($user_lastupdate) {
        $this->user_lastupdate = $user_lastupdate;
    }

    function setUser_level($user_level) {
        $this->user_level = $user_level;
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
