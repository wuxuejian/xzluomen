<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 
/*
 * 主题设置页面 - 阅读 @author 多梦 at 2014.06.23 
 * 
 */

function dmeng_options_reading_page(){
	
  if( isset($_POST['action']) && sanitize_text_field($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) :

	update_option( 'dmeng_copyright_status_all', (int)$_POST['copyright_status_all'] );
	update_option( 'dmeng_post_index_all', (int)$_POST['post_index_all'] );
	update_option( 'dmeng_post_thumbnail', (int)$_POST['post_thumbnail'] );

	update_option( 'dmeng_adsense_archive', json_encode(array(
		'top' => htmlspecialchars($_POST['adsense_archive_top']),
		'bottom' => htmlspecialchars($_POST['adsense_archive_bottom'])
	)));
	
	update_option( 'dmeng_adsense_author', json_encode(array(
		'top' => htmlspecialchars($_POST['adsense_author_top']),
		'bottom' => htmlspecialchars($_POST['adsense_author_bottom'])
	)));
	
	update_option( 'dmeng_adsense_single', json_encode(array(
		'top' => htmlspecialchars($_POST['adsense_single_top']),
		'comment' => htmlspecialchars($_POST['adsense_single_comment']),
		'bottom' => htmlspecialchars($_POST['adsense_single_bottom'])
	)));

    dmeng_settings_error('updated');
	  
  endif;
  
  $copyright_status = (int)get_option('dmeng_copyright_status_all',1);
  $post_index = (int)get_option('dmeng_post_index_all',1);
  $post_thumbnail = (int)get_option('dmeng_post_thumbnail',1);
  
	$adsense_archive = json_decode(get_option('dmeng_adsense_archive','{"top":"","bottom":""}'));
	$adsense_author = json_decode(get_option('dmeng_adsense_author','{"top":"","bottom":""}'));
	$adsense_single = json_decode(get_option('dmeng_adsense_single','{"top":"","comment":"","bottom":""}'));

	?>
<div class="wrap">
	<h2><?php _e('多梦主题设置','dmeng');?></h2>
	<form method="post">
		<input type="hidden" name="action" value="update">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
		<h3 class="title"><?php _e('阅读设置','dmeng');?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="copyright_status_all"><?php _e( '版权声明开关', 'dmeng' );?></label></th>
					<td>
						<p><?php _e( '开关网站的版权声明（选择关闭将全部不显示，无论文章页怎么设置）', 'dmeng' );?></p>
						<select name="copyright_status_all" id="copyright_status_all">
							<option value="1" <?php if($copyright_status===1) echo 'selected="selected"';?>><?php _e( '显示', 'dmeng' );?></option>
							<option value="0" <?php if($copyright_status!==1) echo 'selected="selected"';?>><?php _e( '不显示', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="post_index_all"><?php _e( '锚点导航开关', 'dmeng' );?></label></th>
					<td>
						<p><?php _e( '开关文章的锚点导航（选择关闭将全部不显示，无论文章页怎么设置）', 'dmeng' );?></p>
						<select name="post_index_all" id="post_index_all">
							<option value="1" <?php if($post_index===1) echo 'selected="selected"';?>><?php _e( '全部都显示', 'dmeng' );?></option>
							<option value="2" <?php if($post_index===2) echo 'selected="selected"';?>><?php _e( '只在文章页显示', 'dmeng' );?></option>
							<option value="3" <?php if($post_index===3) echo 'selected="selected"';?>><?php _e( '只在页面显示', 'dmeng' );?></option>
							<option value="0" <?php if(!in_array($post_index,array(1,2,3))) echo 'selected="selected"';?>><?php _e( '不显示', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="post_thumbnail"><?php _e( '文章缩略图', 'dmeng' );?></label></th>
					<td>
						<p><?php _e( '在列表页显示文章缩略图（推荐设置220x146特色图像）。', 'dmeng' );?></p>
						<select name="post_thumbnail" id="post_thumbnail">
							<option value="1" <?php if($post_thumbnail===1) echo 'selected="selected"';?>><?php _e( '只显示特色图像', 'dmeng' );?></option>
							<option value="2" <?php if($post_thumbnail===2) echo 'selected="selected"';?>><?php _e( '没有特色图像时显示文章的第一张图片', 'dmeng' );?></option>
							<option value="0" <?php if(!in_array($post_thumbnail,array(1,2))) echo 'selected="selected"';?>><?php _e( '不显示', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<h3 class="title"><?php _e('广告','dmeng');?></h3>
		<p><?php _e('广告条最大宽度为712px','dmeng');?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php _e('归档页','dmeng');?></th>
					<td>
						<fieldset>
							<p><?php _e('分类/标签/搜索/日期归档页顶部','dmeng');?></p>
							<textarea name="adsense_archive_top" rows="3" cols="50" id="adsense_archive_top" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode($adsense_archive->top));?></textarea>
						</fieldset>
						<fieldset>
							<p><?php _e('分类/标签/搜索/日期归档页底部','dmeng');?></p>
							<textarea name="adsense_archive_bottom" rows="3" cols="50" id="adsense_archive_bottom" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode($adsense_archive->bottom));?></textarea>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('作者页','dmeng');?></th>
					<td>
						<fieldset>
							<p><?php _e('作者页顶部','dmeng');?></p>
							<textarea name="adsense_author_top" rows="3" cols="50" id="adsense_author_top" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode($adsense_author->top));?></textarea>
						</fieldset>
						<fieldset>
							<p><?php _e('作者页底部','dmeng');?></p>
							<textarea name="adsense_author_bottom" rows="3" cols="50" id="adsense_author_bottom" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode($adsense_author->bottom));?></textarea>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('内容页','dmeng');?></th>
					<td>
						<fieldset>
							<p><?php _e('文章/页面/附件页顶部','dmeng');?></p>
							<textarea name="adsense_single_top" rows="3" cols="50" id="adsense_single_top" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode($adsense_single->top));?></textarea>
						</fieldset>
						<fieldset>
							<p><?php _e('文章/页面/附件页评论框上方','dmeng');?></p>
							<textarea name="adsense_single_comment" rows="3" cols="50" id="adsense_single_comment" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode($adsense_single->comment));?></textarea>
						</fieldset>
						<fieldset>
							<p><?php _e('文章/页面/附件页底部','dmeng');?></p>
							<textarea name="adsense_single_bottom" rows="3" cols="50" id="adsense_single_bottom" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode($adsense_single->bottom));?></textarea>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( '保存更改', 'dmeng' );?>"></p>
	</form>
</div>
	<?php
}
