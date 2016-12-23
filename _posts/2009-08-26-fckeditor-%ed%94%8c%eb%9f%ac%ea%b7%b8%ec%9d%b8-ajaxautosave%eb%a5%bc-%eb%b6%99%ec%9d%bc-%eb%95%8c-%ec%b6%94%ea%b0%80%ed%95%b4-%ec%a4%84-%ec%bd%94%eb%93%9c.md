---
title: FCKeditor 플러그인 ajaxAutoSave를 붙일 때 추가해 줄 코드
author: 안형우
layout: post
permalink: /archives/26
aktt_notify_twitter:
  - yes
daumview_id:
  - 37265266
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
ajaxAutoSave는 FCKeditor의 플러그인이다. 글을 쓰는 중간에 자동저장하는 플러그인이다. 

자세한 건 나중에 적겠다. 영어에 자신감을 갖고(;;) 다음 설명서를 열심히 해석해 보면 어떻게 하는지 금방 알 수 있을 것이다. 별 얘기 없다.

<a target="_blank" href="http://greenmap.sourceforge.net/fck_demo/about.html">FCKeditor ajaxAutoSave Plug-in 설명서</a>

수정해 줘야 할 게 있다. 필요한 정보는 자신의 DB인코딩이다.

ajaxAutoSave의 파일, saveAdapter.php를 열고 한 줄을 추가해 준다. 아래 강조표시한 줄이다.

<pre title="code" class="brush: php;first-line: 9; highlight: [10]; ">// trigger the appropriate command
	$_REQUEST[&#039;content&#039;] = rawurldecode($_REQUEST[&#039;content&#039;]);
	switch ($_REQUEST[&#039;action&#039;])
	{
		case &#039;save&#039; 	: saveAdapter::saveToDatabase($_REQUEST[&#039;content&#039;]) ; 
		case &#039;draft&#039;	: saveAdapter::saveToDatabase($_REQUEST[&#039;content&#039;], true);
	}</pre>

그다음, saveAdapter.class를 연다. 여기서는 70번째 줄에 다음을 추가해 준다.

<pre title="code" class="brush: php;first-line: 52; highlight: [70]; ">// Connect to database
		function dbConnect($host, $username, $password, $database)
		{
			global $dbStatus;

			if($dbStatus[&#039;Connected&#039;])
			{
				return true;
			}

			if (!mysql_connect($host, $username, $password))
			{
				return &#039;Connect: &#039; . mysql_error();
			}
			if (!mysql_select_db($database))
			{
				return &#039;DB_SELECT: &#039; . mysql_error();
			}
			@mysql_query("set names UTF8");
			return $dbStatus[&#039;Connected&#039;] = true;
		}</pre>

나는 DB의 인코딩이 UTF8이기 때문에 저렇게 했는데, 만약 EUCKR을 쓰면 EUCKR이라고 써주면 될 터.

자세한 설명은 다음 포스팅에서 하기로 한다.