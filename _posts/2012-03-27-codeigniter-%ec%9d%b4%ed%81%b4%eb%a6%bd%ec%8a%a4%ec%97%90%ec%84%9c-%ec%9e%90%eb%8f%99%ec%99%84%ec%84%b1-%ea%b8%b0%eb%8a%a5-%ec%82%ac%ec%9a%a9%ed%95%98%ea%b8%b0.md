---
title: '[CodeIgniter] 이클립스로 코드이그니터 사용할 때 자동완성 기능 되게 하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2379
aktt_notify_twitter:
  - yes
daumview_id:
  - 36613954
categories:
  - 개발 툴
tags:
  - Eclipse
---
일단 기본적으로는 이 페이지를 참고하면 된다.

[▶Autocomplete Eclipse Codeigniter 2][1]

주욱 보면서 이해하고 싶은 사람은 [동영상][2]을 봐도 된다. HD 화면으로 봐야 잘 보인다. 내 글 맨 아래 첨부해 놓기도 했으니 이 화면에서 바로 볼 수도 있다.

## 자동완성 기능용 프로젝트를 하나 만든다

이 팁은 자동완성만을 위해 프로젝트를 하나 만드는 방식의 팁이다. 이클립스가 함수를 참조할 수만 있게 한다. (만약 이 팁을 실제 사용하는 프로그램에 넣게 되면 웹사이트가 작동을 안 하게 될 거다.)

일단 CI_CodeBase 따위로 이름을 짓고 프로젝트를 하나 만든다. 그리고 거기 코드이그니터 소스코드를 다 집어 넣는다.

<p style="text-align: center;">
  <img class="aligncenter" src="http://dl.dropbox.com/u/15546257/blog/mytory/codeigniter-eclipse-autocomplete-1.png" alt="" width="237" height="249" />
</p>

이렇게 넣으면 된다. 위에서 .settings 는 이클립스가 만든 거니 신경쓰지 마시고. (평소엔 감춰져 있는데 난 보이게 설정했을 뿐이다.)

이제 아래 코드를 CI_CodeBase 프로젝트의 `system/core/Controller.php` 와 `system/core/Model.php` 의 class 안에 넣는다. (함수 안이나 이런 데 넣지 말고 그냥 클래스 안에 넣으면 된다.)

<pre class="brush: php; gutter: true; first-line: 1">//Put the codes below in system/core/Controller.php, Model.php
// for Eclipse auto completion
/**
* @var CI_Benchmark
*/
var $benchmark;
/**
* @var CI_Calendar
*/
var $calendar;
/**
* @var CI_Cart
*/
var $cart;
/**
* @var CI_Config
*/
var $config;
/**
* @var CI_DB_active_record
*/
var $db;
/**
* @var CI_Email
*/
var $email;
/**
* @var CI_Encrypt
*/
var $encrypt;
/**
* @var CI_Form_validation
*/
var $form_validation;
/**
* @var CI_Ftp
*/
var $ftp;
/**
* @var CI_Image_lib
*/
var $image_lib;
/**
* @var CI_Input
*/
var $input;
/**
* @var CI_Javascript
*/
var $javascript;
/**
* @var CI_Lang
*/
var $lang;
/**
* @var CI_Loader
*/
var $load;
/**
* @var CI_Log
*/
var $log;
/**
* @var CI_Output
*/
var $output;
/**
* @var CI_Pagination
*/
var $pagination;
/**
* @var CI_Parser
*/
var $parser;
/**
* @var CI_Security
*/
var $security;
/**
* @var CI_Session
*/
var $session;
/**
* @var CI_Sha1
*/
var $sha1;
/**
* @var CI_Table
*/
var $table;
/**
* @var CI_Trackback
*/
var $trackback;
/**
* @var CI_Typography
*/
var $typography;
/**
* @var CI_URI
*/
var $uri;
/**
* @var CI_Unit_test
*/
var $unit;
/**
* @var CI_Upload
*/
var $upload;
/**
* @var CI_User_agent
*/
var $agent;
/**
* @var CI_Utf8
*/
var $utf8;
/**
* @var CI_Xmlrpc
*/
var $xmlrpc;
/**
* @var CI_Xmlrpcs
*/
var $xmlrpcs;
/**
* @var CI_Zip
*/
var $zip;</pre>

이제 실제 프로젝트로 간다. 실제 프로젝트에서 마우스 우클릭을 하고 **Include Path > Configure Include Path&#8230;** 를 누른다. (아래 그림 참고)

![][3]

나오는 창에서 Projects 탭을 고른 후, Add 버튼을 누른다. 여기서 CI_CodeBase 프로젝트를 선택해 준 후 OK 버튼을 누른다. (아래 그림 참고)

<img class="aligncenter" src="http://dl.dropbox.com/u/15546257/blog/mytory/codeigniter-eclipse-autocomplete-3.png" alt="" width="746" height="554" />

그러면 이제부터 자동완성 기능이 작동하기 시작한다.

## 원리를 추측해 봤다

원리를 추측해 봤다. 아마도 이클립스가 이해할 수 있는 방식으로 주석을 달아 클래스와 변수를 연결해 주는 방식이지 싶다.

코드이그니터의 모든 컨트롤러와 모델은 모두 CI\_Controller, CI\_Model을 상속받으므로, 이 안에 변수를 넣어 두면 인식을 하는 걸로 이해할 수 있겠다.

<pre>부모의 변수 → 변수가 가리키는 클래스(주석 참조) → 해당 클래스에서 함수 검색</pre>

이런 과정을 거치는 듯하다.

## 내가 만든 클래스의 함수 자동완성 기능 사용하기

그러나 위 설명대로 하면 내가 만든 클래스들까지 자동완성되지는 않는다. 코드이그니터의 기본 함수들만 자동완성 기능으로 쓸 수 있게 되는 것이다.

내가 만든 클래스도 위 방식과 같은 방식으로 지정을 해 주면 된다. CI\_CodeBase 에 있는 Model.php 와 Controller.php 를 열어서 같은 위치에 아래처럼 자신이 만든 클래스들을 추가해 준다. 굳이 CI\_CodeBase에 이 클래스들이 있지 않아도 잘 작동하더라. 이 코드 자체는 CI_CodeBase에 써 줘야 하지만 말이다.

<pre class="brush: php; gutter: true; first-line: 1">//custom start
/**
* @var Functions
*/
var $functions;
/**
* @var Stringtable
*/
var $stringtable;
//custom end</pre>

이렇게 하면 아래와 같이 자동완성 기능을 사용할 수 있다.

<img class="aligncenter" src="http://dl.dropbox.com/u/15546257/blog/mytory/codeigniter-eclipse-autocomplete.png" alt="" width="491" height="287" />

## 동영상 보고 따라하기

<div class="video-container">
  <div class="video-container__inner">
  </div>
</div>

 [1]: http://taggedzi.com/articles/display/autocomplete-eclipse-codeigniter-2
 [2]: http://youtu.be/MzvSA0hq3Ts?hd=1
 [3]: http://dl.dropbox.com/u/15546257/blog/mytory/codeigniter-eclipse-autocomplete-2.png