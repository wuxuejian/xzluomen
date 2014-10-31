<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 主题设置页面 @author 多梦 at 2014.06.23 
 * 
 */

add_action( 'admin_menu', 'dmeng_admin_menu_page' );
function dmeng_admin_menu_page(){

	$title = __('多梦主题设置','dmeng');
	$slug = 'dmeng_options_general';

	add_menu_page( $title, $title, 'manage_options', $slug, 'dmeng_options_general_page', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAACRklEQVR42qXUS0hUURzH8fFBQj5CQsjAJAofSGEmgmKRWqQlhJpQmNKDiozIfBBFQrZQ2qSWoQsRo0VRuhFxEe1aWlFhRGEiVii9KFpI1szt+4ffhatMw5QXPsw9Z8753/P4n+PzhfE4jhOHBN9yHgJE4SgGcRENuI4ubPyXQLGoxUHsxnG0oR0tqEQp6lAQztQ6kIJO/HaCP3MoRBV2ICJYsHgF246XCDihn4dIVvuyYAFrkIS7gUDgKV7x/hWPeX+BCaun/B7zyPP0PbRo0yissDXT+0pbGzo/wIzWL0H15xX0F4o9/VPR6g24S0PPVzkPb+HHNLJUX646e8YQrfrDaEaiFWKUEq04qw3JxyVcwQmUuB9nhB/xg7pvyFFAS601SHcb3aFwC40Y10gW0KMR7UMRruEcBuhzn99epdkN3MROd8pD6lxOw0nbNVzm/R0+8b4HXxTAPvoGTUqfbNqM6APpFiyRwmut2XNU4JQ2o0pTs84XtJ7V+KAN+mzJz++s/tvvjrAYW+xLapyjo3cMt20N8cTSSu3PKPG34TSuatqb3IBr7UgR8JkSut+z21MYVn2u6rNxUvV+rXn3ohOjrc+0NbMk1jG0UTbqQ44luHXSf1spf9cMbJnSlp6UTNTbLlpq8Juh+g34qdzze+qbdfysX+3fLoc0HaMC3FNd95JzbVdZpKaZpXJMqBsnF0cU1Kbcx4gfKT9HdbXF6xo7YMc2nDsxQutiibzX8gvr9bEG7ejq/7m1o7EOmy2tFHhVqD5/AMwI1hzsuzg9AAAAAElFTkSuQmCC' ); 
	
	$submenus = array(
		'writing' =>__('撰写','dmeng'),
		'reading' =>__('阅读','dmeng'),
		'discussion' =>__('讨论','dmeng'),
		'slide' =>__('幻灯片','dmeng'),
		'open' =>__('开放平台','dmeng'),
		'credit' =>__('积分','dmeng'),
		'smtp' =>__('SMTP发信','dmeng'),
		'tool' =>__('高级','dmeng')
	);

	foreach( $submenus as $skey=>$stitle ){
		add_submenu_page( $slug, $stitle, $stitle, 'manage_options', 'dmeng_options_'.$skey , 'dmeng_options_'.$skey.'_page' ); 
	}

}

//~ 载入设置选项
require_once( get_template_directory() . '/inc/settings-writing.php' );
require_once( get_template_directory() . '/inc/settings-reading.php' );
require_once( get_template_directory() . '/inc/settings-discussion.php' );
require_once( get_template_directory() . '/inc/settings-slide.php' );
require_once( get_template_directory() . '/inc/settings-open.php' );
require_once( get_template_directory() . '/inc/settings-credit.php' );
require_once( get_template_directory() . '/inc/settings-smtp.php' );
require_once( get_template_directory() . '/inc/settings-tool.php' );

function dmeng_options_general_page(){
	
  if( isset($_POST['action']) && sanitize_text_field($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) :

	update_option( 'zh_cn_l10n_icp_num', sanitize_text_field($_POST['zh_cn_l10n_icp_num']) );
	update_option( 'dmeng_home_seo', json_encode(array(
		'keywords' => sanitize_text_field($_POST['home_keywords']),
		'description' => sanitize_text_field($_POST['home_description'])
	)));
	update_option( 'dmeng_head_code', htmlspecialchars($_POST['head_code']) );
	update_option( 'dmeng_footer_code', htmlspecialchars($_POST['footer_code']) );
	update_option( 'dmeng_float_button', (int)$_POST['float_button'] );

	$dmeng_home_cat = empty($_POST['home_cat']) ? array() : $_POST['home_cat'];
	$dmeng_home_post_exclude = empty($_POST['home_post_exclude']) ? array() : $_POST['home_post_exclude'];

	update_option( 'dmeng_home_setting', json_encode(array(
		'cat' => $dmeng_home_cat,
		'cat_list' => intval($_POST['home_cat_list']),
		'cat_desc' => intval($_POST['home_cat_desc']),
		'post' => intval($_POST['home_post']),
		'post_title' => $_POST['home_post_title'],
		'ignore_sticky_posts' => intval($_POST['home_ignore_sticky_posts']),
		'sticky_posts_title' => $_POST['home_sticky_posts_title'],
		'post_exclude' => $dmeng_home_post_exclude
	)));

	dmeng_settings_error('updated');
	  
  endif;
  
	$float_button = (int)get_option('dmeng_float_button',1);
  
	$home_seo = json_decode(get_option('dmeng_home_seo','{"keywords":"","description":""}'));
  
	$home_setting = json_decode(get_option('dmeng_home_setting','{"cat":"[]","cat_list":"2","cat_desc":"","post":"1","post_title":"","ignore_sticky_posts":"1","sticky_posts_title":"{title}","post_exclude":"[]"}'));
	$home_cat = (array)$home_setting->cat;
	$home_cat_list = intval($home_setting->cat_list);
	$home_cat_desc = intval($home_setting->cat_desc);
	$home_post = intval($home_setting->post);
	$home_post_title = $home_setting->post_title;
	$home_ignore_sticky_posts = intval($home_setting->ignore_sticky_posts);
	$home_sticky_posts_title = $home_setting->sticky_posts_title;
	$home_post_exclude = (array)$home_setting->post_exclude;
	?>
<div class="wrap">
	<h2><?php _e('多梦主题设置','dmeng');?></h2>
	<form method="post">
		<input type="hidden" name="action" value="update">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
		<h3 class="title"><?php _e('常规设置','dmeng');?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="zh_cn_l10n_icp_num"><?php _e('ICP','dmeng');?></label></th>
					<td>
						<input name="zh_cn_l10n_icp_num" type="text" id="zh_cn_l10n_icp_num" value="<?php echo get_option('zh_cn_l10n_icp_num');?>" class="regluar-text ltr">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_keywords"><?php _e('首页关键词','dmeng');?></label></th>
					<td>
						<input name="home_keywords" type="text" id="home_keywords" value="<?php echo $home_seo->keywords;?>" class="regluar-text ltr">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_description"><?php _e('首页描述','dmeng');?></label></th>
					<td>
						<textarea name="home_description" rows="2" cols="50" id="home_description" class="large-text code"><?php echo $home_seo->description;?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('头部HEAD代码','dmeng');?></th>
					<td>
						<fieldset>
							<p><?php _e('如添加meta信息验证网站所有权','dmeng');?></p>
							<textarea name="head_code" rows="5" cols="50" id="head_code" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode(get_option('dmeng_head_code')));?></textarea>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('脚部统计代码','dmeng');?></th>
					<td>
						<fieldset>
							<p><?php _e('放置CNZZ、百度统计或安全网站认证小图标等','dmeng');?></p>
							<textarea name="footer_code" rows="5" cols="50" id="footer_code" class="large-text code"><?php echo stripslashes(htmlspecialchars_decode(get_option('dmeng_footer_code')));?></textarea>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="float_button"><?php _e('是否显示浮动按钮','dmeng');?></label></th>
					<td>
						<p><?php _e('选择是时显示到顶部、刷新、到底部等浮动按钮','dmeng');?></p>
						<select name="float_button" id="float_button">
							<option value="1" <?php if($float_button===1) echo 'selected="selected"';?>><?php _e( '显示', 'dmeng' );?></option>
							<option value="0" <?php if($float_button!==1) echo 'selected="selected"';?>><?php _e( '不显示', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<h3 class="title"><?php _e('首页内容','dmeng');?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="home_cat"><?php _e('分类列表','dmeng');?></label></th>
					<td>
						<p><?php _e('选择要显示的分类列表，留空则不显示任何分类。','dmeng');?></p><br>
<?php
$categories = get_categories( array('hide_empty' => 0) );
foreach ( $categories as $category ) {
	?>
<label><input name="home_cat[]" type="checkbox" value="<?php echo $category->term_id;?>" <?php if(in_array($category->term_id,$home_cat)) echo 'checked';?>> <?php echo $category->name;?> </label> 
	<?php
}
?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_cat_list"><?php _e('分类列表排版','dmeng');?></label></th>
					<td>
						<p><?php _e('首页分类列表显示方式','dmeng');?></p>
						<select name="home_cat_list" id="home_cat_list">
							<option value="1" <?php if($home_cat_list===1) echo 'selected="selected"';?>><?php _e( '一列', 'dmeng' );?></option>
							<option value="2" <?php if($home_cat_list!==1) echo 'selected="selected"';?>><?php _e( '两列', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_cat_desc"><?php _e('分类信息','dmeng');?></label></th>
					<td>
						<p><?php _e('显示分类的文章数量。','dmeng');?></p>
						<select name="home_cat_desc" id="home_cat_desc">
							<option value="1" <?php if($home_cat_desc===1) echo 'selected="selected"';?>><?php _e( '显示', 'dmeng' );?></option>
							<option value="0" <?php if($home_cat_desc!==1) echo 'selected="selected"';?>><?php _e( '不显示', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_post"><?php _e('文章列表','dmeng');?></label></th>
					<td>
						<p><?php _e('首页文章列表','dmeng');?></p>
						<select name="home_post" id="home_post">
							<option value="1" <?php if($home_post===1) echo 'selected="selected"';?>><?php _e( '最新发表的', 'dmeng' );?></option>
							<option value="2" <?php if($home_post===2) echo 'selected="selected"';?>><?php _e( '最后更新的', 'dmeng' );?></option>
							<option value="3" <?php if($home_post===3) echo 'selected="selected"';?>><?php _e( '评论最多的', 'dmeng' );?></option>
							<option value="0" <?php if(!in_array($home_post,array(1,2,3))) echo 'selected="selected"';?>><?php _e( '不显示', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_post_title"><?php _e('文章列表标题','dmeng');?></label></th>
					<td>
						<p><?php _e('如：最新文章。留空不显示。','dmeng');?></p>
						<input name="home_post_title" type="text" id="home_post_title" value="<?php echo $home_post_title;?>" class="regluar-text ltr">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_ignore_sticky_posts"><?php _e('排除置顶文章','dmeng');?></label></th>
					<td>
						<p><?php _e('不置顶显示置顶文章','dmeng');?></p>
						<select name="home_ignore_sticky_posts" id="home_ignore_sticky_posts">
							<option value="0" <?php if(!in_array($home_ignore_sticky_posts,array(1,2))) echo 'selected="selected"';?>><?php _e( '可以置顶', 'dmeng' );?></option>
							<option value="1" <?php if($home_ignore_sticky_posts===1) echo 'selected="selected"';?>><?php _e( '不置顶', 'dmeng' );?></option>
							<option value="2" <?php if($home_ignore_sticky_posts===2) echo 'selected="selected"';?>><?php _e( '单独显示在分类列表之上', 'dmeng' );?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_sticky_posts_title"><?php _e('置顶文章标题格式','dmeng');?></label></th>
					<td>
						<p><?php _e('如果让置顶文章单独显示在分类列表之上，那么可以设置一个标题格式，其中{title}代表原来的文章标题。','dmeng');?></p>
						<input name="home_sticky_posts_title" type="text" id="home_sticky_posts_title" value="<?php echo $home_sticky_posts_title;?>" class="regluar-text ltr">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_post_exclude"><?php _e('文章列表排除分类','dmeng');?></label></th>
					<td>
						<p><?php _e('选择排除的分类，留空则不排除任何分类。','dmeng');?></p><br>
<?php
foreach ( $categories as $exclude ) {
	?>
<label><input name="home_post_exclude[]" type="checkbox" value="<?php echo $exclude->term_id;?>" <?php if(in_array($exclude->term_id,$home_post_exclude)) echo 'checked';?>> <?php echo $exclude->name;?> </label> 
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
