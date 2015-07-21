<?php

/**
 * Seo.class.php [MODEL]
 * Classe de apoio para o modelo LINK. Pode ser utilizada para gerar SSEO para as páginas do sistem!
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Seo {

    private $File;
    private $Link;
    private $Data;
    private $Tags;

    /* DADOS POVOADOS */
    private $seoTags;
    private $seoData;

    function __construct($File, $Link) {
        $this->File = strip_tags(trim($File));
        $this->Link = strip_tags(trim($Link));
    }

    public function getTags() {
        $this->checkData();
        return $this->seoTags;
    }

    public function getData() {
        $this->checkData();
        return $this->seoData;
    }

    //privates

    private function checkData() {
        if (!$this->seoData):
            $this->getSeo();
        endif;
    }

    private function getSeo() {
        $ReadSeo = new WsPosts;

        switch ($this->File):
            case 'artigo':
                $Admin = (isset($_SESSION['userlogin']['user_level']) && $_SESSION['userlogin']['user_level'] == 3 ? true : false);
                $Check = ($Admin ? '' : 'post_status = 1 AND ');

                $ReadSeo->setPost_name($this->Link);
                $ReadSeo->Query("WHERE {$Check} #post_name#");

                if (!$ReadSeo->getResult()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    extract((array) $ReadSeo->getResult()[0]);
                    $this->seoData = (array) $ReadSeo->getResult()[0];
                    $this->Data = [$post_title . ' - ' . SITENAME, $post_content, HOME . "/artigo/{$post_name}", HOME . "/uploads/{$post_cover}"];

                    //post:: post_views
                    $ReadSeo->setPost_id($post_id);
                    $ReadSeo->setPost_views($post_views + 1);
                    $ReadSeo->setPost_last_views(date('Y-m-d H:i:s'));
                    $ReadSeo->update();
                endif;
                break;

            case 'index':
                $this->Data = [SITENAME . ' - Seu Guia de empresas, eventos e baladas!', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];
                break;

            default :
                $this->Data = ['404 Oppss, Nada encontrado!', SITEDESC, HOME . '/404', INCLUDE_PATH . '/images/site.png'];
                break;

        endswitch;

        if ($this->Data):
            $this->setTags();
        endif;
    }

    private function setTags() {
        $this->Tags['Title'] = $this->Data[0];
        $this->Tags['Content'] = Check::Words(html_entity_decode($this->Data[1]), 25);
        $this->Tags['Link'] = $this->Data[2];
        $this->Tags['Image'] = $this->Data[3];
        $this->Tags = array_map('strip_tags', $this->Tags);
        $this->Tags = array_map('trim', $this->Tags);

        $this->Data = null;

        //NORMAL PAGE
        $this->seoTags = "<title>{$this->Tags['Title']}</title>" . "\n";
        $this->seoTags .= "<meta name='description' content='{$this->Tags['Content']}'/>" . "\n";
        $this->seoTags .= "<meta name='robots' content='index, fallow'/>" . "\n";
        $this->seoTags .= "<link rel='canonical' href='{$this->Tags['Link']}'>" . "\n";
        $this->seoTags .= "\n";

        //FACEBOOK
        $this->seoTags .= "<meta property='og:site_name' content='" . SITENAME . "' />" . "\n";
        $this->seoTags .= "<meta property='og:locale' content='pt-BR' />" . "\n";
        $this->seoTags .= "<meta property='og:title' content='{$this->Tags['Title']}' />" . "\n";
        $this->seoTags .= "<meta property='og:description' content='{$this->Tags['Content']}' />" . "\n";
        $this->seoTags .= "<meta property='og:image' content='{$this->Tags['Image']}' />" . "\n";
        $this->seoTags .= "<meta property='og:url' content='{$this->Tags['Link']}' />" . "\n";
        $this->seoTags .= "<meta property='og:type' content='article' />" . "\n";
        $this->seoTags .= "" . "\n";

        //Item GROUP (TWITTER)
        $this->seoTags .= "<meta itemprop='name' content='{$this->Tags['Title']}' />" . "\n";
        $this->seoTags .= "<meta itemprop='description' content='{$this->Tags['Content']}' />" . "\n";
        $this->seoTags .= "<meta itemprop='url' content='{$this->Tags['Link']}' />" . "\n";

        $this->Tags = null;
    }

}
