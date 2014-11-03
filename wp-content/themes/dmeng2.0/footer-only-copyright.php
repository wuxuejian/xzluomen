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
    <div class="row hidden-xs">
        <dl class="col-sm-2 site-link">
            <dt>网站相关</dt>
            <dd><a href="/about">关于我们</a></dd>
            <dd><a href="/tos">服务条款</a></dd>
            <dd><a href="/faq">帮助中心</a></dd>
        </dl>
        <dl class="col-sm-2 site-link">
            <dt>联系合作</dt>
            <dd><a href="/contact">联系我们</a></dd>
            <dd><a href="/hiring">加入我们</a></dd>
            <dd><a href="/link">合作伙伴</a></dd>
            <dd><a href="/press">媒体报道</a></dd>
            <dd><a href="http://0x.segmentfault.com">建议反馈</a></dd>
        </dl>
        <dl class="col-sm-2 site-link">
            <dt>常用链接</dt>
            <dd><a href="/feeds">问答订阅</a></dd>
            <dd><a href="/feeds/blogs">文章订阅</a></dd>
            <dd><a href="http://mirrors.segmentfault.com/" target="_blank">文档镜像</a></dd>

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
    </div>
    <div class="copyright">
	Copyright&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url('/');?>"><?php bloginfo('name');?></a> <?php _e('版权所有','dmeng');?> <br/>
	<span>地    址：</span>徐州万达广场C座423室</br>
        <a href="http://www.miibeian.gov.cn/" rel="nofollow">京 ICP 备 12004932 号</a>, 京公网安备 110108008322 号
    </div>
</div>
</footer>
<?php echo stripslashes(htmlspecialchars_decode(get_option('dmeng_footer_code')));?>