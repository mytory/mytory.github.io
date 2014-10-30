---
title: '[PHP] 배열을 간단히 출력해 보자. print_r'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/625
aktt_notify_twitter:
  - yes
daumview_id:
  - 36908940
categories:
  - 서버단
tags:
  - PHP
---
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<a href="http://php.net/manual/kr/function.print-r.php" target="_blank">http://php.net/manual/kr/function.print-r.php</a> <div>
  아래는 PHP 공식 홈페이지의 함수 설명이다. 사실 배열만 보여 주는 건 아닌데, 배열의 정보를 눈으로 볼 때 가장 도움이 되는 것 같다.
</div>

<div>
  <blockquote>
    <p>
      print_r()은 변수에 대한 정보를 사람이 읽을 수 있는 방법으로 표시합니다.
    </p>
    
    <p>
      print_r(), var_dump(), var_export()는 PHP 5에서 객체의 protected와 private 프로퍼티도 보여줍니다. 정적 클래스 멤버는 보여주지 않습니다.
    </p>
    
    <p>
      print_r()은 배열 포인터를 마지막으로 이동합니다. 처음으로 되돌리려면 reset()을 사용하십시오.
    </p>
  </blockquote>
  
  <p>
    이런 걸 잘 알면 도움이 많이 된다.
  </p>
</div>

<div>
  사용예는 아래와 같다. 위아래를 <pre>로 감싸줘야 한다.
</div>

<div>
  <blockquote>
    <p>
      <span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><pre></span>
    </p>
    
    <p>
      <span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 0, 187); "><?php<br />$a </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">= array (</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(221, 0, 0); ">&#8216;a&#8217; </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">=> </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(221, 0, 0); ">&#8216;apple&#8217;</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">, </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(221, 0, 0); ">&#8216;b&#8217; </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">=> </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(221, 0, 0); ">&#8216;banana&#8217;</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">, </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(221, 0, 0); ">&#8216;c&#8217; </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">=> array (</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(221, 0, 0); ">&#8216;x&#8217;</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">, </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(221, 0, 0); ">&#8216;y&#8217;</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">,</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(221, 0, 0); ">&#8216;z&#8217;</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">));<br /></span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 0, 187); ">print_r </span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">(</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 0, 187); ">$a</span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 119, 0); ">);<br /></span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "><span style="color: rgb(0, 0, 187); ">?><br /></span></span><span class="Apple-style-span" style="font-family: Consolas, 'Andale Mono WT', 'Andale Mono', 'Lucida Console', Monaco, 'Courier New', Courier, monospace; line-height: normal; font-size: 14px; border-collapse: collapse; "></pre></span>
    </p>
  </blockquote>
</div>

$\_SERVER나 $\_POST, $_GET 등 기본 환경변수의 내용을 보는 데 사용하면 유용하다.

(xmp 태그로 감쌀 수도 있다. 배열 안에 html이 들어있을 경우 사용하는 것도 나쁘지 않을 수 있다. pre는 html을 렌더링해서 보여 주기 때문이다. html 코드를 출력하려면 < 따위 특수문자로 써 줘야 한다. 그러나 <a href="http://mytory.textcube.com/entry/%EC%BD%94%EB%93%9C%EB%A5%BC-%EA%B7%B8%EB%8C%80%EB%A1%9C-%EC%B6%9C%EB%A0%A5%ED%95%B4-%EC%A3%BC%EB%8A%94-html-%ED%83%9C%EA%B7%B8-xmp" target="_blank">xmp 태그가 (아마도 보안 문제로) 향후 html5에서 지원이 중단될 것</a>이라는 점을 알아 두는 게 좋을 것이다. 만약 배열 안에 html이 들어있다면 그냥 소스보기를 하면 코드를 볼 수 있다.)