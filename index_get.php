<?php get_header(); ?>

	<div class="news">

		<ul class="news-list">

			<?php
				$args = [
					// argument（セルフ）
					// 引数（セルフ）
					'post_type' => 'news',
					// カスタム投稿名が「event」の場合
					'posts_per_page' => 3,
					// 表示する数
					// 'orderby' => 'rand',
					// ランダムになった！！！！！
					// orderby	ソート対象を示すauthor、date、category、title、modified、ID、menu_order、randなど（省略時は'post_date'：投稿日時）
				];
				$news_posts = get_posts( $args );
				// get_posts の最も適切な使い方は、パラメータに基づいて投稿データの配列を作成することです。最近の投稿あるいはパラメータに一致した投稿を取得します。（セルフ）
				// 同じように条件を指定できる関数にはquery_posts関数がある。query_posts関数との違いは、get_posts関数は単に情報を取得するだけでグローバル変数には影響を与えないが、query_posts関数はグローバル変数の$wp_queryを使用し、$postなどの関連する情報も更新される。（セルフ）
				// 戻り値
				// WP_Post オブジェクトを返します。指定された投稿が存在しないか、エラーが発生した場合は、null を返します。
				// WP_Post の役割
				// WP_Post クラスはデータベースに格納された投稿オブジェクトを包含するために使われ、get_post などの関数によって返される。
				// https://wpdocs.osdn.jp/%E3%82%AF%E3%83%A9%E3%82%B9%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/WP_Post
			?>

			<?php
				if ($news_posts) :
					foreach ($news_posts as $post) :
						setup_postdata($post);
						// 投稿がある場合
						// 引数で受け取った１つの投稿オブジェクトをもとに各種のグローバル変数にセットする。
						// 何言ってんのこいつ
						// 返り値
						// 終了するとtrueを返す。
						// 説明
						// 投稿情報を各種のグローバル変数へセットします。その変数は、テンプレートタグを使ってカスタムクエリの結果を表示するときに使われます。
						// setup_postdata() は下記のグローバル変数をセットします：
						// $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages
						// これらは現在の投稿を参照する多くのテンプレートタグによって使われます。
						// この関数は $post グローバル変数をセットしませんが、それへのリファレンスを引数とするつもりで設計されています。
						// 公式が一番わかりやすい
			?>

						<li class="news-item">
							<a href="<?php the_permalink(); ?>">
								<time>
									<?php the_time('Y年 n月'); ?>
								</time>
								<h3>
									<?php the_title(); ?>
								</h3>
								<?php the_content(); ?>
								<!-- これってpタグも出力するんやな -->
								<!-- なんかクラス名付けられないとか昔あったなぁ -->
							</a>
						</li>

					<?php endforeach;
					// 閉じカッコと同等
					// HTMLの中にPHPを書くときに { }の書き方をすると、「 } が、どのブロックを閉じるのか」がわかりにくいため、endforeach を書くことが好まれるようです。
					// 「}」と同等
					// https://magazine.techacademy.jp/magazine/18793
					?>

				<?php else : // 記事がない場合 ?>

					<li>まだ投稿がありません。</li>

				<?php endif;
				// コロン構文とは、if文などの構造を書く際に、「{ }（波括弧）」ではなく「:（コロン）」を使って記述する構文のことです。「endif」はコロン構文の終わりを意味していて、if文の最後に記述されます。
					wp_reset_postdata();
				// もし $wp_query がセットされているなら $post に入っている内容をリセットする」というものです。
				// これ「wp_reset_postdata();」いらなくね？？？？？？
				// https://karukichi-blog.netlify.app/blogs/wp-query-get-posts-difference
				// https://qiita.com/takumi-19/items/96fe6f7b8eb0436e9100
				// こいつ間違ってるやん
				?>

		</ul>
		<!-- /ニュース３件出力 -->

	</div>
	<!-- /ニュース（get_post） -->

<?php get_footer();
