---
title: '[크롬] 구글 I`m Feeling Lucky 기본검색으로 사용하기, 다양한 검색엔진 쉽게 활용하기'
author: 안형우
layout: post
permalink: /archives/495
aktt_notify_twitter:
  - yes
daumview_id:
  - 36977990
categories:
  - 기타
tags:
  - TIP
---
I\`m Feeling Lucky는, 키워드를 입력하면 즉각 해당 홈페이지로 보내 주는 서비스다.

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/google.png" alt="" width="625" height="255" />

위에 버튼이 보일 것이다.

이 기능을 사용하면 생각보다 편하다.

대부분은 가장 위에 있는 검색 결과가 사용자가 찾는 검색 결과이기 때문이다. 클릭 한 번을 줄일 수 있는 것이다. 검색결과를 클릭하면 새 창이 뜨는데 그럼 원래 검색 결과 창을 닫아야 한다. 이 때 생기는 클릭도 막을 수 있다.

게다가 구글 검색이 어떤 것이 가장 나은지 판단이 힘들다고 생각할 때는 그냥 검색 결과를 뿌려 준다. 쓸만하다.

자, 그럼 크롬에서 I\`m Feeling Lucky를 기본 검색엔진으로 만드는 방법.

일단 우측 상단의 도구![][1] 버튼을 눌러 설정으로 들어간다.

그리고 &#8220;검색&#8221; 항목의 &#8220;검색엔진 관리&#8230;&#8221;를 누른다. 찾기 복잡하면 우측 상단에 있는 검색창에 &#8220;검색엔진 관리&#8221;라고 쓴다. 그러면 &#8220;검색&#8221; 항목이 표시된다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/chrome-im-feeling-lucky-default-search-engine-1.png" alt="" />
</p>

&#8220;검색엔진 관리&#8230;&#8221;를 눌렀을 때 뜨는 창에서 맨 아래로 내려가서 빈 칸에 새 검색엔진을 추가한다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/chrome-im-feeling-lucky-default-search-engine-2.png" alt="" width="870" height="655" />
</p>

위 이미지에서 보이듯이 첫 칸엔 &#8216;Feeling Lucky&#8217; 같은 자신이 알아볼 수 있는 이름을 넣는다. 키워드는 짧고 기억하기 쉬운 것으로 넣는다. URL은 아래 문자열을 복사해 넣는다.

<pre class="brush:plain">http://www.google.co.kr/search?complete=1&hl=ko&q=%s&btnI=I&#039;m+Feeling+Lucky&lr=&aq=f&aqi=&aql=&oq=&gs_rfai=</pre>

근데 입력칸을 다 채우고 엔터를 치거나 하면, 방금 입력한 놈이 사라진다. 알파벳순으로 자기 위치를 찾아 간 것이니 놀라지 말자. (입력한 놈이 알아서 정렬되느라 사용자의 시야에서 사라지는 건 좋은 인터페이스가 아니라고 생각한다.)

이제 알파벳순으로 방금 입력한 놈을 찾아서 기본 검색엔진으로 만들면 완료다. 기본 검색엔진으로 만드는 방법은, 방금 만든 놈을 찾아가서 마우스를 올리면 &#8216;기본으로 설정&#8217;이라는 버튼이 뜬다. 그걸 누르면 된다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/chrome-im-feeling-lucky-default-search-engine-3.png" alt="" />
</p>

그러면 이렇게 기본 검색엔진이 된다.

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/chrome-im-feeling-lucky-default-search-engine-4.png" alt="" width="884" height="661" />

## 구글 크롬 검색엔진 설정의 키워드 사용법

근데 검색엔진의 키워드는 뭘까? 이것은 크롬이 사용자의 여러 검색엔진 사용을 쉽게 해 주기 위해 갖고 있는 기능이다.

아까 I\`m Feeling Lucky 검색의 키워드를 f로 지정했을 것이다. 한 번 주소 표시줄에 f라고 쓰고 스페이스바 (혹은 탭 키)를 눌러 보자. 그러면 아래처럼 &#8216;Feeling Lucky 검색&#8217;이라고 작동을 한다.

즉, 평소엔 구글 검색을 하고, Feeling Lucky 검색을 하고 싶을 때만 주소 표시줄에 f라고 쓴 후 스페이스바 (혹은 탭 키)를 누르고 검색을 하면 된다.

이를 응용하면 자주 가는 사이트의 검색, 네이버, 다음 검색 등을 손쉽게 할 수 있다.

Feeling Lucky를 기본 검색으로 하고 구글 검색 키워드를 g로 해서 필요할 땐 기본 검색을 사용하면 어떨까? 그러면 꽤 편리할 것 같은데.

 [1]: http://www.google.com/help/hc/images/chrome_toolsmenu.gif