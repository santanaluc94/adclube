<?php

/**
 * Enable Logo
 */
add_theme_support('custom-logo');

/**
 * Enable thumbnail
 */
add_theme_support('post-thumbnails');

/**
 * Call function to change logo class
 */
add_filter('get_custom_logo', 'change_logo_class');

/**
 * Change logo class
 */
function change_logo_class($html)
{
    $html = str_replace('custom-logo', 'logo-menu', $html);
    $html = str_replace('logo-menu-link', 'logo', $html);

    return $html;
}

/**
 * Create custom posts type - Atleta
 */
function create_post_type()
{
    // Function to create post atletas
    register_post_type(
        'atletas',
        [
            'labels' => [
                'name' => __('Atletas'),
                'singular_name' => __('Atleta'),
                'add_new' => __('Adicionar Atleta'),
                'add_new_item' => __('Adicionar Novo Atleta'),
                'edit_item' => __('Editar Atleta'),
                'all_items' => __('Todos os Atletas'),
                'view_item' => __('Visualizar Atleta'),
                'search_item' => __('Buscar Atleta'),
            ],
            'public' => true,
            'has_archive' => false,
            'rewrite' => ['slug' => 'atleta'],
            'supports' => [
                'editor',
                'thumbnail'
            ]
        ]
    );

    // Function to create post Patrocinadores
    register_post_type(
        'patrocinadores',
        [
            'labels' => [
                'name' => __('Patrocinadores'),
                'singular_name' => __('Patrocinador'),
                'add_new' => __('Adicionar Patrocinador'),
                'add_new_item' => __('Adicionar Novo Patrocinador'),
                'edit_item' => __('Editar Patrocinador'),
                'all_items' => __('Todos os Patrocinadores'),
                'view_item' => __('Visualizar Patrocinador'),
                'search_item' => __('Buscar Patrocinador'),
            ],
            'public' => true,
            'has_archive' => false,
            'rewrite' => ['slug' => 'patrocinador'],
            'supports' => [
                'title',
                'editor',
                'thumbnail'
            ]
        ]
    );
}

/**
 * Call function to create custom posts type
 */
add_action('init', 'create_post_type');

/**
 * Create form to Atletas and Patrocinador in SQL
 */
function register_custom_posts()
{
    add_meta_box(
        'info-atleta',
        'Informações do Atleta',
        'form_atleta',
        'atletas',
        'normal',
        'high'
    );

    add_meta_box(
        'info-patrocinador',
        'Informações do Patrocinador',
        'form_patrocinador',
        'patrocinadores',
        'normal',
        'high'
    );
}

/**
 * Call function to create form to atletas
 */
add_action('add_meta_boxes', 'register_custom_posts');

/**
 * Create form to Atletas in custom post
 */
function form_atleta($post)
{
    $atleta = get_post_meta($post->ID);
?>

    <form method="post">
        <h1>Form atleta</h1>

        <fieldset>
            <div>
                <label>
                    <span>Nome</span>
                </label>
                <input name="nome" id="nome" type="text" value="<?= $atleta['nome'][0] ?>" required />
            </div>

            <div>
                <label>
                    <span>Nome Completo:</span>
                </label>
                <input name="nome_completo" id="nome_completo" type="text" value="<?= $atleta['nome_completo'][0] ?>" required />
            </div>

            <div>
                <label>
                    <span>Altura:</span>
                </label>
                <input name="altura" id="altura" type="text" value="<?= $atleta['altura'][0] ?>" />
                <span>cm</span>
            </div>

            <div>
                <label>
                    <span>Peso:</span>
                </label>
                <input name="peso" id="peso" type="text" value="<?= $atleta['peso'][0] ?>" />
                <span>kg</span>
            </div>

            <div>
                <label>
                    <span>Posição:</span>
                </label>
                <input name="posicao" id="posicao" type="text" value="<?= $atleta['posicao'][0] ?>" />
            </div>

            <div>
                <label>
                    <span>Data de Nascimento:</span>
                </label>
                <input name="data_de_nascimento" id="data_de_nascimento" type="date" value="<?= $atleta['data_de_nascimento'][0] ?>" required />
            </div>
        </fieldset>
    </form>
<?php
}

/**
 * Create form to Atletas in custom post
 */
function form_patrocinador($post)
{
    $patrocinador = get_post_meta($post->ID);
?>

    <form method="post">
        <fieldset>
            <div>
                <label>
                    <span>Site</span>
                </label>
                <input name="site" id="site" type="text" value="<?= $patrocinador['site'][0] ?>" required />
            </div>
        </fieldset>
    </form>
<?php
}

/**
 * Save custom post Atletas in SQL
 */
function save_atletas($post_id)
{
    if (isset($_POST['nome'])) {
        update_post_meta($post_id, 'nome', sanitize_text_field($_POST['nome']));
    }

    if (isset($_POST['nome_completo'])) {
        update_post_meta($post_id, 'nome_completo', sanitize_text_field($_POST['nome_completo']));
    }

    if (isset($_POST['altura'])) {
        update_post_meta($post_id, 'altura', sanitize_text_field($_POST['altura']));
    }

    if (isset($_POST['peso'])) {
        update_post_meta($post_id, 'peso', sanitize_text_field($_POST['peso']));
    }

    if (isset($_POST['posicao'])) {
        update_post_meta($post_id, 'posicao', sanitize_text_field($_POST['posicao']));
    }

    if (isset($_POST['data_de_nascimento'])) {
        update_post_meta($post_id, 'data_de_nascimento', sanitize_text_field($_POST['data_de_nascimento']));
    }
}

/**
 * Call function to save cutom post Atletas in SQL
 */
add_action('save_post', 'save_atletas');


/**
 * Save custom post Patrocinador in SQL
 */
function save_patrocinador($post_id)
{
    if (isset($_POST['site'])) {
        update_post_meta($post_id, 'site', sanitize_text_field($_POST['site']));
    }
}

/**
 * Call function to save cutom post Patrocinador in SQL
 */
add_action('save_post', 'save_patrocinador');
