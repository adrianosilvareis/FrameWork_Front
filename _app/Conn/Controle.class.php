<?php

/**
 * Controle [Controle das informações]
 * Camada responsavel por gerenciar as informaçoes do banco
 * @copyright (c) 2015, Adriano S. Reis SunTzu Tecnologia
 */
abstract class Controle extends Business {

    protected $Dados;
    protected $Result;

    /**
     * array atribuitivo com os dados a serem incluidos e seus respectivos campos
     * @param array $Dados
     */
    public function insert(array $Dados) {
        $this->Dados = $Dados;
        $Syntax = $this->getSyntax();
        $sql = "INSERT INTO {$this->Table} ({$Syntax['Fields']}) VALUES ({$Syntax['Places']})";
        return $this->execute($sql);
    }

    /**
     * <b>O ID deve ser o ultimo dado do array</b>
     * 
     * array atribuitivo com todos os dados a ser atualizados, 
     * @param array $Dados
     */
    public function update(array $Dados, $Termos = null) {
        $this->Dados = $Dados;
        $Syntax = $this->getSyntax();
        if (!empty($Termos)):
            $Syntax['Id'] = $Termos;
        endif;

        $sql = "UPDATE {$this->Table} SET {$Syntax['Seter']} WHERE {$Syntax['Id']}";
        return $this->execute($sql);
    }

    /**
     * <b>Atribuição do array é o nome do Id na tabela</b>
     * 
     * array atribuitivo com o ID do valor a ser excluido
     * @param array $Dados
     */
    public function delete(array $Dados, $Termos = null) {
        $this->Dados = $Dados;
        $Syntax = $this->getSyntax();
        if (!empty($Termos)):
            $Syntax['Id'] = $Termos;
        endif;

        $sql = "DELETE FROM {$this->Table} WHERE {$Syntax['Id']}";

        return $this->execute($sql);
    }

    public function getRowCount() {
        return $this->Stmt->RowCount();
    }

    protected function getSyntax() {
        $Keys = array_keys($this->Dados);
        $Fields = implode(', ', $Keys);
        $Places = ':' . implode(', :', $Keys);

        foreach ($Keys as $values):
            $Seter[] = "{$values} = :{$values}";
        endforeach;

        $Id = $Seter[count($Seter) - 1];
        if (count($Seter) > 1):
            unset($Seter[count($Seter) - 1]);
        endif;
        $Seter = implode(', ', $Seter);

        return ['Keys' => $Keys, 'Fields' => $Fields, 'Places' => $Places, 'Seter' => $Seter, 'Id' => $Id];
    }

    /**
     * <b>Faz o preparo do banco antes de executar a query</b>
     * 
     * @param string $sql
     * @return boolean
     */
    protected function execute($sql) {
        $this->Stmt = $this->prepare($sql);
        $param = null;
        if (array_key_exists('limit', $this->Dados)) {
            $Limit = (int) $this->Dados['limit'];
            $this->Stmt->bindParam(':limit', $Limit, PDO::PARAM_INT);
            unset($this->Dados['limit']);
            $param = true;
        }
        if (array_key_exists('offset', $this->Dados)) {
            $Offset = (int) $this->Dados['offset'];
            $this->Stmt->bindParam(':offset', $Offset, PDO::PARAM_INT);
            unset($this->Dados['offset']);
            $param = true;
        }
        
        foreach ($this->Dados as $dado => $value):
            $this->Stmt->bindParam(":{$dado}", $value);
        endforeach;
        $this->Dados = null;
        return $this->commit();
    }

    /**
     * <b>Executa a query preparada</b>
     * 
     * @return boolean
     */
    protected function commit() {
        try {
            $this->Stmt->execute();
            $this->Result = $this->getRowCount();
        } catch (PDOException $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());
            $this->Result = false;
        }
        return $this->Result;
    }

}
