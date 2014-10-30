---
title: '[링크] 워드프레스 한글 태그 문제 해결 방법'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9917
daumview_id:
  - 43218131
categories:
  - 기타
tags:
  - 분류대기중
---
한글 태그 문제라고 제목이 달려 있지만, `/archive/category/카테고리-이름` 형식에도 적용되는 것이며, `.htaccess` rewrite rule이 적용되는 URL의 모든 한글에 해당하는 문제인 듯하다. 여튼간에 나는 카테고리에서도 같은 문제를 겪었기 때문에.

자세한 내용은 [워드프레스 한글 태그 문제 해결방법 원문][1]에 가서 보시라.

해결하는 코드는 아래와 같다. `.htaccess` 파일에 아래 코드를 추가한다. 서버에서 `mod_url`로 URL을 죄다 euc-kr로 바꿔 버리기 때문에 발생하는 문제다. 그런데 `?변수명=변수값` 형식으로 넘어온 것에는 영향을 안 주는 듯하다. 폴더 구조 같은 데만 영향을 주는 듯.

<pre>&lt;IfModule mod_url.c&gt;
    ServerEncoding UTF-8
    ClientEncoding EUC-KR
&lt;/IfModule&gt;</pre>

 [1]: http://mygony.com/archives/1681