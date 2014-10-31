<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 用户页模板 @author 多梦 at 2014.06.19 
 * 
 */

if( !is_user_logged_in() ){
	wp_redirect(wp_login_url(dmeng_get_current_page_url()));
	exit;
}

get_header(); ?>
<?php get_header('user'); ?>

<div id="main" class="container">

		<div id="content" class="col-lg-8 col-md-8 col-sm-8" role="main">
			<div class="panel panel-default panel-archive">
				<div class="panel-body">
<?php

			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$user = get_current_user_id();
			$query = new WP_Query( array( 'paged' => $paged , 'author' => $user , 'post_status' => array( 'pending', 'draft', 'publish' ) ) );
			if ( $query->have_posts() && ( !isset($_GET['action']) || ( isset($_GET['action'])  && trim(($_GET['action']))!=='new' ) ) &&  !isset($_GET['p'])  ) {
				?>
<div class="panel panel-default">
	<div class="panel-body">
		<a href="<?php echo dmeng_get_user_url('post');?>" class="btn btn-default"><?php _e('已发表','dmeng');?> <?php echo count_user_posts( get_current_user_id() );?></a>
		<a href="<?php echo add_query_arg('action','new',dmeng_get_user_url('post'));?>" class="btn btn-info"><?php _e('投稿','dmeng');?></a> 
	</div>
</div>
				<?php
				while ( $query->have_posts() ) : $query->the_post();
					get_template_part('content','archive');
				endwhile; // end of the loop. 
				dmeng_paginate($query);
				wp_reset_postdata();
			}else{
				get_template_part('post','new');
			}
 ?>
				</div>
			</div>
		 </div><!-- #content -->
		 <?php get_sidebar('user');?>	

 </div><!-- #main -->

<?php get_footer('only-copyright'); ?>
<?php get_footer(); ?>
