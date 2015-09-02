<?php
/**
 * The template for displaying search results pages.
 *
 * @package _s
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="wrap site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php
					$options = get_option( _S_OPTIONS );
					if ( ! empty( $options['search_results_headline'] ) ) {
						$search_results_headline = $options['search_results_headline'];
					} else {
						$search_results_headline = __( 'Search Results for: %s', '_s' );
					}
					
					$search_results_headline = str_replace( '%s', '<span class="search-query">"' . get_search_query() . '"</span>', $search_results_headline );
					echo wp_kses( $search_results_headline, array( 
						'a' => array(
							'href' => array(),
							'title' => array(),
						),
						'br' => array(),
						'em' => array(),
						'strong' => array(),
						'span' => array(
							'class' => array(),
							'id' => array(),
						),
					));
				?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
