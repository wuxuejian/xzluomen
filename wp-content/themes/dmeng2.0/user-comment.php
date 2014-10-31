<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 用户评论页模板 @author 多梦 at 2014.06.19 
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

<ul class="list-group">

<?php

$all = get_comments( array('status' => '0', 'user_id'=>get_current_user_id(), 'count' => true) );
$approve = get_comments( array('status' => '1', 'user_id'=>get_current_user_id(), 'count' => true) );

$paged = max( 1, get_query_var('page') );
$number = 10;
$offset = ($paged-1)*$number;
$pages = ceil($all/$number);

$comments = get_comments(array(
	'order' => 'DESC',
	'number' => $number,
	'offset' => $offset,
	'user_id' => get_current_user_id()
));

if($comments){
	echo '<li class="list-group-item text-muted small">' . sprintf(__('共有 %1$s 条评论，其中 %2$s 条已获准， %3$s 条正等待审核。','dmeng'),$all, $approve, $all-$approve) . '</li>';
	foreach( $comments as $comment ){
		$item_html = ' <li class="list-group-item">';
		if($comment->comment_approved!=1) $item_html .= '<small class="text-danger">'.__( '这条评论正在等待审核','dmeng' ).'</small>';
		$item_html .= '<p class="list-group-item-heading">'.$comment->comment_content . '</p>';
		$item_html .= '<a class="list-group-item-text small" href="'.htmlspecialchars( get_comment_link( $comment->comment_ID) ).'">'.sprintf(__('%1$s 发表在 %2$s','dmeng'),$comment->comment_date,get_the_title($comment->comment_post_ID)).'</a>';
		$item_html .= '</li>';
		echo $item_html;
	}
	$tips = sprintf(__('第 %1$s 页，共 %2$s 页，每页显示 %3$s 条。','dmeng'),$paged, $pages, $number);
}else{
	$tips = __('没有找到记录','dmeng');
}
?>
	<li class="list-group-item text-muted small"><?php echo $tips;?></li>
</ul>

<?php
if ($pages>1 ){

echo '<ul class="pager">';

	if($paged>1) echo '<li class="previous"><a href="' . add_query_arg('page',$paged-1) . '">'.__('上一页','dmeng').'</a></li>';
	if($paged<$pages) echo '<li class="previous"><a href="' . add_query_arg('page',$paged+1) . '">'.__('下一页','dmeng').'</a></li>';
	echo '<li class="next"><a href="' . add_query_arg('page',$pages) . '">'.__('最后一页','dmeng').'</a></li>';
	echo '<li class="next"><a href="' . add_query_arg('page',1) . '">'.__('第一页','dmeng').'</a></li>';
	
echo '</ul>';

}
?>

		 </div><!-- #content -->
		 <?php get_sidebar('user');?>	

 </div><!-- #main -->

<?php do_action( 'login_footer' ); ?>
<?php get_footer('only-copyright'); ?>
<?php get_footer(); ?>
