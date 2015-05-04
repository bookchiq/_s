<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package _s
 */

get_header();
$options = get_option( _S_OPTIONS );
 ?>

	<div id="primary" class="content-area">
		<main id="main" class="wrap site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php
						if ( ! empty( $options['four_oh_four_headline'] ) ) {
							$four_oh_four_headline = $options['four_oh_four_headline'];
						} else {
							$four_oh_four_headline = esc_html__( 'Oops! That page can&rsquo;t be found.', '_s' );
						}
						echo $four_oh_four_headline;
					?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php
						if ( ! empty( $options['four_oh_four_intro'] ) ) {
							$four_oh_four_intro = $options['four_oh_four_intro'];
						} else {
							$four_oh_four_intro = esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_s' );
						}
						echo $four_oh_four_intro;
					?></p>

					<div id="widgets" class="widget-area" role="complementary">
						<?php if ( ! dynamic_sidebar( 'four-oh-four' ) ) { ?>
							<?php get_search_form(); ?>

							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( _s_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', '_s' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>

							<?php
								/* translators: %1$s: smiley */
								$archive_content = '<p>' . __( 'Try looking in the monthly archives.', '_s' ) . '</p>';
								the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>

							<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
						<?php } ?>
					</div><!-- #secondary -->

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
