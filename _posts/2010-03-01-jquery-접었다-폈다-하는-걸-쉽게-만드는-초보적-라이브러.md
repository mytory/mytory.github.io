---
title: '[jQuery] 접었다 폈다 하는 걸 쉽게 만드는 초보적 라이브러리'
author: 안형우
layout: post
permalink: /archives/337
aktt_notify_twitter:
  - yes
daumview_id:
  - 37051094
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
음.. 어차피 텍스트큐브나 티스토리 같은 블로그에서는 접었다폈다하는 걸 기본으로 제공해 준다. 아래 예시를 보면 뭔지 알 거다.

[#M\_펼쳐두기..|접어두기..|접었다폈다\_M#] 
그런데 보통 사이트에서 만들 때는 귀찮다.

그리고 한 가지 걱정이 생길 것이다. 접었다 폈다 하는 js를 만들어뒀는데 나중에 사이트 이전할 때나 담당자가 바뀌었을 때 등, 여튼간에 어떤 경우에 js가 파괴(?)되거나 사라지거나 망가지면 어떻게 할 것인가. 그럴 때 별 모양 변경 없이 내용이 잘 살아있도록 해야 할 것이다.

당연히 자바스크립트를 끄고 들어온 사람들에게도 내용이 잘 보여야 할 것이다.

이런 점을 고려해서 접었다폈다 하는 스크립트를 만들었다.

<a href="/uploads/legacy/old-images/1/cfile25.uf.1346774A4D4BC89C24D1A9.rar" class="aligncenter" />cfile25.uf.1346774A4D4BC89C24D1A9.rar</a>

## 초보적인 스크립트다.

그런데 초보적이다. 왜냐? method로 만들지 않고, 그냥 script src= 으로 연결하게 만들었기 때문이다. 연결해 두기만 하면 알아서 고쳐져 버린다.;; 이거 별로 좋지 않은 것 같은데&#8230; 원하는 알아서 고쳐 사용하기 바란다.

다음으로, 성능이 최적화돼있지는 않다. 불필요하게 변수를 많이 사용하는 것 같다. 급히 만드느라 그랬다. 이것도 개선할 수 있는 분은 개선해서 사용하시면 될 듯하다.

## 사용법

일단 아래 코드로 js파일을 읽어들인다. head 사이에 넣어야 한다는 사실을 잊지 마라. 참, 그리고 내가 첨부한 js파일을 읽어들이기 전에 <a href="http://jquery.com/" target="_blank">jQuery</a>를 읽어들여야 한다는 것도 잊지 말기 바란다.

<pre class="brush:html">&lt;script type="text/javascript" src="jquery.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="mytory.folding.js"&gt;&lt;/script&gt;</pre>

그리고 접히길 원하는 곳에 아래처럼 클래스명과 타이틀을 지정해 준다.

<pre class="brush:html">&lt;div class="folder" title="이거"&gt;접었다폈다&lt;/div&gt;</pre>

그러면 자바스크립트가 알아서 접었다폈다 하는 구조를 아래 그림처럼 만들어 준다.

<img src="/uploads/legacy/old-images/1/cfile22.uf.152CF4484D4BC89C21D6EB.png" class="aligncenter" width="540" height="167" alt="" />

실제 적용된 것은 <a href="http://www.left21.com/article/7726" target="_blank">여기</a>에서 볼 수 있다.

참, 전체 소스 코드는 아래와 같다.

<pre class="brush:js">$(function(){
	/**
	 * class="folder"를 접었다 폈다 하게 만든다.
	 * title="이 글"로 달면 버튼에 반영된다. ex) 이 글 열기, 이 글 닫기
	*/
	$(&#039;.folder&#039;).each(function(){
		var openFolderTitle = &#039;&#039;;
		var closeFolderTitle = &#039;&#039;;
		var folderTitle = $(this).attr(&#039;title&#039;);
		openFolderTitle = folderTitle + &#039; 열기&#039;;
		closeFolderTitle = folderTitle + &#039; 닫기&#039;;
		$.trim(openFolderTitle);
		$.trim(closeFolderTitle);
		$(this).wrap(&#039;&#039;).hide()
			.before(&#039;&lt;p style="text-align: center;"&gt;&lt;button class="toggleNext"&gt;&#039; + openFolderTitle + &#039;&lt;/button&gt;&lt;/p&gt;&#039;)
			.append(&#039;&lt;p style="text-align: right;"&gt;&lt;button class="closeParent"&gt;닫기&lt;/button&gt;&lt;/p&gt;&#039;);
	});

	$(&#039;.toggleNext&#039;).each(function(){
		$(this).click(function(){
			
			var openFolderTitle = &#039;&#039;;
			var closeFolderTitle = &#039;&#039;;
			var folderTitle = $(this).parent().next().attr(&#039;title&#039;);
			openFolderTitle = folderTitle + &#039; 열기&#039;;
			closeFolderTitle = folderTitle + &#039; 닫기&#039;;

			$(this).parent().next().slideToggle(&#039;slow&#039;);
			if(/열기/.test($(this).text())){
				$(this).text(closeFolderTitle);
			}else{
				$(this).text(openFolderTitle);
			}
		});
	});

	$(&#039;.closeParent&#039;).each(function(){
		$(this).click(function(){
			var folderTitle = $(this).parent().parent().attr(&#039;title&#039;);
			var openFolderTitle = folderTitle + &#039; 열기&#039;;
			$.trim(openFolderTitle);
			$(this).parent().parent().slideUp().prev().find(&#039;button&#039;).text(openFolderTitle);
		});
	});
});
</pre>

<div id="__KO_DIC_LAYER__" style="padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; position: fixed; z-index: 999999999; overflow-x: hidden; overflow-y: hidden; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(51, 51, 119); border-right-color: rgb(51, 51, 119); border-bottom-color: rgb(51, 51, 119); border-left-color: rgb(51, 51, 119); display: none; ">
</div>