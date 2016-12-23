---
title: 워드프레스 업로드 폴더 보안용 .htaccess 생성 플러그인
author: 안형우
layout: post
permalink: /archives/3304
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36545381
categories:
  - WordPress
tags:
  - My WordPress Plugin
---
오늘 [How to Setup Secure Media Uploads][1]라는 글을 봤다. 주요 요지는 `.htaccess` 파일을 이용해서 업로드 폴더의 보안을 강화하는 거였다. 서버에서 파일을 업로드할 때 퍼미션을 777로 해야 하는 경우가 생기는데 이러면 해킹에 무지 취약해진다. `.htaccess` 파일을 이용해서 보안 설정을 하면 퍼미션이 777일 때도 방어력을 높일 수 있다.

원리는, 허용된 확장자 외에는 어떤 것도 읽을 수 없게 하는 거다. PHP서버에서 해킹을 할 때는 해커가 PHP 파일을 업로드하고 그걸 실행시켜야 할 텐데, PHP 파일을 아예 읽을 수 없도록 하면 간단하게 보안을 지킬 수 있는 거다. (다른 우회로가 있는지 뭐 이런 건 난 해킹 지식이 없어서 모른다.)

여튼간에, 위 글에서 알려 준 방식의 `.htaccess` 파일은 아래와 같다.

<pre class="brush: xml; gutter: true; first-line: 1; highlight: [6]"># secure uploads directory
&lt;Files ~ ".*\..*"&gt;
	Order Allow,Deny
	Deny from all
&lt;/Files&gt;
&lt;FilesMatch "\.(jpg|jpeg|jpe|gif|png|tif|tiff)$"&gt;
	Order Deny,Allow
	Allow from all
&lt;/FilesMatch&gt;</pre>

자, 핵심은 6번째 줄에 있는 확장자 모음이다. 이렇게, 읽을 수 있는 확장자만 지정해 주는 게 이 보안 방법의 핵심이다.

나도 이 보안 방법을 사용하려고 하다가, &#8220;도대체 어떤 확장자들이 올라가 있는지 알 수가 있어야지!&#8221; 하는 생각이 들어서 스크립트를 짰다. 업로드 폴더에 있는 모든 파일의 확장자를 구하는 거다. php 같은 확장자는 빼고 말이다. 그걸 자동으로 구해 주면 편하게 .htaccess 파일을 생성할 수 있겠다고 생각해서 스크립트를 짰다. 스크립트를 짜고 나서는, &#8216;이거 나중에 유지보수할 때 찾기 힘들 텐데&#8217; 하는 생각이 들었고, 그래서 플러그인으로 만들면 편하겠다는 생각이 들었다. 그래서 플러그인을 만들었다. [다운로드][2]는 이 글의 맨 아래서 받을 수 있고, 코드는 아래와 같다.

<pre class="brush: php; gutter: true; first-line: 1">&lt;?php
/*
Plugin Name: 업로드 폴더 보안 .htaccess
Description: 업로드 폴더 보안을 위해서 .htaccess 텍스트를 구성해 주는 플러그인이다. 활성화하면 노티스로 뿌려 준다. 필요할 때 활성화해서 메시지를 보고, 메시지를 바탕으로 업로드 폴더의 .htaccess 파일을 구성한 뒤, 플러그인을 비활성화하면 된다.  
Author: 위트인웹 멤버 안형우
Author URI: http://mytory.net
Version: 1.0
*/

/**
 * 이 함수의 출처는 http://php.net/manual/kr/function.readdir.php#103418
 * Finds path, relative to the given root folder, of all files and directories in the given directory and its sub-directories non recursively.
 * Will return an array of the form
 * array(
 *   &#039;files&#039; =&gt; [],
 *   &#039;dirs&#039;  =&gt; [],
 * )
 * @author sreekumar
 * @param string $root
 * @result array
 */
function gae_read_all_files($root = &#039;.&#039;){
  $files  = array(&#039;files&#039;=&gt;array(), &#039;dirs&#039;=&gt;array());
  $directories  = array();
  $last_letter  = $root[strlen($root)-1];
  $root  = ($last_letter == &#039;\\&#039; || $last_letter == &#039;/&#039;) ? $root : $root.DIRECTORY_SEPARATOR;

  $directories[]  = $root;

  while (sizeof($directories)) {
    $dir  = array_pop($directories);
    if ($handle = opendir($dir)) {
      while (false !== ($file = readdir($handle))) {
        if ($file == &#039;.&#039; || $file == &#039;..&#039;) {
          continue;
        }
        $file  = $dir.$file;
        if (is_dir($file)) {
          $directory_path = $file.DIRECTORY_SEPARATOR;
          array_push($directories, $directory_path);
          $files[&#039;dirs&#039;][]  = $directory_path;
        } elseif (is_file($file)) {
          $files[&#039;files&#039;][]  = $file;
        }
      }
      closedir($handle);
    }
  }

  return $files;
}

function gae_get_all_extension( $root ){
	$files = gae_read_all_files($root);
	$extensions = array();
	foreach ($files[&#039;files&#039;] as $file) {
		$extension = pathinfo($file, PATHINFO_EXTENSION);
		$extension = strtolower($extension);
		if( $extension == &#039;php&#039; OR $extension == &#039;&#039; OR $extension == &#039;ds_store&#039; OR $extension == &#039;htaccess&#039;){
			continue;
		}
		if( ! in_array($extension, $extensions) ){
			$extensions[] = $extension;
			$extensions[] = strtoupper($extension);
		}
	}
	$extensions_string = implode(&#039;|&#039;, $extensions);
	return $extensions_string;
}

function gae_notice(){
	$upload_dir = wp_upload_dir();
	$extensions_string = gae_get_all_extension($upload_dir[&#039;basedir&#039;]);
	$htaccess_string = &#039;# secure uploads directory
&lt;Files ~ ".*\..*"&gt;
	Order Allow,Deny
	Deny from all
&lt;/Files&gt;
&lt;FilesMatch "\.($extensions_string)$"&gt;
	Order Deny,Allow
	Allow from all
&lt;/FilesMatch&gt;&#039;;
	$result_string = str_replace(&#039;$extensions_string&#039;, $extensions_string, $htaccess_string);
	?&gt;
	&lt;div class="updated"&gt;
		&lt;p&gt;아래 문자열을 복사해서 업로드 폴더의 .htaccess 를 구성하세요. 이 메시지를 그만 보이게 하려면 ‘업로드 폴더 보안 .htaccess’ 플러그인을 비활성화하세요.&lt;/p&gt;
		&lt;p&gt;&lt;pre&gt;&lt;?php echo htmlspecialchars($result_string)?&gt;&lt;/pre&gt;&lt;/p&gt;
	&lt;/div&gt;
	&lt;?php
}

add_action(&#039;admin_notices&#039;, &#039;gae_notice&#039;);
?&gt;</pre>

플러그인 폴더 없이 파일 하나이므로 plugins 폴더에 그냥 넣으면 된다. 플러그인을 활성화하면 아래와 같은 메시지가 출력된다. 그러면 메시지의 코드 부분을 긁어서 업로드 폴더에 .htaccess 파일을 만들고 붙여 넣으면 된다.

<div style="width: 1269px" class="wp-caption alignnone">
  <img src="/uploads/legacy/get-all-extensions-plugin.png" alt="" width="1259" height="547" /><p class="wp-caption-text">
    이렇게, .htaccess에 넣을 문자열을 만들어서 뿌려 준다.
  </p>
</div>

<p style="text-align: center;">
  <a href="http://dl.dropbox.com/u/15546257/wordpress-plugin/get-all-extension/get-all-extension.zip">업로드 폴더 보안 .htaccess 문자열 생성 플러그인 다운로드</a>
</p>

 [1]: http://digwp.com/2012/09/secure-media-uploads/
 [2]: http://dl.dropbox.com/u/15546257/wordpress-plugin/get-all-extension/get-all-extension.zip