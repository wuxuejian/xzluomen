<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 
$panel_style = 'panel-default';
if( $post->post_status!=='publish' || is_sticky() ) $panel_style = 'panel-danger';
?>
		<?php
			$thumbnail_html = $has_thumbnail_class = '';
			$thumbnail = dmeng_get_the_thumbnail();
			if($thumbnail){
				$thumbnail_html =  '<div class="entry-thumbnail"><a href="'.get_permalink().'" title="'.get_the_title().'"><img height="" src="'.get_bloginfo('template_url').'/images/grey.png" data-original="'.$thumbnail.'" alt="'.get_the_title().'"></a></div>';
				$has_thumbnail_class = ' has_post_thumbnail';
			}
			?>
<div id="post-<?php the_ID(); ?>" class="col-xs-6 col-md-4">
    <div class="thumbnail">
		<a href="<?php echo get_permalink();?>" title="<?php echo get_the_title();?>"><img src="<?php echo get_bloginfo('template_url'); ?>/images/grey.png" class="lazy" data-original="<?php echo $thumbnail; ?>" alt="<?php echo  get_the_title();?>"></a>
		<div class="caption">
			<h4><a href="<?php echo get_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_title(); ?></a></h4>
			<p><?php the_excerpt();?></p>
			<p><a href="<?php echo get_permalink();?>" class="btn btn-primary btn-sm" role="button">详细资料</a></p>
		</div>
	</div>
	
</div>

