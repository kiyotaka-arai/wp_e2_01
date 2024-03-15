<!-- 会社概要 -->
<?php get_header(); ?>

	<div class="">

		<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
		?>

					<h3>
						<?php the_title(); ?>
					</h3>
					<?php the_content(); ?>

					<div class="list">

						<dl>
							<dt>代表取締役社長</dt>
							<dd>
								<?php the_field('ceo'); ?>
							</dd>
						</dl>
						<dl>
							<dt>社員数</dt>
							<dd>
								<span>
									<?php the_field('employees'); ?>人
								</span>

							</dd>
						</dl>
						<dl>
							<dt>取引先</dt>
							<dd>
								<?php the_field('suppliers'); ?>
							</dd>
						</dl>

					</div>

				<?php endwhile;
				?>

			<?php else : ?>

			<li>まだ投稿がありません。</li>

			<?php endif;
				wp_reset_postdata();
			?>

	</div>

<?php get_footer();
