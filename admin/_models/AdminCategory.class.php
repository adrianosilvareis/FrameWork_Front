<?php

/**
 * AdminCategory.class.php [ Models Admin ]
 * Responsavel por gerenciar as categorias do sistema no Admin
 *
 * @copyright (c) Adriano, AdrianoReis AdrianoReis Tecnologia
 */
class AdminCategory {

    private $Data;
    private $CatId;
    private $Error;
    private $Result;
    private $Read;

    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao Cadastrar:</b> Para Cadastrar uma categoria, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->setNome();
            $this->Create();
        endif;
    }

    public function ExeUpdate($CategoryId, array $Data) {
        $this->CatId = (int) $CategoryId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria {$this->Data['category_title']}, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->setNome();
            $this->Update();
        endif;
    }

    public function ExeDelete($CategoryId) {
        $this->CatId = (int) $CategoryId;

        $WsCategories = new WsCategories;
        $WsCategories->setCategory_id($this->CatId);
        $WsCategories->Query("WHERE #category_id#");
        if (!$WsCategories->getResult()):
            $this->Result = false;
            $this->Error = ['Oppsss, você tentou remover uma categoria que não existe no sistema!', WS_INFOR];
        else:
            extract((array) $WsCategories->getResult()[0]);
            if (!$category_parent && !$this->checkCats()):
                $this->Result = false;
                $this->Error = ["A <b>seção {$category_title}</b> possui categorias cadastradas. Para deletar, antes altere ou remova todas as categorias filhas!", WS_ALERT];
            elseif ($category_parent && !$this->checkPosts()):
                $this->Result = false;
                $this->Error = ["A <b>categoria {$category_title}</b> possui artigos cadastradas. Para deletar, antes altere ou remova todos os postes desta categoria!", WS_ALERT];
            else:
                $this->Result = true;
                $tipo = ( empty($category_parent) ? 'seção' : 'categoria' );
                $WsCategories->setCategory_id($this->CatId);
                $WsCategories->delete();
                $this->Error = ["A <b>{$tipo} {$category_title}</b> foi removida com sucesso do sistema!", WS_ACCEPT];
            endif;
        endif;
    }

    function getError() {
        return $this->Error;
    }

    function getResult() {
        return $this->Result;
    }

    //private 
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['category_name'] = Check::Name($this->Data['category_title']);
        $this->Data['category_date'] = Check::Data($this->Data['category_date']);
        $this->Data['category_parent'] = ($this->Data['category_parent'] == 'null' ? null : $this->Data['category_parent']);
    }

    private function setNome() {
        $Where = (!empty($this->CatId) ? "category_id != {$this->CatId} AND" : '');
        $this->Read = new WsCategories();
        $this->Read->setCategory_title($this->Data['category_title']);
        $this->Read->Query("WHERE {$Where} #category_title#");
        if ($this->Read->getResult()):
            $this->Data['category_name'] = $this->Data['category_name'] . '-' . $this->Read->getRowCount();
        endif;
    }

    //verifica categorias da seção
    private function checkCats() {
        $Read = new WsCategories;
        $Read->setCategory_parent($this->CatId);
        $Read->Query("WHERE #category_parent#");
        if (isset($Read->getResult()[0])):
            return false;
        else:
            return true;
        endif;
    }

    //verifica artigos da categoria
    private function checkPosts() {
        $readPosts = new WsPosts();
        $readPosts->setPost_category($this->CatId);
        $readPosts->Query("WHERE #post_category#");
        if (isset($readPosts->getResult()[0])):
            return false;
        else:
            return true;
        endif;
    }
    
    //Cadastra a categoria no banco!
    private function Create() {
        $this->Data['category_id'] = null;
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->insert();
        $this->Messagem("cadastrada", $this->Read->getLastId('category_id'), $insert);
    }
    
    //Atualiza Categoria
    private function Update() {
        $this->Data['category_id'] = $this->CatId;
        $this->Read->setThis((object) $this->Data);
        $update = $this->Read->update();
        $this->Messagem("atualizada", $this->Read->getLastId('category_id'), $update);
    }

    private function Messagem($Action, $Return, $Criterio) {
        if ($Criterio):
            $tipo = ( empty($this->Data['category_parent']) ? 'seção' : 'categoria' );
            $this->Result = $Return;
            $this->Error = ["<b>Sucesso:</b> A {$tipo} <b>{$this->Data['category_title']}</b> foi {$Action} no sistema!", WS_ACCEPT];
        endif;
    }

}
