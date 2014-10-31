<?php
/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 ?>
<header id="masthead" class="navbar navbar-default navbar-fixed-top" role="banner" itemscope itemtype="http://schema.org/WPHeader">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".header-navbar-collapse">
                <span class="sr-only"><?php _e('切换菜单','dmeng');?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo home_url('/');?>" rel="home" itemprop="headline"><img src="/wp-includes/images/luomen/brand.png" style="width: 70px; height: 40px; margin-top: -10px; margin-bottom: -10px; margin-right: 10px;"><?php bloginfo('name'); ?></a>
        </div>
		<nav id="navbar" class="collapse navbar-collapse header-navbar-collapse" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <?php
			// 载入菜单，设置深度为2，因为Bootstrap最多只支持二级菜单
			//  wp_bootstrap_navwalker 是 /inc/wp_bootstrap_navwalker.php 的类，已在functions.php载入
			
			// 主菜单
			if ( has_nav_menu( 'header_menu' ) ) {
				wp_nav_menu( array(
					'menu'              => 'header_menu',
					'theme_location'    => 'header_menu',
					'depth'             => 0,
					'container'         => '',
					'container_class'   => '',
					'menu_class'        => 'nav navbar-nav',
					'items_wrap' 		=> '<ul class="%2$s">%3$s</ul>',
					'walker'            => new Dmeng_Bootstrap_Menu()
				)	);
			}

			// 右侧菜单
			if ( has_nav_menu( 'header_right_menu' ) ) {
				wp_nav_menu( array(
					'menu'              => 'header_right_menu',
					'theme_location'    => 'header_right_menu',
					'depth'             => 2,
					'container'         => '',
					'container_class'   => '',
					'menu_class'        => 'nav navbar-nav navbar-right',
					'items_wrap' 		=> '<ul class="%2$s">%3$s</ul>',
					'walker'            => new Dmeng_Bootstrap_Menu()
				)	);
			}
        ?>
			<form class="navbar-form navbar-right" role="search" method="get" id="searchform" action="<?php echo home_url('/');?>">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="<?php _e('搜索 &hellip;','dmeng');?>" name="s" id="s" required>
				</div>
				<button type="submit" class="btn btn-default" id="searchsubmit"><span class="glyphicon glyphicon-search"></span></button>
			</form>
		</nav><!-- #navbar -->
    </div>
</header><!-- #masthead -->
