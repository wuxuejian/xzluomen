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
		<article id="post-<?php the_ID(); ?>" class="panel <?php echo $panel_style;?> archive" data-post-id="<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/Article">
		<?php if( $post->post_status!=='publish' ) { ?>
				<div class="panel-heading">
					<?php
					if( $post->post_status==='pending' ) printf(__('正在等待审核，你可以<a href="%1$s">预览</a>或<a href="%2$s">重新编辑</a>。','dmeng'),add_query_arg('preview','true',get_permalink($post->ID)),add_query_arg('p',$post->ID,dmeng_get_user_url('post')) );
					if( $post->post_status==='draft' ) printf(__('这是一篇草稿，你可以<a href="%1$s">预览</a>、<a href="%2$s">继续编辑</a>。','dmeng'),add_query_arg('preview','true',get_permalink($post->ID)),add_query_arg('p',$post->ID,dmeng_get_user_url('post')) );
					?>
					</div>
		<?php } ?>
					<?php
					$thumbnail_html = $has_thumbnail_class = '';
					$thumbnail = dmeng_get_the_thumbnail();
					if($thumbnail){
						$thumbnail_html =  '<div class="entry-thumbnail"><a href="'.get_permalink().'" title="'.get_the_title().'"><img src="'.get_bloginfo('template_url').'/images/grey.png" data-original="'.$thumbnail.'" alt="'.get_the_title().'"></a></div>';
						$has_thumbnail_class = ' has_post_thumbnail';
					}
					?>
				<div class="panel-body<?php echo $has_thumbnail_class;?>">
					<?php if($thumbnail_html) echo $thumbnail_html;?>
					<div class="entry-header page-header">
						<h3 class="entry-title h4">
							<a href="<?php the_permalink();?>" rel="bookmark" itemprop="url"><span itemprop="name"><?php the_title();?></a></span> <?php if(is_sticky()) echo '<span class="label label-danger">'.__('置顶','dmeng').'</span>'; ?>
						</h3>
						<?php dmeng_post_meta();?>
					</div>
					<div class="entry-content" itemprop="description"><?php the_excerpt();?></div>
				</div>
		 </article><!-- #content -->
