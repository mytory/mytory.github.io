---
title: '[ckeditor] jQuery 아답터(adaptor) 함수들'
author: 안형우
layout: post
permalink: /archives/552
aktt_notify_twitter:
  - yes
daumview_id:
  - 36961209
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
ckeditor는 기본으로 jQuery 아답터를 갖고 있다. 심지어 <a href="http://www.w3schools.com/jquery/default.asp" target="_blank">W3C schools에도 jQuery가 기본 설명</a>으로 들어갈 정도니, jQuery의 위상은 정말 높은 것 같다. 당연히 기본적인 사용법을 보렴면 <a href="http://docs.cksource.com/CKEditor_3.x/Developers_Guide/jQuery_Adapter" target="_blank">documentation</a>을 봐야 한다.

대충 요약한다.

일단 jQuery 아답터를 사용하렴면 아래처럼 코드를 서야 한다. 2번째 줄이 추가로 필요한 줄이다.

<pre class="brush:html">&lt;script type="text/javascript" src="/ckeditor/ckeditor.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="/ckeditor/adapters/jquery.js"&gt;&lt;/script&gt;
</pre>

아래 함수를 사용하면 div든 뭐든 죄다 ckeditor로 만들 수 있다. 단, form 내의 textarea가 아닌 경우에는 save 버튼이 비활성화되는 듯하다.

<pre class="brush:js">$( &#039;textarea.editor&#039; ).ckeditor();</pre>

jQuery 채인도 당연히 이용할 수 있다.

<pre class="brush:js">$( &#039;.section-x&#039; )
    .find( &#039;textarea.editor&#039; )
        .ckeditor()
    .end()
    .find( &#039;a&#039; )
        .addClass( &#039;mylink&#039; )
    .end();
</pre>

콜백 함수도 사용할 수 있고, <a href="http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html" target="_blank">설정</a>도 사용할 수 있다.

<pre class="brush:js">$(&#039;.jquery_ckeditor&#039;)
    .ckeditor( function() { /* callback code */ }, { skin : &#039;office2003&#039; } );
    .ckeditor( callback2 );
</pre>

위 함수를 실행하면 ckeditor를 두 개 만드는 게 아니라 콜백 함수를 두 개 추가하는 게 된다고 설명하는 듯하다. 번역에 자신없으니 원문 살펴보기 바란다.

아래처럼 스면 editor의 인스턴스를 얻을 수 있다.

<pre class="brush:js">var editor = $(&#039;.jquery_ckeditor&#039;).ckeditorGet();
alert( editor.checkDirty() );
</pre>

위에서 alert( editor.checkDirty() ); 부분은 인스턴스가 제대로 불려왔는지 확인하는 부분이지 인스턴스를 얻기 위해 필수는 부분이 아니다. checkDirty()는 에디터 내용이 초기 내용인지 편집을 했는지 확인하는 거다. 자동저장 같은 걸 할 때 사용하면 되는 함수다.

위에 들어가는 $(&#8216;.jquery\_ckeditor&#8217;)는 처음에 $(&#8216;.jquery\_ckeditor&#8217;).ckeditor() 함수를 사용했던 그 놈이다.

당연히 내부 데이터를 가져올 수 있는 함수를 제공한다면서 아래 코드를 써 놨다. 그런데 내가 사용했을 때는 작동하지 않았다.

<pre class="brush:js">// Get the editor data.
var data = $( &#039;textarea.editor&#039; ).val();
// Set the editor data.
$( &#039;textarea.editor&#039; ).val( &#039;my new content&#039; );
</pre>

이 함수는 CKEDITOR.config.jqueryOverrideVal을 false로 설정하면 작동하지 않는다고 한다. 나도 한 번 체크해 봐야겠다.

그래서 나는 그냥 고전적인 방법을 사용해서 내용을 얻었다.

<pre class="brush:js">alert(editor.getData());
editor.setData(&#039;ddd&#039;);
</pre>

기본적으로 에디터 내의 내용을 모두 수정한 다음에 editor.destroy() 를 실행하면 변한 내용이 그대로 내용에 가서 달라붙게 된다. 물론 내용을 db에 넣든, file로 쓰든 그건 알아서 처리를 해야 할 것이다.