<?php get_header(); ?>

	<div class="news">

		<ul class="news-list">

			<?php
				$args = [
					'post_type' => 'news',
					'posts_per_page' => 3,
				];
				$news_posts = new WP_Query( $args );
				// WP_Queryバージョン
				// https://zenn.dev/ohno/articles/33fab94b9b9228
			?>

			<?php
				if ( $news_posts -> have_posts() ) :
					// そうかメソッドはシングルアロー？なんやな
					// そうかメソッドはシングルアロー？なんやな
					// そうかメソッドはシングルアロー？なんやな
					while ( $news_posts -> have_posts() ) :
				    //  while文は、式の値がtrueである間、 入れ子の文を繰り返し実行することをPHPに指示します。
					// have_posts
					// この関数は現在の WordPress クエリにループできる結果があるかどうかをチェックします。ブール型関数で、TRUE または FALSE を返します。
						$news_posts -> the_post();
						// ループを次の投稿へ進めます。 次の投稿を取得して、それを「現在の投稿」としてセットアップし、ループの 'in the loop' プロパティを true にします。
						// 0からスタートみたいなことなの？？？（セルフ）
						// 「現在の投稿」はループの中で the_title() や the_content() 等が対象とする投稿です。
						// 'in the loop' プロパティはループの中であるかどうかを示します。これは in_the_loop() 条件分岐タグを使って確かめることができます。
						// $permalink = get_permalink();
			?>

						<li class="news-item">
							<a href="<?php the_permalink(); ?>">
							<!-- WordPressループを用いて記事の一覧を表示したら、今度はそれぞれの記事へのリンクを付けることになると思います。個別記事へのURLを取得するには、the_permalink()を使用します。
							個別ページへのURLを文字列として取得するには、get_permalink()を使います。
							この関数は、WordPressループ内で使用すると現在対象となっている記事のURLを返します。この点ではthe_permalink()と同じ挙動をします。
							ところが、get_permalink()は投稿のIDを指定すればWordPressループの外でもURLを取得してくることができます。
							get_permalink( 99 );
							-->
								<time>
									<?php the_time('Y年 n月'); ?>
									<!-- WordPressで構築したサイトで投稿記事や固定ページの公開日時を表示させる際、通常は the_date(); または the_time(); 函数を使います。
									このとき、［the_date();］のほうは少々変わった挙動をするので注意が必要です。
									……というのも［the_date();］はWordPressの仕様で「同じ日に複数の記事がある場合、最初の記事のみに一度だけ日付が出力される」という仕様になっているため、同じ日に複数記事を投稿した場合に思ったように日付が表示されないという現象が起こります。 -->
								</time>
								<h3>
									<?php the_title(); ?>
								</h3>
							</a>
						</li>

				<?php endwhile;
				?>

				<?php else : // 記事がない場合 ?>

					<li>まだ投稿がありません。</li>

				<?php endif;
					wp_reset_postdata();
				?>

		</ul>
		<!-- /ニュース３件出力 -->

		<a href="<?php echo esc_url( get_post_type_archive_link('news') ); ?>">アーカイブページへ</a>
		<!-- /調べても全然escしてないんだけど -->
		<!-- https://jobtech.jp/wp/4802/ -->
		<!-- してるのあった -->

	</div>
	<!-- /ニュース（WP_Query） -->

	<div class="blog">

		<ul class="blog-list">

			<?php
				$args = [
					'post_type' => 'blog',
					'posts_per_page' => 3,
				];
				$blog_posts = new WP_Query( $args );
				// WP_Queryバージョン
				// https://zenn.dev/ohno/articles/33fab94b9b9228
			?>

			<?php
				if ( $blog_posts -> have_posts() ) :
					while ( $blog_posts -> have_posts() ) :
					//  while文は、式の値がtrueである間、 入れ子の文を繰り返し実行することをPHPに指示します。
					// have_posts
					// この関数は現在の WordPress クエリにループできる結果があるかどうかをチェックします。ブール型関数で、TRUE または FALSE を返します。
						$blog_posts -> the_post();
						// ループを次の投稿へ進めます。 次の投稿を取得して、それを「現在の投稿」としてセットアップし、ループの 'in the loop' プロパティを true にします。
						// 「現在の投稿」はループの中で the_title() や the_content() 等が対象とする投稿です。
						// 'in the loop' プロパティはループの中であるかどうかを示します。これは in_the_loop() 条件分岐タグを使って確かめることができます。
			?>

				<li class="blog-item">
					<a href="<?php the_permalink(); ?>">
						<figure>
							<?php
								if ( has_post_thumbnail() ):
									the_post_thumbnail();
								endif;
								// このif文ないとどうなるの？？？（セルフ）参考書だとないけど…
							?>
						</figure>
						<p>
							<?php
								$post_id = get_the_ID();
								$term = get_the_terms( $post_id, 'blog_cat' );
								// https://un.panoramaworks.jp/wordpress%EF%BC%9A%E7%8F%BE%E5%9C%A8%E3%81%AE%E6%8A%95%E7%A8%BF%EF%BC%88%E8%A8%98%E4%BA%8B%EF%BC%89id%E3%81%AA%E3%81%A9%E3%82%92%E5%8F%96%E5%BE%97%E3%81%99%E3%82%8B%E6%96%B9%E6%B3%95/
								// 「get_the_ID()」と「$post->ID」の違いとは？
								// ループの中で取得したいなら get the ID を使う。
								// ループの中で取得したいなら get the ID を使う。
								// ループの中で取得したいなら get the ID を使う。
								// ループの中で取得したいなら get the ID を使う。
								// ループの中で取得したいなら get the ID を使う。
								// Codex：関数リファレンス/get the ID
								// get_the_ID();
								// 出力したいときは
								// Codex：テンプレートタグ/the ID
								// the_ID();
								// ループの外でIDを取得する必要な場合。
								// ループの外でIDを取得する必要な場合。
								// ループの外でIDを取得する必要な場合。
								// グローバル関数（ $post ）を使って「$post->ID;」でIDを取得できます。
								// グローバル関数（ $post ）を使って「$post->ID;」でIDを取得できます。
								// グローバル関数（ $post ）を使って「$post->ID;」でIDを取得できます。
								// これちょっと感覚的によくわからんな
								// これちょっと感覚的によくわからんな
								// これちょっと感覚的によくわからんな
								// 戻り値はタームのオブジェクトの配列になるので、エラーなどが返ってきていないか確認してforeachなどで各要素を展開します。
								// https://yosiakatsuki.net/blog/wp-custom-tax-terms/
								// この0がよくわからん
								// この0がよくわからん
								// この0がよくわからん
								// get_the_terms - 投稿記事のタクソノミー情報を取得する
								// タクソノミー：分類
								// 投稿ID（数値）または投稿情報（オブジェクト）を指定（省略時は0）。
								// マッチしたすべてのタクソノミー情報が格納された配列を返す。パラメータ$taxonomyで指定された名前が無効な場合はfalseを返す。タクソノミー情報のプロパティは次の通り。
								// var_dump($term);
								// array(1) { [0]=> object(WP_Term)#6061 (10) { ["term_id"]=> int(7) ["name"]=> string(6) "旅行" ["slug"]=> string(4) "trip" ["term_group"]=> int(0) ["term_taxonomy_id"]=> int(7) ["taxonomy"]=> string(8) "blog_cat" ["description"]=> string(0) "" ["parent"]=> int(0) ["count"]=> int(2) ["filter"]=> string(3) "raw" } } 旅行
								// array(1)ってなってるけど？？？？？
								// array(1)ってなんなん
								// $sampleArray = ['a','b'];
								// var_dump($sampleArray);
								// array(2) { [0]=> string(1) "a" [1]=> string(1) "b" }
								// 中身の数？か…
								// 配列の中にオブジェクトが一つ入ってるのか
								// 配列の中にオブジェクトが一つ入ってるのか
								// 配列の中にオブジェクトが一つ入ってるのか
								// そりゃ[0]必要だわな
								// そりゃ[0]必要だわな
								// そりゃ[0]必要だわな
								// なんでこんな構造になってんの？？？
								// なんでこんな構造になってんの？？？
								// なんでこんな構造になってんの？？？
								// 投稿に属するタームを単体で取得
								// タームを単体で取得する関数は「get_the_terms」を使用します。
								// 投稿に属するタームを取得するので、主に投稿一覧ページ、投稿詳細ページで使用します。
								// 「タクソノミースラッグ」と記載されている箇所には、登録したカスタムタクソノミーのスラッグを入れてください。
								echo esc_html( $term[0] -> name );
								// これ$term[0]なしじゃいけなかったけど配列の中に配列みたいな感じだったん？？？？？？？
								// パラメータ
								// $id
								// 投稿ID（数値）または投稿情報（オブジェクト）を指定（省略時は0）。
								// $taxonomy
								// 'category'、'post_tag'などのタクソノミー名を指定。
								// てかこれthe_term使うべきじゃね？？？？？？？
								// てかこれthe_term使うべきじゃね？？？？？？？
								// てかこれthe_term使うべきじゃね？？？？？？？
								// the_terms( 0, 'blog_cat' );
								// やっぱりな
								// <a href="http://localhost:8888/blog/trip/%e3%83%96%e3%83%ad%e3%82%b05/">
								// </a><a href="http://localhost:8888/blog/trip/" rel="tag">旅行</a>
								// なんか二つ出力されてんだけど😭😭😭😭
								// なんか二つ出力されてんだけど😭😭😭😭
								// なんか二つ出力されてんだけど😭😭😭😭
								// 投稿についているカスタムタクソノミーの表示はthe_termsを使います。
								// これ情報取れるやつじゃないっぽいな
								// いや同じじゃね？
								// イメージ的にはカテゴリーを表示するthe_categoryに似ています。
								// 【the_terms】で表示する
								// リンク付きのリストを表示する
								// the_termsはデフォルトでリンクが付きます。
								// あまり出力の自由度が無い。
								// あまり出力の自由度が無い。
								// あまり出力の自由度が無い。
								// the_terms( $post->ID, 'カスタム分類名');
								// HTMLでの表示結果
								// <a href="http://example.com/slug/term1">ターム1</a>,
								// <a href="http://example.com/slug/term2">ターム1</a>
								// やっぱりな
								// これなんなん？？？？
								// これなんなん？？？？
								// これなんなん？？？？
							?>
						</p>
						<time>
							<?php the_time('Y年 n月'); ?>
						</time>
						<h3>
							<?php the_title(); ?>
						</h3>
						<?php the_excerpt(); ?>
					</a>
				</li>

			<?php endwhile; ?>

			<?php else : // 記事がない場合 ?>

				<li>まだ投稿がありません。</li>

			<?php endif;
				wp_reset_postdata();
			?>

		</ul>
		<!-- /ブログ３件出力 -->

		<ul>
			<?php
				$terms = get_terms( 'blog_cat' );
				// 条件を指定してタクソノミー情報を検索し、マッチしたすべてのデータを取得する。
				// 返り値
				// マッチしたすべてのデータが格納された配列を返す。
				foreach ( $terms as $term ) :
				// echo '<li><a href="'.get_term_link($term).'">'.$term->name.'</a></li>';
			?>

					<li>
						<a href="<?php echo esc_url( get_term_link($term) ); ?>">
						<!-- /get_term_link()は、指定したタクソノミーのURLアドレスを取得する関数です。 -->
						<!-- https://migi.me/wordpress/custom-post-tag-list/ -->
							<?php echo esc_html( $term -> name ); ?>
							<!-- これget的なことになるんだ -->
							<!-- esc_html一旦使おう… -->
							<!-- htmlタグ出力してなくね？？？？？？ -->
						</a>
					</li>

				<?php endforeach; ?>


		</ul>
		<!-- /カスタム投稿「ブログ」のブログカテゴリ一覧出力 -->

		<a href="<?php echo esc_url( get_post_type_archive_link( 'blog' ) ); ?>">アーカイブページへ</a>
		<!-- 投稿タイプのアーカイブページのURLを取得します。 -->

	</div>
	<!-- /ブログ（WP_Query） -->

<?php get_footer();
