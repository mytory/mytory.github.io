---
title: '[prototype] Ajax.Autocompleter API'
author: 안형우
layout: post
permalink: /archives/326
aktt_notify_twitter:
  - yes
daumview_id:
  - 37055999
categories:
  - 웹 퍼블리싱
tags:
  - javascript
---
프로토타입과 스크립타큘러스는 공부하지 않기로 했고, jQuery에도 이 글을 쓰고 얼마 안 있어 [jQuery UI의 AutoComplete][1]가 등장했다.

한글도 잘 작동한다. 이미 실제로 적용해 봤다.

그러니 jQuery UI를 사용하기를 권한다.

&#8212;&#8212;&#8212;- 이하 원래 내용 &#8212;&#8212;&#8212;&#8211;

프로토타입도 기회 되면 공부할 생각이다. 프로토타입의 스크립타큘러스에 있는 <a href="http://wiki.github.com/madrobby/scriptaculous/ajax-autocompleter" target="_blank">Ajax.Autocompleter의 DOC</a>다.

궁금했던 기능을 설명하고 있는 글을 찾았다. 일단 링크하고 : <a href="http://trend21c.tistory.com/360" target="_blank">http://trend21c.tistory.com/360</a>

필요한 부분을 긁었다. 책제목만 자동완성으로 검색하면 책 관련 가격 정보 등이 자동으로 따라 들어오게 하고 싶을 때 사용하는 방법이라는데, 정확하게 어떻게 사용하는지는 알려주지 않고 있으나 단서를 주고 있다.

자동검색되는 내용중에서 검색어로는 넣고 싶지 않지만 추가하고 싶은 텍스트가 있는 경우도 있습니다.

예를 들면 책 제목과 가격, 출판사, 저자를 한꺼번에 나타내고 싶긴한데

검색어로는 제목만 입력되게 하고 싶을때!!!!

바로 이런 경우를 위해 scriptaculous는 다음과 같은 방법을 사용하면 됩니다.

<pre class="brush:html">&lt;li&gt; 책제목 &lt;span class="informal"&gt;검색에는나타나지않는기타정보&lt;/span&gt;&lt;/li&gt;</pre>

이렇게 마크업을 하게 되면(informal 클래스명을 사용) informal 클래스 안에 있는 텍스트는 자동완성 키워드가 완성될때 포함되지 않습니다.

 [1]: http://jqueryui.com/demos/autocomplete/