<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 
 * 获取评论用户信息AJAX @author 多梦 at 2014.07.04
 * 
 */
 
function dmeng_comment_user_callback(){

	if ( ! wp_verify_nonce( trim($_POST['wp_nonce']), 'check-nonce' ) ){
		echo 'NonceIsInvalid';
		die();
	}

	$id = (int)$_POST['comment_id'];
	
	if ( !$id ) return;
	
	$comment = get_comment($id);
	
	header('Content-Type:application/json;');
	
	$posts_url = get_author_posts_url( $comment->user_id );
	
	$comments = '<a href="'.$posts_url.'">' . sprintf( __( '%s 评论', 'dmeng') , get_comments( array('status' => 'approve', 'user_id'=>$comment->user_id, 'count' => true) ) ) . '</a>';
	
	$user_url = get_the_author_meta( 'user_url', $comment->user_id );
	$user_url = $user_url ? $user_url : $posts_url;
	
	echo json_encode(array(
		'author' => '<a href="'.$user_url.'" rel="external nofollow" target="_blank">'.get_the_author_meta( 'display_name', $comment->user_id ).'</a>',
		'comments' => '<i>'.$comments.'</i>',
		'agent' => dmeng_detect_ua($comment->comment_agent)
	));
	
	die();
}
add_action( 'wp_ajax_dmeng_comment_user', 'dmeng_comment_user_callback' );
add_action( 'wp_ajax_nopriv_dmeng_comment_user', 'dmeng_comment_user_callback' );

/*
 * 
 * 评论置顶 @author 多梦 at 2014.07.04
 * 
 */
 
function dmeng_comment_sticky_callback(){

	if ( ! wp_verify_nonce( trim($_POST['wp_nonce']), 'check-nonce' ) ){
		echo 'NonceIsInvalid';
		die();
	}
	
	$pid = (int)$_POST['post_id'];
	$id = (int)$_POST['comment_id'];
	$sticky = (int)$_POST['sticky'];

	if( $id && get_comment($id)->comment_post_ID==$pid && ( get_current_user_id()==get_post($pid)->post_author || current_user_can('moderate_comments') ) ) :
	
	if($sticky===0){
		delete_comment_meta( $id, 'dmeng_sticky_comment' );
	}else{
		update_comment_meta( $id, 'dmeng_sticky_comment', $sticky );
	}

	endif;
	
	die();
}
add_action( 'wp_ajax_dmeng_comment_sticky', 'dmeng_comment_sticky_callback' );

/*
 * 
 * 获取评论内容 @author 多梦 at 2014.07.04
 * 
 */
 
function dmeng_get_comments_callback(){

	if ( ! wp_verify_nonce( trim($_POST['wp_nonce']), 'check-nonce' ) ){
		echo 'NonceIsInvalid';
		die();
	}
	
	$id = (int)$_POST['post_id'];
	$cpage = (int)$_POST['cpage'];
	$max_page = (int)$_POST['max_page'];
	
	if( !$id || !$cpage ) return;

	$comments = get_comments(array(
		'post_id' => $id,
		'status' => 'approve',
		'order' => 'ASC',
	));

	$depth = get_option('thread_comments_depth');
	$depth = intval($depth)<2 ? 2 : $depth;
	
	$per_page = get_option('comments_per_page');
	
	if ( get_option('comment_order')=='asc' ){
		$top_level = false;
	}else{
		$top_level = true;
	}

	wp_list_comments( "type=comment&callback=dmeng_comment&max_depth=$depth&page=$cpage&per_page=$per_page&reverse_top_level=$top_level", $comments );
	
	$paginate = dmeng_paginate_comments($id,$cpage,$max_page);
	if($paginate) echo '<li class="list-group-item text-center">'.$paginate.'</li>';

	die();
}
add_action( 'wp_ajax_dmeng_get_comments', 'dmeng_get_comments_callback' );
add_action( 'wp_ajax_nopriv_dmeng_get_comments', 'dmeng_get_comments_callback' );
