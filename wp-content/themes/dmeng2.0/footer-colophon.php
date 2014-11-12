<?php
/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */
 ?>
<footer id="footer">
<div id="colophon" class="container">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>

    <div class="copyright">
	Copyright&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url('/');?>"><?php bloginfo('name');?></a> <?php _e('版权所有','dmeng');?> <br/>
	<span>地    址：</span>徐州万达广场C座423室</br>
        <a href="#" rel="nofollow"></a>
    </div>
</div>
</footer>
<?php echo stripslashes(htmlspecialchars_decode(get_option('dmeng_footer_code')));?>
<?php if(  (int)get_option('dmeng_float_button',1) ==1 ){ ?>
<div class="btn-group-vertical floatButton">
	<button type="button" class="btn btn-default" id="goTop" title="<?php _e('去顶部','dmeng');?>"><span class="glyphicon glyphicon-arrow-up"></span></button>
	<button type="button" class="btn btn-default" id="refresh" title="<?php _e('刷新','dmeng');?>"><span class="glyphicon glyphicon-repeat"></span></button>
	<?php if ( is_home() || is_front_page() ) echo '<a href="http://koubei.baidu.com/s/'.home_url().'" class="btn btn-default" target="_blank"><span class="glyphicon glyphicon-thumbs-up"></span></a>';?>
	<?php if ( is_single() || is_page() ) echo '<button type="button" class="btn btn-default" id="goComments" title="'.__('评论','dmeng').'"><span class="glyphicon glyphicon-align-justify"></span></button>';?>
	<button type="button" class="btn btn-default" id="goBottom" title="<?php _e('去底部','dmeng');?> "><span class="glyphicon glyphicon-arrow-down"></span></button>
</div>
<?php } ?>
