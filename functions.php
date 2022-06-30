<?php

/*-----------------------------------------------------------------------------------*/
/* Load scripts and style sheets
/*-----------------------------------------------------------------------------------*/

/* JS管理 */
/*書き方の参考
<?php wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ); ?>
$handle：ハンドルを命名。そのファイルを表す何かを入れる。
$src：ファイルのURLを入れる。
$deps：このスクリプトより前に読み込まれる必要があるスクリプトのハンドルを配列で指定。
$ver：ファイル名の後ろに?ver=とパラメータが付与される。date('Ymdg:iA')を入れると、その時の年月日時間分がはいります。（=キャッシュを残さない）
$in_footer：falseでhead内に、trueで</body>の直前に設置。
*/

function add_scripts() {
    // サイト共通＿JS
    wp_deregister_script('jquery'); // WordPress本体のjquery.jsを読み込まない
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.6.0.min.js', '', ('20220125'), false );
    wp_enqueue_script( 'loading', get_template_directory_uri() . '/common/js/loading.js', array( 'jquery' ), date('Ymdg:iA'), false );
    wp_enqueue_script( 'lib', get_template_directory_uri() . '/common/js/lib.js', array( 'jquery' ), date('Ymdg:iA'), false );
}
add_action('wp_enqueue_scripts', 'add_scripts');


/* CSS */
/*書き方の参考
<?php wp_enqueue_style( $handle, $src, $deps, $ver, $media ); ?>
$handle ハンドル名を命名。そのファイルを表す何かを入れる。
$src ファイルのURLを入れる。
$deps このスタイルより前に読み込まれる必要があるスタイルのハンドルを配列で指定。
$ver ファイル名の後ろに?ver=とパラメータが付与される。date('Ymdg:iA')を入れると、その時の年月日時間分がはいります。（=キャッシュを残さない）
$media メディアを指定する文字列　例: ‘all’、’screen’、’handheld’、’print’。
*/
function add_styles() {
    // サイト共通＿CSS
    wp_enqueue_style( 'fontawsome', '//use.fontawesome.com/releases/v5.5.0/css/all.css', '', ('20220125'), 'all' );
    wp_enqueue_style( 'googlefonts', '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;700&family=Roboto:wght@300;700&display=swap', '', ('20220125'), 'all' );
    wp_enqueue_style( 'yakuhanjp', '//cdn.jsdelivr.net/npm/yakuhanjp@3.4.1/dist/css/yakuhanjp-narrow.min.css', '', ('20220125'), 'all' );
    wp_enqueue_style( 'common_style', get_template_directory_uri() . '/common/css/style.css', '', date('Ymdg:iA'), 'all' );
}
add_action('wp_print_styles', 'add_styles');


/*-----------------------------------------------------------------------------------*/
/* テーマサポート設定
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wpqw_setup' ) ):
    function wpqw_setup() {
        add_theme_support( 'title-tag' ); //Titleタグ
        add_theme_support( 'automatic-feed-links' ); //フィードリンク
        //add_theme_support( 'custom-background' ); //カスタム背景
        //add_theme_support( 'custom-header' ); //カスタムヘッダー
        //add_theme_support( 'custom-logo' ); //カスタムロゴ
        //add_theme_support( 'customize-selective-refresh-widgets' ); //テーマカスタマイザーでのウィジェット再読み込み
        add_theme_support( 'post-thumbnails' ); //投稿サムネイル（アイキャッチ）
        //set_post_thumbnail_size( 210, 210, true );
        /*画像を表示する箇所に追加するタグ→<?php the_post_thumbnail('thumbnail'); ?>*/
        add_theme_support( 'post-formats', array( //投稿フォーマット
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ) );
        add_theme_support( 'html5', array( //html5サポート（html5による出力をしたい場合）
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption',
        ) );
        add_theme_support( 'wp-block-styles' ); //ブロックエディターサポート WP5.0〜
        //add_theme_support( 'align-wide' ); //ブロックエディターの画像投稿で、幅広/全幅が使える
        //add_theme_support( 'editor-styles' ); //投稿画面に、オリジナルCSSを適用
        //add_editor_style( 'css/editor-style.css' ); 投稿画面のオリジナルCSSを指定
        //add_theme_support( 'dark-editor-style' ); //ダークモード
        //add_theme_support( 'disable-custom-font-sizes' ); //ブロックのカスタム文字サイズを使えなくする
        //add_theme_support( 'editor-font-sizes' ); //ブロックの文字サイズの選択肢を使えなくする
        //add_theme_support( 'disable-custom-colors' ); //ブロックの色設定のカスタムカラーを選ばせないようにする
        //add_theme_support( 'editor-color-palette' ); //ブロックの色設定のカラーパレットを使わないようにする
        add_theme_support( 'responsive-embeds' ); //レスポンシブ対応埋め込みタグ WP5.0〜
        /*register_nav_menus( array( //カスタムメニュー（管理画面 ＞ 外観 ＞ メニュー）設定を出来るようにする
            'theme_location' => 'header-navigation',
        ) );*/
        load_theme_textdomain( 'textdomain', get_template_directory() . '/language' ); //翻訳ファイルの場所を指定
    }
endif;
add_action( 'after_setup_theme', 'wpqw_setup' );


/*-----------------------------------------------------------------------------------*/
/* 管理画面の不要な入力項目を削除します。
/*-----------------------------------------------------------------------------------*/
function remove_default_post_screen_metaboxes() {
    remove_meta_box( 'postcustom','post','normal' ); // カスタムフィールド
    //remove_meta_box( 'postexcerpt','post','normal' ); // 抜粋
    remove_meta_box( 'commentstatusdiv','post','normal' ); // ディスカッション
    remove_meta_box( 'commentsdiv','post','normal' ); // コメント
    remove_meta_box( 'trackbacksdiv','post','normal' ); // トラックバック
    remove_meta_box( 'authordiv','post','normal' ); // 作成者
    remove_meta_box( 'slugdiv','post','normal' ); // スラッグ
    remove_meta_box( 'revisionsdiv','post','normal' ); // リビジョン
}
add_action('admin_menu','remove_default_post_screen_metaboxes');


/*-----------------------------------------------------------------------------------*/
/* 管理画面サイドバーから使用しないメニューを非表示にする
/*-----------------------------------------------------------------------------------*/
function remove_menus() {
    global $current_user;
    $current_user = wp_get_current_user();
    if ( $current_user->user_login == "XXXXXXXX" ) {
        //remove_submenu_page( 'index.php', 'index.php' ); // ダッシュボード / ホーム.
        //remove_submenu_page( 'index.php', 'update-core.php' ); // ダッシュボード / 更新.

        //remove_submenu_page( 'edit.php', 'edit.php' ); // 投稿 / 投稿一覧.
        //remove_submenu_page( 'edit.php', 'post-new.php' ); // 投稿 / 新規追加.
        //remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' ); // 投稿 / カテゴリー.
        //remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); // 投稿 / タグ.

        //remove_submenu_page( 'upload.php', 'upload.php' ); // メディア / ライブラリ.
        //remove_submenu_page( 'upload.php', 'media-new.php' ); // メディア / 新規追加.

        //remove_submenu_page( 'edit.php?post_type=page', 'edit.php?post_type=page' ); // 固定 / 固定ページ一覧.
        //remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page' ); // 固定 / 新規追加.

        //remove_submenu_page( 'themes.php', 'themes.php' ); // 外観 / テーマ.
        remove_submenu_page( 'themes.php', 'customize.php?return=' . rawurlencode( $_SERVER['REQUEST_URI'] ) ); // 外観 / カスタマイズ.
        remove_submenu_page( 'themes.php', 'nav-menus.php' ); // 外観 / メニュー.
        remove_submenu_page( 'themes.php', 'widgets.php' ); // 外観 / ウィジェット.
        //remove_submenu_page( 'themes.php', 'theme-editor.php' ); // 外観 / テーマエディタ.

        //remove_submenu_page( 'plugins.php', 'plugins.php' ); // プラグイン / インストール済みプラグイン.
        //remove_submenu_page( 'plugins.php', 'plugin-install.php' ); // プラグイン / 新規追加.
        //remove_submenu_page( 'plugins.php', 'plugin-editor.php' ); // プラグイン / プラグインエディタ.

        //remove_submenu_page( 'users.php', 'users.php' ); // ユーザー / ユーザー一覧.
        //remove_submenu_page( 'users.php', 'user-new.php' ); // ユーザー / 新規追加.
        //remove_submenu_page( 'users.php', 'profile.php' ); // ユーザー / あなたのプロフィール.

        //remove_submenu_page( 'tools.php', 'tools.php' ); // ツール / 利用可能なツール.
        //remove_submenu_page( 'tools.php', 'import.php' ); // ツール / インポート.
        //remove_submenu_page( 'tools.php', 'export.php' ); // ツール / エクスポート.
        //remove_submenu_page( 'tools.php', 'site-health.php' ); // ツール / サイトヘルス.
        //remove_submenu_page( 'tools.php', 'export_personal_data' ); // ツール / 個人データのエクスポート.
        //remove_submenu_page( 'tools.php', 'remove_personal_data' ); // ツール / 個人データの消去.

        //remove_submenu_page( 'options-general.php', 'options-general.php' ); // 設定 / 一般.
        //remove_submenu_page( 'options-general.php', 'options-writing.php' ); // 設定 / 投稿設定.
        //remove_submenu_page( 'options-general.php', 'options-reading.php' ); // 設定 / 表示設定.
        //remove_submenu_page( 'options-general.php', 'options-discussion.php' ); // 設定 / ディスカッション.
        //remove_submenu_page( 'options-general.php', 'options-media.php' ); // 設定 / メディア.
        //remove_submenu_page( 'options-general.php', 'options-permalink.php' ); // 設定 / メディア.
        //remove_submenu_page( 'options-general.php', 'privacy.php' ); // 設定 / プライバシー.

        //remove_menu_page('edit.php?post_type=acf-field-group');   // acf
        //remove_menu_page('cptui_main_menu'); //cptui
        //remove_menu_page('wp-dbmanager/database-manager.php'); //データベース
        //remove_submenu_page('wp-dbmanager/database-manager.php','wp-dbmanager/database-empty.php'); //データベースを空にする
    }
}
add_action( 'admin_menu', 'remove_menus', 999 );

/*-----------------------------------------------------------------------------------*/
/* 管理画面バーから不要なものを非表示にする
/*-----------------------------------------------------------------------------------*/
function remove_admin_bar_menu($wp_admin_bar) {
    //$wp_admin_bar->remove_menu('wp-logo');// WordPressロゴ
    //$wp_admin_bar->remove_menu( 'site-name' );サイト名
    //$wp_admin_bar->remove_menu( 'view-site' );//サイト名-サイトを表示
    //$wp_admin_bar->remove_menu( 'updates' );//更新
    $wp_admin_bar->remove_menu('comments');// コメント
    //$wp_admin_bar->remove_menu('new-content');// 新規
    //$wp_admin_bar->remove_menu( 'new-post' );//新規-投稿
    //$wp_admin_bar->remove_menu( 'new-media' );//新規-メディア
    //$wp_admin_bar->remove_menu( 'new-link' );//新規-リンク
    //$wp_admin_bar->remove_menu( 'new-page' );//新規-固定ページ
    $wp_admin_bar->remove_menu( 'new-user' );//新規-ユーザー
    //$wp_admin_bar->remove_menu( 'my-account' );//アカウント
    $wp_admin_bar->remove_menu('user-info');// アカウント-プロフィール
    $wp_admin_bar->remove_menu('edit-profile');// アカウント-プロフィール編集
    //$wp_admin_bar->remove_menu( 'logout' ); //アカウント-ログアウト
}
add_action('admin_bar_menu', 'remove_admin_bar_menu', 201);


/*-----------------------------------------------------------------------------------*/
/* 不要なページを無効化(404扱い)
/*-----------------------------------------------------------------------------------*/
function custom_handle_404() {
    // 404、検索ページ、作成者ページ、添付ファイルページを無効化
    if ( is_404() || is_search() || is_author() || is_attachment() ) {
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        nocache_headers();
}
}
add_action( 'template_redirect', 'custom_handle_404' );


/*-----------------------------------------------------------------------------------*/
/* ログイン画面のロゴを変更
/*-----------------------------------------------------------------------------------*/
function login_logo_image() {
    echo '<style type="text/css">
            #login h1 a {
    background: url(' . get_bloginfo('template_directory') . '/common/img/login-logo.png) no-repeat center center !important;
    background-size: contain !important;
    width: 240px;
    height: 30px;
            }
    </style>';
}
add_action('login_head', 'login_logo_image');


/*-----------------------------------------------------------------------------------*/
/* フッターのメッセージを変更
/*-----------------------------------------------------------------------------------*/
function custom_admin_footer() {
    echo get_bloginfo('name');
}
add_filter('admin_footer_text', 'custom_admin_footer');


/*-----------------------------------------------------------------------------------*/
/* パーマリンクから category をとる（プラグインでも代用可）
/*-----------------------------------------------------------------------------------*/
function rename_cat_function($link) {
  return str_replace("/category/", "/", $link);
}
add_filter('user_trailingslashit', 'rename_cat_function');

function rename_cat_flush_rules() {
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action('init', 'rename_cat_flush_rules');

function rename_cat_rewrite($wp_rewrite) {
  $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'rename_cat_rewrite');


/*-----------------------------------------------------------------------------------*/
/* カテゴリーリスト（リンク付）にスラッグ名のclassを追加する
/*-----------------------------------------------------------------------------------*/
function add_cat_slug_class( $output, $args ) {
    $regex = '/<li class="cat-item cat-item-([\d]+)[^"]*">/';
    $taxonomy = isset( $args['taxonomy'] ) && taxonomy_exists( $args['taxonomy'] ) ? $args['taxonomy'] : 'category';

    preg_match_all( $regex, $output, $m );

    if ( ! empty( $m[1] ) ) {
        $replace = array();
        foreach ( $m[1] as $term_id ) {
            $term = get_term( $term_id, $taxonomy );
            if ( $term && ! is_wp_error( $term ) ) {
                $replace['/<li class="cat-item cat-item-' . $term_id . '("| )/'] = '<li class="cat-item cat-item-' . $term_id . ' cat-item-' . esc_attr( $term->slug ) . '$1';
            }
        }
        $output = preg_replace( array_keys( $replace ), $replace, $output );
    }
    return $output;
}
add_filter( 'wp_list_categories', 'add_cat_slug_class', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/* 記事ページのページ区切り用ページャー
/*-----------------------------------------------------------------------------------*/
function wp_link_pages_args_prevnext_add($args) {
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number')
        return $args; # exit early
    $args['next_or_number'] = 'number'; # keep numbering for the main part
    if (!$more)
        return $args; # exit early
    if($page-1) # there is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
        ;
    if ($page<$numpages) # there is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . ' ' . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after']
        ;
    return $args;
}
add_filter('wp_link_pages_args','wp_link_pages_args_prevnext_add');

