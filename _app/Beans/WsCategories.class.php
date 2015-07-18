<?php

/**
 * WsCategories.class.php [Beans]
 * 
 * Classe que representa a tabela ws_categories do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsCategories extends Beans {

    private $category_id;
    private $category_parent;
    private $category_name;
    private $category_title;
    private $category_content;
    private $category_date;

    function __construct() {
        $this->Read = new Read('ws_categories');
    }

    //get e set
    function getCategory_id() {
        return (int) $this->category_id;
    }

    function getCategory_parent() {
        return $this->category_parent;
    }

    function getCategory_name() {
        return $this->category_name;
    }

    function getCategory_title() {
        return $this->category_title;
    }

    function getCategory_content() {
        return $this->category_content;
    }

    function getCategory_date() {
        return $this->category_date;
    }

    function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }

    function setCategory_parent($category_parent) {
        $this->category_parent = $category_parent;
    }

    function setCategory_name($category_name) {
        $this->category_name = $category_name;
    }

    function setCategory_title($category_title) {
        $this->category_title = $category_title;
    }

    function setCategory_content($category_content) {
        $this->category_content = $category_content;
    }

    function setCategory_date($category_date) {
        $this->category_date = $category_date;
    }

    //privates
    public function getDados() {
        $this->Dados = array_filter(
                [
                    'category_parent' => $this->getCategory_parent(),
                    'category_name' => $this->getCategory_name(),
                    'category_title' => $this->getCategory_title(),
                    'category_content' => $this->getCategory_content(),
                    'category_date' => $this->getCategory_date(),
                    'category_id' => $this->getCategory_id()
                ]
        );
        return $this->Dados;
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
    
    public function getRowCount() {
        $this->getDados();
        return parent::getRowCount();
    }

    /**
     * 
     * @param WsCategories $object
     */
    public function setThis($object) {
        $this->setCategory_id($object->category_id);
        $this->setCategory_parent($object->category_parent);
        $this->setCategory_name($object->category_name);
        $this->setCategory_title($object->category_title);
        $this->setCategory_content($object->category_content);
        $this->setCategory_date($object->category_date);
    }
    
}
