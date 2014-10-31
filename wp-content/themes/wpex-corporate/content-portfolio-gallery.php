<?php
/**
 * The default template for displaying portfolio content.
 *
 * @package		WordPress
 * @subpackage	Corporate WPExplorer Theme
 * @since		Corporate 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Single Posts
global $wpex_query;
if ( is_singular( 'portfolio' ) && ! $wpex_query ) {

	// Display post slider based on gallery images
	// See functions/post-slider.php
	wpex_post_slider();

// Entries
} else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if( has_post_thumbnail() ) {  ?>
			<div class="portfolio-entry-media clr">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="overlayparent">
					<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php the_title(); ?>" class="portfolio-entry-img" />
					<div class="overlay"><h3><?php the_title(); ?></h3></div>
				</a>
			</div><!-- .portfolio-entry-media -->
		<?php } ?>
	</article><!-- .portfolio-entry -->

<?php } ?>