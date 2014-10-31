<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 用户界面构造 @author 多梦 at 2014.06.19 
 * 
 */
 
//~ 启动主题时清理固定链接缓存
function dmeng_rewrite_flush_rules(){
	global $pagenow,$wp_rewrite;   
	if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){
		$wp_rewrite->flush_rules();
	}
}
add_action( 'load-themes.php', 'dmeng_rewrite_flush_rules' ); 

//~ 使用重写美化URL（伪静态）
function dmeng_rewrite_user_url(){

    global $wp_rewrite; 
    add_rewrite_tag('%user%','([^&]+)');
    add_rewrite_rule( 'user/([A-Za-z0-9]{1,})/?$','index.php?user=$matches[1]', 'top' );
	add_rewrite_rule( '^user/([^/]*)/page/([^/]*)/?','index.php?user=$matches[1]&paged=$matches[2]', 'top' );

}
add_action( 'init', 'dmeng_rewrite_user_url' );

function dmeng_add_query_vars_user( $vars ){
  $vars[] = "user";
  return $vars;
}
add_filter( 'query_vars', 'dmeng_add_query_vars_user' );

//~ 一个获取新的用户界面URL的函数
//~ 主要是判断有没开启固定链接，然而决定输出什么样的链接
function dmeng_get_user_url( $type = 'login', $permalink = false ){
	if($permalink){
		return home_url('/user/'.$type.'/');
		exit;
	}
	$url = add_query_arg( 'user', $type, home_url('/') );
	if ( get_option('permalink_structure') ) $url = home_url('/user/'.$type.'/');
	return $url;
}

//~ 用户界面模板
function dmeng_user_template_redirect(){
	
	//~ 重定向 /?user=* 之类的URL到重写过的URL
	$user = isset($_GET['user']) ? $_GET['user'] : 0;
    if($user && get_option('permalink_structure')){
        wp_redirect( dmeng_get_user_url( $user , true ) );
        exit();
    }
    
    //~ 根据链接传入参数输出不同界面
    //~ 对于没定义的返回404
	global $wp_query;
	$user_part = isset($wp_query->query_vars['user']) ? $wp_query->query_vars['user'] : 0;
	if( $user_part ){
		if( in_array($user_part , array('logout', 'lostpassword', 'register', 'login', 'home', 'credit', 'post', 'profile', 'comment', 'message' ) ) ){
			get_template_part( 'user', $user_part );
			exit;
		}else{
			$wp_query->is_404 = true;
		}
	}
}
add_action( 'template_redirect', 'dmeng_user_template_redirect' );

function dmeng_get_user_page_title($user_part=''){

		if(empty($user_part)){
			global $wp_query;
			$user_part = isset($wp_query->query_vars['user']) ? $wp_query->query_vars['user'] : 0;
		}
				switch($user_part){
						case 'logout' :
							$user_part = __('登出', 'dmeng');
						break;
						case 'lostpassword' :
							$user_part = __('获取新密码', 'dmeng');
						break;
						case 'register' :
							$user_part = __('注册', 'dmeng');
						break;
						case 'login' :
							$user_part = __('登录', 'dmeng');
						break;
						case 'home' :
							$user_part = __('个人主页', 'dmeng');
						break;
						case 'credit' :
							$user_part = __('积分', 'dmeng');
						break;
						case 'post' :
							$user_part = __('文章', 'dmeng');
						break;
						case 'profile' :
							$user_part = __('资料', 'dmeng');
						break;
						case 'comment' :
							$user_part = __('评论', 'dmeng');
						break;
						case 'message' :
							$user_part = __('消息', 'dmeng');
						break;
				}
	return $user_part;
}

//~ 判断是否用户界面URL
function dmeng_is_user_page( $type = ''  ){

		//~ 404页直接返回 false
		if(is_404()) return false;
		
		//~ 声明 WordPress 全局变量，获取链接传入参数
		global $wp_query;
		$user_part = isset($wp_query->query_vars['user']) ? $wp_query->query_vars['user'] : 0;
		
		//~ 如果有传入参数，按类型输出内容
		if($user_part){
			
			//~ 如果本函数有传入参数且传入参数为text时按类型返回标题
			if( $type && $type=='text' ) $user_part = dmeng_get_user_page_title($user_part);
			
			//~ 如果本函数有传入参数且传入参数和链接传入参数一样时返回 yes
			//~ 用于判断用户页的类型，如判断是否登录页 dmeng_is_user_page('login')
			if( $type && $type!='text' && $type==$user_part ) return 'yes';
			
			return $user_part;
		}
		
		//~ 其他的直接返回 false
		return false;
}

//~ 更改用户页的标题
function dmeng_user_page_wp_title( $title, $sep ) {

	if( dmeng_is_user_page()) $title = dmeng_is_user_page('text')." $sep ";

	return $title;
}
add_filter( 'wp_title', 'dmeng_user_page_wp_title', 10, 2 );

//~ 更改登录链接
function dmeng_login_page( $url, $redirect='' ) {
	$url = dmeng_get_user_url('login');
	if(!$redirect) $redirect = dmeng_get_current_page_url();
	$url = add_query_arg( 'redirect_to', urlencode($redirect), $url );
    return $url;
}
add_filter( 'login_url', 'dmeng_login_page' );

//~ 更改登出链接
function dmeng_logout_page( $url, $redirect='' ) {
	$url = dmeng_get_user_url('logout');
	if(!$redirect) $redirect = dmeng_get_current_page_url();
	$url = add_query_arg( 'redirect_to', $redirect, $url );
	return wp_nonce_url( $url, 'logout' );
}
add_filter( 'logout_url', 'dmeng_logout_page' );

if( !is_admin() ) {

//~ 更改注册链接
function dmeng_register_page( $url ) {
    return dmeng_get_user_url('register');
}
add_filter( 'register_url', 'dmeng_register_page' );

//~ 更改忘记密码链接
function dmeng_lostpassword_page( $lostpassword_url ) {
    return dmeng_get_user_url('lostpassword');
}
add_filter( 'lostpassword_url', 'dmeng_lostpassword_page' );

//~ 更改管理页面链接
function dmeng_admin_page( $url ) {
    return dmeng_get_user_url('home');
}
//~ add_filter( 'admin_url', 'dmeng_admin_page' );

//~ 更改编辑个人资料链接
function dmeng_profile_page( $url ) {
    return dmeng_get_user_url('profile');
}
add_filter( 'edit_profile_url', 'dmeng_profile_page' );

}

function dmeng_redirect_wp_admin(){
	global $pagenow;
	if( $pagenow == 'wp-login.php' || ( is_admin() && !current_user_can( 'manage_options' ) && ( !defined('DOING_AJAX') || !DOING_AJAX ) ) ){
		wp_redirect( dmeng_get_user_url('login') );
		exit;
	}
}
add_action( 'init', 'dmeng_redirect_wp_admin' );

//~ 在后台用户列表中显示昵称
function dmeng_display_name_column( $columns ) {
	$columns['dmeng_display_name'] = '显示名称';
	unset($columns['name']);
	return $columns;
}
add_filter( 'manage_users_columns', 'dmeng_display_name_column' );
 
function dmeng_display_name_column_callback( $value, $column_name, $user_id ) {

	if( 'dmeng_display_name' == $column_name ){
		$user = get_user_by( 'id', $user_id );
		$value = ( $user->display_name ) ? $user->display_name : '';
	}

	return $value;
}
add_action( 'manage_users_custom_column', 'dmeng_display_name_column_callback', 10, 3 );

//~ 侧边栏用户中心小工具
function dmeng_user_profile_widget(){

	$current_user = wp_get_current_user();
?>

	<li >
		<?php echo dmeng_get_avatar( $current_user->ID , '34' , dmeng_get_avatar_type($current_user->ID), false ); ?>
		<?php printf(__('Logged in as <a href="%1$s">%2$s</a>.'), get_edit_profile_url(), $current_user->display_name); ?> 
		<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_attr_e('Log out of this account'); ?>"><?php _e('Log out &raquo;'); ?></a>
	</li>

<?php if(!filter_var($current_user->user_email, FILTER_VALIDATE_EMAIL)){ ?>
<li>
	<a href="<?php echo dmeng_get_user_url('profile').'#pass';?>"><?php _e('【重要】请添加正确的邮箱以保证账户安全','dmeng');?></a>
</li>
<?php } ?>

<li class="active">
	<a href="<?php echo get_author_posts_url($current_user->ID);?>"><?php _e('个人主页 &raquo;','dmeng');?></a>
	<?php if( current_user_can( 'manage_options' ) ){ ?>
		<a href="<?php echo admin_url();?>"><?php _e('管理后台 &raquo;','dmeng');?></a> 
	<?php } ?>
	<a href="<?php echo add_query_arg('action','new',dmeng_get_user_url('post'));?>"><?php _e('文章投稿 &raquo;','dmeng');?></a>
</li>
		<?php 
		$credit = intval(get_user_meta( $current_user->ID, 'dmeng_credit', true ));
		$credit_void = intval(get_user_meta( $current_user->ID, 'dmeng_credit_void', true ));
		$unread_count = intval(get_dmeng_message($current_user->ID, 'count', "msg_type='unread'"));
		?>
<li>
	<?php _e('文章','dmeng');?><a href="<?php echo dmeng_get_user_url('post');?>"><?php echo count_user_posts($current_user->ID);?></a><?php _e('评论','dmeng');?><a href="<?php echo dmeng_get_user_url('comment');?>"><?php echo get_comments( array('status' => '1', 'user_id'=>$current_user->ID, 'count' => true) );?></a><?php _e('积分','dmeng');?><a href="<?php echo dmeng_get_user_url('credit');?>" ><?php echo ($credit+$credit_void);?></a>
<?php if($unread_count){ ?>
<?php _e('未读消息','dmeng');?><a href="<?php echo dmeng_get_user_url('message');?>"><?php echo $unread_count;?></a></li>
<?php } ?>
<?php if(!dmeng_is_user_page()){ ?>
	<li>
		<div class="input-group">
			<span class="input-group-addon"><?php _e('本页推广链接','dmeng');?></span>
			<input id="dmeng_friend_url" type="text" class="form-control" value="<?php echo add_query_arg('fid',$current_user->ID,dmeng_canonical_url());?>">
		</div>
	</li>
<?php } ?>

	<?php	
}
