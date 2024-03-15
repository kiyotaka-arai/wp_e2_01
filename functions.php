<?php

/*【管理画面】投稿メニューを非表示 */
function remove_menus () {
	// https://hirashimatakumi.com/blog/3916.html
	// global $menu;
	// これなくてもいけるなぁ
	remove_menu_page( 'edit.php' ); // 投稿を非表示
}
add_action('admin_menu', 'remove_menus');
// admin_menu
// アクションフックの admin_menu は、管理画面のメニュが表示される時にフックされます。

// https://wadablog.net/wordpress-roading/

define("INCURL", includes_url());

function add_scripts() {
	// デフォルトのjQueryの読み込みをなくす
	if(!is_admin()) wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', INCURL.'js/jquery/jquery.min.js', '', false , true );
	// $handle	ファイルを区別するための名前（ハンドル名）を入力してください。
	// ダブり厳禁。必須項目です。	なし
	// $src	ファイルのURLを入力してください。	false
	// $deps	先に読み込みたいファイルのハンドル名を入力してください。
	// 入力するときはarray('ハンドル名')で記述	array()
	// $ver	任意のバージョンを入力。	false
	// $in_footer	ファイルの読み込み位置を指定。
	// trueでwp_footer()にて読み込みます。	false
}
// add_action( 'wp_enqueue_scripts', 'add_scripts' );
// 一旦コメントアウト

// https://naokeyzmt.com/blog/wp-themes-head-control/

/* 絵文字削除 */
remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles',     'print_emoji_styles' );
remove_action( 'admin_print_styles',  'print_emoji_styles' );
// WP関数の remove_action() は、親テーマの中で設定されたアクションフックを子テーマの中で除去する関数です。
// 関数
// remove_action( $tag, $function_name, $priority, $accepted_args )
// パラメータ
// $tag (文字列) (必須)
// 除去する関数がフックされているアクションフック名を指定します。
// $function_name (文字列) (必須)
// 除去する関数名を指定します。

/* wp-json削除 */
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');

/* 外部投稿ツール設定削除 */
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

/* WPのバージョン削除 */
remove_action('wp_head', 'wp_generator');

// classic-theme-styles-inline-css
// global-styles-inline-css
// は消していいのかどうかわからん＞＜


function theme_setup() {

	// https://web-souko.com/wp-add_theme_support/

	add_theme_support( 'title-tag' );
	// WordPress4.1 からタイトルタグは <head> タグ内に記述しなくても、functions.php に以下を記述すれば、WordPress がページ種類に応じてタイトルタグを自動的に表示（挿入）してくれるようになりました。
	// 以下を使用する場合は <title> タグは記述しません（記述すると二重に出力されてしまいます）。

	add_theme_support( 'post-thumbnails' );
	// アイキャッチ画像のサポート

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	// 2番目のパラメータに指定した箇所がHTML5に準拠した形で出力されるようになります。
	// 例えばtype='text/javascript'やtype='text/css'のような不要な属性は出力されなくなります。

}
add_action( 'after_setup_theme', 'theme_setup' );


function wp_document_title_separator( $separator ) {
	$separator = '|';
	return $separator;
}
add_filter( 'document_title_separator', 'wp_document_title_separator' );
// add_theme_support( 'title-tag' );を使うと、「タイトル - サイト名」と出力されるので、このセパレーターを変更したい場合は、functions.phpに以下を記述します。
// 2番目に設置されているフィルターが以下の document_title_separator です。
// このフィルターは WordPress がページ種類によって設定したタイトル文字列内の区切り文字を変更する場合に使用します。


function body_hook(){
	// wp_body_openにフックするテスト
	echo '<!--wp_body_open action hook-->';
	// これエスケープしなくて大丈夫なの？？？？
}
add_action('wp_body_open', 'body_hook');
// https://shu-sait.com/wp-body-open-tukaikata/
// WordPressのwp_body_open()をbodyに記述するとwp_body_openにフックすることができるようになります。
// フックができるようになったか試しにWordPressのadd_actionでコメント文を出力する関数をwp_body_open()に登録してみたので、お試しフックで出力確認が必要な方は参考に使ってください。


function create_news()
// カスタム投稿の追加関数（セルフ）
{
	register_post_type('news', array(
		// このnewsを外すと全てのカスタム投稿が死ぬ（セルフ）
		'labels' => array(
			'name' => 'お知らせ',
			// 投稿タイプの一般名
			// 'singular_name' => 'お知らせ',
			// 一旦コメントアウトするか…（セルフ）
			// この投稿タイプのオブジェクト1個の名前
			// どちらも管理画面の画面のラベルですね。
			// name : 複数形で表示する場合のラベルの名前
			// singular_name : 単数形で表示する場合のラベルの名前
			// 何言ってるのかわからん
		),
		'public' => true,
		// パブリックにするかどうか。初期値: false
		// パブリックってなんなんだっけ？？？？（セルフ）
		// https://blog.dododori.com/create/program/register-post-type-public/
		// 'publicly_queryable' => true,
		// post_typeクエリが実行可能かどうか。初期値: public引数の値
		// 'show_ui' => true,
		// 管理するデフォルトUIを生成するかどうか。初期値: public引数の値
		// 管理画面に表示しないなんて状況ある？？？？（セルフ）

		// 'query_var' => true,
		// query_varキーの名前。初期値: true - $post_typeの名前
		// 何言ってるのかわからん（セルフ）
		// 'rewrite' => true,
		// 投稿タイプのパーマリンクのリライト方法を変更。初期値: true
		// 'capability_type' => 'post',
		// 権限の指定。初期値: 'post'
		'has_archive' => true,
		// アーカイブページを有効にするかどうか。初期値: false
		// 'hierarchical' => false,
		// 階層構造を持つかどうか。初期値: false
		// 'menu_position' => 5,
		// メニューの表示位置。初期値: null - コメントの下
		'supports' => array('title', 'editor', 'thumbnail','excerpt')
		// 投稿できる項目。初期値: titleとeditor
	));
	// とりあえず初期値はコメントアウトするわわけわからんから
}
add_action('init', 'create_news');

function create_blog()
// カスタム投稿の追加関数（セルフ）
{
	register_post_type('blog', array(
		// このnewsを外すと全てのカスタム投稿が死ぬ（セルフ）
		'labels' => array(
			'name' => 'ブログ',
			// 投稿タイプの一般名
			// 'singular_name' => 'お知らせ',
			// 一旦コメントアウトするか…（セルフ）
			// この投稿タイプのオブジェクト1個の名前
			// どちらも管理画面の画面のラベルですね。
			// name : 複数形で表示する場合のラベルの名前
			// singular_name : 単数形で表示する場合のラベルの名前
			// 何言ってるのかわからん
		),
		'public' => true,
		// パブリックにするかどうか。初期値: false
		// パブリックってなんなんだっけ？？？？（セルフ）
		// https://blog.dododori.com/create/program/register-post-type-public/
		// 'publicly_queryable' => true,
		// post_typeクエリが実行可能かどうか。初期値: public引数の値
		// 'show_ui' => true,
		// 管理するデフォルトUIを生成するかどうか。初期値: public引数の値
		// 管理画面に表示しないなんて状況ある？？？？（セルフ）

		// 'query_var' => true,
		// query_varキーの名前。初期値: true - $post_typeの名前
		// 何言ってるのかわからん（セルフ）
		// 'rewrite' => true,
		// 投稿タイプのパーマリンクのリライト方法を変更。初期値: true
		// 'capability_type' => 'post',
		// 権限の指定。初期値: 'post'
		'has_archive' => true,
		// アーカイブページを有効にするかどうか。初期値: false
		// 'hierarchical' => true,
		// これにすると固定ページになるんだけど…😭😭😭😭😭
		// 階層を持つ＝固定ページなのか…
		'hierarchical' => false,
		// 階層構造を持つかどうか。初期値: false
		// 'menu_position' => 5,
		// メニューの表示位置。初期値: null - コメントの下
		'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
		// 投稿できる項目。初期値: titleとeditor
		'taxonomies' => ['blog_cat'],
		// register_taxonomy_for_object_typeと同じ効果だなぁ・・・（セルフ）
		// 「'post_tag','category','blog'」にカテゴリ（カスタムタクソノミー）を追加（セルフ）
		'rewrite' => array( 'with_front' => false )
	));

	//カスタムタクソノミー（ブログカテゴリー：カテゴリー形式）の登録
	register_taxonomy(
		'blog_cat',   //カスタムタクソノミー名
		'blog',   //このタクソノミーが使われる投稿タイプ
		array(
			'label' => 'ブログカテゴリー',  //カスタムタクソノミーのラベル
			'labels' => array(
				'popular_items' => 'よく使うブログカテゴリー',
				'edit_item' => 'ブログカテゴリーを編集',
				'add_new_item' => '新規ブログカテゴリーを追加',
				'search_items' => 'ブログカテゴリーを検索'
			),
			'public' => true,  // 管理画面及びサイト上に公開
			'description' => 'ブログカテゴリーの説明文です。',  //説明文
			'hierarchical' => true,  //カテゴリー形式
			'show_in_rest' => true,  //Gutenberg で表示
		)
	);

	//カスタムタクソノミー（ブログタグ：タグ形式）の登録
	register_taxonomy(
		'blog_tag',   //カスタムタクソノミー名
		'blog',  //このタクソノミーが使われる投稿タイプ
		array(
			'label' => 'ブログタグ', //カスタムタクソノミーのラベル
			'labels' => array(
				'popular_items' => 'よく使うブログタグ',
				'edit_item' => 'ブログタグを編集',
				'add_new_item' => '新規ブログタグを追加',
				'search_items' => 'ブログタグを検索'
			),
			'public' => true,  // 管理画面及びサイト上に公開
			'description' => 'ブログタグの説明文です。',  //説明文
			'hierarchical' => false, //タグ形式
			'update_count_callback' => '_update_post_term_count',
			'show_in_rest' => true //Gutenberg で表示
		)
	);

	// $args = array(
	// 	// カスタムタクソノミーの表示名を指定
	// 	'label'        => 'ブログカテゴリー',
	// 	// ダッシュに爆誕してるなぁ…（セルフ）
	// 	// true なら階層あり。false ならタグ階層なしで初期値は false
	// 	'hierarchical' => false,
	// );
	// register_taxonomy('blog_category','blog',$args);
	// 一旦消しとくけど…

	// とりあえず初期値はコメントアウトするわわけわからんから
	// register_taxonomy_for_object_type('category', 'blog');
	// register_taxonomy_for_object_type('post_tag', 'blog');
	// この関数は登録済みのタクソノミー（カスタム分類）を登録済みの投稿タイプへ付けます。 タクソノミーの名前とそれを付けるオブジェクトタイプ（投稿など）の名前を受け取って、成功すると true を返します。
	// ダッシュにカテゴリー爆誕したやん！！！！！！（セルフ）
	// ダッシュにカテゴリー爆誕したやん！！！！！！（セルフ）
}
add_action('init', 'create_blog');


global $wp_rewrite;
$wp_rewrite->flush_rules();
// こんなんわかんないぽよ…＞＜
// https://gray-code.com/blog/wordpress/how-to-repair-404page/
// 原因はWordPressがURL構造をデータベースに保持していて、こちらに追加したカスタム投稿タイプのURLが存在していないことでした。
// そのため、上記の関数で一旦リセットする必要があったということです。
// これで新しいカスタム投稿タイプを含めたURL構造が登録され、ページも正常に表示されるようになります。
// なお、一度実行したら、上記のコードは削除しても大丈夫です。
// まじすかポテト（セルフ）
// WordPressでリライトをコントロールしているのはWP_Rewriteというクラスで、$wp_rewriteというインスタンスが在ります。このWP_Rewriteによってリライトルールが生成され、みんな大好きパーマリンクを実現しています。


function change_posts_per_page($query)
{

	/* 管理画面,メインクエリに干渉しないために必須 */
	if (is_admin() || !$query->is_main_query()) {
		return;
	}
	// is_admin
	// リクエストページが管理者ページか調べる
	// 管理者ページにも影響するの！？（セルフ）
	// is_main_query
	// is_main_query() は、現在のページがメインクエリー(投稿、固定ページ等)か否かを判断する関数です。

	$target_archives = ['news', 'blog'];
	// 自作変数（セルフ）

	/* カスタム投稿「hoge」アーカイブページの表示件数を10件にする */
	if ($query->is_post_type_archive( $target_archives )) {
		// is_post_type_archive
		// 投稿タイプのアーカイブページかどうかを判別します。
		// パラメーター
		// チェックする投稿タイプまたは投稿タイプの配列。
		$query->set('posts_per_page', '5'); // 10件
		return;
	}
}
add_action('pre_get_posts', 'change_posts_per_page');
// 一旦コメントアウト
// pre_get_posts
// functions.phpに「pre_get_posts」というアクションフックを書いて、表示を制御します。
// １ページの表示件数だけでなく、ソート順を変更したり、カスタムフィールドの内容で並べ替えたり、いろいろできます。
// １ページの表示件数を指定
// １ページに何件の投稿を表示させるかは、WordPressの「設定」→「表示設定」→「1ページに表示する最大投稿数」の数字が反映されますが、「pre_get_posts」で、以下のように記述することで、特定のカスタム投稿のアーカイブページの１ページの表示件数を指定することができます。


function my_custom_post_type_permalinks_set($termlink, $term, $taxonomy){
	return str_replace('/' . $taxonomy . '/', '/', $termlink);
}
add_filter('term_link', 'my_custom_post_type_permalinks_set', 11, 3);
// フィルターは、WordPress が様々な種類のテキストをデータベースまたはブラウザ画面へ送信する前に、それを変更できます。プラグインは、フィルター API を利用して、指定したテキストをその時点で変更する PHP 関数を実行できます。フィルターフックの一覧は プラグイン_API/フィルターフック一覧 を参照してください。
// なるほどこれは早そうやな（抽象）

add_rewrite_rule('blog/([^/]+)/?$', 'index.php?blog_cat=$matches[1]', 'top');
add_rewrite_rule(
	'blog/([^/]+)/page/([0-9]+)/?$',
	'index.php?blog_cat=$matches[1]&paged=$matches[2]',
	'top'
);
// ターム別一覧のリンクからタクソノミー名を消す


/*
	タクソノミー未選択時に特定のタームを選択させる
----------------------------------------------------- */
function add_defaultcategory_automatically($post_ID) {
	global $wpdb;
	//カスタムタクソノミーのタームを取得
	$curTerm = wp_get_object_terms($post_ID, 'blog_cat');//★カスタムタクソノミー名
	//既存のターム指定数が未設定の時に特定のタームを指定
	if (0 == count($curTerm)) {
	  $defaultTerm= array(1);//★選択させたいタームID
	  wp_set_object_terms($post_ID, $defaultTerm, 'blog_cat');//★カスタムタクソノミー名
	}
}
// ownersblogを作成する際に指定
add_action('publish_blog', 'add_defaultcategory_automatically');//★publish_カスタム投稿タイプ名
