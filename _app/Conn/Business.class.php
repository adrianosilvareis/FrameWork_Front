<?php

/**
 * Classe que gerencia a negociação com o banco de dados
 *
 * @copyright (c) 2015, Adriano Reis AdrianoReis Tecnologia
 */
abstract class Business extends Conn{

    /** @var string Nome da tabela */
    protected $Table;
    /** @var PDOStatement */
    protected $Stmt;
    
    abstract public function insert( array $Dados );

    abstract public function update( array $Dados );
    
    abstract public function delete( array $Dados );
    
    abstract protected function getSyntax();
    
    abstract protected function execute($sql);
    
    /**
     * <b>O parametro deve ser um array atribuitivo apenas com Id da tabela</b>
     * 
     * @param array $Dados
     * @return array
     */
    public function find(array $Dados) {
        $Condicao = array_keys($Dados)[0];
        $Id = "{$Condicao} = :{$Condicao}";
        
        $sql = "SELECT * FROM $this->Table WHERE {$Id}";
        $this->Stmt = Conn::prepare($sql);
        $this->Stmt->execute($Dados);
        return $this->Stmt->fetch();
    }

    /**
     * <b>Não é passado com os Joins</b>
     * 
     * @return array[Objetos]
     */
    public function findAll() {
        $sql = "SELECT * FROM $this->Table";
        $this->Stmt = Conn::prepare($sql);
        $this->Stmt->execute();
        return $this->Stmt->fetchAll();
    }

}
