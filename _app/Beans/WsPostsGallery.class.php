<?php

/**
 * WsPostsGallery.class.php [Beans]
 * 
 * Classe que representa a tabela ws_posts_gallery do banco de dados
 * 
 * @copyright (c) year, Adriano S. Reis Programador
 */
class WsPostsGallery extends Beans {

    private $post_id;
    private $gallery_id;
    private $gallery_image;
    private $gallery_date;

    function __construct() {
        $this->Read = new Read('ws_posts_gallery');
    }
    
    public function getDados() {
        $this->Dados = array_filter(
                [
                    'post_id' => $this->getPost_id(),
                    'gallery_image' => $this->getGallery_image(),
                    'gallery_date' => $this->getGallery_date(),
                    'gallery_id' => $this->getGallery_id()
                ]
        );
        return $this->Dados;
    }

    public function setThis($object) {
        $this->setPost_id($object->gallery_id);
        $this->setGallery_image($object->gallery_image);
        $this->setGallery_date($object->gallery_date);
        $this->setPost_id($object->post_id);
    }

    function getPost_id() {
        return $this->post_id;
    }

    function getGallery_id() {
        return $this->gallery_id;
    }

    function getGallery_image() {
        return $this->gallery_image;
    }

    function getGallery_date() {
        return $this->gallery_date;
    }

    function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    function setGallery_id($gallery_id) {
        $this->gallery_id = $gallery_id;
    }

    function setGallery_image($gallery_image) {
        $this->gallery_image = $gallery_image;
    }

    function setGallery_date($gallery_date) {
        $this->gallery_date = $gallery_date;
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
