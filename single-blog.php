<?php get_header(); ?>

	<?php
		while ( have_posts() ) :
		the_post();
	?>

		<h1 class="ttl-area">
			<?php the_title(); ?>
		</h1>
		<p>
			<?php
				$term = get_the_terms( 0, 'blog_cat' );
				echo esc_html( $term[0] -> name );
			?>
		</p>
		<time datetime="the_time( 'Y-m-d' )"><?php the_time( 'Y.m.d' ); ?></time>
		<div class="edit-area">
			<?php the_content(); ?>
		</div>

	<?php endwhile; ?>

<?php get_footer();
