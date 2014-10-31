<?php
/**
 * Template Name: 【DW主题】无侧边栏页面
*/

get_header(); ?>

    <div id="main">
        
        <?php 
            if (have_posts()) : while (have_posts()) : the_post();
                /**
                 * Find the post formatting for the pages in the post-page.php file
                 */
                get_template_part('post', 'page');
                
                if(comments_open( get_the_ID() ))  {
                    comments_template('', true); 
                }
            endwhile;
            
            else :
                get_template_part('post', 'noresults');
            endif;       ?>
    
<?php get_footer(); ?>   
 </div>