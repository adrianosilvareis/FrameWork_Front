<?php

/**
 * WsPost.class.php [Beans]
 * 
 * Classe que representa a tabela ws_posts do banco de dados
 * 
 * @copyright (c) year, Adriano S. Reis Programador
 */
class WsPosts extends Beans {

    private $post_id;
    private $post_name;
    private $post_title;
    private $post_content;
    private $post_cover;
    private $post_date;
    private $post_author;
    private $post_category;
    private $post_cat_parent;
    private $post_views;
    private $post_last_views;
    private $post_status;
    private $post_type;

    function __construct() {
        $this->Read = new Read('ws_posts');
    }

    public function getDados() {
        $this->Dados = array_filter(
                [
                    'post_name' => $this->getPost_name(),
                    'post_title' => $this->getPost_title(),
                    'post_content' => $this->getPost_content(),
                    'post_cover' => $this->getPost_cover(),
                    'post_date' => $this->getPost_date(),
                    'post_author' => $this->getPost_author(),
                    'post_category' => $this->getPost_category(),
                    'post_cat_parent' => $this->getPost_cat_parent(),
                    'post_views' => $this->getPost_views(),
                    'post_last_views' => $this->getPost_last_views(),
                    'post_status' => $this->getPost_status(),
                    'post_type' => $this->getPost_type(),
                    'post_id' => $this->getPost_id()
                ]
        );
        return $this->Dados;
    }

    public function setThis($object) {
        $this->setPost_name($object->post_name);
        $this->setPost_title($object->post_title);
        $this->setPost_content($object->post_content);
        $this->setPost_cover($object->post_cover);
        $this->setPost_date($object->post_date);
        $this->setPost_author($object->post_author);
        $this->setPost_category($object->post_category);
        $this->setPost_cat_parent($object->post_cat_parent);
        $this->setPost_views($object->post_views);
        $this->setPost_last_views($object->post_last_views);
        $this->setPost_status($object->post_status);
        $this->setPost_type($object->post_type);
        $this->setPost_id($object->post_id);
    }

    function getPost_id() {
        return $this->post_id;
    }

    function getPost_name() {
        return $this->post_name;
    }

    function getPost_title() {
        return $this->post_title;
    }

    function getPost_content() {
        return $this->post_content;
    }

    function getPost_cover() {
        return $this->post_cover;
    }

    function getPost_date() {
        return $this->post_date;
    }

    function getPost_author() {
        return $this->post_author;
    }

    function getPost_category() {
        return $this->post_category;
    }

    function getPost_cat_parent() {
        return $this->post_cat_parent;
    }

    function getPost_views() {
        return $this->post_views;
    }

    function getPost_last_views() {
        return $this->post_last_views;
    }

    function getPost_status() {
        return $this->post_status;
    }

    function getPost_type() {
        return $this->post_type;
    }

    function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    function setPost_name($post_name) {
        $this->post_name = $post_name;
    }

    function setPost_title($post_title) {
        $this->post_title = $post_title;
    }

    function setPost_content($post_content) {
        $this->post_content = $post_content;
    }

    function setPost_cover($post_cover) {
        $this->post_cover = $post_cover;
    }

    function setPost_date($post_date) {
        $this->post_date = $post_date;
    }

    function setPost_author($post_author) {
        $this->post_author = $post_author;
    }

    function setPost_category($post_category) {
        $this->post_category = $post_category;
    }

    function setPost_cat_parent($post_cat_parent) {
        $this->post_cat_parent = $post_cat_parent;
    }

    function setPost_views($post_views) {
        $this->post_views = $post_views;
    }

    function setPost_last_views($post_last_views) {
        $this->post_last_views = $post_last_views;
    }

    function setPost_status($post_status) {
        $this->post_status = (int) $post_status;
    }

    function setPost_type($post_type) {
        $this->post_type = $post_type;
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
    
}
