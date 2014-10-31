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
 
ob_start();
 
get_header(); ?>

<?php get_header('user'); ?>

<?php

$user_id = get_current_user_id();
$user_info = get_userdata($user_id);
$avatar = $user_info->dmeng_avatar;
$qq = dmeng_is_open_qq();
$weibo = dmeng_is_open_weibo();

$message = '';

if( isset($_POST['update']) && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) {
	
	$message = __('没有发生变化','dmeng');
	
	$update = sanitize_text_field($_POST['update']);
	
	if($update=='info'){
		$update_user_id = wp_update_user( array(
			'ID' => $user_id, 
			'nickname' => sanitize_text_field($_POST['display_name']),
			'display_name' => sanitize_text_field($_POST['display_name']),
			'user_url' => sanitize_text_field($_POST['url']),
			'description' => sanitize_text_field($_POST['description'])
		 ) );
		$update_user_avatar = update_user_meta( $user_id , 'dmeng_avatar', sanitize_text_field($_POST['avatar']) );
		if ( ! is_wp_error( $update_user_id ) || $update_user_avatar ) $message = __('基本信息已更新','dmeng');
	}
	
	if($update=='pass'){
		$data = array();
		$data['ID'] = $user_id;
		$data['user_email'] = sanitize_text_field($_POST['email']);
		if( !empty($_POST['pass1']) && !empty($_POST['pass2']) && $_POST['pass1']===$_POST['pass2'] ) $data['user_pass'] = sanitize_text_field($_POST['pass1']);
		$user_id = wp_update_user( $data );
		if ( ! is_wp_error( $user_id ) ) $message = __('安全信息已更新','dmeng');
	}

}

?>

<div id="main" class="container">

		<div id="content" class="col-lg-8 col-md-8 col-sm-8" role="main">
			<div class="panel panel-default">
				<div class="panel-body">
			<?php if($message) echo '<div class="alert alert-success" role="alert">'.$message.' <a href="'.dmeng_get_current_page_url().'">'.__('点击刷新','dmeng').'</a></div>'; ?>
			
<form id="info-form" class="form-horizontal" role="form" method="post">
	<input type="hidden" name="update" value="info">
	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
			<div class="page-header">
				<h3 id="info"><?php _e('基本信息','dmeng');?> <small><?php _e('公开资料','dmeng');?></small></h>
			</div>

	<div class="form-group">
		<label class="col-sm-2 control-label"><?php _e('头像','dmeng');?></label>
		<div class="col-sm-10">

<div class="radio">
<?php echo dmeng_get_avatar( $user_info->ID , '40' ); ?>
  <label>
	<input type="radio" name="avatar"  value="default" <?php if( ($avatar!='qq' || dmeng_is_open_qq($user_info->ID)===false) && ($avatar!='weibo' || dmeng_is_open_weibo($user_info->ID)===false) ) echo 'checked';?>> 默认头像
  </label>
</div>

<?php if(dmeng_is_open_qq($user_info->ID)){ ?>
<div class="radio">
<?php echo dmeng_get_avatar( $user_info->ID , '40' , 'qq' ); ?>
  <label>
    <input type="radio" name="avatar" value="qq" <?php if($avatar=='qq') echo 'checked';?>> QQ头像
  </label>
</div>
<?php } ?>

<?php if(dmeng_is_open_weibo($user_info->ID)){ ?>
<div class="radio">
<?php echo dmeng_get_avatar( $user_info->ID , '40' , 'weibo' ); ?>
  <label>
    <input type="radio" name="avatar" value="weibo" <?php if($avatar=='weibo') echo 'checked';?>> 微博头像
  </label>
</div>
<?php } ?>

		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label"><?php _e('用户名','dmeng');?></label>
		<div class="col-sm-10">
			<p class="form-control-static"><?php echo $user_info->user_login;?></p>
		</div>
	</div>
	
	<div class="form-group">
		<label for="display_name" class="col-sm-2 control-label"><?php _e('昵称','dmeng');?></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="display_name" name="display_name" value="<?php echo $user_info->display_name;?>">
		</div>
	</div>

	<div class="form-group">
		<label for="url" class="col-sm-2 control-label"><?php _e('站点','dmeng');?></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="url" name="url" value="<?php echo $user_info->user_url;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="description" class="col-sm-2 control-label"><?php _e('个人说明','dmeng');?></label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="3" name="description" id="description"><?php echo $user_info->description;?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><?php _e('保存更改','dmeng');?></button>
		</div>
	</div>
</form>
<?php if( $qq || $weibo ) { ?>
<form id="open-form" class="form-horizontal" role="form" method="post">
			<div class="page-header">
				<h3 id="open"><?php _e('绑定账号','dmeng');?> <small><?php _e('可用于直接登录','dmeng');?></small></h>
			</div>
			
	<?php if($qq){ ?>
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php _e('QQ账号','dmeng');?></label>
			<div class="col-sm-10">
		<?php  if(dmeng_is_open_qq($user_info->ID)) { ?>
			<span class="help-block"><?php _e('已绑定','dmeng');?> <a href="<?php echo home_url('/?connect=qq&action=logout'); ?>"><?php _e('点击解绑','dmeng');?></a></span>
			<?php echo dmeng_get_avatar( $user_info->ID , '100' , 'qq' ); ?>
		<?php }else{ ?>
			<a class="btn btn-primary" href="<?php echo home_url('/?connect=qq&action=login&redirect='.urlencode(get_edit_profile_url())); ?>"><?php _e('绑定QQ账号','dmeng');?></a>
		<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if($weibo){ ?>
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php _e('微博账号','dmeng');?></label>
			<div class="col-sm-10">
		<?php if(dmeng_is_open_weibo($user_info->ID)) { ?>
			<span class="help-block"><?php _e('已绑定','dmeng');?> <a href="<?php echo home_url('/?connect=weibo&action=logout'); ?>"><?php _e('点击解绑','dmeng');?></a></span>
			<?php echo dmeng_get_avatar( $user_info->ID , '100' , 'weibo' ); ?>
		<?php }else{ ?>
			<a class="btn btn-danger" href="<?php echo home_url('/?connect=weibo&action=login&redirect='.urlencode(get_edit_profile_url())); ?>"><?php _e('绑定微博账号','dmeng');?></a>
		<?php } ?>
			</div>
		</div>
	<?php } ?>
</form>
<?php } ?>
<form id="pass-form" class="form-horizontal" role="form" method="post">
	<input type="hidden" name="update" value="pass">
	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
			<div class="page-header">
				<h3 id="pass"><?php _e('账号安全','dmeng');?> <small><?php _e('仅自己可见','dmeng');?></small></h>
			</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label"><?php _e('电子邮件 (必填)','dmeng');?></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $user_info->user_email;?>" aria-required='true' required>
		</div>
	</div>
	<div class="form-group">
		<label for="pass1" class="col-sm-2 control-label"><?php _e('新密码','dmeng');?></label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="pass1" name="pass1" >
			<span class="help-block"><?php _e('如果您想修改您的密码，请在此输入新密码。不然请留空。','dmeng');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="pass2" class="col-sm-2 control-label"><?php _e('重复新密码','dmeng');?></label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="pass2" name="pass2" >
			<span class="help-block"><?php _e('再输入一遍新密码。 提示：您的密码最好至少包含7个字符。为了保证密码强度，使用大小写字母、数字和符号（例如! " ? $ % ^ & )）。','dmeng');?></span>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><?php _e('保存更改','dmeng');?></button>
		</div>
	</div>
</form>
				</div>
			</div>
		 </div><!-- #content -->
		 <?php get_sidebar('user');?>	

 </div><!-- #main -->

<?php get_footer('only-copyright'); ?>
<?php get_footer(); ?>
