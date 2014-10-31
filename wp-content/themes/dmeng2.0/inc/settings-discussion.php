<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 
/*
 * 主题设置页面 - 讨论 @author 多梦 at 2014.06.23 
 * 
 */

function dmeng_options_discussion_page(){
	
  if( isset($_POST['action']) && sanitize_text_field($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) :

	update_option( 'dmeng_sticky_comment_title', sanitize_text_field($_POST['sticky_comment_title']) );
	update_option( 'dmeng_sticky_comment_button_txt', sanitize_text_field($_POST['sticky_comment_button_txt']) );

    dmeng_settings_error('updated');
	  
  endif;
  
  $title = get_option('dmeng_sticky_comment_title', __('置顶评论','dmeng'));
  $button_txt = get_option('dmeng_sticky_comment_button_txt',__('置顶','dmeng'));
	
	?>
<div class="wrap">
	<h2><?php _e('多梦主题设置','dmeng');?></h2>
	<form method="post">
		<input type="hidden" name="action" value="update">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
		<h3 class="title"><?php _e('讨论设置','dmeng');?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="sticky_comment_title"><?php _e( '“置顶评论”标题文本', 'dmeng' );?></label></th>
					<td><input name="sticky_comment_title" type="text" value="<?php echo $title; ?>" class="regular-text"></td>
				</tr>
				<tr>
					<th scope="row"><label for="sticky_comment_button_txt"><?php _e( '“置顶”按钮文本', 'dmeng' );?></label></th>
					<td><input name="sticky_comment_button_txt" type="text" value="<?php echo $button_txt; ?>" class="regular-text"></td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( '保存更改', 'dmeng' );?>"></p>
	</form>
</div>
	<?php
}
