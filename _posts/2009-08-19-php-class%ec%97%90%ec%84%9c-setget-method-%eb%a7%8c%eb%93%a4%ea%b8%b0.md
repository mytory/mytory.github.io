---
title: PHP class에서 set/get method 만들기
author: 안형우
layout: post
permalink: /archives/19
aktt_notify_twitter:
  - yes
daumview_id:
  - 37267916
categories:
  - 서버단
tags:
  - PHP
---
java에서 set/get 메서드를 만들어본 사람들이라면, php에서도 같은 것을 찾을 것이다.(아마도)

책 보면 나와있지만, 항상 사용하는 아이는 아닌데, 꼭 필요한 경우가 생기는 이 아이들을, php로 class를 만드는 걸 이제 막 시작한 나 같은 사람은 자꾸 까먹게 된다.

그래서 여기 적어 놓는다. 아래 소스를 그냥 긁으면 된다.

<pre class="brush: php;" title="code">public function __get($name){
        return $this-&gt;$name;
    }

    public function __set($name, $value){
        $this-&gt;$name=$value;
    }</pre>

어때요? 참 쉽죠? ㅋ