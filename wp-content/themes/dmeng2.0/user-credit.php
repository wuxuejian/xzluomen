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

<?php

$credit = intval(get_user_meta( get_current_user_id(), 'dmeng_credit', true )); 
$credit_void = intval(get_user_meta( get_current_user_id(), 'dmeng_credit_void', true )); 

?>

<ul class="list-group">
	<li class="list-group-item clearfix">
<div class="btn-group btn-group-justified">
  <div class="btn-group">
     <span class="btn btn-info"><?php printf(__('总积分 %s','dmeng') , '<span class="glyphicon glyphicon-credit-card"></span> ' . ($credit+$credit_void) );?></span>
  </div>
  <div class="btn-group">
     <span class="btn btn-warning"><?php printf(__('已消费 %s','dmeng') , '<span class="glyphicon glyphicon-shopping-cart"></span> ' . $credit_void );?></span>
  </div>
  <div class="btn-group">
    <span class="btn btn-success"><?php printf(__('当前可用 %s','dmeng') , '<span class="glyphicon glyphicon-ok-sign"></span> ' . $credit );?></span>
  </div>
</div>
	</li>
	<li class="list-group-item disabled">
		<div class="input-group">
			<span class="input-group-addon"><?php _e('推广链接','dmeng');?></span>
			<input type="text" class="form-control" value="<?php echo add_query_arg('fid' , get_current_user_id() , home_url('/') );?>">
		</div>
	</li>
<?php

$all = get_dmeng_message(get_current_user_id(), 'count', "msg_type='credit'");

$paged = max( 1, get_query_var('page') );
$number = 10;
$offset = ($paged-1)*$number;
$pages = ceil($all/$number);

$creditLog = get_dmeng_credit_message(get_current_user_id(), $number,$offset);

if($creditLog){
	foreach( $creditLog as $log ){
		echo '<li class="list-group-item text-muted"><span>'.$log->msg_date.'</span>  '.$log->msg_title.'</li>';
	}
	$tips = sprintf(__('第 %1$s 页，共 %2$s 页，每页显示 %3$s 条。','dmeng'),$paged, $pages, $number);
}else{
	$tips = __('没有找到记录','dmeng');
}
?>
	<li class="list-group-item text-muted"><?php echo $tips;?></li>
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

    <table class="table table-bordered ">
      <thead>
        <tr class="active">
          <th><?php _e('积分方法','dmeng');?></th>
          <th><?php _e('一次得分','dmeng');?></th>
          <th><?php _e('可用次数','dmeng');?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php _e('注册奖励','dmeng');?></td>
          <td><?php printf( __('%1$s 分','dmeng'), get_option('dmeng_reg_credit','50'));?></td>
          <td><?php _e('只有 1 次','dmeng');?></td>
        </tr>
        <tr>
          <td><?php _e('文章投稿','dmeng');?></td>
          <td><?php printf( __('%1$s 分','dmeng'), get_option('dmeng_rec_post_credit','50'));?></td>
          <td><?php printf( __('每天 %1$s 次','dmeng'), get_option('dmeng_rec_post_num','5'));?></td>
        </tr>
        <tr>
          <td><?php _e('评论回复','dmeng');?></td>
          <td><?php printf( __('%1$s 分','dmeng'), get_option('dmeng_rec_comment_credit','5'));?></td>
          <td><?php printf( __('每天 %1$s 次','dmeng'), get_option('dmeng_rec_comment_num','50'));?></td>
        </tr>
        <tr>
          <td><?php _e('访问推广','dmeng');?></td>
          <td><?php printf( __('%1$s 分','dmeng'), get_option('dmeng_rec_view_credit','5'));?></td>
          <td><?php printf( __('每天 %1$s 次','dmeng'), get_option('dmeng_rec_view_num','50'));?></td>
        </tr>
        <tr>
          <td><?php _e('注册推广','dmeng');?></td>
          <td><?php printf( __('%1$s 分','dmeng'), get_option('dmeng_rec_reg_credit','50'));?></td>
          <td><?php printf( __('每天 %1$s 次','dmeng'), get_option('dmeng_rec_reg_num','5'));?></td>
        </tr>
      </tbody>
    </table>
		 </div><!-- #content -->
		 <?php get_sidebar('user');?>		 

 </div><!-- #main -->

<?php get_footer('only-copyright'); ?>
<?php get_footer(); ?>
