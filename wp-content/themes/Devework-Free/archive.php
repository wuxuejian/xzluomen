<?php get_header(); ?>
    <div id="main">
      <div id="content">
            <?php 
                if (have_posts()) : while (have_posts()) : the_post();
                    get_template_part('post', 'archive');
                endwhile;
                
                else :
                    get_template_part('post', 'noresults');
                endif; 
            ?> 
     
         <div class="page_navi"><?php par_pagenavi(7); ?></div>  
        </div><!-- #content -->   
        <?php get_sidebar(); ?>
    </div><!-- #main -->   
<?php get_footer(); ?>