---
title: '[jQuery] ajaxForm 플러그인과 validation 플러그인 동시에 사용하기'
author: 안형우
layout: post
permalink: /archives/2292
aktt_notify_twitter:
  - yes
daumview_id:
  - 36622970
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
요약 : ajaxForm 플러그인 `beforeSubmit` 옵션에 `function(){ return $('.myForm').valid(); }` 를 넣어 주면 된다.

나는 폼 관련 처리를 할 때 가장 많이 사용하게 되는 게 [jQuery ajaxForm 플러그인][1]과 [validation 플러그인][2]인 것 같다.

그런데 이 둘을 동시에 사용하게 되면 validate 플러그인이 작동을 하지 않는다.

이 때 해결책은 간단하다. [ajaxForm 문서][3]를 살펴 보면 beforeSubmit이라는 옵션이 있는 것을 볼 수 있다. 서브밋하기 직전에 수동으로 validate를 작동하면 된다.

<pre class="brush: javascript; gutter: true; first-line: 1">$(&#039;.myForm&#039;).ajaxForm({
  beforeSubmit: function(){
    return $(&#039;.myForm&#039;).valid();
  },
  success: thisIsSuccess
});</pre>

<p class="brush: javascript; gutter: true; first-line: 1">
  이렇게 문서를 잘 보면 문제를 잘 해결할 수 있다.
</p>

 [1]: http://mytory.net/archives/223 "jQuery ajaxForm plugin을 사용해 보자"
 [2]: http://mytory.net/archives/195 "jQuery Form Validation Plugin 폼 검증 플러그인 간단 사용법"
 [3]: http://jquery.malsup.com/form/#options-object