<?php

 /**
* Template Name:案例展示
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/ 
get_header(); ?>
<?php get_header('masthead'); ?>
<div id="main" class="container" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
			<?php 
				while ( have_posts() ) : the_post();
					get_template_part('content');
				endwhile; // end of the loop. 
				dmeng_paginate();
			?>
		<?php get_sidebar();?>
 </div><!-- #main -->
<?php get_footer('colophon'); ?>
<?php get_footer(); ?>
