<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 
/*
 * 主题设置页面 - 开放平台 @author 多梦 at 2014.06.23 
 * 
 */

function dmeng_options_open_page(){
	
  if( isset($_POST['action']) && sanitize_text_field($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) :

	update_option( 'dmeng_open_qq',  intval($_POST['open_qq']) );
	update_option( 'dmeng_open_qq_id',  sanitize_text_field($_POST['open_qq_id']) );
	update_option( 'dmeng_open_qq_key',  sanitize_text_field($_POST['open_qq_key']) );
	
	update_option( 'dmeng_open_weibo',  intval($_POST['open_weibo']) );
	update_option( 'dmeng_open_weibo_key',  sanitize_text_field($_POST['open_weibo_key']) );
	update_option( 'dmeng_open_weibo_secret',  sanitize_text_field($_POST['open_weibo_secret']) );

   dmeng_settings_error('updated');
    
  endif;

	?>
<div class="wrap">
	<h2><?php _e('多梦主题设置','dmeng');?></h2>
	<form method="post">
		<input type="hidden" name="action" value="update">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
		<h3 class="title"><?php _e('开放平台设置','dmeng');?></h3>
		<p><?php _e('启用社会化登录需同时设置相关开放平台参数，否则无效。','dmeng');?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="open_qq"><?php _e('启用QQ登录','dmeng');?> [ <a href="http://www.dmeng.net/connect-qq.html" title="<?php _e('网站接入QQ登录申请','dmeng');?>" target="_blank">?</a> ]</label></th>
					<td>
						<select name="open_qq" id="open_qq">
							<?php $open_qq = (int)get_option('dmeng_open_qq',1);?>
							<option value="1" <?php if($open_qq===1) echo 'selected="selected"';?>><?php _e( '启用', 'dmeng' );?></option>
							<option value="0" <?php if($open_qq!==1) echo 'selected="selected"';?>><?php _e( '关闭', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="open_qq_id">QQ ID</label></th>
					<td>
						<input name="open_qq_id" type="text" id="open_qq_id" value="<?php echo get_option('dmeng_open_qq_id');?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="open_qq_key">QQ KEY</label></th>
					<td>
						<input name="open_qq_key" type="text" id="open_qq_key" value="<?php echo get_option('dmeng_open_qq_key');?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="open_weibo"><?php _e('启用微博登录','dmeng');?> [ <a href="http://www.dmeng.net/connect-weibo.html" title="<?php _e('网站接入微博登录申请','dmeng');?>" target="_blank">?</a> ]</label></th>
					<td>
						<select name="open_weibo" id="open_weibo">
							<?php $open_weibo = (int)get_option('dmeng_open_weibo',1);?>
							<option value="1" <?php if($open_weibo===1) echo 'selected="selected"';?>><?php _e( '启用', 'dmeng' );?></option>
							<option value="0" <?php if($open_weibo!==1) echo 'selected="selected"';?>><?php _e( '关闭', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="open_weibo_key">WEIBO KEY</label></th>
					<td>
						<input name="open_weibo_key" type="text" id="open_weibo_key" value="<?php echo get_option('dmeng_open_weibo_key');?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="open_weibo_secret">WEIBO SECRET</label></th>
					<td>
						<input name="open_weibo_secret" type="text" id="open_weibo_secret" value="<?php echo get_option('dmeng_open_weibo_secret');?>" class="regular-text">
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( '保存更改', 'dmeng' );?>"></p>
	</form>
</div>
	<?php
}
