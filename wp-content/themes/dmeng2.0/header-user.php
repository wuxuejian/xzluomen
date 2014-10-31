<?php
/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 ?>
 
<header id="masthead" class="navbar navbar-default navbar-fixed-top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".header-navbar-collapse">
                <span class="sr-only"><?php _e('切换菜单','dmeng');?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo home_url('/');?>" rel="home"><img src="/wp-includes/images/luomen/brand.png" style="width: 70px; height: 40px; margin-top: -10px; margin-bottom: -10px; margin-right: 10px;"><?php bloginfo('name'); ?></a>
        </div>
		
		<nav id="navbar" class="collapse navbar-collapse header-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav">
			  <?php
					foreach( array( 'home',  'post', 'comment', 'credit', 'message',  'profile' )  as $item ){
						$active = dmeng_is_user_page()==$item ? ' class="active" ' : '';
						echo '<li '.$active.'>';
						echo '<a href="'.dmeng_get_user_url($item).'">'.dmeng_get_user_page_title($item).'</a>';
						echo '</li>';
					}
				?>
          </ul>
		</nav><!-- #navbar -->
    </div>
</header>
