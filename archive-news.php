<!-- メインループに書き換えた -->
<?php get_header(); ?>

	<div class="archive">

		<ul class="archive-list">

			<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
			?>

						<li class="news-item">
							<a href="<?php the_permalink() ;?>">
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
		<!-- /ニュース３件出力 -->

		<div class="pagination">
			<?php global $wp_rewrite;
				$paginate_base = get_pagenum_link(1);
				if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
				$paginate_format = '';
				$paginate_base = add_query_arg('paged', '%#%');
				} else {
				$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') .
				user_trailingslashit('page/%#%/', 'paged');
				$paginate_base .= '%_%';
				}
				the_posts_pagination( array(
				'base' => $paginate_base,
				'format' => $paginate_format,
				'total' => $wp_query->max_num_pages,
				'mid_size' => 5,
				'current' => ($paged ? $paged : 1),
				));
			?>
		</div>
		<!-- //ナビゲーション -->

	</div>
	<!-- /ニュース（get_post） -->

<?php get_footer();
