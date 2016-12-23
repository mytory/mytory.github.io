---
title: '[PDT(PHP용 이클립스)] 이미 있는 프로젝트를 PHP 프로젝트로 만들기'
author: 안형우
layout: post
permalink: /archives/589
aktt_notify_twitter:
  - yes
daumview_id:
  - 36931153
categories:
  - 개발 툴
tags:
  - Eclipse
---
<span class="mw-headline">원문 제목은 이거다 : </span><a href="http://wiki.eclipse.org/IRC_FAQ#How_do_I_manually_assign_a_project_Nature_or_BuildCommand.3F" target="_blank"><span class="mw-headline">How do I manually assign a project Nature or BuildCommand?</span></a> (PDT의 FaQ에서 <a href="http://wiki.eclipse.org/PDT/FAQ#How_do_I_convert_an_existing_project_to_use_PDT.3F" target="_blank">How do I convert an existing project to use PDT?</a> 항목을 클릭하니까 이게 연결돼 있었다. 그러니까 맞을 거다;; 맞을 거야;; )

<span class="mw-headline">내가 제대로 읽었기를 바라면서&#8230;</span>

<span class="mw-headline">내용은 간단한데, .project 파일에 아래 코드를 넣으라는 설명이다.</span>

<pre class="brush:xml">&lt;buildSpec&gt;
    &lt;buildCommand&gt;
        &lt;name&gt;org.eclipse.php.core.PhpIncrementalProjectBuilder&lt;/name&gt;
        &lt;arguments&gt;&lt;/arguments&gt;
    &lt;/buildCommand&gt;
    &lt;buildCommand&gt;
        &lt;name&gt;org.eclipse.wst.validation.validationbuilder&lt;/name&gt;
        &lt;arguments&gt;&lt;/arguments&gt;
    &lt;/buildCommand&gt;
&lt;/buildSpec&gt;
&lt;natures&gt;
    &lt;nature&gt;org.eclipse.php.core.PHPNature&lt;/nature&gt;
&lt;/natures&gt;</pre>

충돌이 날 수도 있으니까 다른 nature는 끄는 게 좋을 거라고 한다. 그리고 엥간하면 이클립스 다시 시작하란다. 프로젝트를 닫았다가(close project 항목이 있다) 열거나 말이다.

지금 이클립스를 실행할 수 없어서 내일 테스트해볼 생각이다.

&#8212;&#8212;&#8212;&#8212;&#8211;

설명대로 해 봤다. 정확히 말하면 위 것을 복사해서 덮어 씌우면 안 되고, buildSpec 항목과 natures 항목을 위 내용으로 채우라는 말이었다. 그리고, 성공! PHP 프로젝트로 만들려고 골머리 싸고 지웠다가 다시 넣고 별 짓을 다 했는데 편리하게 할 수 있게 됐다.