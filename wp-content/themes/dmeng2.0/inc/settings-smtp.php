<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 
/*
 * 主题设置页面 - SMTP @author 多梦 at 2014.06.23 
 * 
 */

function dmeng_options_smtp_page(){
	
  if( isset($_POST['action']) && sanitize_text_field($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) :

	update_option('dmeng_smtp',json_encode(array(
		'option' => $_POST['dmeng_smtp_option'],
		'host' => $_POST['dmeng_smtp_host'],
		'ssl' => $_POST['dmeng_smtp_ssl'],
		'port' => $_POST['dmeng_smtp_port'],
		'user' => $_POST['dmeng_smtp_user'],
		'pass' => $_POST['dmeng_smtp_pass'],
		'name' => $_POST['dmeng_smtp_name'],
	)));

	dmeng_settings_error('updated');
	  
  endif;

	$smtp = json_decode(get_option('dmeng_smtp','{"option":"0","host":"","ssl":"0","port":"25","user":"","pass":"","name":""}'));
	$option = intval($smtp->option);
	$host = sanitize_text_field($smtp->host);
	$ssl = intval($smtp->ssl);
	$port = intval($smtp->port);
	$user = sanitize_text_field($smtp->user);
	$pass = sanitize_text_field($smtp->pass);
	$name = empty($smtp->name) ? get_bloginfo('name') : sanitize_text_field($smtp->name);

	?>
<div class="wrap">
	<h2><?php _e('多梦主题设置','dmeng');?></h2>
	<form method="post">
		<input type="hidden" name="action" value="update">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
		<h3 class="title"><?php _e('SMTP 发信','dmeng');?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="dmeng_smtp_option">启用SMTP</label></th>
					<td>
						<select name="dmeng_smtp_option" id="dmeng_smtp_option">
							<option value="1" <?php if($option===1) echo 'selected="selected"';?>><?php _e( '启用', 'dmeng' );?></option>
							<option value="0" <?php if($option!==1) echo 'selected="selected"';?>><?php _e( '禁用', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmeng_smtp_host">发信服务器</label></th>
					<td>
						<input name="dmeng_smtp_host" type="text" id="dmeng_smtp_host" value="<?php echo $host?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmeng_smtp_ssl">启用 SSL</label></th>
					<td>
						<select name="dmeng_smtp_ssl" id="dmeng_smtp_ssl">
							<option value="1" <?php if($ssl===1) echo 'selected="selected"';?>><?php _e( '启用', 'dmeng' );?></option>
							<option value="0" <?php if($ssl!==1) echo 'selected="selected"';?>><?php _e( '禁用', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmeng_smtp_port">端口号</label></th>
					<td>
						<input name="dmeng_smtp_port" type="text" id="dmeng_smtp_port" value="<?php echo $port;?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmeng_smtp_user">发信账号</label></th>
					<td>
						<input name="dmeng_smtp_user" type="text" id="dmeng_smtp_user" value="<?php echo $user;?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmeng_smtp_pass">账号密码</label></th>
					<td>
						<input name="dmeng_smtp_pass" type="password" id="dmeng_smtp_pass" value="<?php echo $pass;?>" class="regular-text">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmeng_smtp_name">显示昵称</label></th>
					<td>
						<input name="dmeng_smtp_name" type="text" id="dmeng_smtp_name" value="<?php echo $name;?>" class="regular-text">
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( '保存更改', 'dmeng' );?>"></p>
	</form>
</div>
	<?php
}
