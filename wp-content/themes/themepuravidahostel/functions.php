<?php

    // USUÁRIO: puravidah2
    // SENHA: Pur@369vi

    $_domain_i = 'localhost';

    $_domain_ii = 'puravidahostel.com.br';

    if ($_SERVER['HTTP_HOST'] === trim($_domain_i) || $_SERVER['HTTP_HOST'] === trim($_domain_ii)):

        // Modo classico do admin
        add_filter('use_block_editor_for_post_type', '__return_false', 100);

        // Não carregue folhas de estilo relacionadas ao Gutenberg
        add_action('wp_enqueue_scripts', function () {
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('wc-block-style');
            wp_dequeue_style('storefront-gutenberg-blocks');
        }, 100);

        add_filter('show_admin_bar', '__return_false');

        // Remove páginas admin
        add_action('admin_menu', function () {
            // remove_menu_page('index.php');
            remove_menu_page('jetpack');
            // remove_menu_page('edit.php');
            // remove_menu_page('upload.php');
            // remove_menu_page('edit.php?post_type=page');
            remove_menu_page('edit-comments.php');
            // remove_menu_page('themes.php');
            // remove_menu_page('plugins.php');
            // remove_menu_page('users.php');
            // remove_menu_page('tools.php');
            // remove_menu_page('options-general.php');
        });

        // Google Analytic
        add_action('wp_footer', function () {
        });

        // Rodapé do admin
        add_filter('admin_footer_text', function () {
            echo orange_helpdesk ([
                'company' => [
                    'title' => 'Clockwork Orange Development',
                    'href' => 'clockworkorange.com.br',
                ],
                'whatsapp' => [
                    'message' => 'Estou precisando de ajuda.',
                    'number' => '5511940058153',
                ],
            ]);
        });

        add_action('wp_head', function () {
            $is_ico_path = '/images/favicon.ico';
            echo file_exists(__DIR__ . $is_ico_path) ? orange_config_selector (
                [
                    'rel' => [
                        'Shortcut',
                        'Icon',
                    ],
                    'type' => 'image/x-icon',
                    'href' => get_template_directory_uri() . $is_ico_path,
                ],
                [
                    'closed' => false,
                    'content' => '',
                    'name' => 'link',
                ],
            ) : '';
        });

        add_filter('excerpt_more', function () {
            return '<p>' . '' . '</p>';
        });

        // Versão do wordpress
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', function () {
            return '';
        });
        function sunset_remove_wp_version_strings ($src) {
            global $wp_version;
            parse_str(parse_url($src, PHP_URL_QUERY), $query);
            if (!empty($query['ver']) && $query['ver'] === $wp_version):
                $src = remove_query_arg('ver', $src);
            endif;
            return $src;
        }
        add_filter('script_loader_src', 'sunset_remove_wp_version_strings');
        add_filter('style_loader_src', 'sunset_remove_wp_version_strings');

        // Adicione um favicon para seu site
        add_action('wp_head', function () {
            echo '<link rel=\'shortcut icon\' type=\'image/x-icon\' href=\'' . '' . '\' />';
        });

        // Adicionar campo no perfil
        // add_filter('user_contactmethods', function ($field) {
        //     $field['facebook']  = 'Facebook';
        //     return $field;
        // });

        // Remover campo no perfil
        // add_filter('user_contactmethods', function ($field) {
        //     unset($field['facebook']);
        //     return $field;
        // });

        // Campo resumo na página
        add_action('init', function () {
            add_post_type_support('page', [
                'author',
                'excerpt',
                'comments',
            ]);
        });

        add_filter('manage_edit-post_columns', function ($column) {
            unset($column['author']);
            unset($column['categories']);
            unset($column['comments']);
            unset($column['date']);
            unset($column['tags']);
            return $column;
        });

        add_filter('manage_pages_columns', function ($column) {
            unset($column['author']);
            unset($column['comments']);
            unset($column['date']);
            return $column;
        });

        // Formato de post
        // add_action('after_setup_theme', function () {
        //     add_theme_support('post-formats', [
        //         'aside',
        //         'gallery',
        //         'link',
        //         'image',
        //         'quote',
        //         'status',
        //         'video',
        //         'audio',
        //         'chat'
        //     ]);
        // });

        // Imagem destacada
        add_action('after_setup_theme', function () {
            add_theme_support('post-thumbnails', [
                'page',
                'post',
                // 'movie',
            ]);
        });

        // Definimos um nome, a largura e altura
        // add_image_size('tamanho-personalizado-2', 220, 180, true);

        // Menu personalizado
        // register_nav_menus([
        //     'menu_1' => 'Primeiro Menu',
        //     'menu_2' => 'Segundo Menu',
        // ]);

        $lorem = '';
        $lorem .= ' Lorem ipsum dolor sit amet,';
        $lorem .= ' consectetur adipiscing elit.';
        $lorem .= ' Vestibulum eget quam id quam ultrices condimentum ac vitae tortor.';
        $lorem .= ' Lorem ipsum dolor sit amet,';
        $lorem .= ' consectetur adipiscing elit.';
        $lorem .= ' Vestibulum eget quam id quam ultrices condimentum ac vitae tortor.';

        function orange_require_php_archive ($object) {
            return file_exists(str_replace('\\', '/', __DIR__ . '/' . trim($object['archive'])))
            ? require_once str_replace('\\', '/', __DIR__ . '/' . trim($object['archive']))
            : '';
        };

        function orange_require_json_archive ($object) {
            return file_exists(str_replace('\\', '/', __DIR__ . '/' . trim($object['archive'])))
            ? json_decode(file_get_contents(str_replace('\\', '/', __DIR__ . '/' . trim($object['archive']))))
            : [];
        };

        $JSON = orange_require_json_archive ([ 'archive' => 'data.json' ]);

        class variable {
            const column = 4;
            const dimension = 26.075;
            const unity = 'rem';
            const number = [
                'drop' => [
                    'height' => (self::dimension - self::column) / self::column . self::unity,
                    'width' => (self::dimension - self::column) / self::column . self::unity,
                ],
                'margin' => 1 . self::unity,
                'thumbnail' => [
                    'height' => self::dimension . self::unity,
                    'width' => self::dimension . self::unity,
                ],
            ];
            const attribute = [
                'alt',
                'allow',
                'height',
                'src',
                'title',
                'width',
            ];
        };

        function is_true_variable ($is_variable) {
            if (!$is_variable):
                return false;
            elseif (is_array($is_variable)):
                if (empty($is_variable)):
                    return false;
                else:
                    return true;
                endif;
            elseif (is_null($is_variable)):
                return false;
            else:
                return true;
            endif;
        };

        function is_same ($is_first, $is_second) {
            return trim($is_first) === trim($is_second);
        }

        function is_true_key ($object, $key) {
            if (array_key_exists($key, $object))
                if (is_true_variable($object[$key]))
                    return true;
        };

        function is_last_word ($is_string, $is_type) {
            return substr($is_string, strlen($is_string) - strlen($is_type), strlen($is_string)) === $is_type;
        };

        function is_first_word ($is_string, $is_type) {
            return substr($is_string, 0, strlen($is_type)) === $is_type;
        };

        function orange_search_form ($object) {
            $is_return = '';
            if (is_true_key($object, 'name')):
                $is_return .= '<form action=\'' . get_home_url( '/' ) . '\' class=\'d-flex\' method=\'get\'>';
                    $is_return .= '<input';
                        $is_return .= ' aria-label=\'Search\'';
                        $is_return .= ' class=\'form-control me-2\'';
                        $is_return .= ' id=\'search\'';
                        $is_return .= ' name=\'s\'';
                        $is_return .= ' placeholder=\'' . ucfirst(trim($object['name'])) . '\'';
                        $is_return .= ' type=\'search\'';
                        $is_return .= ' value=\'' . get_search_query() . '\'';
                    $is_return .= '>';
                    $is_return .= '<button class=\'btn btn-outline-secondary bg-white\' type=\'submit\'>';
                        $is_return .= ucfirst(trim($object['name']));
                    $is_return .= '</button>';
                $is_return .= '</form>';
            endif;
            return $is_return;
        };

        function orange_metatags () {
            global $JSON;
            $is_return = '';
            $is_return .= orange_config_selector (
                [
                    'name' => 'author',
                    'content' => is_true_variable(get_bloginfo('name'))
                    ? trim(get_bloginfo('name'))
                    : trim($JSON->hostel->title),
                ],
                [
                    'closed' => false,
                    'content' => '',
                    'name' => 'meta',
                ],
            );
            $is_return .= orange_config_selector (
                [
                    'name' => 'description',
                    'content' => is_true_variable(get_bloginfo('description'))
                    ? trim(get_bloginfo('description'))
                    : trim($JSON->hostel->description),
                ],
                [
                    'closed' => false,
                    'content' => '',
                    'name' => 'meta',
                ],
            );

            $is_keyword = '';
            for ($x = 0; $x < (is_true_variable($JSON->app->meta->object) ? sizeof($JSON->app->meta->object) : 0); $x++):
                for ($y = 0; $y < (is_true_variable($JSON->app->meta->genre) ? sizeof($JSON->app->meta->genre) : 0); $y++):
                    for ($z = 0; $z < (is_true_variable($JSON->app->meta->place) ? sizeof($JSON->app->meta->place) : 0); $z++):
                        $is_keyword .= trim($JSON->app->meta->object[$x]);
                        $is_keyword .= is_true_variable($JSON->app->meta->genre[$y]) ? ' ' : '';
                        $is_keyword .= trim($JSON->app->meta->genre[$y]);
                        $is_keyword .= is_true_variable($JSON->app->meta->place[$z]) ? ' ' : '';
                        $is_keyword .= trim($JSON->app->meta->place[$z]);
                        $is_keyword .=
                        $x < sizeof($JSON->app->meta->object) - 1 ||
                        $y < sizeof($JSON->app->meta->genre) - 1 ||
                        $z < sizeof($JSON->app->meta->place) - 1 ? ', ' : '';
                    endfor;
                endfor;
            endfor;

            $is_return .= is_true_variable($JSON->app->meta->object) || is_true_variable($JSON->app->meta->genre) || is_true_variable($JSON->app->meta->place) ? orange_config_selector (
                [
                    'name' => 'keywords',
                    'content' => $is_keyword,
                ],
                [
                    'closed' => false,
                    'content' => '',
                    'name' => 'meta',
                ],
            ) : '';

            $is_return .= '<meta name=\'robots\' content=\'index, follow\'>';
            $is_return .= '<meta name=\'viewport\' content=\'width=device-width, initial-scale=1, shrink-to-fit=no\'>';
            $is_return .= '<meta http-equiv=\'Content-Type\' content=\'text/html; charset=utf-8\'>';
            return $is_return;
        };

        function orange_head () {
            echo '<head>';
                echo orange_metatags();
                echo orange_stylesheets();
                wp_head();
            echo '</head>';
        };

        function orange_youtube_channel ($object) {
            $is_return = '';
            $is_random = array_rand($object);
            $is_src = str_replace([
                'https://www.youtube.com/watch?v=',
                'https://youtu.be/',
            ], 'https://www.youtube.com/embed/', trim($object[$is_random]->src));
            $is_src .= '?controls=0';
            $is_return .= orange_config_selector (
                [
                    'allow' => [
                        'accelerometer;',
                        'autoplay;',
                        'clipboard-write;',
                        'encrypted-media;',
                        'gyroscope;',
                        'picture-in-picture;',
                    ],
                    'src' => $is_src,
                ],
                [
                    'closed' => true,
                    'content' => '',
                    'name' => 'iframe',
                ],
            );
            return $is_return;
        };
        
        add_action('widgets_init', function () {
            global $JSON;
            class Widget { public $title, $amount; };
            function widgets_list ($object) {
                $n = 0;
                $array = [];
                for ($i = 0; $i < $object->amount; $i++):
                    $array[$n] = new Widget();
                    $array[$n]->title = $object->title;
                    $array[$n]->amount = $object->amount;
                    $n++;
                endfor;
                return $array;
            };
            class Element { public $amount, $array, $title; };
            $is_index = [];
            for ($i = 0; $i < sizeof($JSON->app->widgets); $i++):
                $is_index[$i] = new Element();
                $is_index[$i]->title = $JSON->app->widgets[$i]->title;
                $is_index[$i]->amount = $JSON->app->widgets[$i]->amount;
            endfor;
            $is_indexes = [];
            for ($i = 0; $i < count($is_index); $i++):
                array_push($is_indexes, ...widgets_list($is_index[$i]));
            endfor;
            for ($x = 0; $x < count($is_indexes); $x++):
                for ($y = 0; $y < $is_indexes[$x]->amount; $y++):
                    if (!$is_indexes[$x]->amount): else:
                        $is_ID = '';
                        $is_ID .= strtolower(str_replace(' ', '-', $is_indexes[$x]->title));
                        $is_ID .= '-';
                        $is_ID .= $y;
                        register_sidebar([
                            'name' => $is_ID,
                            'id' => $is_ID,
                            'description' => __('', ''),
                            'beforetitle' => '<h5 class="widget-title">',
                            'aftertitle' => '</h5>',
                            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
                            'after_widget' => '</div>',
                        ]);
                    endif;
                endfor;
            endfor;
        });

        function orange_highlight ($object) {
            $is_return = is_true_key($object, 'content') ? $object['content'] : '';
            if (is_true_key($object, 'array')):
                $is_array = [];
                for ($i = 0; $i < sizeof($object['array']); $i++)
                    array_push($is_array, strtolower($object['array'][$i]));
                for ($i = 0; $i < sizeof($object['array']); $i++)
                    array_push($is_array, strtoupper($object['array'][$i]));
                for ($i = 0; $i < sizeof($object['array']); $i++)
                    array_push($is_array, ucfirst($object['array'][$i]));
                for ($i = 0; $i < sizeof($object['array']); $i++)
                    array_push($is_array, ucwords($object['array'][$i]));
                for ($i = 0; $i < sizeof($is_array); $i++):
                    $is_index = trim($is_array[$i]);
                    $is_replace = '';
                    $is_replace .= '<em>';
                    $is_replace .= $is_index;
                    $is_replace .= '</em>';
                    $is_return = str_replace($is_index, $is_replace, $is_return);
                endfor;
            endif;
            return $is_return;
        };

        function orange_text_content ($object) {
            global $JSON;
            $is_return = '';
            $is_return .= is_true_key ($object, 'wrapper') ? orange_wrapper($object['wrapper']) : '';
            $is_return .= is_true_key ($object, 'url') ? orange_config_selector($object['url'], [ 'closed' => false, 'name' => 'a' ]) : '';
            $n = 5; $h = [];
            for ($i = 1; $i < 9; $i++): if ($i === $n): else: array_push($h, 'h' . $i . '>'); endif; endfor;
            $is_content = str_replace($h, 'h' . $n . '>', trim($object['content']));
            $selector = is_true_variable($JSON->app->clear) ? $JSON->app->clear : [];
            for ($i = 0; $i < sizeof($selector); $i++)
                $is_content = str_replace([ '<' . $selector[$i] . '>', '</' . $selector[$i] . '>' ], '', $is_content);
            $is_content = str_replace('<li>', '<li><p>', $is_content);
            $is_content = str_replace('</li>', '</p></li>', $is_content);
            $is_content = str_replace('<p><p>', '<p>', $is_content);
            $is_content = str_replace('</p></p>', '</p>', $is_content);
            $is_content = str_replace('width="600"', '', $is_content);
            $is_content = str_replace('height="450"', '', $is_content);
            $is_content = str_replace('style="border:0;"', '', $is_content);
            $is_content = str_replace('allowfullscreen=""', '', $is_content);
            $is_content = str_replace('loading="lazy"', '', $is_content);
            $is_content = str_replace('referrerpolicy="no-referrer-when-downgrade"', '', $is_content);
            $is_content = is_true_variable($JSON->app->highlight)
            ? orange_highlight([ 'array' => $JSON->app->highlight, 'content' => $is_content, ])
            : $is_content;
            $is_return .= is_true_key ($object, 'content') ? $is_content : '';
            $is_return .= is_true_key ($object, 'url') ? '</a>' : '';
            $is_return .= is_true_key ($object, 'wrapper') ? orange_wrapper($object['wrapper'], 'closed') : '';
            return $is_return;
        };

        function orange_categories_list () {
            $is_return = '';
            if (empty(get_the_category())): else:
                $is_return .= '<div class=\'categories-list\'>';
                    $is_return .= '<p>';
                        $is_value = '';
                        foreach (get_the_category() as $category):
                            $is_value .= orange_config_selector (
                                [
                                    'href' => esc_url(get_category_link($category->term_id)),
                                    'title' => esc_attr(sprintf(__("View all posts in %s"), $category->name)),
                                ],
                                [
                                    'closed' => true,
                                    'content' => trim($category->cat_name),
                                    'name' => 'a',
                                ],
                            );
                            $is_value .= ', ';
                        endforeach;
                        $is_return .= trim($is_value, ', ');
                    $is_return .= '</p>';
                $is_return .= '</div>';
            endif;
            return $is_return;
        };

        function orange_javascripts () {
            $is_return = '';
            global $is_archivename;
            $is_return .= orange_url_archive([
                [ 'src' => 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', ],
                [ 'src' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', ],
                [ 'module' => true, 'src' => 'https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js', ],
                [ 'src' => 'https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js', ],
            ]);
            $is_return .= orange_sever_archive([
                [ 'archive' => '--script.js', 'folder' => 'javascripts', 'module' => true, ],
                [ 'archive' => ($is_archivename . '.js'), 'folder' => 'javascripts', 'module' => true, ],
            ]);
            return $is_return;
        };

        function orange_stylesheets () {
            $is_return = '';
            global $is_archivename;
            $is_return .= orange_url_archive([
                [ 'src' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', ],
                [ 'src' => 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', ],
                [ 'src' => 'https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css', ],
            ]);
            $is_return .= orange_sever_archive([
                [ 'archive' => '--style.css', 'folder' => 'stylesheets' ],
                [ 'archive' => ($is_archivename . '.css'), 'folder' => 'stylesheets', ],
            ]);
            return $is_return;
        };

        function orange_side_button_config ($object, $string = 'top') {
            $is_array = [];
            for ($i = 0 ; $i < sizeof($object); $i++):
                if (is_true_variable($object[$i]->active)):
                    array_push($is_array, $object[$i]);
                endif;
            endfor;
            $is_return = '';
            for ($i = 0 ; $i < sizeof($is_array); $i++):
                $is_return .= is_true_variable($is_array[$i]->url) ? orange_config_selector (
                    [
                        'href' => esc_url(trim($is_array[$i]->url)),
                        'target' => is_true_variable($is_array[$i]->target) ? '_blank' : '',
                    ],
                    [
                        'closed' => false,
                        'name' => 'a',
                    ],
                ) : '';
                $is_return .= orange_config_selector (
                    [
                        'class' => 'side-button',
                        'id' => is_true_variable($is_array[$i]->id) ? trim($is_array[$i]->id) : '',
                        'data-animation' => 'side-button',
                        'style' => [
                            'right' => '1rem',
                            trim($string) => 'calc(calc(3rem + 1rem) * ' . $i . ' + 1rem)',
                        ],
                    ],
                    [
                        'closed' => true,
                        'content' => orange_config_selector (
                            [
                                'name' => trim($is_array[$i]->name),
                            ],
                            [
                                'closed' => true,
                                'name' => 'ion-icon',
                            ],
                        ),
                        'name' => 'div',
                    ],
                );
                $is_return .= is_true_variable($is_array[$i]->url) ? '</a>' : '';
            endfor;
            return $is_return;
        };

        function orange_side_button () {
            global $JSON;
            $is_return = '';
            $is_return .= orange_side_button_config($JSON->app->sidebar->up, 'top');
            $is_return .= orange_side_button_config($JSON->app->sidebar->bottom, 'bottom');
            return $is_return;
        };

        function orange_sever_archive ($object) {
            $is_return = '';
            for ($i = 0; $i < sizeof($object); $i++):
                $is_path = '';
                if (is_true_key($object[$i], 'folder')):
                    $is_path .= '/';
                    $is_path .= trim($object[$i]['folder'], '/');
                endif;
                if (is_true_key($object[$i], 'archive')):
                    $is_path .= '/';
                    $is_path .= trim($object[$i]['archive']);
                    if (is_last_word($object[$i]['archive'], '.css')):
                        $is_return .= file_exists(__DIR__ . $is_path) ? orange_config_selector(
                            [
                                'rel' => 'stylesheet',
                                'href' => esc_url(get_template_directory_uri() . $is_path),
                            ],
                            [
                                'closed' => false,
                                'name' => 'link',
                            ],
                        ) : '';
                    endif;
                    if (is_last_word($object[$i]['archive'], '.js')):
                        $is_return .= file_exists(__DIR__ . $is_path) ? orange_config_selector (
                            [
                                'src' => esc_url(get_template_directory_uri() . $is_path),
                                'type' => is_true_key($object[$i], 'module') ? 'module' : '',
                            ],
                            [
                                'closed' => true,
                                'content' => '',
                                'name' => 'script',
                            ],
                        ) : '';
                    endif;
                endif;
            endfor;
            return $is_return;
        };

        function orange_url_archive ($object) {
            $is_return = '';
            for ($i = 0; $i < sizeof($object); $i++):
                if (is_true_key($object[$i], 'src')):
                    if (is_last_word($object[$i]['src'], 'css')):
                        $is_return .= orange_config_selector (
                            [
                                'rel' => 'stylesheet',
                                'href' => esc_url(trim($object[$i]['src'])),
                            ],
                            [
                                'closed' => false,
                                'name' => 'link',
                            ],
                        );
                    endif;
                    if (is_last_word($object[$i]['src'], 'js')):
                        $is_return .= orange_config_selector (
                            [
                                'src' => esc_url(trim($object[$i]['src'])),
                                'type' => is_true_key($object[$i], 'module') ? 'module' : '',
                            ],
                            [
                                'closed' => true,
                                'content' => '',
                                'name' => 'script',
                            ],
                        );
                    endif;
                endif;
            endfor;
            return $is_return;
        };

        function orange_config_selector ($object, $selector = [ 'closed' => true, 'content' => '', 'name' => 'div' ]) {
            $is_return = '';
            $is_return .= is_true_key($selector, 'name') ? '<' . strtolower(trim($selector['name'])) : '';
            if (is_array($object)):
                if (empty($object)): else:
                    $x = 0;
                    foreach ($object as $key => $value):
                        $is_return .= !$x ? ' ' : '';
                        if (is_true_variable($value)):
                            $is_return .= $key;
                            $is_return .= '=\'';
                                if (is_array($value)):
                                    $y = 0;
                                    foreach ($value as $key => $value):
                                        $is_return .= !$y ? '' : ' ';
                                        if (is_true_variable($value)):
                                            if (is_int($key)): else:
                                                $is_return .= $key;
                                                $is_return .= ': ';
                                            endif;
                                            $is_return .= $value;
                                            if (is_int($key)): else:
                                                $is_return .= ';';
                                            endif;
                                        endif;
                                        $y++;
                                    endforeach;
                                elseif (is_string($value)):
                                    $is_return .= $value;
                                endif;
                            $is_return .= '\'';
                        endif;
                        $x++;
                    endforeach;
                endif;
            endif;
            $is_return .= is_true_key($selector, 'name') ? '>' : '';
            if (is_true_key($selector, 'closed')):
                $is_return .= is_true_key($selector, 'content') ? $selector['content'] : '';
                $is_return .= is_true_key($selector, 'name') ? '</' . strtolower(trim($selector['name'])) . '>' : '';
            endif;
            return $is_return;
        };

        function orange_category_button_list () {
            $is_return = '';
            $is_query = new WP_Query([ 'cat' => get_queried_object_id() ]);
            if ($is_query->have_posts()):
                while ($is_query->have_posts()):
                    $is_query->the_post();
                    $is_return .= orange_config_selector (
                        [
                            'class' => 'item-menu',
                            'href' => '#' . get_post_field('post_name', get_post()),
                        ],
                        [
                            'closed' => true,
                            'content' => is_true_variable(get_post_field('_secondary_title', get_post()))
                            ? get_post_field('_secondary_title', get_post())
                            : get_post_field('post_title', get_post()),
                            'name' => 'a',
                        ],
                    );
                endwhile;
                wp_reset_postdata();
            endif;
            return ($is_query->post_count > 1) ? orange_config_selector (
                [ 'class' => 'post-itemsmenu', ],
                [
                    'closed' => true,
                    'content' => $is_return,
                    'name' => 'div',
                ],
            ) : '';
        };

        function orange_category_main_post_list ($object) {
            $is_wrapper = '';
            $is_query = new WP_Query([ 'cat' => is_true_key($object, 'id') ? $object['id'] : 1 ]);
            if ($is_query->have_posts()):
                while ($is_query->have_posts()):
                    $is_query->the_post();
                    $is_content = '';
                    if (is_true_variable(get_the_post_thumbnail_url())):
                        $is_content .= orange_config_selector (
                            [ 'class' => 'main-title', ],
                            [
                                'closed' => true,
                                'content' => orange_config_selector (
                                    [ 'href' => get_the_permalink(), ],
                                    [
                                        'closed' => true,
                                        'content' => orange_text_content([
                                            'content' => get_post_field('post_title', get_post()),
                                            'wrapper' => [ 'h4' ],
                                        ]),
                                        'name' => 'a',
                                    ],
                                ),
                                'name' => 'div',
                            ],
                        );
                        $is_content .= orange_config_selector (
                            [
                                'class' => 'main-content',
                                'style' => orange_style_background ([
                                    'type' => 'thumbnail',
                                    'url' => get_the_post_thumbnail_url()
                                ]),
                            ],
                            [
                                'closed' => true,
                                'content' => '',
                                'name' => 'div',
                            ],
                        );
                        $is_wrapper .= orange_config_selector (
                            [
                                'class' => 'main-wrapper',
                                'style' => [
                                    'height' => variable::number['thumbnail']['height'],
                                    'width' => variable::number['thumbnail']['width'],
                                ],
                            ],
                            [
                                'closed' => true,
                                'content' => $is_content,
                                'name' => 'div'
                            ],
                        );
                    endif;
                endwhile;
                wp_reset_postdata();
            endif;
            $is_container = '';
            if (is_true_variable($is_wrapper)):
                $is_container .= orange_config_selector (
                    [],
                    [
                        'closed' => true,
                        'content' => orange_text_content([
                            'content' => get_cat_name($object['id']),
                            'wrapper' => [
                                'h3',
                            ],
                        ]),
                        'name' => '',
                    ],
                );
                $is_container .= orange_config_selector (
                    [ 'class' => 'main-container', ],
                    [
                        'closed' => true,
                        'content' => $is_wrapper,
                        'name' => 'div',
                    ],
                );
            endif;
            return is_true_variable($is_container) ? orange_config_selector (
                [
                    "style" => [
                        'margin' => '0 0 1rem 0',
                        'padding' => '1rem 1rem 0 1rem',
                    ],

                ],
                [
                    'closed' => true,
                    'content' => $is_container,
                    'name' => 'section',
                ],
            ) : '';
        };

        function orange_category_widget_post_list ($object) {
            $is_return = '';
            for ($i = 0; $i < sizeof($object['array']); $i++):
                $is_query = new WP_Query([ 'cat' => $object['array'][$i] ]);
                if ($is_query->have_posts()):
                    $is_return .= '<div class=\'widget-wrapper\'>';
                        $is_return .= '<ul>';
                            $is_return .= orange_config_selector (
                                [],
                                [
                                    'closed' => true,
                                    'content' => orange_text_content([
                                        'content' => ucwords(get_cat_name($object['array'][$i])) . ':',
                                        'wrapper' => [ 'p', 'b' ],
                                    ]),
                                    'name' => 'li',
                                ],
                            );
                            while ($is_query->have_posts()):
                                $is_query->the_post();
                                $is_post_title = '';
                                if (is_true_variable(get_post_field('post_title', get_post()))):
                                    $is_post_title .= ucwords(trim(get_post_field('post_title', get_post())));
                                endif;
                                $is_content = '';
                                $is_content .= is_true_variable($is_post_title) ? orange_config_selector (
                                    [],
                                    [
                                        'closed' => true,
                                        'content' => orange_text_content([
                                            'content' => $is_post_title,
                                            'wrapper' => [],
                                        ]),
                                        'name' => '',
                                    ],
                                ) : '';
                                $is_secondary_title = '';
                                if (is_true_variable(get_post_field('_secondary_title', get_post()))):
                                    $is_secondary_title .= '&nbsp;';
                                    $is_secondary_title .= '(';
                                    $is_secondary_title .= strtolower(trim(get_post_field('_secondary_title', get_post())));
                                    $is_secondary_title .= ')';
                                endif;
                                $is_content .= is_true_variable($is_secondary_title) ? orange_config_selector (
                                    [],
                                    [
                                        'closed' => true,
                                        'content' => orange_text_content([
                                            'content' => $is_secondary_title,
                                            'wrapper' => [ 'em' ],
                                        ]),
                                        'name' => '',
                                    ],
                                ) : '';
                                if ($is_query->post_count <= 1): else:
                                    $is_content .= $is_query->current_post < $is_query->post_count - 1 ? ', ' : '.';
                                endif;
                                $is_post_content = 0;
                                $is_post_content += is_true_variable(get_post_field('post_content', get_post())) ? 1 : 0;
                                $is_post_content += is_true_variable(get_post_field('post_excerpt', get_post())) ? 1 : 0;
                                $is_content = is_true_variable($is_post_content) ? orange_config_selector (
                                    [
                                        'href' => get_the_permalink(),
                                    ],
                                    [
                                        'closed' => true,
                                        'content' => $is_content,
                                        'name' => 'a',
                                    ],
                                ) : $is_content;
                                $is_return .= orange_config_selector (
                                    [],
                                    [
                                        'closed' => true,
                                        'content' => $is_content,
                                        'name' => 'li',
                                    ],
                                );
                            endwhile;
                            wp_reset_postdata();
                        $is_return .= '</ul>';
                    $is_return .= '</div>';
                endif;
            endfor;
            return $is_return;
        };

        function orange_format_phone_number ($object) {
            $is_return = '';
            if (is_true_variable($object)):
                $is_return .= '+';
                $is_return .= substr(trim($object), 0, 2);
                $is_return .= ' ';
                $is_return .= '(';
                $is_return .= substr(trim($object), 2, 2);
                $is_return .= ')';
                $is_return .= ' ';
                $is_return .= substr(trim($object), 4, 1);
                $is_return .= ' ';
                $is_return .= substr(trim($object), 5, 4);
                $is_return .= '-';
                $is_return .= substr(trim($object), 9, 4);
            endif;
            return $is_return;
        }

        function orange_helpdesk ($object) {
            $is_return = '';
            if (is_true_key($object, 'company')):
                if (is_true_key($object['company'], 'title')):
                    $is_return .= '<p>';
                        $is_return .= is_true_key($object['company'], 'href') ? '<a href=\'https://' . trim($object['company']['href']) . '/\' target=\'_blank\'>' : '';
                            $is_return .= trim($object['company']['title']);
                        $is_return .= is_true_key($object['company'], 'href') ? '</a>' : '';
                    $is_return .= '</p>';
                endif;
            endif;
            if (is_true_key($object, 'whatsapp')):
                if (is_true_key($object['whatsapp'], 'number') && is_true_key($object['whatsapp'], 'message')):
                    $is_return .= '<p>';
                        $is_return .= '<a href=\'https://api.whatsapp.com/send?phone=' . trim($object['whatsapp']['number']) . '&text=' . trim($object['whatsapp']['message']) . '\' target=\'_blank\'>';
                            $is_return .= orange_format_phone_number($object['whatsapp']['number']);
                        $is_return .= '</a>';
                    $is_return .= '</p>';
                endif;
            endif;
            return $is_return;
        };

        function orange_powered ($object) {
            global $JSON;
            $is_return = '';
            if (is_true_variable(get_bloginfo('name'))):
                $is_return .= '<div id=\'powered\'>';
                    $is_content = '&copy;';
                    $is_content .= '&nbsp;';
                    $is_content .= date_i18n('Y');
                    $is_name = '&nbsp;';
                    $is_name .= is_true_variable(get_bloginfo('name')) ? trim(get_bloginfo('name')) : trim($JSON->hostel->title);
                    $is_description = '&nbsp;';
                    $is_description .= '|';
                    $is_description .= '&nbsp;';
                    $is_description .= is_true_variable(get_bloginfo('description')) ? trim(get_bloginfo('description')) : trim($JSON->hostel->description);
                    $is_content .= is_true_variable(trim($is_name)) ? trim($is_name) : '';
                    $is_content .= is_true_variable(trim($is_description)) ? trim($is_description) : '';
                    $is_return .= orange_config_selector(
                        [],
                        [
                            'closed' => true,
                            'content' => orange_text_content([
                                'content' => $is_content,
                                'wrapper' => [ 'p' ],
                            ]),
                            'name' => '',
                        ],
                    );
                    if (is_true_key($object, 'date')):
                        if (strtotime($object['date']) <= strtotime((new DateTime('NOW'))->format('Y-m-d'))):
                            if (is_true_key($object, 'powered') && is_true_key($object, 'url')):
                                $is_powered = '';
                                $is_powered .= 'Powered by';
                                $is_powered .= '&nbsp;';
                                $is_powered .= orange_config_selector (
                                    [
                                        'href' => esc_url($object['url']),
                                        'target' => '_blank',
                                    ],
                                    [
                                        'closed' => true,
                                        'content' => trim($object['powered']),
                                        'name' => 'a',
                                    ],
                                );
                                $is_return .= orange_config_selector (
                                    [],
                                    [
                                        'closed' => true,
                                        'content' => $is_powered,
                                        'name' => 'p',
                                    ],
                                );
                            endif;
                        endif;
                    endif;
                $is_return .= '</div>';
            endif;
            return $is_return;
        };

        function orange_widget_content ($id) {
            $is_return = '';
            foreach (wp_get_sidebars_widgets()[$id] as $key):
                $is_widget = get_option('widget_' . _get_widget_id_base($key))[str_replace(_get_widget_id_base($key) . '-', '', $key)]['content'];
                $is_widget = str_replace([ '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>', '<h7>', '<h8>', '<h9>' ], '<h6>', $is_widget);
                $is_widget = str_replace([ '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>', '</h7>', '</h8>', '</h9>' ], '</h6>', $is_widget);
                $is_return .= $is_widget;
            endforeach;
            return $is_return;
        }

        function orange_widget ($object) {
            $is_return = '';
            for ($i = 0; $i < (is_true_key($object, 'number') ? $object['number'] : 1); $i++):
                $is_ID = '';
                $is_ID .= is_true_key($object, 'id') ? trim($object['id']) : 'widget';
                $is_ID .= '-';
                $is_ID .= $i;
                $is_return .= is_active_sidebar($is_ID) ? orange_config_selector(
                    [
                        'class' => 'widget-container',
                    ],
                    [
                        'closed' => true,
                        'content' => orange_widget_content($is_ID),
                        'name' => 'div',
                    ],
                ) : '';
            endfor;
            return $is_return;
        };

        function orange_widget_check ($object) {
            for ($i = 0; $i < sizeof($object['array']); $i++):
                if (is_first_word($object['array'][$i]->title, $object['index'])):
                    return is_true_variable($object['array'][$i]->amount) ? $object['array'][$i]->amount : 1;
                endif;
            endfor;
        }




        function orange_widget_list ($object) {
            $is_return = '';
            if(is_true_key($object, 'array')):
                for ($i = 0; $i < sizeof($object['array']); $i++):
                    $is_return .= is_true_variable($object['array'][$i]->title) ? orange_config_selector (
                        [],
                        [
                            'closed' => true,
                            'content' => orange_text_content([
                                'content' => $object['array'][$i]->title . ':',
                                'wrapper' => [ 'p', 'b' ],
                            ]),
                            'name' => 'div',
                        ],
                    ) : '';
                    $is_return .= orange_wp_list([
                        'type' => $object['type'],
                        'exclude' => $object['array'][$i]->exclude,
                        'wrapper' => [ 'ul' ],
                    ]);
                endfor;
            endif;
            return $is_return;
        };

        function orange_run_sentences ($object) {
            $is_return = '';
            if (is_true_variable($object['array'])):
                for ($i = 0; $i < sizeof($object['array']); $i++):
                    $is_return .= is_true_variable($object['array'][$i]) ? orange_config_selector (
                        [],
                        [
                            'closed' => true,
                            'content' => trim($object['array'][$i]),
                            'name' => 'p',
                        ],
                    ) : '';
                endfor;
            endif;
            return $is_return;
        };

        function orange_whatsApp ($object) {
            $is_return = '';
            if (is_true_key($object, 'phone')):
                $is_return .= '<p>';
                    $is_return .= orange_config_selector (
                        [],
                        [
                            'closed' => true,
                            'content' => __('O nosso WhatsApp é:'),
                            'name' => 'em',
                        ],
                    );
                    $is_return .= '<br>';

                    $is_return .= '<b>';
                        $is_return .= '<a';
                            $is_return .= ' href=\'';
                                $is_return .= 'https://api.whatsapp.com/send?phone=' . trim($object['phone']);
                                $is_return .= is_true_key($object, 'text') ? '&text=' . trim($object['text']) : '';
                            $is_return .= '\'';
                            $is_return .= ' target=\'_blank\'';
                        $is_return .= '>';
                            $is_return .= orange_format_phone_number($object['phone']);
                        $is_return .= '</a>';
                    $is_return .= '</b>';

                $is_return .= '</p>';
            endif;
            return $is_return;
        };

        function orange_footer () {
            global $JSON;
            $is_return = '';
            $is_return .= '<footer>';
                $is_return .= '<div id=\'footer-row\'>';
                    $is_return .= orange_widget([
                        'id' => 'footer',
                        'number' => orange_widget_check ([
                            'array' => $JSON->app->widgets,
                            'index' => 'footer',
                        ]),
                    ]);
                    $is_return .= '<div class=\'widget-container\' id=\'widget-attention\' >';
                        $is_return .= orange_whatsApp ([ 'phone' => $JSON->hostel->whatsapp->phone, 'text' => $JSON->hostel->whatsapp->text ]);
                        $is_return .= is_true_variable(orange_run_sentences([ 'array' => $JSON->app->attention ]))
                        ? orange_run_sentences([ 'array' => $JSON->app->attention ])
                        : '';
                        $is_return .= orange_config_selector (
                            [ 'class' => 'widget-wrapper' ],
                            [
                                'closed' => true,
                                'content' => orange_config_selector (
                                    [
                                        'id' => 'reservation-content',
                                    ],
                                    [
                                        'closed' => true,
                                        'content' => orange_reservation_form([]),
                                        'name' => 'div',
                                    ],
                                ),
                                'name' => 'div',
                            ],
                        );
                        $is_return .= orange_category_widget_post_list([ 'array' => $JSON->app->widget->attention ]);
                    $is_return .= '</div>';
                    $is_return .= is_true_variable($JSON->app->sidebar->up) ? orange_config_selector (
                        [
                            'class' => 'widget-container',
                            'id' => 'widget-channels',
                        ],
                        [
                            'closed' => true,
                            'content' => is_true_variable($JSON->app->sidebar->up)
                            ? orange_drop_list ([ 'array' => $JSON->app->sidebar->up, ])
                            : '',
                            'name' => 'div',
                        ],
                    ) : '';
                    $is_content = '';
                    // $is_content .= orange_widget_list ([
                    //     'array' => $JSON->app->category,
                    //     'type' => 'category',
                    // ]);
                    $is_content .= orange_widget_list ([
                        'array' => $JSON->app->page,
                        'type' => 'page',
                    ]);
                    $is_content .= orange_category_widget_post_list([ 'array' => $JSON->app->widget->navigation ]);
                    $is_return .= is_true_variable($is_content) ? orange_config_selector (
                        [
                            'class' => 'widget-container',
                            'id' => 'widget-navigation',
                        ],
                        [
                            'closed' => true,
                            'content' => $is_content,
                            'name' => 'div',
                        ],
                    ) : '';
                    $is_content = '';
                    $is_content .= is_true_variable($JSON->hostel->maps) ? orange_config_selector (
                        [ 'class' => 'widget-wrapper' ],
                        [
                            'closed' => true,
                            'content' => orange_config_selector (
                                [ 'src' => trim($JSON->hostel->maps), ],
                                [
                                    'closed' => true,
                                    'content' => '',
                                    'name' => 'iframe',
                                ],
                            ),
                            'name' => 'div',
                        ],
                    ) : '';
                    $is_content .= is_true_variable($JSON->hostel->address) ? orange_text_content([
                        'content' => trim($JSON->hostel->address),
                        'wrapper' => [ 'address', 'p' ],
                    ]) : '';
                    $is_return .= is_true_variable($is_content) ? orange_config_selector(
                        [
                            'class' => 'widget-container',
                            'id' => 'widget-localization',
                        ],
                        [
                            'closed' => true,
                            'content' => $is_content,
                            'name' => 'div',
                        ],
                    ) : '';
                    $is_content = '';
                    $is_content .= is_true_variable($JSON->youtube->iframe) ? orange_config_selector(
                        [ 'class' => 'widget-wrapper' ],
                        [
                            'closed' => true,
                            'content' => orange_youtube_channel($JSON->youtube->iframe),
                            'name' => 'div',
                        ],
                    ) : '';
                    $is_content .= is_true_variable($JSON->youtube->description) ? orange_text_content([
                        'content' => trim($JSON->youtube->description),
                        'wrapper' => [ 'p' ],
                    ]) : '';
                    $is_return .= is_true_variable($is_content) ? orange_config_selector (
                        [
                            'class' => [
                                'widget-container',
                                'last',
                            ],
                            'id' => 'widget-youtube',
                        ],
                        [
                            'closed' => true,
                            'content' => $is_content,
                            'name' => 'div',
                        ],
                    ) : '';
                $is_return .= '</div>';
            $is_return .= '</footer>';
            $is_return .= orange_powered([
                'date' => '2022-06-10',
                // 'date' => '2022-02-28',
                'powered' => 'Clockwork Orange Development',
                'url' => 'https://clockworkorange.com.br/',
            ]);
            $is_return .= orange_config_selector([ 'style' => [ 'height' => '3rem' ], 'id' => 'footer', ]);
            return $is_return;
        };

        function orange_wrapper ($object, $string = 'open') {
            $is_return = '';
            if (is_first_word($string, 'open')):
                if (is_array($object)):
                    for ($i = 0; $i <= sizeof($object) - 1; $i++)
                        $is_return .= '<' . trim($object[$i]) . '>';
                elseif (is_string($object)):
                    $is_return .= '<' . trim($object) . '>';
                endif;
            endif;
            if (is_first_word($string, 'closed')):
                if (is_array($object)):
                    for ($i = sizeof($object) - 1; $i >= 0; $i--)
                        $is_return .= '</' . trim($object[$i]) . '>';
                elseif (is_string($object)):
                    $is_return .= '</' . trim($object) . '>';
                endif;                    
            endif;
            return $is_return;
        };

        function orange_exclude_ids ($object) {
            $is_return = '';
            for ($i = 0; $i < sizeof($object); $i++):
                $is_return .= trim($object[$i]);
                $is_return .= $i < sizeof($object) - 1 ? ', ' : '';
            endfor;
            return $is_return;
        }

        function orange_wp_list ($object) {
            $is_return = '';
            $is_return .= is_true_key($object, 'wrapper') ? orange_wrapper($object['wrapper']) : '';
            if (is_true_key($object, 'type')):
                if ($object['type'] === 'category'):
                    $is_return .= orange_config_selector (
                        [],
                        [
                            'closed' => true,
                            'content' => orange_config_selector (
                                [
                                    'href' => get_home_url( '/' ),
                                    'class' => [
                                        !is_true_key($object, 'wrapper') ? 'nav-link' : '',
                                    ],
                                ],
                                [
                                    'closed' => true,
                                    'content' => 'O Hostel',
                                    'name' => 'a',
                                ],
                            ),
                            'name' => 'li',
                        ],
                    );
                    $is_return .= wp_list_categories([
                        'child_of' => 0,
                        'current_category' => 0,
                        'depth' => 0,
                        'echo' => 0,
                        'exclude' => is_true_key($object, 'exclude') ? orange_exclude_ids($object['exclude']) : '',
                        'exclude_tree' => '',
                        'feed' => '',
                        'feed_image' => '',
                        'feed_type' => '',
                        'hide_empty' => true,
                        'hide_title_if_empty' => true,
                        'hierarchical' => true,
                        'order' => 'ASC',
                        'orderby' => 'name',
                        'separator' => '<br />',
                        'show_count' => 0,
                        'show_option_all' => '',
                        'show_option_none' => '',
                        'style' => 'list',
                        'taxonomy' => 'category',
                        'title_li' => '',
                        'use_desc_for_title' => 0,
                    ]);
                elseif ($object['type'] === 'page'):
                    $is_return .= wp_list_pages([
                        'depth' => 0,
                        'show_date' => '',
                        'date_format' => get_option('date_format'),
                        'child_of' => 0,
                        'exclude' => is_true_key($object, 'exclude') ? orange_exclude_ids($object['exclude']) : '',
                        'title_li' => '',
                        'echo' => 0,
                        'authors' => '',
                        'sort_column' => 'menu_order, post_title',
                        'link_before' => '',
                        'link_after' => '',
                        'item_spacing' => 'preserve',
                        'walker' => '',
                    ]);
                elseif ($object['type'] === 'bookmark'):
                    $is_return .= wp_list_bookmarks([
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'limit' => -1,
                        'category' => '',
                        'exclude_category' => '',
                        'category_name' => '',
                        'hide_invisible' => 1,
                        'show_updated' => 0,
                        'echo' => 0,
                        'categorize' => 1,
                        'title_li' => '',
                        'title_before' => '',
                        'title_after' => '',
                        'category_orderby' => 'name',
                        'category_order' => 'ASC',
                        'class' => 'linkcat',
                        'category_before' => '<li id="%id" class="%class">',
                        'category_after' => '</li>',
                    ]);
                elseif ($object['type'] === 'menu'):
                    $is_return .= wp_page_menu([
                        'sort_column' => 'menu_order, post_title',
                        'menu_id' => '',
                        'menu_class' => 'menu',
                        'container' => 'div',
                        'echo' => 0,
                        'link_before' => '',
                        'link_after' => '',
                        'before' => '<ul>',
                        'after' => '</ul>',
                        'item_spacing' => 'discard',
                        'walker' => '',
                    ]);
                elseif ($object['type'] === 'cloud'):
                    $is_return .= wp_tag_cloud([
                        'smallest' => 8,
                        'largest' => 22,
                        'unit' => 'pt',
                        'number' => 45,
                        'format' => 'flat',
                        'separator' => '\n',
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'exclude' => is_true_key($object, 'exclude') ? orange_exclude_ids($object['exclude']) : '',
                        'include' => '',
                        'link' => 'view',
                        'taxonomy' => 'post_tag',
                        'post_type' => '',
                        'echo' => 0,
                        'show_count' => 0,
                    ]);
                endif;
            endif;
            $is_return .= is_true_key($object, 'wrapper') ? orange_wrapper($object['wrapper'], 'closed') : '';
            return $is_return;
        };

        function orange_post_info ($object) {
            $is_title = '';
            if (is_true_variable(get_the_author_meta('first_name'))):
                $is_title .= get_the_author_meta('first_name');
                if (is_true_variable(get_the_author_meta('last_name'))):
                    $is_title .= ' ';
                    $is_title .= get_the_author_meta('last_name');
                endif;
            elseif (is_true_variable(get_the_author_meta('user_nicename'))):
                $is_title .= get_the_author_meta('user_nicename');
            endif;
            $is_active = 0;
            if (is_category() || is_single()):
                if (is_true_key($object, 'date')):
                    $is_active++;
                endif;
                if (is_true_key($object, 'author')):
                    $is_active++;
                endif;
            endif;
            if (is_user_logged_in()):
                if (is_true_key($object, 'edit')):
                    $is_active++;
                endif;
            endif;
            $is_return = '';
            $is_return .= is_true_variable($is_active) ? '<div class=\'post-info\'>' : '';
            if (is_category() || is_single()):
                if (is_true_key($object, 'date')):
                    $is_return .= orange_text_content([
                        'content' => get_the_date(),
                        'wrapper' => 'p',
                    ]);
                endif;
                if (is_true_key($object, 'author')):
                    $is_return .= orange_text_content([
                        'content' => $is_title,
                        'url' => [
                            'href' => get_author_posts_url(get_the_author_meta('ID')),
                        ],
                        'wrapper' => 'p',
                    ]);
                endif;
            endif;
            if (is_user_logged_in()):
                if (is_true_key($object, 'edit')):
                    $is_return .= orange_text_content([
                        'content' => 'edit',
                        'url' => [
                            'href' => get_edit_post_link(),
                        ],
                        'wrapper' => 'p',
                    ]);
                endif;
            endif;
            $is_return .= is_true_variable($is_active) ? '</div>' : '';
            return $is_return;
        };

        function orange_modal ($object) {
            $is_return = '';
            $is_return .= '<div class=\'modal\' tabindex=\'-1\'>';
                $is_return .= '<div class=\'modal-dialog\'>';
                    $is_return .= '<div class=\'modal-content\'>';
                        $is_return .= '<div class=\'modal-header\'>';
                            $is_return .= is_true_key($object, 'title') ? '<h5>' . $object['title'] . '</h5>' : '';
                            $is_return .= '<button type=\'button\' class=\'btn-close\' data-bs-dismiss=\'modal\' aria-label=\'Close\'></button>';
                        $is_return .= '</div>';
                        if (is_true_key($object, 'body')):
                            $is_return .= '<div class=\'modal-body\'>';
                                $is_return .= $object['body'];
                            $is_return .= '</div>';
                        endif;
                        $is_return .= '<div class=\'modal-footer\'>';
                            $is_return .= '<button type=\'button\' class=\'btn btn-secondary\' data-bs-dismiss=\'modal\'>' . 'Close' . '</button>';
                            $is_return .= '<button type=\'button\' class=\'btn btn-primary\'>' . 'Save' . '</button>';
                        $is_return .= '</div>';
                    $is_return .= '</div>';
                $is_return .= '</div>';
            $is_return .= '</div>';
            return $is_return;
        };

        // FABIO

        function orange_reservation_form ($object) {
            $is_return = '';
            $is_return .= '<form action=\'https://booking.hqbeds.com.br/puravida\' method=\'get\' name=\'bookingForm\' class=\'form-horizontal form-validate\' target=\'_blank\' accept-charset=\'utf-8\'>';


                    // <div class="container">
                    // <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    // <div class="col">Column</div>
                    // <div class="col">Column</div>
                    // <div class="col">Column</div>
                    // <div class="col">Column</div>
                    // </div>
                    // </div>


                $is_return .= '<div class=\'row\'>';
                    $is_return .= '<div class=\'col p-0 me-3\'>';
                        $is_return .= '<div class=\'input-group' . (is_true_key($object, 'header') ? '' : ' mb-3') . '\'>';
                                $is_return .= '<span class=\'input-group-text\'>' . __('Chegada') . '</span>';
                                $is_return .= '<input type=\'date\' class=\'form-control\' name=\'arrival\' id=\'arrival\' value=\'\'>';
                        $is_return .= '</div>';
                    $is_return .= '</div>';
                    $is_return .= is_true_key($object, 'header') ? '<div class=\'col p-0 me-3\'>' : '';
                        $is_return .= '<div class=\'input-group' . (is_true_key($object, 'header') ? '' : ' mb-3') . '\'>';
                                $is_return .= '<span class=\'input-group-text\'>' . __('Partida') . '</span>';
                                $is_return .= '<input type=\'date\' class=\'form-control\' name=\'departure\' id=\'departure\' value=\'\'>';
                        $is_return .= '</div>';
                    $is_return .= is_true_key($object, 'header') ? '</div>' : '';
                    $is_return .= '<div class=\'col p-0\'>';
                        $is_return .= '<button type=\'submit\' class=\'btn btn-outline-secondary\'>' . __('Checar disponibilidade') . '</button>';
                    $is_return .= '</div>';
                $is_return .= '</div>';




                // $is_return .= '<div class=\'row\'>';
                //     $is_return .= is_true_key($object, 'header') ? '<div class=\'col p-0 me-3\'>' : '';
                //         $is_return .= '<div class=\'input-group' . (is_true_key($object, 'header') ? '' : ' mb-3') . '\'>';
                //                 $is_return .= '<span class=\'input-group-text\'>' . __('Chegada') . '</span>';
                //                 $is_return .= '<input type=\'date\' class=\'form-control\' name=\'arrival\' id=\'arrival\' value=\'\'>';
                //         $is_return .= '</div>';
                //     $is_return .= is_true_key($object, 'header') ? '</div>' : '';
                //     $is_return .= is_true_key($object, 'header') ? '<div class=\'col p-0 me-3\'>' : '';
                //         $is_return .= '<div class=\'input-group' . (is_true_key($object, 'header') ? '' : ' mb-3') . '\'>';
                //                 $is_return .= '<span class=\'input-group-text\'>' . __('Partida') . '</span>';
                //                 $is_return .= '<input type=\'date\' class=\'form-control\' name=\'departure\' id=\'departure\' value=\'\'>';
                //         $is_return .= '</div>';
                //     $is_return .= is_true_key($object, 'header') ? '</div>' : '';
                //     $is_return .= '<div class=\'col p-0\'>';
                //         $is_return .= '<button type=\'submit\' class=\'btn btn-outline-secondary\'>' . __('Checar disponibilidade') . '</button>';
                //     $is_return .= '</div>';
                // $is_return .= '</div>';




                
            $is_return .= '</form>';
            // $is_return .= '<form action=\'https://admin.hqbeds.com.br/pt-br/hqb/D9pyRQdZmQ/availability\' method=\'get\' target=\'_blank\'>';
            //     $is_return .= '<div class=\'input-group\' id=\'reservation-date\'>';
            //             $is_return .= '<span class=\'input-group-text\'>';
            //                 $is_return .= __('Chegada');
            //             $is_return .= '</span>';
            //             $is_return .= '<input type=\'date\' class=\'form-control\' name=\'arrival\' id=\'arrival\' value=\'\'>';
            //     $is_return .= '</div>';
            //     $is_return .= '<div class=\'input-group\' id=\'reservation-number\'>';
            //             $is_return .= '<span class=\'input-group-text\'>';
            //                 $is_return .= __('Noites');
            //             $is_return .= '</span>';
            //             $is_return .= '<select class=\'form-control\' name=\'nights\'>';
            //                 for ($i = 0; $i < 31; $i++):
            //                     $is_return .= '<option';
            //                         $is_return .= ' value=\'' . ($i + 1) . '\'';
            //                         $is_return .= !$i ? ' selected' : '';
            //                     $is_return .= '>';
            //                     $is_return .= $i + 1;
            //                     $is_return .= '</option>';
            //                 endfor;
            //             $is_return .= '</select>';
            //     $is_return .= '</div>';
            //     $is_return .= '<div id=\'reservation-check\'>';
            //         $is_return .= '<button type=\'submit\' class=\'btn btn-outline-secondary\'>';
            //             $is_return .= __('Checar disponibilidade');
            //         $is_return .= '</button>';
            //     $is_return .= '</div>';
            // $is_return .= '</form>';
            return $is_return;
        }

        function orange_archive_list ($object) {
            $is_array = [];
            $is_format = [ 'jpg' ];
            $is_pattern = '';
            $is_pattern .= '/^';
            $is_pattern .= '[a-z]{0,9}';
            $is_pattern .= '\-';
            $is_pattern .= '[0-9]{0,9}';
            $is_pattern .= '\.';
            if (is_true_variable($is_format)):
                $is_pattern .= '(';
                    for ($i = 0; $i < sizeof($is_format); $i++):
                        $is_pattern .= $is_format[$i];
                        $is_pattern .= sizeof($is_format) <= 1 ? '' : ($i < sizeof($is_format) ? '|' : '');
                    endfor;
                $is_pattern .= ')';
            endif;
            $is_pattern .= '$/i';
            $is_server = str_replace('themes/orange', 'uploads', __DIR__);
            foreach (new DirectoryIterator($is_server) as $is_archive):
                if (in_array(strtolower($is_archive->getExtension()), $is_format)):
                    if (is_first_word($is_archive->getFilename(), is_true_key($object, 'archive') ? $object['archive'] : '')):
                        if (preg_match($is_pattern, $is_archive->getFilename())):
                            array_push($is_array, $is_archive->getFilename());
                        endif;
                    endif;
                endif;
            endforeach;
            $is_random = is_true_variable($is_array) ? (is_true_key($object, 'random') ? array_rand($is_array) : 0) : 0;
            $is_server = is_true_variable($is_array) ? $is_server . '/' . $is_array[$is_random] : '';
            $is_url = 'http://';
            $is_url .= $_SERVER['SERVER_NAME'];
            $is_url .= str_replace('index.php', 'wp-content/uploads', $_SERVER['SCRIPT_NAME']);
            return file_exists($is_server) ? (is_true_variable($is_array) ? $is_url . '/' . $is_array[$is_random] : '') : '';
        }

        function orange_archive ($object) {
            $is_server = '';
            $is_server .= str_replace('themes/orange', 'uploads', __DIR__);
            $is_server .= '/';
            $is_server .= is_true_key($object, 'archive') ? $object['archive'] : '';
            $is_url = '';
            $is_url .= 'http://';
            $is_url .= $_SERVER['SERVER_NAME'];
            $is_url .= str_replace('index.php', 'wp-content/uploads', $_SERVER['SCRIPT_NAME']);
            $is_url .= '/';
            $is_url .= is_true_key($object, 'archive') ? $object['archive'] : '';
            return file_exists($is_server) ? $is_url : '';
        }

        function orange_header ($object) {
            $is_return = '';
            if (is_true_key($object, 'type')):
                if ($object['type'] === 'bloginfo'):
                    $is_return .= '<header>';
                        $is_content = '';
                        $is_content .= orange_text_content([
                            'content' => orange_config_selector (
                                [
                                    'src' => orange_archive([ 'archive' => 'logo.jpg' ]),
                                    'alt' => is_true_variable(get_bloginfo('name'))
                                    ? get_bloginfo('name') . (is_true_variable(get_bloginfo('description')) ? ' | ' . get_bloginfo('description') : '')
                                    : '',
                                ],
                                [
                                    'closed' => false,
                                    'content' => '',
                                    'name' => 'img',
                                ],
                            ),
                            'url' => [ 'href' => get_home_url('/'), ],
                            'wrapper' => 'picture',
                        ]);
                        $is_bloginfo = '';
                        $is_bloginfo .= is_true_variable(get_bloginfo('name')) ? orange_text_content([
                            'content' => get_bloginfo('name'),
                            'url' => [ 'href' => get_home_url('/'), ],
                            'wrapper' => [ 'h1' ],
                        ]) : '';
                        $is_bloginfo .= is_true_variable(get_bloginfo('description')) ? orange_text_content([
                            'content' => get_bloginfo('description'),
                            'url' => [ 'href' => get_home_url('/'), ],
                            'wrapper' => [ 'p' ],
                        ]) : '';
                        $is_content .= is_true_variable($is_bloginfo) ? orange_config_selector (
                            [
                                'id' => 'bloginfo',
                            ],
                            [
                                'closed' => true,
                                'content' => $is_bloginfo,
                                'name' => 'div',
                            ],
                        ) : '';
                        $is_container = is_true_variable($is_content) ? orange_config_selector (
                            [
                                'id' => 'brand',
                            ],
                            [
                                'closed' => true,
                                'content' => $is_content,
                                'name' => 'div',
                            ],
                        ) : '';
                        $is_style = orange_style_background ([
                            'type' => 'normal',
                            'url' => orange_archive_list([ 'archive' => 'header', 'random' => true ]),
                        ]);
                        $is_style = array_merge($is_style, [
                            'height' => variable::number['thumbnail']['height'],
                        ]);
                        $is_return .= is_true_variable($is_container) ? orange_config_selector (
                            [
                                'id' => 'background',
                                'style' => $is_style,
                            ],
                            [
                                'closed' => true,
                                'content' => $is_container,
                                'name' => 'div',
                            ],
                        ) : '';
                        $is_return .= orange_config_selector (
                            [
                                'id' => 'reservation',
                            ],
                            [
                                'closed' => true,
                                'content' => orange_config_selector (
                                    [
                                        'id' => 'reservation-content',
                                    ],
                                    [
                                        'closed' => true,
                                        'content' => orange_reservation_form([ 'header' => true ]),
                                        'name' => 'div',
                                    ],
                                ),
                                'name' => 'div',
                            ],
                        );
                    $is_return .= '</header>';
                endif;
                if ($object['type'] === 'category'):
                    if (is_category()):
                        $is_content = '';
                        $is_content .= is_true_variable(get_category(get_query_var('cat'))->name) ? orange_text_content([
                            'content' => trim(get_category(get_query_var('cat'))->name),
                            'wrapper' => 'h2',
                        ]) : '';
                        $is_content .= is_true_variable(get_category(get_query_var('cat'))->description) ? orange_text_content([
                            'content' => trim(get_category(get_query_var('cat'))->description),
                            'wrapper' => [ 'p' ],
                        ]) : '';
                        $is_return .= is_true_variable(get_category(get_query_var('cat'))->description) ? orange_config_selector(
                            [],
                            [
                                'closed' => true,
                                'content' => $is_content,
                                'name' => 'header',
                            ],
                        ) : '';
                    endif;
                endif;
                if ($object['type'] === 'author'):
                    if (is_author()):
                        $is_return .= '<div class=\'section-header\'>';
                            $is_title = '';
                            if (is_true_variable(get_the_author_meta('first_name'))):
                                $is_title .= get_the_author_meta('first_name');
                                if (is_true_variable(get_the_author_meta('last_name'))):
                                    $is_title .= ' ';
                                    $is_title .= get_the_author_meta('last_name');
                                endif;
                            elseif (is_true_variable(get_the_author_meta('user_nicename'))):
                                $is_title .= get_the_author_meta('user_nicename');
                            endif;
                            $is_return .= orange_text_content([
                                'content' => $is_title,
                                'wrapper' => 'h2',
                            ]);
                            if (is_true_variable(get_the_author_meta('description'))): 
                                $is_return .= orange_text_content([
                                    'content' => trim(get_the_author_meta('description')),
                                    'wrapper' => [ 'p', 'em' ],
                                ]);
                            endif;
                            if (is_true_variable(get_the_author_meta('user_email'))):
                                $is_return .= orange_text_content([
                                    'content' => trim(get_the_author_meta('user_email')),
                                    'url' => [
                                        'href' => 'mailto:' . trim(get_the_author_meta('user_email')),
                                    ],
                                    'wrapper' => [ 'p' ],
                                ]);
                            endif;
                        $is_return .= '</div>';
                    endif;
                endif;
            endif;
            return $is_return;
        };

        function orange_title ($object) {
            $is_return = '';
            $is_content = is_true_variable(get_post_field('post_title', get_post())) ? trim(get_post_field('post_title', get_post())) : '';
            $is_content .= is_true_variable(get_post_field('_secondary_title', get_post())) ? (is_same(get_post_field('post_title', get_post()), get_post_field('_secondary_title', get_post())) ? '' : ' (' . trim(get_post_field('_secondary_title', get_post())) . ').') : '';
            $is_return .= orange_text_content([
                'content' => is_true_key($object, 'title') ? trim($object['title']) : $is_content,
                'url' => [ 'href' => esc_url(get_the_permalink(get_option('page_for_posts'))) ],
                'wrapper' => [ 'h3' ],
            ]);
            return $is_return;
        };

        function orange_post_custom ($object) {
            $is_return = '';
            $is_array = [];
            if (empty(get_post_custom())): else:
                foreach (get_post_custom() as $key => $value):
                    if (is_first_word($key, '_')): else:
                        $is_return .= ucfirst(trim($key));
                        $is_return .= ':&nbsp;';
                        foreach ($value as $key => $sub_value):
                            $is_return .= orange_text_content([
                                'content' => ucfirst(trim($sub_value)) . ($key < count($value) - 1 ? ',&nbsp;' : '.'),
                                'wrapper' => [ 'em' ],
                            ]);
                        endforeach;
                        array_push($is_array, $is_return);
                        $is_return = '';
                    endif;
                endforeach;
            endif;
            $is_return = '';
            if (is_true_variable($is_array)):
                $is_return .= '<div class=\'post-postcustom\'>';
                    $is_return .= is_true_key($object, 'title') ? orange_text_content([
                        'content' => $object['title'],
                        'wrapper' => [ 'h5' ],
                    ]) : '';
                    foreach ($is_array as $key => $value):
                        $is_return .= orange_text_content([
                            'content' => ($key + 1) . ')&nbsp;' . $value,
                            'wrapper' => [ 'p' ],
                        ]);
                    endforeach;
                $is_return .= '</div>';
            endif;
            return $is_return;
        };
        function orange_carousel ($object) {
            if (is_true_key($object, 'content')):
                if (is_first_word($object['content'], '<iframe')):
                    $is_attrib = orange_element_attributes([
                        'attribute' => variable::attribute,
                        'content' => $object['content'],
                        'element' => 'iframe',
                        'explode' => '></iframe>',
                    ]);
                endif;
                if (is_first_word($object['content'], '<img')):
                    $is_attrib = orange_validate_element_attributes(orange_element_attributes([
                        'attribute' => variable::attribute,
                        'content' => $object['content'],
                        'element' => 'img',
                        'explode' => '>',
                    ]));
                endif;
            endif;
            $is_return = '';
            if (!sizeof($is_attrib)): else:
                $is_return .= orange_config_selector (
                    [
                        'class' => 'carousel-container',
                        'style' => [
                            'height' => is_true_key($object, 'height') ? $object['height'] : variable::number['thumbnail']['height'],
                            'width' => '100%',
                        ],
                    ],
                    [
                        'closed' => false,
                        'name' => 'div',
                    ],
                );
                    $is_ID = 'carousel';
                    $is_ID .= is_true_key($object, 'id') ? '-' . trim($object['id']) : '';
                    $is_return .= '<div class=\'carousel slide h-100 w-100\' data-bs-ride=\'' . $is_ID . '\' id=\'' . $is_ID . '\'>';
                        if (sizeof($is_attrib) <= 1): else:
                            $is_return .= '<div class=\'carousel-indicators\'>';
                                for ($i = 0; $i < sizeof($is_attrib); $i++):
                                    $is_return .= '<button';
                                    $is_return .= ' type=\'button\'';
                                    $is_return .= ' data-bs-target=\'#' . $is_ID . '\'';
                                    $is_return .= ' data-bs-slide-to=\'' . $i . '\'';
                                    $is_return .= !$i ? ' class=\'active\'' : '';
                                    $is_return .= !$i ? ' aria-current=\'true\'' : '';
                                    $is_return .= ' aria-label=\'' . ($i + 1) . '\'';
                                    $is_return .= '></button>';
                                endfor;
                            $is_return .= '</div>';
                        endif;
                        $is_return .= '<div class=\'carousel-inner h-100 w-100\'>';
                            for ($i = 0; $i < sizeof($is_attrib); $i++):
                                    if (is_true_key($object, 'content')):
                                        if (is_first_word($object['content'], '<img')):
                                            $is_replace = '';
                                            $is_replace .= '-';
                                            $is_replace .= $is_attrib[$i]['width'];
                                            $is_replace .= 'x';
                                            $is_replace .= $is_attrib[$i]['height'];
                                            $is_return .= orange_config_selector (
                                                [
                                                    'class' => [ 'carousel-item', !$i ? 'active' : '', ],
                                                    'style' => orange_style_background ([
                                                        'type' => 'normal',
                                                        'url' => str_replace($is_replace, '', $is_attrib[$i]['src']),
                                                    ]),
                                                ],
                                                [
                                                    'closed' => false,
                                                    'name' => 'div',
                                                ],
                                            );
                                            $content = '';
                                            // $content .= is_true_variable($is_attrib[$i]['title']) ? orange_config_selector (
                                            //     [],
                                            //     [
                                            //         'closed' => true,
                                            //         'content' => orange_text_content([
                                            //             'content' => trim($is_attrib[$i]['title']),
                                            //             'wrapper' => '',
                                            //         ]),
                                            //         'name' => 'h4',
                                            //     ],
                                            // ) : '';
                                            // $content .= is_true_variable($is_attrib[$i]['alt']) ? orange_config_selector (
                                            //     [],
                                            //     [
                                            //         'closed' => true,
                                            //         'content' => orange_text_content([
                                            //             'content' => trim($is_attrib[$i]['alt']),
                                            //             'wrapper' => '',
                                            //         ]),
                                            //         'name' => 'p',
                                            //     ],
                                            // ) : '';
                                            $is_return .= is_true_variable($content) ? orange_config_selector (
                                                [
                                                    'class' => [
                                                        'carousel-caption',
                                                    ],
                                                ],
                                                [
                                                    'closed' => true,
                                                    'content' => $content,
                                                    'name' => 'div',
                                                ],
                                            ) : '';
                                        endif;
                                        $is_return .= is_first_word($object['content'], '<iframe') ? orange_config_selector (
                                            [
                                                'allow' => is_true_variable($is_attrib[$i]['allow']) ? trim($is_attrib[$i]['allow']) : '',
                                                'src' => trim($is_attrib[$i]['src']),
                                                'title' => get_bloginfo('name'),
                                            ],
                                            [
                                                'closed' => true,
                                                'name' => 'iframe',
                                            ],
                                        ) : '';
                                    endif;
                                $is_return .= '</div>';
                            endfor;
                        $is_return .= '</div>';
                        $is_button = [ 'prev', 'next' ];
                        if (sizeof($is_attrib) <= 1): else:
                            if (empty($is_button)): else:
                                for ($i = 0; $i < sizeof($is_button); $i++):
                                    $is_return .= '<button';
                                    $is_return .= ' class=\'carousel-control-' . $is_button[$i] . '\'';
                                    $is_return .= ' type=\'button\'';
                                    $is_return .= ' data-bs-target=\'#' . $is_ID . '\'';
                                    $is_return .= ' data-bs-slide=\'' . $is_button[$i] . '\'';
                                    $is_return .= '>';
                                        $is_return .= '<span';
                                        $is_return .= ' class=\'carousel-control-' . $is_button[$i] . '-icon\'';
                                        $is_return .= ' aria-hidden=\'true\'';
                                        $is_return .= '>';
                                        $is_return .= '</span>';
                                        $is_return .= '<span';
                                        $is_return .= ' class=\'visually-hidden\'';
                                        $is_return .= '>';
                                        $is_return .= $is_button[$i];
                                        $is_return .= '</span>';
                                    $is_return .= '</button>';
                                endfor;
                            endif;
                        endif;
                    $is_return .= '</div>';
                $is_return .= '</div>';
            endif;
            return $is_return;
        };

        function orange_validate_element_attributes ($object) {
            $is_return = [];
            if (is_true_variable($object)):
                for ($x = 0; $x < sizeof($object); $x++):
                    if (file_exists(str_replace(str_replace('\\', '/', wp_get_upload_dir()['url']), str_replace('\\', '/', wp_get_upload_dir()['path']), $object[$x]['src']))):
                        $is_array = [];
                        for ($y = 0; $y < sizeof(variable::attribute); $y++):
                            $is_array += [variable::attribute[$y] => $object[$x][variable::attribute[$y]]];
                        endfor;
                        array_push($is_return, $is_array);
                    endif;
                endfor;
            endif;
            return $is_return;
        }

        function orange_element_attributes ($object) {
            $is_return = [];
            $is_explode = explode($object['explode'], $object['content']);
            for ($x = 0; $x < sizeof($is_explode); $x++):
                $is_DOM = new DOMDocument();
                $is_DOM->loadHTML($is_explode[$x] . '>');
                foreach ($is_DOM->getElementsByTagName($object['element']) as $is_key):
                    $is_array = [];
                    for ($y = 0; $y < sizeof($object['attribute']); $y++):
                        $is_array += [ $object['attribute'][$y] => $is_key->getAttribute($object['attribute'][$y]) ];
                    endfor;
                    array_push($is_return, $is_array);
                endforeach;
            endfor;
            return $is_return;
        };

        function orange_style_background ($object) {
            $is_return = is_true_key($object, 'url') ? [
                'background-attachment' => 'scroll',
                'background-image' => 'url(' . $object['url'] . ')',
                'background-position' => 'center',
                'background-repeat' => 'no-repeat',
                'background-size' => 'cover',
            ] : [];
            if (is_true_key($object, 'type')):
                $is_return = array_merge($is_return, is_first_word ($object['type'], 'normal') ? [
                    'height' => '100%',
                    'width' => '100%',
                ] : []);
                $is_return = array_merge($is_return, is_first_word ($object['type'], 'thumbnail') ? [
                    'cursor' => 'pointer',
                    'height' => 'calc(100% - 1rem)',
                    'left' => 'calc(1rem / 2)',
                    'position' => 'absolute',
                    'top' => 'calc(1rem / 2)',
                    'width' => 'calc(100% - 1rem)',
                ] : []);
            endif;
            return $is_return;
        };

        function orange_thumbnail ($object) {
            $is_return = '';
            $is_mainclassname = '';
            $is_mainclassname .= 'thumbnail';
            $is_mainclassname .= is_true_key($object, 'title') ? '-' . trim($object['title']) : '';
            $is_mainclassname .= '-';
            $is_mainclassname .= 'container';
            global $lorem;
            if (is_true_key($object, 'content')):
                if (is_first_word($object['content'], '<iframe')):
                    $is_attrib = orange_element_attributes([
                        'attribute' => variable::attribute,
                        'content' => $object['content'],
                        'element' => 'iframe',
                        'explode' => '></iframe>',
                    ]);
                endif;
                if (is_first_word($object['content'], '<img')):
                    $is_attrib = orange_validate_element_attributes(orange_element_attributes([
                        'attribute' => variable::attribute,
                        'content' => $object['content'],
                        'element' => 'img',
                        'explode' => '>',
                    ]));
                endif;
            endif;
            if (is_true_variable($is_attrib)):
                $is_return .= orange_config_selector([ 'class' => $is_mainclassname ], [ 'closed' => false, 'name' => 'div' ]);
                    for ($i = 0; $i < sizeof($is_attrib); $i++):
                        if (is_true_variable($is_attrib[$i]['src'])):
                            $is_return .= orange_config_selector(
                                [
                                    'class' => 'thumbnail-wrapper',
                                    'style' => [
                                        'height' => variable::number['thumbnail']['height'],
                                        'width' => sizeof($is_attrib) <= 1 ? '100%' : variable::number['thumbnail']['width'],
                                        'margin' => sizeof($is_attrib) <= 1 ? '0 0 1rem 0' : '0 1rem 1rem 0',
                                    ],
                                ],
                                [
                                    'closed' => false,
                                    'name' => 'div'
                                ]
                            );
                                if (is_true_key($object, 'content')):
                                    if (is_first_word($object['content'], '<img')):
                                        $is_return .= is_true_variable($is_attrib[$i]['alt']) ? orange_config_selector (
                                            [ 'class' => 'thumbnail-title', ],
                                            [
                                                'closed' => true,
                                                'content' => orange_text_content([
                                                    'content' => substr($is_attrib[$i]['alt'], 0, strlen(trim($lorem))),
                                                    'wrapper' => 'p',
                                                ]),
                                                'name' => 'div',
                                            ],
                                        ) : '';
                                    endif;
                                        $is_replace = '';
                                        $is_replace .= '-';
                                        $is_replace .= $is_attrib[$i]['width'];
                                        $is_replace .= 'x';
                                        $is_replace .= $is_attrib[$i]['height'];
                                        $is_style = [];
                                        if (is_first_word($object['content'], '<iframe')):
                                            $is_style = [ 'height' => '100%', 'width' => '100%' ];
                                        elseif (is_first_word($object['content'], '<img')):
                                            $is_style = orange_style_background ([
                                                'type' => 'thumbnail',
                                                'url' => str_replace($is_replace, '', $is_attrib[$i]['src']),
                                            ]);
                                        endif;
                                        $is_return .= orange_config_selector (
                                            [
                                                'class' => 'thumbnail-content',
                                                'style' => $is_style,
                                            ],
                                            [
                                                'closed' => false,
                                                'name' => 'div',
                                            ],
                                        );
                                        $is_return .= is_first_word($object['content'], '<iframe') ? orange_config_selector (
                                            [
                                                'allow' => is_true_variable($is_attrib[$i]['allow']) ? trim($is_attrib[$i]['allow']) : '',
                                                'src' => trim($is_attrib[$i]['src']),
                                                'title' => get_bloginfo('name'),
                                            ],
                                            [
                                                'closed' => true,
                                                'name' => 'iframe',
                                            ],
                                        ) : '';
                                    $is_return .= '</div>';
                                endif;
                            $is_return .= '</div>';
                        endif;
                    endfor;
                $is_return .= '</div>';
            endif;
            return $is_return;
        };

        function orange_drop_list ($object) {
            $is_container = '';
            $is_array = [];
            if (is_true_key($object, 'array')):
                for ($i = 0; $i < sizeof($object['array']); $i++):
                    if (is_true_variable($object['array'][$i]->active)):
                        array_push($is_array, $object['array'][$i]);
                    endif;
                endfor;
            endif;
            for ($i = 0; $i < sizeof($is_array); $i++):
                $is_content = '';
                $is_content .= is_true_variable($is_array[$i]->url) ? orange_config_selector (
                    [
                        'href' => trim($is_array[$i]->url),
                        'target' => is_true_variable($is_array[$i]->target) ? '_blank' : '',
                    ],
                    [
                        'closed' => false,
                        'content' => '',
                        'name' => 'a',
                    ],
                ) : '';
                $is_content .= orange_config_selector (
                    [
                        'class' => 'drop',
                        'style' => [
                            'height' => variable::number['drop']['height'],
                            'width' => variable::number['drop']['width'],
                        ],
                    ],
                    [
                        'closed' => true,
                        'content' => orange_config_selector (
                            [
                                'name' => trim(strtolower($is_array[$i]->name)),
                            ],
                            [
                                'closed' => true,
                                'content' => '',
                                'name' => 'ion-icon',
                            ],
                        ),
                        'name' => 'div',
                    ],
                );
                $is_content .= is_true_variable($is_array[$i]->url) ? '</a>' : '';
                $is_content .= orange_config_selector (
                    [
                        'style' => [
                            'width' => '100%',
                            'text-align' => 'center',
                            'margin' => '.5rem 0 0 0',
                        ],
                    ],
                    [
                        'closed' => true,
                        'content' => orange_text_content([
                            'content' => trim(ucfirst($is_array[$i]->title)),
                            'wrapper' => [ 'p' ],
                        ]),
                        'name' => 'div',
                    ],
                );
                $is_content .= is_true_variable($is_array[$i]->description) ? orange_config_selector (
                    [
                        'style' => [
                            'width' => '100%',
                            'text-align' => 'center',
                            'margin' => '0',
                        ],
                    ],
                    [
                        'closed' => true,
                        'content' => orange_text_content([
                            'content' => trim(ucfirst($is_array[$i]->description)),
                            'wrapper' => [ 'p', 'em' ],
                        ]),
                        'name' => 'div',
                    ],
                ) : '';
                $is_margin = '';
                $is_margin .= ' 0';
                $is_margin .= ' calc(' . variable::number['margin'] . ' / 2)';
                $is_margin .= ' ' . variable::number['margin'];
                $is_margin .= ' calc(' . variable::number['margin'] . ' / 2)';
                $is_container .= orange_config_selector (
                    [
                        'style' => [
                            'align-items' => 'center',
                            'display' => 'flex',
                            'flex-direction' => 'column',
                            'margin' => $is_margin,
                            'width' => variable::number['drop']['width'],
                        ],
                    ],
                    [
                        'closed' => true,
                        'content' => $is_content,
                        'name' => 'div',
                    ],
                );
            endfor;
            return orange_config_selector (
                [
                    'style' => [
                        'display' => 'flex',
                        'flex-wrap' => 'wrap',
                        'justify-content' => 'center',
                    ],
                ],
                [
                    'closed' => true,
                    'content' => $is_container,
                    'name' => 'div',
                ],
            );
        };

        function orange_drop_page ($object) {
            $is_return = '';
            $is_return .= is_true_key ($object, 'array') ? orange_config_selector (
                [
                    'class' => is_true_key ($object, 'class') ? $object['class'] : '',
                    'id' => is_true_key ($object, 'id') ? $object['id'] : '',
                    'style' => [
                        'margin' => '0 0 1rem 0',
                        'padding' => '1rem 1rem 0 1rem',
                    ],
                ],
                [
                    'closed' => true,
                    'content' => orange_drop_list ([
                        'array' => $object['array'],
                    ]),
                    'name' => 'section',
                ],
            ) : '';
            return $is_return;
        }

        function orange_content ($object) {
            $is_content = '';
            $is_content .= is_true_key($object, 'title') ? orange_title([ 'title' => '' ]) : '';
            $is_content .= is_first_word(get_post_field('post_content', get_post()), '<iframe') ? orange_thumbnail([
                'content' => get_post_field('post_content', get_post()),
                'id' => get_post_field('post_name', get_post()),
            ]) : '';
            $is_content .= is_first_word(get_post_field('post_content', get_post()), '<img') ? orange_carousel([
                'content' => get_post_field('post_content', get_post()),
                'id' => get_post_field('post_name', get_post()),
            ]) : '';
            if (is_first_word(get_post_field('post_excerpt', get_post()), '<img')): else:
                $is_content .= is_true_variable(get_post_field('post_excerpt', get_post())) ? orange_config_selector (
                    [
                        'class' => 'excerpt',
                        'style' => [
                            'margin' => is_first_word(get_post_field('post_content', get_post()), '<img') ? '1rem 0 0 0' : '0',
                        ],
                    ],
                    [
                        'closed' => true,
                        'content' => orange_text_content([
                            'content' => get_post_field('post_excerpt', get_post()),
                        ]),
                        'name' => 'div',
                    ],
                ) : '';
            endif;
            $is_content .= is_true_key($object, 'menu') ? orange_menu() : '';
            $is_return = '';
            $is_return .= is_true_key($object, 'margin')
            ? (is_category() ? orange_config_selector([ 'id' => get_post_field('post_name', get_post()) ]) : '')
            : '';
            $is_return .= orange_config_selector (
                [
                    "style" => [
                        'margin' => '0 0 1rem 0',
                        'padding' => is_true_variable(get_post_field('post_excerpt', get_post())) ? '1rem 1rem 0 1rem' : '1rem',
                    ],
                ],
                [
                    'closed' => true,
                    'content' => $is_content,
                    'name' => 'section',
                ],
            );
            return $is_return;
        }

        function orange_page_main_content () {
            global $JSON;
            $is_return = '';
            $is_return .= is_true_variable($JSON->app->sidebar->up) ? orange_drop_page ([
                'class' => 'container-channels',
                'array' => $JSON->app->sidebar->up,
            ]) : '';
            $is_return .= orange_content([]);
            if (is_true_variable($JSON->app->main)):
                for ($i = 0; $i < sizeof($JSON->app->main); $i++):
                    $is_return .= orange_category_main_post_list([ 'id' => $JSON->app->main[$i] ]);
                endfor;
            endif;
            $is_return .= is_true_variable($JSON->hostel->easiness) ? orange_drop_page ([
                'class' => 'container-easiness',
                'array' => $JSON->hostel->easiness,
            ]) : '';
            return $is_return;
        };

        function orange_menu () {
            global $JSON;
            $is_container = '';
            for ($x = 0; $x < sizeof($JSON->menu); $x++):
                for ($y = 0; $y < sizeof($JSON->menu[$x]->item); $y++):
                    $is_container .= is_true_variable($JSON->menu[$x]->item[$y]->title) ? orange_config_selector (
                        [
                            'class' => is_true_variable($JSON->menu[$x]->item[$y]->description) ? [ 'm-0' ] : [ 'm-3' ],
                        ],
                        [
                            'closed' => true,
                            'content' => $JSON->menu[$x]->item[$y]->title,
                            'name' => 'h4',
                        ],
                    ) : '';
                    $is_container .= is_true_variable($JSON->menu[$x]->item[$y]->description) ? orange_config_selector (
                        [
                            'class' => [ 'm-3' ],
                        ],
                        [
                            'closed' => true,
                            'content' => $JSON->menu[$x]->item[$y]->description,
                            'name' => 'p',
                        ],
                    ) : '';
                    $is_content = '';
                    $is_content .= '<thead>';
                        $is_content .= '<tr>';
                            $is_content .= '<th width=\'' . 45 . '%' . '\'>' . '<p>' . __('Produto') . '</p>' . '</th>';
                            $is_content .= '<th width=\'' . 45 . '%' . '\'>' . '<p>' . __('Descrição') . '</p>' . '</th>';
                            $is_content .= '<th width=\'' . 10 . '%' . '\'>' . '<p>' . __('Valor') . '</p>' . '</th>';
                        $is_content .= '</tr>';
                    $is_content .= '</thead>';
                    $is_content .= '<tbody>';
                    for ($z = 0; $z < sizeof($JSON->menu[$x]->item[$y]->item); $z++):
                        if (is_true_variable ($JSON->menu[$x]->item[$y]->item[$z]->title)):
                            if (is_true_variable ($JSON->menu[$x]->item[$y]->item[$z]->value)):
                                $is_content .= '<tr>';
                                        $is_content .= '<td>';
                                            $is_content .= is_true_variable ($JSON->menu[$x]->item[$y]->item[$z]->title)
                                            ? '<p>' . trim($JSON->menu[$x]->item[$y]->item[$z]->title) . '</p>'
                                            : '';
                                        $is_content .= '</td>';
                                        $is_content .= '<td>';
                                            $is_content .= is_true_variable ($JSON->menu[$x]->item[$y]->item[$z]->description)
                                            ? '<p>' . trim($JSON->menu[$x]->item[$y]->item[$z]->description) . '</p>'
                                            : '';
                                        $is_content .= '</td>';
                                        $is_content .= '<td>';
                                            $is_content .= is_true_variable ($JSON->menu[$x]->item[$y]->item[$z]->value)
                                            ? '<p>' . 'r$' . number_format(trim($JSON->menu[$x]->item[$y]->item[$z]->value), 2, ',', '.') . '</p>'
                                            : '';
                                        $is_content .= '</td>';
                                $is_content .= '</tr>';
                            endif;
                        endif;
                    endfor;
                    $is_content .= '</tbody>';
                    $is_container .= orange_config_selector (
                        [
                            'class' => [
                                'alert',
                                'alert-light',
                                'rounded',
                                'shadow-sm',
                            ],
                            'role' => 'alert',
                        ],
                        [
                            'closed' => true,
                            'content' => orange_config_selector (
                                [
                                    'class' => [
                                        'table',
                                        'table-striped',
                                        'table-hover',
                                        'm-0',
                                    ]
                                ],
                                [
                                    'closed' => true,
                                    'content' => $is_content,
                                    'name' => 'table',
                                ],
                            ),
                            'name' => 'div',
                        ],
                    );                    
                endfor;
            endfor;
            return orange_config_selector (
                [
                    'class' => 'excerpt',
                    "style" => [
                        'margin' => '1rem 0 0 0',
                    ],
                ],
                [
                    'closed' => true,
                    'content' => $is_container,
                    'name' => 'div',
                ],
            );
        };

        function orange_page_menu_content () {
            return orange_content([
                'margin' => false,
                'menu' => true,
                'title' => true,
            ]);
        };

        function orange_page_single_content () {
            return orange_content([
                'margin' => true,
                'menu' => false,
                'title' => true,
            ]);
        };

        function orange_template_part ($content) {
            $is_template = 'templates' . '/' . str_replace(' ', '-', trim($content));
            $is_template = str_replace('\\', '/', $is_template);
            $is_dirpath = __DIR__ . '/' . trim($is_template) . '.php';
            $is_dirpath = str_replace('\\', '/', $is_dirpath);
            return file_exists($is_dirpath) ? get_template_part($is_template, get_post_type()) : orange_config_selector (
                [],
                [
                    'closed' => true,
                    'content' => orange_text_content([
                        'content' => 'File not found!',
                        'wrapper' => [ 'p' ],
                    ]),
                    'name' => '',
                ],
            );
        };

        function orange_loop_content ($content) {
            get_header();
                echo '<main>';
                    echo '<article>';
                        echo orange_header([ 'type' => 'category', ]);
                        echo is_category() ? orange_category_button_list() : '';
                            if (have_posts()):
                                while (have_posts()):
                                    the_post();
                                    echo orange_template_part($content);
                                endwhile;
                            endif;
                        echo is_category() ? orange_category_button_list() : '';
                    echo '</article>';
                echo '</main>';
            get_footer();
        };

        function orange_lightbox_container ($string) {
            $is_return = '';
            if (is_true_variable($string)):
                $is_return .= '<div id=\'' . $string . '\' class=\'' . $string . '\'>';
                    $is_return .= '<div id=\'' . $string . '-container\' class=\'' . $string . '-container\'>';
                        $is_return .= '<div id=\'' . $string . '-wrapper\' class=\'' . $string . '-wrapper\'>';
                        $is_return .= '</div>';
                    $is_return .= '</div>';
                $is_return .= '</div>';
            endif;
            return $is_return;
        }
        
    endif;
?>