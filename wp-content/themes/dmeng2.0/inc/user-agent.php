<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * UA @author 多梦 at 2014.07.04
 * 
 */
 
function dmeng_detect_os($useragent){
	
	if(preg_match('/Android/i', $useragent))
	{
		$link="http://www.android.com/";
		$title="Android";
		$code="android";

		if(preg_match('/Android[\ |\/]?([.0-9a-zA-Z]+)/i', $useragent, $regmatch))
		{
			$version=$regmatch[1];
			$title.=" ".$version;
		}

		if(preg_match('/x86_64/i', $useragent))
		{
			$title.=" x64";
		}
	}elseif(preg_match('/Linux/i', $useragent))
	{
		$link="http://www.linux.org/";
		$title="GNU/Linux";
		$code="linux";

		if(preg_match('/x86_64/i', $useragent))
		{
			$title.=" x64";
		}
	}elseif(preg_match('/Windows/i', $useragent)
		|| preg_match('/WinNT/i', $useragent)
		|| preg_match('/Win32/i', $useragent))
	{
		$link="http://www.microsoft.com/windows/";

		if(preg_match('/Windows NT 6.3; Win64; x64;/i', $useragent)
			|| preg_match('/Windows NT 6.3; WOW64/i', $useragent))
		{
			$title="Windows 8.1 x64 Edition";
			$code="win-5";
		}
		elseif(preg_match('/Windows NT 6.3/i', $useragent))
		{
			$title="Windows 8.1";
			$code="win-5";
		}
		elseif(preg_match('/Windows NT 6.2; Win64; x64;/i', $useragent)
			|| preg_match('/Windows NT 6.2; WOW64/i', $useragent))
		{
			$title="Windows 8 x64 Edition";
			$code="win-5";
		}
		elseif(preg_match('/Windows NT 6.2/i', $useragent))
		{
			$title="Windows 8";
			$code="win-5";
		}
		elseif(preg_match('/Windows NT 6.1; Win64; x64;/i', $useragent)
			|| preg_match('/Windows NT 6.1; WOW64/i', $useragent))
		{
			$title="Windows 7 x64 Edition";
			$code="win-4";
		}
		elseif(preg_match('/Windows NT 6.1/i', $useragent))
		{
			$title="Windows 7";
			$code="win-4";
		}
		elseif(preg_match('/Windows NT 6.0/i', $useragent))
		{
			$title="Windows Vista";
			$code="win-3";
		}
		elseif(preg_match('/Windows NT 5.2 x64/i', $useragent))
		{
			$title="Windows XP x64 Edition";
			$code="win-2";
		}
		elseif(preg_match('/Windows NT 5.2; Win64; x64;/i', $useragent))
		{
			$title="Windows Server 2003 x64 Edition";
			$code="win-2";
		}
		elseif(preg_match('/Windows NT 5.2/i', $useragent))
		{
			$title="Windows Server 2003";
			$code="win-2";
		}
		elseif(preg_match('/Windows NT 5.1/i', $useragent)
			|| preg_match('/Windows XP/i', $useragent))
		{
			$title="Windows XP";
			$code="win-2";
		}
		elseif(preg_match('/Windows NT 5.01/i', $useragent))
		{
			$title="Windows 2000, Service Pack 1 (SP1)";
			$code="win-1";
		}
		elseif(preg_match('/Windows NT 5.0/i', $useragent)
			|| preg_match('/Windows 2000/i', $useragent))
		{
			$title="Windows 2000";
			$code="win-1";
		}
		elseif(preg_match('/Windows NT 4.0/i', $useragent)
			|| preg_match('/WinNT4.0/i', $useragent))
		{
			$title="Microsoft Windows NT 4.0";
			$code="win-1";
		}
		elseif(preg_match('/Windows NT 3.51/i', $useragent)
			|| preg_match('/WinNT3.51/i', $useragent))
		{
			$title="Microsoft Windows NT 3.11";
			$code="win-1";
		}
		elseif(preg_match('/Windows 3.11/i', $useragent)
			|| preg_match('/Win3.11/i', $useragent)
			|| preg_match('/Win16/i', $useragent))
		{
			$title="Microsoft Windows 3.11";
			$code="win-1";
		}
		elseif(preg_match('/Windows 3.1/i', $useragent))
		{
			$title="Microsoft Windows 3.1";
			$code="win-1";
		}
		elseif(preg_match('/Windows 98; Win 9x 4.90/i', $useragent)
			|| preg_match('/Win 9x 4.90/i', $useragent)
			|| preg_match('/Windows ME/i', $useragent))
		{
			$title="Windows Millennium Edition (Windows Me)";
			$code="win-1";
		}
		elseif(preg_match('/Win98/i', $useragent))
		{
			$title="Windows 98 SE";
			$code="win-1";
		}
		elseif(preg_match('/Windows 98/i', $useragent)
			|| preg_match('/Windows\ 4.10/i', $useragent))
		{
			$title="Windows 98";
			$code="win-1";
		}
		elseif(preg_match('/Windows 95/i', $useragent)
			|| preg_match('/Win95/i', $useragent))
		{
			$title="Windows 95";
			$code="win-1";
		}
		elseif(preg_match('/Windows CE/i', $useragent))
		{
			$title="Windows CE";
			$code="win-2";
		}
		elseif(preg_match('/WM5/i', $useragent))
		{
			$title="Windows Mobile 5";
			$code="win-phone";
		}
		elseif(preg_match('/WindowsMobile/i', $useragent))
		{
			$title="Windows Mobile";
			$code="win-phone";
		}
		else
		{
			$title="Windows";
			$code="win-2";
		}
	}elseif(preg_match('/Mac/i', $useragent)
		|| preg_match('/Darwin/i', $useragent))
	{
		$link="http://www.apple.com/macosx/";

		if(preg_match('/Mac OS X/i', $useragent))
		{
			$title=substr($useragent, strpos(strtolower($useragent), strtolower("Mac OS X")));
			$title=substr($title, 0, strpos($title, ")"));

			if(strpos($title, ";"))
			{
				$title=substr($title, 0, strpos($title, ";"));
			}

			$title=str_replace("_", ".", $title);
			$code="mac-3";
		}
		elseif(preg_match('/Mac OSX/i', $useragent))
		{
			$title=substr($useragent, strpos(strtolower($useragent), strtolower("Mac OS X")));
			$title=substr($title, 0, strpos($title, ")"));

			if(strpos($title, ";"))
			{
				$title=substr($title, 0, strpos($title, ";"));
			}

			$title=str_replace("_", ".", $title);
			$code="mac-2";
		}
		elseif(preg_match('/Darwin/i', $useragent))
		{
			$title="Mac OS Darwin";
			$code="mac-1";
		}
		else
		{
			$title="Macintosh";
			$code="mac-1";
		}
	}else
	{
		$title="unknown";
		$code="null";
	}
	
	return '<img src="'.get_bloginfo('template_url').'/images/os/'.$code.'.png" width="16" height="16" alt="'.$title.'" />';

}

function dmeng_detect_webbrowser($useragent){
	
	if(preg_match('/360se/i', $useragent))
	{
		$link="http://se.360.cn/";
		$title="360Safe Explorer";
		$code="360se";
	}elseif(preg_match('/baidubrowser/i', $useragent))
	{
		$link="http://liulanqi.baidu.com/";
		$title="Baidu Browser";
		$code="baidubrowser";
	}elseif(preg_match('/Chrome/i', $useragent))
	{
		$link="http://google.com/chrome/";
		$title="Google Chrome";
		$code="chrome";
	}elseif(preg_match('/Chromium/i', $useragent))
	{
		$link="http://www.chromium.org/";
		$title="Chromium";
		$code="chromium";
	}elseif(preg_match('/Safari/i', $useragent)
		&& !preg_match('/Nokia/i', $useragent))
	{
		$link="http://www.apple.com/safari/";
		$title="Safari";

		if(preg_match('/Version/i', $useragent))
		{
			$title="Safari";
		}
		
		if(preg_match('/Mobile Safari/i', $useragent))
		{
			$title="Mobile ".$title;
		}

		$code="safari";
	}elseif(preg_match('/Firefox/i', $useragent))
	{
		$link="http://www.mozilla.org/";
		$title="Firefox";
		$code="firefox";
	}elseif(preg_match('/MSIE/i', $useragent) || preg_match('/Trident/i', $useragent))
	{
		$link="http://www.microsoft.com/windows/products/winfamily/ie/default.mspx";
		$title="Internet Explorer";
		
		if (preg_match('/MSIE[\ |\/]?([.0-9a-zA-Z]+)/i', $useragent, $regmatch))
		{
			// We have IE10 or older
		}
		elseif (preg_match('/\ rv:([.0-9a-zA-Z]+)/i', $useragent, $regmatch))
		{
			// We have IE11 or newer
		}
		

		if($regmatch[1]>=10)
		{
			$code="msie10";
		}
		elseif($regmatch[1]>=9)
		{
			$code="msie9";
		}
		elseif($regmatch[1]>=7)
		{
			// also ie8
			$code="msie7";
		}
		elseif($regmatch[1]>=6)
		{
			$code="msie6";
		}
		elseif($regmatch[1]>=4)
		{
			// also ie5
			$code="msie4";
		}
		elseif($regmatch[1]>=3)
		{
			$code="msie3";
		}
		elseif($regmatch[1]>=2)
		{
			$code="msie2";
		}
		elseif($regmatch[1]>=1)
		{
			$code="msie1";
		}
		else
		{
			$code="msie";
		}
	}elseif(preg_match('/Opera Mini/i', $useragent))
	{
		$link="http://www.opera.com/mini/";
		$title="Opera Mini";
		$code="opera-2";
	}
	elseif(preg_match('/Opera Mobi/i', $useragent))
	{
		$link="http://www.opera.com/mobile/";
		$title="Opera Mobi";
		$code="opera-2";
	}
	elseif(preg_match('/Opera Labs/i', $useragent)
		|| (preg_match('/Opera/i', $useragent)
			&& preg_match('/Edition Labs/i', $useragent)))
	{
		$link="http://labs.opera.com/";
		$title="Opera Labs";
		$code="opera-next";
	}
	elseif(preg_match('/Opera Next/i', $useragent)
		|| (preg_match('/Opera/i', $useragent)
			&& preg_match('/Edition Next/i', $useragent)))
	{
		$link="http://www.opera.com/support/kb/view/991/";
		$title="Opera Next";
		$code="opera-next";
	}
	elseif(preg_match('/Opera/i', $useragent))
	{
		$link="http://www.opera.com/";
		$title="Opera";
		$code="opera-1";
		if(preg_match('/Version/i', $useragent))
			$code="opera-2";
	}
	elseif(preg_match('/OPR/i', $useragent))
	{
		$link="http://www.opera.com/";
		if(preg_match('/(Edition Next)/i', $useragent))
		{
			$title="Opera Next";
			$code="opera-next";
		}
		elseif(preg_match('/(Edition Developer)/i', $useragent))
		{
			$title="Opera Developer";
			$code="opera-developer";
		}
		else
		{
			$title="Opera";
			$code="opera-1";
		}
	}elseif(preg_match('/Mozilla/i', $useragent))
	{
		$link="http://www.mozilla.org/";
		$title="Mozilla Compatible";

		if(preg_match('/rv:([.0-9a-zA-Z]+)/i', $useragent, $regmatch))
		{
			$title="Mozilla ".$regmatch[1];
		}

		$code="mozilla";
	}elseif(preg_match('/AppleWebkit/i', $useragent)
		&& preg_match('/Android/i', $useragent)
		&& !preg_match('/Chrome/i', $useragent))
	{
		$link="http://developer.android.com/reference/android/webkit/package-summary.html";
		$title="Android Webkit";
		$code="android-webkit";
	}elseif(preg_match('/wp-android/i', $useragent) || preg_match('/wp-blackberry/i', $useragent) || preg_match('/wp-iphone/i', $useragent) || preg_match('/wp-nokia/i', $useragent) || preg_match('/wp-webos/i', $useragent))
	{
		$link="http://cn.wordpress.org/";
		$title="WordPress";
		$code="wordpress";
	}else
	{
		$link="#";
		$title="Unknown";
		$code="null";
		
	}
	
	
	return '<img src="'.get_bloginfo('template_url').'/images/net/'.$code.'.png" width="16" height="16" alt="'.$title.'" />';
	
}

function dmeng_detect_ua($ua){
	$c = ' ';
	$c .= dmeng_detect_os($ua);
	$c .= ' ';
	$c .= dmeng_detect_webbrowser($ua);
	$c .= ' ';
	return $c;
}
