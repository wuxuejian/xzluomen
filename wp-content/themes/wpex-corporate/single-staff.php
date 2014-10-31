<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Corporate WPExplorer Theme
 * @since Corporate 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<div id="primary" class="content-area clr">
		<div id="content" class="site-content left-content clr" role="main">
			<article>
				<header class="page-header clr">
					<h1 class="page-header-title"><?php the_title(); ?></h1>
				</header><!-- .page-header -->
				<div class="entry clr">
					<?php the_content(); ?>
				</div><!-- .entry -->
				<footer class="entry-footer">
					<?php edit_post_link( __( 'Edit Post', 'wpex' ), '<span class="edit-link clr">', '</span>' ); ?>
				</footer><!-- .entry-footer -->
			</article>
			<?php
			// Comments
			if ( get_theme_mod( 'wpex_staff_comments') ) {
				comments_template();
			} ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links clr">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div><!-- #content -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->
<?php endwhile; ?>
<?php get_footer(); ?>