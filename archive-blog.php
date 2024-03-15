<!-- メインループに書き換えた -->
<?php get_header(); ?>

	<div class="archive">

		<ul class="archive-list">

			<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
			?>

						<li class="blog-item">
							<a href="<?php the_permalink(); ?>">
								<figure>
									<?php
										if ( has_post_thumbnail() ):
											the_post_thumbnail();
										endif;
									?>
								</figure>
								<p>
									<?php
										$post_id = get_the_ID();
										$term = get_the_terms( $post_id, 'blog_cat' );
									?>
								</p>
								<time>
									<?php the_time('Y年 n月'); ?>
								</time>
								<h3>
									<?php the_title(); ?>
								</h3>
								<?php the_content(); ?>
							</a>
						</li>

					<?php endwhile;
					?>

				<?php else : ?>

					<li>まだ投稿がありません。</li>

				<?php
					endif;
				?>

		</ul>
		<!-- /ブログ３件出力 -->

		<div class="pagination">
			<?php global $wp_rewrite;
			// パーマリンク構造からリライト一致とクエリを構築します。
			// 現在の WP_Rewrite インスタンスへの参照であるパラメータを指定してアクション ‘generate_rewrite_rules’ を実行し、パーマリンク構造をさらに操作し、ルールを書き換えます。完全な書き換えルール配列に対して ‘rewrite_rules_array’ フィルターを実行します
				$paginate_base = get_pagenum_link(1);
				// $paginate_baseは自作なんでしょ？？？？
				// get_pagenum_link
				// ページ番号リンクを取得する
				// パラメータ
				// $pagenum
				// ページ番号を指定（省略時は1）。
				if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
					// strpos
					// 文字列内の部分文字列が最初に現れる場所を見つける
					// 文字列 haystack の中で、 needle が最初に現れる位置を探します。
					// needle が見つからない場合は false を返します。
					// こっちはtrusyでしょ？？？？
					// using_permalinks
					// パーマリンクが使用されているかどうかを決定します。
					// パーマリンクが有効な場合は True。
				$paginate_format = '';
				// ここで多分初期化してるんでしょ？？？？
				$paginate_base = add_query_arg('paged', '%#%');
				// add_query_arg
				// クエリーURIを更新する
				// 何もわからん😭
				} else {
				$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') .
				user_trailingslashit('page/%#%/', 'paged');
				// サイトが末尾のスラッシュを追加するように設定されている場合、末尾のスラッシュ付きの文字列を取得します。
				$paginate_base .= '%_%';
				// なんやこれ！！？？
				// 代入演算子
				// $a = $a . $b に同じ
				}
				// echo paginate_links( array(
				the_posts_pagination( array(
					// paginate_links
					// アーカイブされた投稿ページのページ番号付きのリンクを取得します。この関数は（技術的には）任意のページへ飛ぶためのページ番号付きリンクを生成できます。
					// 取得というか設定してるんでしょ？？？？
					// WP4.1よりthe_posts_pagination() が実装されましたが、内部的にpaginate_links() を利用しているため両方の引数が使えます。
					// the_posts_pagination()の方にあとで変えたほうがいいのかな
					// the_posts_pagination()の方にあとで変えたほうがいいのかな
					// the_posts_pagination()の方にあとで変えたほうがいいのかな
					// 変えちゃった
				'base' => $paginate_base,
				// ベースのURLを生成します。
				// ページ番号付きのリンクを生成するために使われるベースの URL を指定
				// %_%
				'format' => $paginate_format,
				// ページネーションの構造を指定
				// 初期値：	?page=%#%
				'total' => $wp_query->max_num_pages,
				// そこでまずは合計ページ数の情報を、WordPressにおいてグローバル変数として扱われる「$wp_query」から取得していきます。合計のページ数は$wp_queryの中にある「max_num_pages」という場所に格納されています。
				'mid_size' => 5,
				// 初期値：2
				// 現在のページの両側にいくつの数字を表示するか。ただし現在のページは含みません。
				'current' => ($paged ? $paged : 1),
				// 三項演算子きてる
				// 現在のページ番号
				// 初期値：0
				));
				// すごい一瞬でできたやん！！！！
				// あかんここ難しすぎるやろ何個メソッド使うねん
				// https://wpqw.jp/wordpress/themes/the-posts-pagination/
			?>
		</div>
		<!-- //ナビゲーション -->

	</div>
	<!-- /ブログ（WP_Query） -->

<?php get_footer();
