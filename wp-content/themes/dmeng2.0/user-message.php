<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 用户消息页模板 @author 多梦 at 2014.06.19 
 * 
 */

if( !is_user_logged_in() ){
	wp_redirect(wp_login_url(dmeng_get_current_page_url()));
	exit;
 }
 
get_header(); ?>
<?php get_header('user'); ?>

<div id="main" class="container">
	<div class="row">

		<div id="content" class="col-lg-8 col-md-8 col-sm-8" role="main">

<ul class="list-group">
<?php

$all = get_dmeng_message(get_current_user_id(), 'count', "msg_type!='credit'");

$paged = max( 1, get_query_var('page') );
$number = 10;
$offset = ($paged-1)*$number;
$pages = ceil($all/$number);

$creditLog = get_dmeng_message(get_current_user_id(), '', '', $number,$offset);

if($creditLog){
	foreach( $creditLog as $log ){
		$log_class = $log->msg_type!=='read' ? 'list-group-item list-group-item-success' : 'list-group-item';
		echo '<li class="'.$log_class.'"><p class="list-group-item-heading">'.htmlspecialchars_decode($log->msg_content).' </p><p class="list-group-item-text text-muted small"> '.$log->msg_title.'  '.$log->msg_date.'</p></li>';
		if($log->msg_type!=='read') update_dmeng_message_type( $log->msg_id, get_current_user_id() , 'read' );
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
		 
	</div>
 </div><!-- #main -->

<?php get_footer('only-copyright'); ?>
<?php get_footer(); ?>
