<?php

get_header();

$post_destaques = [
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category_name' => 'Destaques'
];

$post_noticias = [
    'post_type' => 'post',
    'posts_per_page' => 6,
    'category_name' => 'Matéria'
];
?>

<div class="container container-top">
    <!-- Carrossel de Destaques -->
    <section class="inicio-secao">
        <?php if (have_posts()) : ?>
            <?php $query = new WP_Query($post_destaques); ?>
            <?php if ($query->have_posts()) : ?>
                <?php $post = $posts[0]; ?>
                <?php $contador_carrossel = 0; ?>
                <?php $contador_indicador = 0; ?>

                <div id="carousel-slide" class="carousel slide" style="z-index: 0;">
                    <ol class="carousel-indicators">
                        <?php while ($contador_indicador < 3) : ?>
                            <li data-target="#carousel-slide" data-slide-to="<?= $contador_indicador++; ?>" class="<?php if ($contador_indicador === 1) echo 'active'; ?>"></li>
                        <?php endwhile; ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php while ($query->have_posts()) : ?>
                            <?php $query->the_post(); ?>
                            <div class="carousel-item<?php $contador_carrossel++ ?> <?php if ($contador_carrossel === 1) echo ' active'; ?>">
                                <?php the_post_thumbnail('post_thumbnail', ['id' => 'carousel-img', 'class' => 'carousel-img', 'alt' => 'First Slide']); ?>
                                <div class="carousel-caption">
                                    <a class="link-carrossel" href="<?= get_permalink(); ?>">
                                        <div class="noticia_carrosel">
                                            <h3><?php the_title(); ?></h3>
                                            <span class="d-none d-md-block"><?php the_excerpt(); ?></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php wp_reset_query(); ?>

                    <a class="carousel-control-prev carrossel-botao" href="#carousel-slide" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next carrossel-botao" href="#carousel-slide" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
            <?php else : ?>
                <article class="texto">
                    <p>Não temos nenhuma postagem marcada com "Importante" em Destaques no momento.</p>
                </article>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <!-- Blocos das Matérias -->
    <section class="secao">
        <article class="sub-texto">
            <div class="row titulo-site">
                <h1>
                    <span class="titulo-pagina">Notícias</span>
                </h1>
            </div>

            <?php if (have_posts()) : ?>
                <?php $query = new WP_Query($post_noticias); ?>
                <?php if ($query->have_posts()) : ?>
                    <div class="noticias">
                        <div class="bloco-inferior">
                            <?php $post = $posts[0]; ?>
                            <?php $contador_carrossel = 0; ?>
                            <?php $contador_indicador = 0; ?>
                            <div class="noticias">
                                <?php while ($query->have_posts()) : ?>
                                    <?php $query->the_post(); ?>

                                    <div class="noticia col-md-4">
                                        <a class="texto-noticia" href="<?= get_permalink(); ?>">
                                            <?php the_post_thumbnail('post_thumbnail', ['class' => 'img-noticias']); ?>
                                            <div class="chamada-noticia">
                                                <span><?= the_title() ?></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <article class="texto">
                        <p>Não temos nenhuma postagem marcada como "Matéria" em Destaques no momento.</p>
                    </article>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            <?php endif; ?>
        </article>
    </section>
</div>


</div>
<?php get_footer(); ?>