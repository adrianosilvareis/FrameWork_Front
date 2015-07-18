<?php

class Read extends Controle {

    protected $Termos;

    function __construct($Table = null) {
        $this->Table = $Table;
    }
    
    public function setTable($Table){
        $this->Table = (string) $Table;
    }
    /**
     * <b>
     * #### OBS IMPORTANTE ####
     * 
     * 
     * Ex.: $Termos = "WHERE #nome# AND #telefone# AND #idade#";
     *      $Dados = ['nome' => '%meuNome%','telefone' => '%meuTelefone%','idade' => '%minhaIdade%'];
     * 
     * ou podemos enviar a query completa caso queira usar um comparador diferente de '='.
     * 
     * Ex.: $Termos = WHERE nome like :nome
     *      $Dados = ['nome' => '%parte do Nome%';
     * </b>
     * 
     * @param string $Termos
     * @param array $Dados
     */
    public function Query($Termos, $Dados) {
        $this->Termos = $Termos;
        return $this->newDados($Dados);
    }
    
    public function FullRead($Dados, $Sql) {
        return $this->newDados($Dados, $Sql);
    }

    /**
     * Criar uma busca com novos dados, (Query precisa estar estanciada)
     * 
     * @param array $Dados
     * @return Objetos do banco
     */
    public function newDados($Dados, $Sql = null) {
        if (!is_array($Dados)):
            parse_str($Dados, $Dados);
        endif;

        $this->Dados = $Dados;
        if ($Dados != null):
            $this->getTermos();
        endif;
        if (!$Sql):
            $Sql = "SELECT * FROM {$this->Table} " . $this->Termos;
        endif;
        $this->execute($Sql);
        $this->Result = $this->Stmt->fetchAll();
        return $this->Result;
    }

    /**
     * 
     * @param Nome do campo ID $FildId
     * @return Ultimo Id do Banco
     */
    public function MaxFild($FildId = null) {
        if (!$FildId):
            $FildId = $this->getSyntax()['Id'];
        endif;

        $Sql = "SELECT MAX({$FildId}) FROM {$this->Table}";

        $this->execute($Sql);
        $id = (array) $this->Stmt->fetch();
        sort($id);
        return (int) $id[0];
    }

    public function getResult() {
        return $this->Result;
    }

    public function find(array $Dados) {
        $this->Result = parent::find($Dados);
        return $this->Result;
    }

    public function findAll() {
        $this->Result = parent::findAll();
        return $this->Result;
    }

    protected function getTermos() {
        $Keys = array_keys($this->Dados);

        foreach ($Keys as $values):
            $Condicoes[$values] = "{$values} = :{$values}";
            $Links[] = "#" . $values . "#";
        endforeach;
        $this->Termos = str_replace($Links, $Condicoes, $this->Termos);
    }

}
