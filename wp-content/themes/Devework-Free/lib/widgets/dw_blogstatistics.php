<?php

// 小工具
// 名称: 博客统计
// 版本: 1.0
// 作者: ipeld14
// 站名: 翼帆远航
// 网址: http://www.ipeld.net


// 定义小工具的类 EfanBlogStat
class EfanBlogStat extends WP_Widget{

	function EfanBlogStat(){
		// 定义小工具的构造函数
		$widget_ops = array('classname' => 'widget_blogstat', 'description' => '显示博客的统计信息');
		$this->WP_Widget(false, '（DW主题）博客统计', $widget_ops);
	}
	
	function form($instance){
		// 表单函数,控制后台显示
		// $instance 为之前保存过的数据
		// 如果之前没有数据的话,设置默认量
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'title' => '博客统计',
				'establish_time' => '2013-01-27'
			)
		);
		/*
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'title' => '博客统计',
				'establish_time' => '2013-01-27',
				'post_count_no' => '1',
				'draft_count_no' => '0',
				'comment_count_no' => '2',
				'establish_date_no' => '3',
				'establish_time_no' => '4',
				'tag_count_no' => '0',
				'page_count_no' => '0',
				'cat_count_no' => '0',
				'link_count_no' => '0',
				'user_count_no' => '0',
				'last_update_no' => '5',
				'support_me' => false
			)
		);
		*/
		$title = htmlspecialchars($instance['title']);
		$establish_time = htmlspecialchars($instance['establish_time']);
		/*
		$post_count_no = htmlspecialchars($instance['post_count_no']);
		$draft_count_no = htmlspecialchars($instance['draft_count_no']);
		$comment_count_no = htmlspecialchars($instance['comment_count_no']);
		$establish_date_no = htmlspecialchars($instance['establish_date_no']);
		$establish_time_no = htmlspecialchars($instance['establish_time_no']);
		$tag_count_no = htmlspecialchars($instance['tag_count_no']);
		$page_count_no = htmlspecialchars($instance['page_count_no']);
		$cat_count_no = htmlspecialchars($instance['cat_count_no']);
		$link_count_no = htmlspecialchars($instance['link_count_no']);
		$user_count_no = htmlspecialchars($instance['user_count_no']);
		$last_update_no = htmlspecialchars($instance['last_update_no']);
		$support_me = $instance['support_me'];
		*/
		
		// 表格布局输出表单
		$output = '<table>';
		$output .= '<tr><td>标题</td><td>';
		$output .= '<input id="'.$this->get_field_id('title') .'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" />';
		$output .= '</td></tr><tr><td>建站日期：</td><td>';   
		$output .= '<input id="'.$this->get_field_id('establish_time') .'" name="'.$this->get_field_name('establish_time').'" type="text" value="'.$instance['establish_time'].'" />';   
		$output .= '</td></tr></table>';  
		/*
		$output .= '<br />输入数字1~11安排显示顺序,0表示不显示';
		$output .= '<table>';
		
		$output .= '<tr><td>日志总数：</td><td>';
		$output .= '<input id="'.$this->get_field_id('post_count_no') .'" name="'.$this->get_field_name('post_count_no').'" type="text" value="'.$instance['post_count_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>草稿数目：</td><td>';
		$output .= '<input id="'.$this->get_field_id('draft_count_no') .'" name="'.$this->get_field_name('draft_count_no').'" type="text" value="'.$instance['draft_count_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>评论数目：</td><td>';
		$output .= '<input id="'.$this->get_field_id('comment_count_no') .'" name="'.$this->get_field_name('comment_count_no').'" type="text" value="'.$instance['comment_count_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>建站日期：</td><td>';
		$output .= '<input id="'.$this->get_field_id('establish_date_no') .'" name="'.$this->get_field_name('establish_date_no').'" type="text" value="'.$instance['establish_date_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>运行天数：</td><td>';
		$output .= '<input id="'.$this->get_field_id('establish_time_no') .'" name="'.$this->get_field_name('establish_time_no').'" type="text" value="'.$instance['establish_time_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>标签总数：</td><td>';
		$output .= '<input id="'.$this->get_field_id('tag_count_no') .'" name="'.$this->get_field_name('tag_count_no').'" type="text" value="'.$instance['tag_count_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>页面总数：</td><td>';
		$output .= '<input id="'.$this->get_field_id('page_count_no') .'" name="'.$this->get_field_name('page_count_no').'" type="text" value="'.$instance['page_count_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>分类总数：</td><td>';
		$output .= '<input id="'.$this->get_field_id('cat_count_no') .'" name="'.$this->get_field_name('cat_count_no').'" type="text" value="'.$instance['cat_count_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>友链总数：</td><td>';
		$output .= '<input id="'.$this->get_field_id('link_count_no') .'" name="'.$this->get_field_name('link_count_no').'" type="text" value="'.$instance['link_count_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>用户总数：</td><td>';
		$output .= '<input id="'.$this->get_field_id('user_count_no') .'" name="'.$this->get_field_name('user_count_no').'" type="text" value="'.$instance['user_count_no'].'" />';
		$output .= '</td></tr>';
		
		$output .= '<tr><td>最后更新：</td><td>';
		$output .= '<input id="'.$this->get_field_id('last_update_no') .'" name="'.$this->get_field_name('last_update_no').'" type="text" value="'.$instance['last_update_no'].'" />';
		$output .= '</td></tr>';
		$output .= '</table>';
		*/
		/*
		$output .= '<label><input id="'.$this->get_field_id('support_me') .'" name="'.$this->get_field_name('support_me').'" type="checkbox" ';
		if ($instance['support_me']) {
			$output .= 'checked="checked"';
		}
		$output .= ' /> 支持开发者</label>';
		*/
		
		
		echo $output;   
	}
	
	function update($new_instance, $old_instance){
		// 更新数据的函数
		$instance = $old_instance;
		// 数据处理
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['establish_time'] = strip_tags(stripslashes($new_instance['establish_time']));
		/*
		$instance['post_count_no'] = strip_tags(stripslashes($new_instance['post_count_no']));
		$instance['draft_count_no'] = strip_tags(stripslashes($new_instance['draft_count_no']));
		$instance['comment_count_no'] = strip_tags(stripslashes($new_instance['comment_count_no']));
		$instance['establish_date_no'] = strip_tags(stripslashes($new_instance['establish_date_no']));
		$instance['establish_time_no'] = strip_tags(stripslashes($new_instance['establish_time_no']));
		$instance['tag_count_no'] = strip_tags(stripslashes($new_instance['tag_count_no']));
		$instance['page_count_no'] = strip_tags(stripslashes($new_instance['page_count_no']));
		$instance['cat_count_no'] = strip_tags(stripslashes($new_instance['cat_count_no']));
		$instance['link_count_no'] = strip_tags(stripslashes($new_instance['link_count_no']));
		$instance['user_count_no'] = strip_tags(stripslashes($new_instance['user_count_no']));
		$instance['last_update_no'] = strip_tags(stripslashes($new_instance['last_update_no']));
		*/
		return $instance;
	}
	
	function widget($args, $instance){
		extract($args); //展开数组
		$title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
		$establish_time = empty($instance['establish_time']) ? '2013-01-27' : $instance['establish_time'];
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo '<ul>';
		// $this->efan_get_blogstat($establish_time, $instance);
		$this->efan_get_blogstat($establish_time);
		echo '</ul>';
		echo $after_widget;
	}
	
	function efan_get_blogstat($establish_time /*, $instance */){
		// 相关数据的获取
		global $wpdb;
		$count_posts = wp_count_posts();
		$published_posts = $count_posts->publish;
		$draft_posts = $count_posts->draft;
		$comments_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");
		$time = floor((time()-strtotime($establish_time))/86400);
		$count_tags = wp_count_terms('post_tag');
		$count_pages = wp_count_posts('page');
		$page_posts = $count_pages->publish;
		$count_categories = wp_count_terms('category'); 
		$link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); 
		$users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
		$last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
		$last = date('Y-n-j', strtotime($last[0]->MAX_m));
		// 显示数据
		/*
		$op = array(
			$published_posts,
			$draft_posts,
			$comments_count,
			$establish_time,
			$time,
			$count_tags,
			$page_posts,
			$count_categories,
			$link,
			$users,
			$last
		);
		$output = "";
		foreach ($instance as $key => $value){
			switch ($value){
				case "1": 
				case "2":
				case "3":
				case "4":
				case "5":
				case "6":
				case "7":
				case "8":
				case "9":
				case "10":
				case "11":
				default: $output .= $this->efan_get_var_name($key, $op);break;
			}
		}
		*/
		$output = '<li>日志总数：';
		$output .= $published_posts;
		$output .= ' 篇</li>';
		$output .= '<li>评论数目：';
		$output .= $comments_count;
		$output .= ' 条</li>';
		$output .= '<li>建站日期：';
		$output .= $establish_time;
		$output .= '</li>';
		$output .= '<li>运行天数：';
		$output .= $time;
		$output .= ' 天</li>';
		$output .= '<li>标签总数：';
		$output .= $count_tags;
		$output .= ' 个</li>';
		if (is_user_logged_in()){
		$output .= '<li>草稿数目：';
		$output .= $draft_posts;
		$output .= ' 篇</li>';
		$output .= '<li>页面总数：';
		$output .= $page_posts;
		$output .= ' 个</li>';
		$output .= '<li>分类总数：';
		$output .= $count_categories;
		$output .= ' 个</li>';
		$output .= '<li>友链总数：';
		$output .= $link;
		$output .= ' 个</li>';
		}
		if (get_option("users_can_register") == 1){
		$output .= '<li>用户总数：';
		$output .= $users;
		$output .= ' 个</li>';
		}
		$output .= '<li>最后更新：';
		$output .= $last;
		$output .= '</li>';
		
		echo $output;
	}
	/*
	function efan_get_var_name($key, $op){
		extract($op);
		switch ($key){
			case "post_count_no": return '<li>日志总数：'.$published_posts.' 篇</li>';
			case "draft_count_no": return '<li>草稿数目：'.$draft_posts.' 篇</li>';
			case "comment_count_no": return '<li>评论数目：'.$draft_posts.' 条</li>';
			case "establish_date_no": return '<li>建站日期：'.$establish_time.'</li>';
			case "establish_time_no": return '<li>运行天数：'.$time.' 天</li>';
			case "tag_count_no": return '<li>标签总数：'.$count_tags.' 个</li>';
			case "page_count_no": return '<li>页面总数：'.$page_posts.' 个</li>';
			case "cat_count_no": return '<li>分类总数：'.$count_categories.' 个</li>';
			case "link_count_no": return '<li>友链总数：'.$link.' 个</li>';
			case "user_count_no": return '<li>用户总数：'.$users.' 个</li>';
			case "last_update_no": return '<li>最后更新：'.$last.'</li>';
		}
	}
	*/
}

function EfanBlogStat(){
	// 注册小工具
	register_widget('EfanBlogStat');
}

add_action('widgets_init','EfanBlogStat');
?>