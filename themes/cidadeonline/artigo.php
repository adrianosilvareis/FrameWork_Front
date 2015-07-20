<?php
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>
<!--HOME CONTENT-->
<div class="site-container">

    <article class="page_article">


        <div class="art_content">

            <!--CABEÇALHO GERAL-->
            <header>
                <hgroup>
                    <h1><?= $post_title; ?></h1>
                    <div class="img capa">
                        <?= Check::Image('uploads' . DIRECTORY_SEPARATOR . $post_cover, $post_title, 578) ?>
                    </div>
                    <time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>" pubdate>Enviada em: <?= date('d/m/Y H:i', strtotime($post_date)); ?>Hs</time>
                </hgroup>
            </header>


            <!--CONTEUDO-->
            <div class="htmlchars">
                <?= $post_content; ?>
                <!--GALERIA-->
                <?php
                $ReadGb = new WsPostsGallery;
                $ReadGb->setPost_id($post_id);
                $ReadGb->Query("WHERE #post_id# ORDER BY gallery_date DESC");
                if ($ReadGb->getResult()):
                    ?>
                    <section class="gallery">
                        <hgroup>
                            <h3>
                                GALERIA:
                                <p class="tagline">Veja fotos em <mark><?= $post_title; ?></mark></p>
                            </h3>
                        </hgroup>

                        <ul>
                            <?php
                            $gb = 0;
                            foreach ($ReadGb->getResult() as $gallery):
                                $gb++;
                                extract((array) $gallery);
                                ?>
                                <li>
                                    <div class="img">
                                        <a href="<?= HOME ?>/uploads/<?= $gallery_image; ?>" rel="shadowbox[<?= $post_id; ?>]" title="Imagem <?= $gb; ?> do post <?= $post_title; ?>">
                                            <?= Check::Image('uploads' . DIRECTORY_SEPARATOR . $gallery_image, "Imagem {$gb} do post {$post_title}", 120, 80) ?>
                                        </a>
                                    </div>
                                </li>
                                <?php
                            endforeach;
                            ?>
                        </ul>
                        <div class="clear"></div>
                    </section>
                <?php endif; ?>
            </div>

            <!--RELACIONADOS-->
            <footer>
                <nav>
                    <h3>Veja também:</h3>
                    <article>
                        <div class="img">
                            <!--268x165-->
                            <img alt="" title="" src="<?= INCLUDE_PATH; ?>/_tmp/12.jpg" />
                        </div>

                        <header>
                            <h1><a href="<?= HOME ?>/artigo/nome_do_artigo">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                            <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        </header>
                    </article>

                    <article>
                        <div class="img">
                            <!--120x80-->
                            <img alt="" title="" src="<?= INCLUDE_PATH; ?>/_tmp/10.jpg" />
                        </div>

                        <header>
                            <h1><a href="<?= HOME ?>/artigo/nome_do_artigo">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                            <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        </header>
                    </article>
                </nav>
                <div class="clear"></div>
            </footer>


            <!--Comentários aqui-->

        </div><!--art content-->

        <!--SIDEBAR-->
        <?php require(REQUIRE_PATH . '/inc/sidebar.inc.php'); ?>

        <div class="clear"></div>
    </article>

    <div class="clear"></div>
</div><!--/ site container -->