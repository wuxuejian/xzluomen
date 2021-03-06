<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 自定义小工具 @author 多梦 at 2014.06.21 
 * 
 */
class DmengAnalyticsWidget extends WP_Widget {

	function __construct() {
		parent::__construct( 'analytics', __( ' 站点统计' , 'dmeng' ) , array('classname' => 'widget_analytics', 'description' => __( '站点统计信息' , 'dmeng' ) ) );
	}

	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		if(isset($instance['user']) && trim($instance['user'])=='on'){
			$users = count_users();
			$users = $users['total_users'];
		}else{
			$users = '';
		}

		$list = array(
			'post' => array( __('文章总数','dmeng'), wp_count_posts()->publish ),
			'cat' => array( __('文章分类','dmeng'), wp_count_terms('category') ),
			'tag' => array( __('文章标签','dmeng'), wp_count_terms('post_tag') ),
			'user' => array( __('用户总数','dmeng'), $users ),
			'comment' => array( __('评论总数','dmeng'), wp_count_comments()->total_comments ),
			'view' => array( __('浏览总数','dmeng'), get_dmeng_traffic_all() ),
			'search' => array( __('搜索次数','dmeng'), get_dmeng_traffic_all('search') )
		);
	
		echo '<ul>';
		
		foreach( $list as $key=>$value ){
			if($instance[$key]) echo '<li>'.$value[0].' : '.$value[1] .'</li>';
		}
		
		echo '</ul>';

		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'post' => 'on', 'cat' => 'on', 'tag' => 'on', 'user' => 'on', 'comment' => 'on', 'view' => 'on', 'search' => 'on') );
		$title = $instance['title'];
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题：','dmeng');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>
	<p><?php _e('选择要显示的项目。','dmeng');?></p>
<p>
	
	<?php
	
	$list = array(
		'post' => __('文章总数','dmeng'),
		'cat' => __('文章分类','dmeng'),
		'tag' => __('文章标签','dmeng'),
		'user' => __('用户总数','dmeng'),
		'comment' => __('评论总数','dmeng'),
		'view' => __('浏览总数','dmeng'),
		'search' => __('搜索次数','dmeng')
	);
	
	foreach( $list as $key=>$value ){
	?>
	<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" <?php if(isset($instance[$key])&&trim($instance[$key])=='on') echo 'checked="checked"';?>> <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $value?></label><br>
	<?php
	}
	?>

</p>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array());
		$list = array('title', 'post', 'cat', 'tag', 'user', 'comment', 'view', 'search');
		foreach( $list as $key ){
			$instance[$key] = strip_tags($new_instance[$key]);
		}
		return $instance;
	}
	
}

class DmengIntroWidget extends WP_Widget {

	function __construct() {
		parent::__construct( 'intro', __( ' 关于我们' , 'dmeng' ) , array('classname' => 'widget_intro', 'description' => __( '介绍企业' , 'dmeng' ) ) );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
                $intro = $instance['intro']?$instance['intro']:'徐州罗门装饰工程有限公司成立于2014年10月，本公司以室内装修为主体，融工装，室外装饰工程 设计，家具 门制作的一体的专业化装修工程有限公司，罗门装饰有限公司是一个兼室内外装饰工程、设计施工为一体的专业装饰公司.....' ;
		$list = array(
			'post' => array( __('文章总数','dmeng'), $intro ),
		);
		echo '<ul>';
		foreach( $list as $key=>$value ){
			echo '<li>'.$value[1] .'</li>';
		}
		echo '</ul>';
		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'intro' => '',) );
		$title = $instance['title'];
                $intro = $instance['intro'];
        ?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题：','dmeng');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>
        <p>
		<label for="<?php echo $this->get_field_id('intro'); ?>"><?php _e('介绍：','dmeng');?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('intro'); ?>" name="<?php echo $this->get_field_name('intro'); ?>" type="text"><?php echo esc_attr($intro); ?></textarea>
	</p>
        <?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array());
		$list = array('title', 'intro',);
		foreach( $list as $key ){
			$instance[$key] = $new_instance[$key];
		}
		return $instance;
	}
	
}

class DmengSiteLinkWidget extends WP_Widget {
    public $names;
    public $list;
        function __construct() {
            parent::__construct( 'sitelink', __( ' 网站链接' , 'dmeng' ) , array('classname' => 'widget_sitelink', 'description' => __( '网站链接' , 'dmeng' ) ) );

        $this->names = array('about'=>'关于我们','tos'=>'服务条款','contact'=>'联系我们','hiring'=>'加入我们','link'=>'合作伙伴','press'=>'新闻报道','feedback'=>'建议反馈','weibo'=>'新浪微博','qq'=>'腾讯微博');

        $this->list = array('about', 'tos','contact','hiring','link','press','feedback','weibo','qq');   
        }

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
                $about = $instance['about']?$instance['about']:'#' ;
                $tos = $instance['tos']?$instance['tos']:'#';
                $faq = $instance['faq']?$instance['faq']:'#';
                $contact = $instance['contact']?$instance['contact']:'#';
                $hiring = $instance['hiring']?$instance['hiring']:'#';
                $link = $instance['link']?$instance['link']:'#';
                $press = $instance['press']?$instance['press']:'#';
                $feedback = $instance['feedback']?$instance['feedback']:'#';
                $weibo = $instance['weibo']?$instance['weibo']:'#';
                $qq = $instance['qq']?$instance['qq']:'#';
                
		$list = array(
			'post' => array( __('文章总数','dmeng'), $intro ),
		);
		echo '<div class="row hidden-xs">
        <dl class="col-sm-2 site-link">
            <dt>网站相关</dt>
            <dd><a href="'.$about.'">关于我们</a></dd>
            <dd><a href="'.$tos.'">服务条款</a></dd>
            <dd><a href="'.$help.'">帮助中心</a></dd>
        </dl>
        <dl class="col-sm-2 site-link">
            <dt>联系合作</dt>
            <dd><a href="'.$contact.'">联系我们</a></dd>
            <dd><a href="'.$hiring.'">加入我们</a></dd>
            <dd><a href="'.$link.'">合作伙伴</a></dd>
            <dd><a href="'.$press.'">媒体报道</a></dd>
            <dd><a href="'.$feedback.'">建议反馈</a></dd>
        </dl>
        <dl class="col-sm-2 site-link">
            <dt>常用链接</dt>
            <dd><a href="/#">房型图</a></dd>
            <dd><a href="/#">效果图</a></dd>

        </dl>
        <dl class="col-sm-2 site-link">
            <dt>关注我们</dt>
            <dd><a href="http://weibo.com/" target="_blank">新浪微博</a></dd>
            <dd><a href="http://t.qq.com/" target="_blank">腾讯微博</a></dd>
        </dl>
        <dl class="col-sm-4 site-link" id="license">
            <dt>内容许可</dt>
            <dd>除特别说明外，所有内容禁止商业用途</dd>
            <dd>本站由 <a href="##">wxj</a> 提供技术支持</dd>
        </dl>
    </div>';
		echo $after_widget;
	}

	function form( $instance ) {
            

            $instance = wp_parse_args( (array) $instance, array( 'about' =>'', 'tos' =>'','contact'=>'','hiring'=>'','link'=>'','press'=>'','feedback'=>'','weibo'=>'','qq'=>'') );
            foreach ($instance as $key=>$value) {
                ?>
            <p>
            <label for="<?php echo $this->get_field_id($key); ?>"><?php _e( $this->names[$key].'：','dmeng');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" type="text" value="<?php echo esc_attr($value); ?>" />
            </p>
                <?php
            }
        ?>
        <?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array());
		$list = $this->list;
		foreach( $list as $key ){
			$instance[$key] = $new_instance[$key];
		}
		return $instance;
	}
	
}

class DmengOpenWidget extends WP_Widget {

	function __construct() {
		parent::__construct( 'open_login', __( '登录和资料' , 'dmeng' ) , array('classname' => 'widget_open_login', 'description' => __( '用户登录&个人资料展示' , 'dmeng' ) ) );
	}

	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		echo '<ul class="user-profile">';

	if( is_user_logged_in() ){ 

			dmeng_user_profile_widget();
			
	}else{
		if( $instance['qq'] && dmeng_is_open_qq() ) {
			echo '<li class="icon qq"><a href="'.home_url('/?connect=qq&action=login&redirect='.urlencode(dmeng_get_current_page_url())).'">'.__( '使用QQ账号登录' , 'dmeng' ).'</a></li>';
		}
		
		if( $instance['weibo'] && dmeng_is_open_weibo() ) {
			echo '<li class="icon weibo"><a href="'.home_url('/?connect=weibo&action=login&redirect='.urlencode(dmeng_get_current_page_url())).'">'.__( '使用微博账号登录' , 'dmeng' ).'</a></li>';
		} 
		
		if( $instance['wordpress'] ) {
			echo '<li class="icon wordpress"><a href="'.wp_login_url().'">'.__( '使用本地账号登录' , 'dmeng' ).'</a></li>';
		}
		
	}
	
		echo '<ul>';
		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'qq' => 'on', 'weibo' => 'on', 'wordpress' => 'on') );
		$title = $instance['title'];
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题：','dmeng');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>
	<p><?php _e('选择要显示的项目。','dmeng');?></p>
<p>
	<?php
	
	$list = array(
		'qq' => __('显示QQ登录（如果有启用QQ登录）','dmeng'),
		'weibo' => __('显示微博登录（如果有启用微博登录）','dmeng'),
		'wordpress' => __('显示本地登录','dmeng'),
	);
	
	foreach( $list as $key=>$value ){
	?>
	<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" <?php if(isset($instance[$key])&&trim($instance[$key])=='on') echo 'checked="checked"';?>> <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $value?></label><br>
	<?php
	}
	?>

</p>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array());
		$list = array('title', 'qq', 'weibo', 'wordpress');
		foreach( $list as $key ){
			$instance[$key] = strip_tags($new_instance[$key]);
		}
		return $instance;
	}
	
}

class DmengCreditRankWidget extends WP_Widget {

	function __construct() {
		parent::__construct( 'creditRank', __( ' 积分排行榜' , 'dmeng' ) , array('classname' => 'widget_credit_rank', 'description' => __( '用户可用积分排行榜' , 'dmeng' ) ) );
	}

	function widget( $args, $instance ) {
		extract($args);

		global $wpdb;
		$rank = $wpdb->get_results( "SELECT user_id,meta_value FROM $wpdb->usermeta WHERE meta_key = 'dmeng_credit' ORDER BY -meta_value ASC LIMIT 6 ");
		if($rank){

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

?>
<ul>
	<?php foreach ( $rank as $term ){ 
		$user = get_user_by( 'id',  $term->user_id );
		$user_name = filter_var($user->user_url, FILTER_VALIDATE_URL) ? '<a href="'.$user->user_url.'" target="_blank" rel="external">'.$user->display_name.'</a>' : $user->display_name;
		?><li><span class="pull-right"><?php echo $term->meta_value;?></span><a href="<?php echo get_author_posts_url( $term->user_id ); ?>"><?php echo dmeng_get_avatar( $term->user_id , 20 , dmeng_get_avatar_type($term->user_id) ); ?></a> <?php echo $user_name;?></li>
	<?php } ?>
</ul>
<?php

		echo $after_widget;
			}
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题：','dmeng');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
}

class DmengRankWidget extends WP_Widget {

	function __construct() {
		parent::__construct( 'dmengRank', __( ' 排行榜' , 'dmeng' ) , array('classname' => 'widget_dmeng_rank', 'description' => __( '热门文章/热议文章/搜索排行榜' , 'dmeng' ) ) );
	}

	function widget( $args, $instance ) {
		
		$cache = wp_cache_get('widget_dmeng_rank', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$number = (int)$instance['number'];
		if(!$number) return;
		
		$items = array();

//~ 数据转HTML函数
function panel_group_item_output_html($style,$parent,$id,$collapsed,$glyphicon,$data,$title){
	$output = '<div class="panel panel-'.$style.'">';
	$output .= '<div class="panel-heading"><h3 class="panel-title"><a data-toggle="collapse" data-parent="#'.$parent.'" href="#'.$id.'"><span class="glyphicon '.$glyphicon.'"></span> '.$title.'</a></h3></div>';
	$output .= ' <div id="'.$id.'" class="panel-collapse collapse '.$collapsed.'">';
	foreach( $data as $item ){
		$output .= '<li class="list-group-item"><span class="badge" title="'.$item['badge_title'].'">'.$item['badge'].'</span> <a href="'.$item['url'].'" title="'.$item['title'].'">'.$item['title'].'</a></li>';
	}
	$output .= '</div></div>';
	return $output;
}

function get_panel_item_data($type,$number){
	
	$data = array();
	
	if( $type=='search' ){
		$search_rank = dmeng_tracker_rank('search',$number);
		if($search_rank){
			foreach( $search_rank as $search ){
				$data[] = array(
					'url' => add_query_arg('s',$search->pid,home_url()),
					'title' => strip_tags($search->pid),
					'badge' => $search->traffic,
					'badge_title' => sprintf(__('%s次搜索','dmeng'),$search->traffic)
				);
			}
			return array(
				'style' => 'success',
				'id' => 'search',
				'icon' => 'glyphicon-search',
				'data' => $data,
				'title' => __( '搜索次数最多的%s个关键词','dmeng')
			);
		}
	}
	
	if( $type=='comment' ){
		$query = new WP_Query( array( 'posts_per_page' => $number, 'orderby' => 'comment_count', 'ignore_sticky_posts' => true, 'post_type' => array( 'post', 'page' ) ) );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$data[] = array(
					'url' => get_permalink(),
					'title' => get_the_title(),
					'badge' => get_comments_number(),
					'badge_title' => sprintf(__('%s条评论','dmeng'),get_comments_number())
				);
			}
			wp_reset_postdata();
			return array(
				'style' => 'info',
				'id' => 'comment',
				'icon' => 'glyphicon-volume-up',
				'data' => $data,
				'title' => __( '最多人评论的%s篇内容','dmeng')
			);
		}
	}
	
	if( $type=='vote' ){
		global $wpdb;
		$vote_rank = $wpdb->get_results("SELECT post_id,sum(meta_value+0) AS count FROM $wpdb->postmeta WHERE meta_key='dmeng_votes_up' OR meta_key='dmeng_votes_down' GROUP BY post_id ORDER BY count DESC LIMIT $number");
		if($vote_rank){
			foreach( $vote_rank as $vote ){
				$data[] = array(
					'url' => get_permalink($vote->post_id),
					'title' => get_the_title($vote->post_id),
					'badge' =>  $vote->count,
					'badge_title' => sprintf(__('%s人投票','dmeng'),$vote->count)
				);
			}
			return array(
				'style' => 'warning',
				'id' => 'vote',
				'icon' => 'glyphicon-stats',
				'data' => $data,
				'title' => __( '按投票率排行的%s篇内容','dmeng')
			);
		}
	}
	
	if( $type=='view' ){
		$view_rank = dmeng_tracker_rank('single',$number);
		if($view_rank){
			foreach( $view_rank as $view ){
				$data[] = array(
					'url' => get_permalink($view->pid),
					'title' => get_the_title($view->pid),
					'badge' => $view->traffic,
					'badge_title' => sprintf(__('%s次浏览','dmeng'),$view->traffic)
				);
			}
			return array(
				'style' => 'danger',
				'id' => 'view',
				'icon' => 'glyphicon-fire',
				'data' => $data,
				'title' => __( '按浏览次数排行的%s篇内容','dmeng')
			);
		}
	}
	
}

	foreach( $instance as $key=>$value ){
		if( isset($instance[$key]) && trim($instance[$key])=='on' ){
			$output = get_panel_item_data($key, $number);
			if($output) $items[] = $output;
		}
	}

	$count = count($items);
	
	if($count){
		
		echo '<aside id="accordion-'.$args['widget_id'].'" class="panel-group">';
		
		$i = 1;
		foreach( $items as $item ){
			
			$in = $i==$count ? 'in' : '';

			echo panel_group_item_output_html($item['style'], 'accordion-'.$args['widget_id'], $item['id'].'-'.$args['widget_id'], $in, $item['icon'], $item['data'], sprintf( $item['title'] , $number ));
			
			$i++;
		}
		
		echo '</aside>';
	}


		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_dmeng_rank', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array() );

		$list = array('search', 'comment', 'vote', 'view','number');
		foreach( $list as $key ){
			$instance[$key] = strip_tags($new_instance[$key]);
		}

		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_show_entries']) )
			delete_option('widget_show_entries');
			
		return $instance;
	}
	
	function flush_widget_cache() {
		wp_cache_delete('widget_dmeng_rank', 'widget');
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'search' => 'on', 'comment' => 'on', 'vote' => 'on', 'view' => 'on', 'number' => 10 ) );
		$number = $instance['number'];
?>
<p><?php _e('选择要显示的项目。','dmeng');?></p>
<p>
	<?php
	
	$list = array(
		'search' => __('搜索次数最多的关键词','dmeng'),
		'comment' => __('评论最多的内容','dmeng'),
		'vote' => __('最多人投票的内容','dmeng'),
		'view' => __('浏览次数最多的内容','dmeng'),
	);
	
	foreach( $list as $key=>$value ){
	?>
	<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" <?php if(isset($instance[$key])&&trim($instance[$key])=='on') echo 'checked="checked"';?>> <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $value?></label><br>
	<?php
	}
	?>
</p>
	<p>
		<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('显示数量：','dmeng');?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3">
	</p>
<?php
	}
	
}

class DmengRecentUserWidget extends WP_Widget {

	function __construct() {
		parent::__construct( 'recent_user', __( ' 最近登录用户' , 'dmeng' ) , array('classname' => 'widget_recent_user', 'description' => __( '显示最近登录用户头像' , 'dmeng' ) ) );
	}

	function widget( $args, $instance ) {
		
		$cache = wp_cache_get('widget_recent_user', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$number = (int)$instance['number'];
		if(!$number) return;
		
		$users = dmeng_get_recent_user($number);

		if($users){

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

?>
<ul id="recent_user">
	<?php foreach( $users as $user ){
			$user_url = get_the_author_meta( 'user_url', $user->ID );
			$user_url = $user_url ? $user_url : get_author_posts_url( $user->ID );
			echo '<li><a href="'.$user_url .'" target="_blank" rel="nofollow" title="'.$user->display_name.'">'.dmeng_get_avatar( $user->ID , '50' , dmeng_get_avatar_type($user->ID) ).'</a></li>';
		}?>
</ul>
<?php

		echo $after_widget;
		
		}
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '最近登录用户', 'number' => 10) );
		$title = $instance['title'];
		$number = (int)$instance['number'];
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题：','dmeng');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('显示数量：','dmeng');?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3">
	</p>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '最近登录用户', 'number' => 10));
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int)$new_instance['number'];
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_show_entries']) )
			delete_option('widget_show_entries');
			
		return $instance;
	}
	
	function flush_widget_cache() {
		wp_cache_delete('widget_recent_user', 'widget');
	}
	
}

function dmeng_register_widgets() {
	register_widget( 'DmengAnalyticsWidget' );
	register_widget( 'DmengOpenWidget' );
        register_widget( 'DmengIntroWidget' );
	register_widget( 'DmengCreditRankWidget' );
	register_widget( 'DmengRankWidget' );
	register_widget( 'DmengRecentUserWidget' );
        register_widget('DmengSiteLinkWidget');
}

add_action( 'widgets_init', 'dmeng_register_widgets' );
