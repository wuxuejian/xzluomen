<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

get_header(); ?>
<?php get_header('masthead'); ?>
<div id="main" class="container">
		<div id="content" class="col-lg-8 col-md-8 archive" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
			<?php echo dmeng_adsense('author','top');?>
			<div class="panel panel-default panel-archive">
				<div class="panel-body">
			<div class="media page-header panel-archive-title" itemscope itemtype="http://schema.org/Person">
<?php
global $wp_query;
$curauth = $wp_query->get_queried_object();
$user_name = filter_var($curauth->user_url, FILTER_VALIDATE_URL) ? '<a href="'.$curauth->user_url.'" target="_blank" rel="external">'.$curauth->display_name.'</a>' : $curauth->display_name;
$posts_count =  $wp_query->found_posts;
$comments_count = get_comments( array('status' => '1', 'user_id'=>$curauth->ID, 'count' => true) );
$user_info = get_userdata($curauth->ID);
$credit = intval($user_info->dmeng_credit);
?>
				<a class="pull-left" href="<?php echo esc_url( get_author_posts_url( $curauth->ID ) ) ;?>">
					<?php echo dmeng_get_avatar( $curauth->ID , '80' , dmeng_get_avatar_type($curauth->ID) ); ?>
				</a>
			  <div class="media-body text-muted">
				<h1 class="h4 media-heading user-display-name"><?php echo '<span itemprop="name">'.$user_name.'</span>';?> <small><?php printf(__('共有 %1$s 篇文章，%2$s 条评论，%3$s 个积分。','dmeng'), $posts_count, $comments_count, $credit);?></small></h4>
				<p class="small user-register-time"><?php
				 echo date( __('Y年m月d号','dmeng'), strtotime( $user_info->user_registered ) ) .  '<span>'.__('注册','dmeng').'</span>';
				 if($user_info->dmeng_latest_login) echo date( __('Y年m月d号','dmeng'), strtotime( $user_info->dmeng_latest_login ) ) . '<span>'.__('最后登录','dmeng').'</span>';
				 ?></p><?php 
						$description = $curauth->description;
						echo $description ? $description : __('没有个人说明','dmeng'); ?>
			  </div>
			</div>
<?php
if ( current_user_can('edit_users') ) {
	$message = '';
	if( $_POST ){
		if ( ! wp_verify_nonce( $_POST['creditNonce'], 'credit-nonce' ) ) {
			$message = __('安全认证失败，请重试！','dmeng');
		}else{
			$c_user_id =  $curauth->ID;
			if( isset($_POST['creditChange']) && sanitize_text_field($_POST['creditChange'])=='add' ){
				$c_do = 'add';
				$c_do_title = __('增加','dmeng');
			}else{
				$c_do = 'cut';
				$c_do_title = __('减少','dmeng');
			}

			$c_num =  intval($_POST['creditNum']);
			$c_desc =  sanitize_text_field($_POST['creditDesc']);
			
			$c_desc = empty($c_desc) ? '' : __('备注','dmeng') . ' : '. $c_desc;
			
			$current_user = wp_get_current_user();
			
			update_dmeng_credit( $c_user_id , $c_num , $c_do , 'dmeng_credit' , sprintf(__('%1$s将你的积分%2$s %3$s 分。%4$s','dmeng') , $current_user->display_name, $c_do_title, $c_num, $c_desc) );
			
			$message = sprintf(__('操作成功！已将%1$s的积分%2$s %3$s 分。','dmeng'), $user_name, $c_do_title, $c_num);
		}
	}	 //~ $_POST
	
	if($message) echo '<div class="alert alert-warning" role="alert">'.$message.'</div>';
?>
			<div class="panel panel-danger">
				<div class="panel-heading"><?php echo $curauth->display_name.__('积分变更（仅管理员可见）','dmeng');?></div>
				<div class="panel-body">
<form role="form"  action="<?php echo dmeng_get_current_page_url(); ?>" method="post">
	<input type="hidden" name="creditNonce" value="<?php echo  wp_create_nonce( 'credit-nonce' );?>" >
	<p>
		<label class="radio-inline"><input type="radio" name="creditChange" value="add" aria-required='true' required checked><?php _e('增加积分','dmeng');?></label>
		<label class="radio-inline"><input type="radio" name="creditChange" value="cut" aria-required='true' required><?php _e('减少积分','dmeng');?></label>
	</p>
	<div class="form-inline">
	  <div class="form-group">
		<div class="input-group">
		  <div class="input-group-addon"><?php _e('积分','dmeng');?></div>
		  <input class="form-control" type="text" name="creditNum" aria-required='true' required>
		</div>
	  </div>
	  <div class="form-group">
		<div class="input-group">
		  <div class="input-group-addon"><?php _e('备注','dmeng');?></div>
		  <input class="form-control" type="text" name="creditDesc" aria-required='true' required>
		</div>
	  </div>
	   <button class="btn btn-default" type="submit"><?php _e('提交','dmeng');?></button>
	</div>
	<p class="help-block"><?php _e('请谨慎操作！积分数只能填写数字，备注将显示在用户的积分记录中。','dmeng');?></p>
</form>
			  </div>
			</div>

<?php
} //~ if ( current_user_can('edit_users') ) 
 ?>
			<?php /*
				while ( have_posts() ) : the_post();
					get_template_part('content','archive');
				endwhile; // end of the loop. 
				dmeng_paginate();*/
			?>
				</div>
			</div>
			<?php echo dmeng_adsense('author','bottom');?>
		 </div><!-- #content -->
		<?php get_sidebar();?>
 </div><!-- #main -->
<?php get_footer('colophon'); ?>
<?php get_footer(); ?>
