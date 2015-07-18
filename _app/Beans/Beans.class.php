<?php

abstract class Beans {

    /**
     *
     * @var Read 
     */
    protected $Read;
    protected $Dados;

    public function delete($Termos = null) {
        return $this->Read->delete($this->Dados, $Termos);
    }

    public function insert() {
        return $this->Read->insert($this->Dados);
    }

    public function update($Termos = null) {
        return $this->Read->update($this->Dados, $Termos);
    }

    public function Query($Termos) {
        return $this->Read->Query($Termos, $this->Dados);
    }

    public function FullRead($Dados, $Sql) {
        return $this->Read->FullRead($Dados, $Sql);
    }

    public function find() {
        return $this->Read->find($this->Dados);
    }

    public function findAll() {
        return $this->Read->findAll();
    }

    public function newDados() {
        $this->Read->newDados($this->Dados);
    }

    public function getRowCount() {
        return $this->Read->getRowCount();
    }
    
    public function getLastId($FildId = null){
        return $this->Read->MaxFild($FildId);
    }
    
    public function getResult(){
        return $this->Read->getResult();
    }
    
    abstract public function setThis($object);
    
    abstract public function getDados();
  
}