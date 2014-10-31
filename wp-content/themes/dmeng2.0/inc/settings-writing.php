<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 
/*
 * 主题设置页面 - 撰写 @author 多梦 at 2014.06.23 
 * 
 */

function dmeng_options_writing_page(){
	
  if( isset($_POST['action']) && sanitize_text_field($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) :

	update_option( 'dmeng_copyright_status_default', (int)$_POST['copyright_status_default'] );
	update_option( 'dmeng_copyright_content_default', htmlspecialchars($_POST['copyright_content_default']) );
	update_option( 'dmeng_post_index', (int)$_POST['post_index'] );
	
	$dmeng_can_post_cat = empty($_POST['can_post_cat']) ? array() : $_POST['can_post_cat'];
	update_option( 'dmeng_can_post_cat', json_encode($dmeng_can_post_cat) );

    dmeng_settings_error('updated');
	  
  endif;
  
  $copyright_status = (int)get_option('dmeng_copyright_status_default',1);
  $copyright_content = get_option('dmeng_copyright_content_default',sprintf(__('原文链接：%s，转发请注明来源！','dmeng'),'<a href="{link}" rel="author">{title}</a>'));
  $post_index = (int)get_option('dmeng_post_index',1);
  
 $can_post_cat = json_decode(get_option('dmeng_can_post_cat','[]'));

	?>
<div class="wrap">
	<h2><?php _e('多梦主题设置','dmeng');?></h2>
	<form method="post">
		<input type="hidden" name="action" value="update">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
		<h3 class="title"><?php _e('撰写设置','dmeng');?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="copyright_status_default"><?php _e( '（默认）版权声明开关', 'dmeng' );?></label></th>
					<td>
						<p><?php _e( '在文章/页面内容下的版权声明', 'dmeng' );?></p>
						<select name="copyright_status_default" id="copyright_status_default">
							<option value="1" <?php if($copyright_status===1) echo 'selected="selected"';?>><?php _e( '显示', 'dmeng' );?></option>
							<option value="9" <?php if($copyright_status!==1) echo 'selected="selected"';?>><?php _e( '不显示', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="copyright_content_default"><?php _e( '（默认）版权声明内容', 'dmeng' );?></label></th>
					<td>
						<fieldset>
							<p><?php _e( '版权声明内容，文章链接用{link}表示，文章标题用{title}表示，站点地址用{url}表示，站点名称用{name}表示。', 'dmeng' );?></p>
							<textarea name="copyright_content_default" rows="1" cols="50" id="copyright_content_default" class="large-text code"><?php echo stripcslashes(htmlspecialchars_decode($copyright_content));?></textarea>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="post_index"><?php _e( '（默认）锚点导航开关', 'dmeng' );?></label></th>
					<td>
						<p><?php _e( '选择是时将把文章页和页面内容中的H标题生成锚点导航目录。', 'dmeng' );?></p>
						<select name="post_index" id="post_index">
							<option value="1" <?php if($post_index===1) echo 'selected="selected"';?>><?php _e( '显示', 'dmeng' );?></option>
							<option value="9" <?php if($post_index!==1) echo 'selected="selected"';?>><?php _e( '不显示', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<h3 class="title"><?php _e('投稿','dmeng');?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="can_post_cat"><?php _e( '允许投稿的分类', 'dmeng' );?></label></th>
					<td>
<?php
$categories = get_categories( array('hide_empty' => 0) );
foreach ( $categories as $category ) {
	?>
<label><input name="can_post_cat[]" type="checkbox" value="<?php echo $category->term_id;?>" <?php if(in_array($category->term_id,$can_post_cat)) echo 'checked';?>> <?php echo $category->name;?> </label> 
	<?php
}
?>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( '保存更改', 'dmeng' );?>"></p>
	</form>
</div>
	<?php
}
