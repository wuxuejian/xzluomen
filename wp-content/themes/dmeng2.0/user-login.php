<?php 

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 登录页 @author 多梦 at 2014.06.19 
 * 添加登出提示 @author 多梦 at 2014.06.19 
 * 添加重置密码 @author 多梦 at 2014.06.20 
 * 添加注册页 @author 多梦 at 2014.06.20 
 */
 
$messages = '';
 
//~ 重定向链接 @author 多梦 at 2014.06.22 
$redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';

 //~ WordPress Cookie 检查 @author 多梦 at 2014.06.22 
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH )
	setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);
 
do_action( 'login_init' );

if( !empty($_POST['wp-submit']) ){

	if( empty($_POST['log']) ) $messages = __('<strong>ERROR</strong>: Enter a username or e-mail address.');

	if( !empty($_POST['log'])  ) {
		$log_user = sanitize_user($_POST['log']);
		$log_pwd = trim($_POST['pwd']);
		$creds = array();
		$creds['user_login'] = $log_user;
		$creds['user_password'] = $log_pwd;
		$creds['remember'] = true;
		$user = wp_signon( $creds, false );
		if ( is_wp_error($user) ) {
			$messages = $user->get_error_message();
		}else{
			if (filter_var($redirect_to, FILTER_VALIDATE_URL) === FALSE) wp_redirect( home_url() );
			else wp_redirect($redirect_to);
		}
	}
	
}

if( $action=='postpass' ){
	
	require_once ABSPATH . 'wp-includes/class-phpass.php';
	$hasher = new PasswordHash( 8, true );

	$expire = apply_filters( 'post_password_expires', time() + 10 * DAY_IN_SECONDS );
	setcookie( 'wp-postpass_' . COOKIEHASH, $hasher->HashPassword( wp_unslash( $_POST['post_password'] ) ), $expire, COOKIEPATH );

	wp_safe_redirect( wp_get_referer() );
	exit();
}

//~ 如果是注册页，但是后台设置不允许注册，则定向到登录页 @author 多梦 at 2014.06.22 
if( dmeng_is_user_page('register')=='yes' && !get_option( 'users_can_register' ) ) wp_redirect( dmeng_get_user_url( 'login' ) );
 
//~ 载入 header.php 模板
get_header(); 

?>
<style>body{background:#f1f1f1;padding:0;}</style>
<div id="main" class="container">
	<div id="content" class="user-signin box-shadow" role="main">
		<div class="page-header">
			<h1 class="h2"><?php bloginfo('name'); ?> <small><?php echo dmeng_is_user_page('text') ?></small></h1>
		</div>
<?php 

if( dmeng_is_user_page('logout')=='yes' ){
	
	if( wp_verify_nonce($_GET['_wpnonce'], 'logout') || !is_user_logged_in() ){
		
		$messages = __('You are now logged out.');
		wp_logout();
		
	}else{
		
		$messages = sprintf( __( 'You are attempting to log out of %s' ), get_bloginfo( 'name' ) ) . '<br>';
		$messages .= sprintf( __( "Do you really want to <a href='%s'>log out</a>?"), wp_logout_url( $redirect_to ) );
		
	}
}

 	if ( empty( $_COOKIE[ LOGGED_IN_COOKIE ] ) ) {
		if ( headers_sent() ) {
			$messages = sprintf( __( '<strong>ERROR</strong>: Cookies are blocked due to unexpected output. For help, please see <a href="%1$s">this documentation</a> or try the <a href="%2$s">support forums</a>.' ),
				__( 'http://codex.wordpress.org/Cookies' ), __( 'https://wordpress.org/support/' ) );
		} elseif ( isset( $_POST['testcookie'] ) && empty( $_COOKIE[ TEST_COOKIE ] ) ) {
			$messages = sprintf( __( '<strong>ERROR</strong>: Cookies are blocked or not supported by your browser. You must <a href="%s">enable cookies</a> to use WordPress.' ),
				__( 'http://codex.wordpress.org/Cookies' ) );
		}
	}

if ( ! empty( $messages ) ) echo '<div class="messages text-danger">' . apply_filters( 'login_messages', $messages ) . "</div>\n";

?>

<?php if( dmeng_is_user_page('login')=='yes' ){ ?>

<form class="form-signin" role="form" action="<?php echo dmeng_get_user_url( 'login' );?>" method="post">
	<input type="text" name="log" class="form-control input-top" placeholder="<?php _e('Username') ?>" required autofocus>
	<input type="password" name="pwd" class="form-control input-bottom" placeholder="<?php _e('Password') ?>" required>
	<?php do_action( 'login_form' );?>
	<input class="btn btn-lg btn-primary btn-block" type="submit" name="wp-submit" value="<?php esc_attr_e('Log In'); ?>" />
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
	<input type="hidden" name="testcookie" value="1" />
</form>

<p><?php wp_register('', ' | '); ?><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" title="<?php esc_attr_e( 'Password Lost and Found' ) ?>"><?php _e( 'Lost your password?' ); ?></a></p>
<?php } ?>

<?php 

if( dmeng_is_user_page('lostpassword')=='yes' ){ 
	
	do_action( 'lost_password' );
	
	?>

<p class="text-muted"><?php _e( 'Lost your password?' ); ?></p>

<form class="form-signin" role="form">
	<input type="text" class="form-control" placeholder="<?php _e('Username or E-mail:') ?>" required autofocus>
	<?php do_action( 'lostpassword_form' ); ?>
	<button class="btn btn-lg btn-primary btn-block" type="submit"><?php esc_attr_e('Get New Password'); ?></button>
</form>

<p><a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a></p>

<?php } ?>

<?php if( dmeng_is_user_page('register')=='yes' ){ ?>
<form class="form-signin" role="form">
	<input type="text" class="form-control input-top" placeholder="<?php _e('Username') ?>" required autofocus>
	<input type="text" class="form-control input-center" placeholder="<?php _e('E-mail') ?>" required>
	<input type="password" class="form-control input-center" placeholder="<?php _e('Password') ?>" required>
	<input type="password" class="form-control input-bottom" placeholder="<?php _e('Confirm password') ?>" required>
	<?php do_action( 'register_form' );?>
	<button class="btn btn-lg btn-primary btn-block" type="submit"><?php esc_attr_e('Register'); ?></button>
</form>
<p><a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a></p>
<?php } ?>

<?php 
if (filter_var($redirect_to, FILTER_VALIDATE_URL) === FALSE) $redirect_to = home_url('/');
?>
<p><a href="<?php echo esc_url( home_url() ); ?>" title="<?php esc_attr_e( 'Are you lost?' ); ?>"><?php printf( __( '&larr; Back to %s' ), get_bloginfo( 'title', 'display' ) ); ?></a></p>

	</div><!-- #content -->
 </div><!-- #main -->

<?php

//~ 执行 wp-login.php 本来有的动作
do_action( 'login_footer' );
 
//~ 载入 footer.php 模板
get_footer(); 

?>
