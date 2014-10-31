<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 
/*
 * 主题设置页面 - 高级工具 @author 多梦 at 2014.06.23 
 * 
 */

function dmeng_options_tool_page(){
	
  if( isset($_POST['action']) && sanitize_text_field($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) :

	$nonce = explode("+", trim($_POST['nonce_title']));
	if( $nonce[0]==__('我确认操作','dmeng') && wp_verify_nonce( $nonce[1], 'check-captcha' ) ) {
		
		global $wpdb;

		//~ 删除主题自己建的表
		$table_message = $wpdb->prefix . 'dmeng_message';   
		$wpdb->query("DROP TABLE IF EXISTS ".$table_message);
		
		$table_meta = $wpdb->prefix . 'dmeng_meta';   
		$wpdb->query("DROP TABLE IF EXISTS ".$table_meta);
		
		$table_tracker = $wpdb->prefix . 'dmeng_tracker';   
		$wpdb->query("DROP TABLE IF EXISTS ".$table_tracker);

		//~ 清理在WordPress表格中的数据
		$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'dmeng_%'" );
		$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key LIKE 'dmeng_%'" );
		$wpdb->query( "DELETE FROM $wpdb->usermeta WHERE meta_key LIKE 'dmeng_%'" );
		$wpdb->query( "DELETE FROM $wpdb->commentmeta WHERE meta_key LIKE 'dmeng_%'" );

		//~ 切换到其他主题
		$new_theme = '';
		$current_theme = wp_get_theme();
		$themes = wp_get_themes(array( 'errors' => false , 'allowed' => null ));
		foreach(	$themes as $theme_name=>$theme_data ){
			if($theme_name!=$current_theme->template) $new_theme = $theme_name;
		}

		switch_theme( $new_theme );

			?>
			<script>window.location.href='<?php echo admin_url('themes.php?activated=true');?>';</script>
			<?php

	}else{
		
		dmeng_settings_error('error',__('验证码有误，请重试。','dmeng'));
		
	}

  else :
  
	dmeng_settings_error('error',__('请注意：以下操作不可逆！务必谨慎操作！','dmeng'));
	
  endif;

	?>
<div class="wrap">
	<h2><?php _e('多梦主题设置','dmeng');?></h2>
	<form method="post">
		<input type="hidden" name="action" value="update">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
		<h3 class="title"><?php _e('高级工具','dmeng');?></h3>
		<p><?php _e('多梦主题数据包括版权声明、幻灯片、浏览次数、投票数据、消息、积分等。这些数据属于多梦主题私有。','dmeng');?></p>
		<p><?php _e('清理范围包括： 删除 dmeng_message、dmeng_meta、dmeng_tracker 三个表，删除 options、postmeta、usermeta、commentmeta 表以 dmeng_ 开头为 key 的数据。注：多梦主题在 wordpress table 中存储的全部数据的 key 都是以 dmeng_ 开头的。','dmeng');?></p>
		<p style="color:#0074a2;"><?php _e('如果你确定清理并停用多梦主题，请按提示输入”我确认操作”+验证字符的组合（+号也要输入），然后点击清理并停用。','dmeng');?></p>
		<p><?php
		//~ 把一段中文这样分开是防止本地化之后无法验证文字
		_e('请输入：','dmeng');
		_e('我确认操作','dmeng');
		echo '+'.wp_create_nonce('check-captcha');?></p>
		<p><input name="nonce_title" type="text" id="nonce_title" value="" class="regluar-text ltr"> <span style="color:#dd3d36;"><?php _e('请先备份数据库，以防不测。','dmeng');?></span></p>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary confirm" value="<?php _e( '清理并停用', 'dmeng' );?>"></p>
		<p><?php _e('清理WordPress冗余数据（如修订版本、回收站中的文章/垃圾评论等），推荐使用 WP Clean Up  。','dmeng');?>
		
	</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#nonce_title').bind("paste", function(e) {
		alert('<?php _e('为了您的数据安全，请不要直接复制粘贴！','dmeng');?>');
		e.preventDefault();
	});
	jQuery('.confirm').live('click',function(event){
		var r = confirm( '<?php _e('确定要清理吗？你备份数据库了吗？本操作不可逆！','dmeng');?>' );
		if ( r == false ) return false;
    });
});
</script>
	<?php
}
