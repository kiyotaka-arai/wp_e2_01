<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta name="keywords" content="">
	<meta property="og:site_name" content="">
	<meta property="og:type" content="website">
	<!-- これ下層変えないとじゃね？？？ -->
	<meta property="og:image" content="">

	<?php wp_head(); ?>

</head>

<body>
<!--
body_class();は一旦コメントアウト
body_calssで付与されるクラス属性
body_classで付与されるタグはページによって様々です。
トップページの場合：home blog
記事ページの場合：single
固定ページの場合：page
上記のようなものがあります。これはごく一例です。
他にも、アーカイブページや検索結果ページ、404エラーページなどのあらゆるページで個別のclass属性が付与されます。
フルマークスこれ使ってなさそう…
フルマークスこれ使ってなさそう…
フルマークスこれ使ってなさそう…
-->
<?php wp_body_open(); ?>
<!--
<body>直後に必ず書く。wp5.2以降で使用可能。wp5.1以前の場合はこの行を削除する（php入門）
wp_body_openの使い方
wp_body_openの使い方はページの表示では見えない要素、タグやメタデータなどの出力用として使用します。
HTMLのタグを追加する目的としての使用は、ページのデザインなどが崩れてしまったりエラーが発生してしまうことがあるようなので使用しないようにします。
そのため使い方としては、例えばGoogleタグマネージャーのようなbody開始タグ直後にコードを出力する必要がある場合などにWordPressのwp_body_openにフックしてコード出力する使い方をします -->
<header>
    <div class="logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<!-- '/' はなんなんや… -->
		<!-- 現在のブログ（サイト）のホームURLを取得する。ホームURLは、管理者ページの「設定」-「一般」の「サイトのアドレス(URL)」のこと。
		WordPress 3.0より前のバージョンでは get_option( 'home' )や get_bloginfo( 'home' )を使用していたが、3.0以降ではこの関数を使うほうが望ましい（たぶん）。 -->
			<img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo.svg' ); ?>" alt="">
			<!-- uri() . ここ半角開けるのね -->
		</a>
    </div>
	<nav>
		<ul class="nav-list">
			<li class="nav-item">
				<a href="<?php echo esc_url( home_url( 'company' ) ); ?>">
					会社概要
				</a>
				<!-- home_urlむっちゃ便利やん -->
				<!-- これが正解なのかなぁ -->
			</li>
			<li class="nav-item">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>">
					ニュース
				</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'blog' ) ); ?>">
					ブログ
				</a>
			</li>
		</ul>
	</nav>
</header>
