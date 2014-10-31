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
}else{
	wp_redirect( esc_url( get_author_posts_url( get_current_user_id() ) ) );
}
exit;
