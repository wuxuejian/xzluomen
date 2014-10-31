<?php
/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php echo stripslashes(htmlspecialchars_decode(get_option('dmeng_head_code')));?>
<!--[if lte IE 8]><script>window.location.href='http://cdn.dmeng.net/upgrade-your-browser.html?referrer='+location.href;</script><![endif]-->
<link rel="Bookmark" href="/favicon.ico" />
<link rel="shortcut icon" href="/favicon.ico" />
<title><?php wp_title( '&#8211;', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href="<?php echo get_bloginfo('template_url').'/css/bootstrap.min.css';?>" rel="stylesheet">
<!--[if lt IE 9]>
	<script src="<?php echo get_bloginfo('template_url').'/js/html5shiv-3.7.0.js';?>"></script>
	<script src="<?php echo get_bloginfo('template_url').'/js/respond-1.4.2.min.js';?>"></script>
<![endif]-->
<link href="<?php echo get_bloginfo('template_url').'/style.css';?>?v=2.0.5" rel="stylesheet">
<link rel="canonical" href="<?php echo dmeng_canonical_url();?>">
<?php
switch( dmeng_is_user_page() ) {
		case 'login' :
			if( is_user_logged_in() ) wp_redirect( dmeng_get_user_url('home') );
			do_action( 'login_enqueue_scripts' );
			do_action( 'login_head' );
			add_action( 'wp_head', 'wp_no_robots' ); 
		break;
		case 'register' :
			if( is_user_logged_in() ) wp_redirect( dmeng_get_user_url('credit') );
		break;
}
?>
<script type="text/javascript"><?php
echo "var ajaxurl = '".admin_url( '/admin-ajax.php' )."';";
if( !is_admin() && !is_preview() && !dmeng_is_user_page() ) echo "var dmengTracker = ".json_encode(dmeng_tracker_param()).";";
?></script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
