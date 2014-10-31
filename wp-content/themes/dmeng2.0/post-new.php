<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 投稿模板 @author 多梦 at 2014.06.19 
 * 
 */
 
?>

			<article class="panel panel-default archive" role="main">
					<div class="panel-body">
<?php
if( isset($_GET['p']) && is_numeric($_GET['p']) && get_post($_GET['p']) && intval(get_post($_GET['p'])->post_author) === get_current_user_id() ){
	$action = 'edit';
	$the_post = get_post($_GET['p']);
	$post_title = $the_post->post_title;
	$post_content = $the_post->post_content;
	foreach((get_the_category($_GET['p'])) as $category) { 
		$post_cat[] = $category->term_id; 
	}
}else{
	$action = 'new';
	$post_title = !empty($_POST['post_title']) ? $_POST['post_title'] : '';
	$post_content = !empty($_POST['post_content']) ? $_POST['post_content'] : '';
	$post_cat = !empty($_POST['post_cat']) ? $_POST['post_cat'] : array();
}

if( isset($_POST['action']) && sanitize_text_field($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) {
	
	$title = sanitize_text_field($_POST['post_title']);
	$content = $_POST['post_content'];
	$cat = (!empty($_POST['post_cat'])) ? $_POST['post_cat'] : '';
	
	if( $title && $content ){
		
		if( mb_strlen($content,'utf8')<140 ){
			
			$message = __('提交失败，文章内容至少140字。','dmeng');
			
		}else{
			
			$status = sanitize_text_field($_POST['post_status']);
			
			if( $action==='edit' ){

				$new_post = wp_update_post( array(
					'ID' => intval($_GET['p']),
					'post_title'    => $title,
					'post_content'  => $content,
					'post_status'   => ( $status==='pending' ? 'pending' : 'draft' ),
					'post_author'   => get_current_user_id(),
					'post_category' => $cat
				) );

			}else{

				$new_post = wp_insert_post( array(
					  'post_title'    => $title,
					  'post_content'  => $content,
					  'post_status'   => ( $status==='pending' ? 'pending' : 'draft' ),
					  'post_author'   => get_current_user_id(),
					  'post_category' => $cat
					) );

			}
			
			if( is_wp_error( $new_post ) ){
				$message = __('操作失败，请重试或联系管理员。','dmeng');
			}else{
				wp_redirect(dmeng_get_user_url('post'));
			}

		}
	}else{
		$message = __('投稿失败，标题和内容不能为空！','dmeng');
	}
	echo '<div class="alert alert-info" role="alert">'.$message.'</div>';
}
?>



						<h3 class="page-header"><?php _e('投稿','dmeng');?> <small><?php _e('POST NEW','dmeng');?></small></h3>
<form role="form" method="post">
	<div class="form-group">
		<input type="text" class="form-control" name="post_title" placeholder="<?php _e('在此输入标题','dmeng');?>" value="<?php echo $post_title;?>" aria-required='true' required>
	</div>
	<div class="form-group">
		<?php wp_editor(  wpautop($post_content), 'post_content', array('media_buttons'=>false, 'quicktags'=>false, 'editor_class'=>'form-control', 'editor_css'=>'<style>.wp-editor-container{border:1px solid #ddd;}</style>' ) ); ?>
	</div>
	<div class="form-group">
<div class="panel panel-default">
  <div class="panel-body">
<?php
$can_post_cat = json_decode(get_option('dmeng_can_post_cat'));
if($can_post_cat){
	foreach ( $can_post_cat as $term_id ) {
		$category = get_category( $term_id );
		?>
	<label class="checkbox-inline">
		<input type="checkbox" name="post_cat[]" value="<?php echo $category->term_id;?>"  <?php if( (!empty($post_cat)) && in_array($category->term_id,$post_cat)) echo 'checked';?>> <?php echo $category->name;?>
	</label>
		<?php
	}
}
?>
  </div>
  <div class="panel-footer"><?php _e('请在投稿前仔细检查文章内容以及选择分类目录，未完成的文章可选择保存草稿。','dmeng');?></div>
</div>
	</div>
	<div class="form-group text-right">
		<select name="post_status">
			<option value ="pending"><?php _e('提交审核','dmeng');?></option>
			<option value ="draft"><?php _e('保存草稿','dmeng');?></option>
		</select>
		<input type="hidden" name="action" value="update">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
		<button type="submit" class="btn btn-success"><?php _e('确认操作','dmeng');?></button>
	</div>	
</form>
						
					</div>
			 </article>
