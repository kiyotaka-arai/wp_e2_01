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
							<a href="<?php the_permalink(); ?>">
								<p>
									<?php the_time('Y年 n月'); ?>
								</p>
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

	</div>
	<!-- /ニュース（get_post） -->

<?php get_footer();
