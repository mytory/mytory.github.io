---
title: '[번역] 모바일 퍼스트 반응형 웹 디자인 mobile-first responsive web design'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2400
aktt_notify_twitter:
  - yes
daumview_id:
  - 36610085
categories:
  - 웹 퍼블리싱
tags:
  - Web Design
---
원문은 <http://bradfrostweb.com/blog/web/mobile-first-responsive-web-design/> 이다.

[역주] 모바일 퍼스트는 그냥 모바일 퍼스트라고 쓰겠다.

![This is the web][1]

## 모바일-퍼스트 반응형 웹 디자인이란?

모바일-퍼스트 반응형 웹디자인은 철학과 전략의 결합이다. 그리고 궁극적으로는 어떤 기기로든 최고의 웹 경험을 할 수 있도록 하기 위한 것이다. 디지털 풍경은 점점 더 복잡해지고 있다. 우리는 온갖 디지털 디바이스 사이에서 경험을 디자인해야 한다. 재밌어 보인다. 그렇지 않나?

### 모바일 퍼스트

<img class="aligncenter" src="http://bradfrostweb.com/wp-content/uploads/2011/06/aea-cover-6.jpg" alt="Mobile First - Coming Soon" />

[모바일 퍼스트][2]는 <a href="http://www.lukew.com/" rel="external">Luke Wroblewski</a> 가 처음 만든 철학이다. 사용자 경험을 창조할 때 모바일일 경우를 최우선으로 초점을 맞춰서 디자인을 하자는 거다. 이렇게 시작된 거다.

1.  **더 많은 사람들**이 웹사이트에 도달하도록 하자. (세계 인구의 77%가 핸드폰을 갖고 있다. 2011년에 출시된 핸드폰의 85%에 브라우저가 있다.[인터넷 탐색 기능이 있다. - 역자])
2.  디자이너가 **핵심 내용과 기능에 초점을 맞추게** 강제한다. (화면 사이즈가 20%로 줄어 버렸을 때 어떻게 할 것인가?)
3.  디자이너들이 **새로운 기술을 활용하고**, 혁신을 할수 있도록 하자. (위치기반 서비스, 터치 이벤트 등등)

### 반응형 웹 디자인

<img class="aligncenter" src="http://bradfrostweb.com/wp-content/uploads/2011/06/rwd.jpg" alt="Responsive Web Design" />

[반응형 웹 디자인][3]은 <a href="http://ethanmarcotte.com/" rel="eternal">Ethan Marcotte</a> 이 만들어낸 용어다. 다양한 화면 해상도에 웹사이트의 레이아웃을 적응시키는 것을 명확하게 표현하기 위한 용어다. 반응형 웹디자인은 이런 식으로 만든다.

1.  **유동성있는 그리드** : 기기의 화면 사이즈에 따라 좁아졌다 넓어졌다 하는.
2.  **유연한 이미지와 미디어** : 어떤 해상도에서도 내용을 방해하지 않는.
3.  **미디어 쿼리** : 해상도별로 끊어서 디자인을 할 수 있도록 고안된.[0~320px까지는 이렇게 보이도록 하고, 321px~640px까지는 이렇게 보이도록 하고 등.]

### 점진적 개선

궁극적으로 모바일-퍼스트 반응형 웹디자인은 기본적으로 <a href="http://en.wikipedia.org/wiki/Progressive_enhancement" rel="external">점진적 개선(Progressive Enhancement)</a>이라는 웹의 전략과 디자인에 기반한 것이다. 점진적 개선이라는 방법을 사용하면, 강력한 토대 위에 개선용 층위를 영리하게 추가하는 식의 방법으로, 모두에게 접근성을 향상시킬 수 있다. (바라기로는 최적화된 경험도 제공할 수 있다.)

## 모바일-퍼스트 반응형 웹디자인이 작동하는 이유

역동적인 [디저털 - 역자] 풍경은 점점더 복잡해졌다. 열라 많은 모바일 기기(피쳐 폰, 스마트폰, 타블렛), 특화된 기기(이북 리더, 티브이, 인터넷 기기 등) 그리고 더 전통적인 디지털 기기(테스트톱, 랩톱, 넷북). 또한, 나는 곧 무슨 기기가 우리를 덮칠지 모르겠다. 그러면 질문이 명확해진다 : **이 모든 기기를 위해 다 디자인을 해야 돼?**

모바일-퍼스트 반응형 웹디자인은 이에 대한 훌륭한 해결책이다. 모바일로 시작해서 점차 개선해 가면서 모든 것을 구현하는 것이다. (심지어 초보적인 수준에서도 가능하다.) 인터넷에 접근 가능한 기기라면 어떤 기기라도 웹사이트에 와서 기능적인 경험을 할 수 있게 될 것이다. 그러면, 특징을 알아차리고, 조건부 스크립트를 로딩하고, 미디어 쿼리와 다른 테크닉을 적용해서 기기에 따른 최적화된 경험을 제공하는 것이다.

이건, 옆집 아줌마가 4년 전 크리스마스에 받은 구닥다리 웹 기기에서도 사이트가 (어느 정도는) 작동할 것이라는 것을 의미한다.

## 어디에 적용하는가

모바일-퍼스트 반응형 웹디자인은 사이트 기반을 전면 재수정을 요구한다. 그리고 더 중요하게는, 관점에 대한 전면 재수정을 요구한다. **이건 빨리 되는 게 아니다.** 이것은 조심스런 계획, 시간, 그리고 견고한 실행을 요구한다. [이것은 어렵다.][4] 이런 이야기를 들으면 주눅이 들지도 모른다. 하지만 얻을 수 있는 것은 아주 크다. 새로운 기기가 등장해 주목을 받을 때마다 웹사이트를 완전히 새로 만드는 작업을 반복하는 대신에, 새로운 기기에 맞춰서 사용자 경험을 최적화하는 일만 하면 된다. 시간을 절약하고 바퀴를 새로 만드는 헛수고를 방지할 수 있는 것이다.

## 모바일-퍼스트 반응형 웹디자인을 하는 방법

이쯤 되면, 몽상처럼 들릴지도 모른다. 이 원칙들이 정말로 웹표준에서 광범위한 규칙(application)이며, 최고의 방법이라는 것을 믿어도 좋다. 이것은 우리가 오늘 당장 모바일-퍼스트 반응형 웹디자인을 시작해도 된다는 걸 의미한다. 그럼 어디에서 시작하면 될까?

### 콘텐츠를 구조화하는 데서 출발하자

**콘텐츠.** 아다시피, 이걸로 lorem ipsum이나 플레이스홀더 이미지를 바꿔 넣는다. 그렇게 할 때, 콘텐츠는 중요해진다. 이건 정말로 중요하다. 이것이 의미하는 바는, 강력하고, 다양한 곳에 사용할 수 있으며, 목적이 확실한 콘텐츠가 가장 중요하다는 것이다. [어떤 인터페이스도 없는, 사이트의 콘텐츠를 생각해 보라.][5] 누군가가 그 콘텐츠에 신경을 써야 한다면, 왜 그래야 하는지를 스스로에게 질문해 보라. 만약, 여기에 자신있게 대답할 수 없다면, 어떤 디자인이건, 어떤 적용방법이든간에 당신을 도와줄 수 없다. (If you can’t confidently answer that question, I’m afraid no design, no matter how adaptive, can help you.)

[콘텐츠를 우선 구조화][6]해서 콘텐츠의 초점과 계층을 만든다. 이것은 우리의 메시지를 구조화하는 것, 이야기를 전달하는 방법에 관한 것이다. 콘텐츠가 어떤 환경에서 전달되든간에, 의미있게 전달될 수 있도록 하는 것이다. **이것은 콘텐츠를 어디에든 보낼 수 있도록 준비하는 것이다.** (It’s about constructing your message and telling your story in a way that’s meaningful to your users and is cohesive in whatever context they may be in. **It’s preparing your content to go anywhere.**)

토론을 독려하는 차원에서 말한다면: 네이티브 어플리케이션 vs 웹[네이티브 어플리케이션은 앱이나 프로그램, 즉 웹이 아닌 프로그램을 생각하면 된다. - 역자], 모바일 사이트 vs &#8220;하나의 웹&#8221;[하나의 웹을 만들고 기기에 따라 모양만 다르게 보여 주는 전략, 반응형 웹사이트도 이런 전략에서 사용하는 방법 중 하나다 - 역자], 기타 등등에서 모두가 동의하는 바는 강력한 콘텐츠 전략이 점점 더 중요해지고 있다는 점이다. 결국 가장 중요한 것은, 기기는 나왔다가 사라지고, 기술적 트렌드 역시 흥망성쇠를 거듭하겠지만, 콘텐츠와 비즈니스 목표와, 사용자의 목적은 남을 것이라는 점이다. 나이키는 늘 사람들이 신발을 사게 하려고 노력한다. (심지어 우리가 홀로그램과 상호작용하게 되는 미래에도 마찬가지일 거다.) 따라서, 콘텐츠를 보여주는 최고의 방법이 뭔지를 두고 두 진영이 논쟁을 벌이는 동안, 목적이 분명하고 다양한 곳에 사용할 수 있는 콘텐츠가 추구할 만한 가치가 있는 유일한 것이라는 점은 최소한 우리가 동의할 수 있는 점이다.

### 모바일로 시작하기

<div id="attachment_1592">
  <p>
    <img class="aligncenter" title="unfrozen_caveman_lawyer" src="/uploads/legacy/mobile-first/unfrozen_caveman_lawyer.jpg" alt="unfrozen caveman lawyer" width="259" height="194" />이 친구를 보자. 이 사람은 형편없는 폰을 사용하고 있다. 그런데 우리 콘텐츠를 보고 싶어 한다. 그렇게 해 줄 수 있을까?
  </p>
  
  <p>
    일단 콘텐츠가 구조화되면, 콘텐츠를 제공할 첫 환경은 모바일 웹이다. 왜 데스크탑이 아니라 모바일에서 시작할까? 모바일 웹은 다른 환경에 비해 제한이 아주 많고, 절충적이고, 불안정하다. 모바일 환경은 안개 속을 걷는 듯하다고 할 수 있다. 사용자는 걷고 있을까 쇼파에 앉아 있을까? 사용자는 WiFi를 사용할까 EDGE[최대 256kb/s가 나오는 무선 통신 기술 - 역자]를 사용할까? 최악의 모바일 시나리오를 염두에 두고 우선 작업을 하면, 장애물이 많을 때조차 사용자들이 자신의 목표를 달성할 수 있을 것이라고 보장할 수 있을 거다. <strong>간단히 말해, 만약 우리가 모바일 웹을 지원할 수 있다면, 무엇이든 지원할 수 있게 될 거라는 거다.</strong>
  </p>
</div>

<img title="progressive_enhancement" src="/uploads/legacy/mobile-first/progressive_enhancement.jpg" alt="progressive enhancement" width="650" height="424" />

모바일 환경에 맞춰 제작한 뒤 데스크탑에 맞게 점진적으로 향상시켜 나가는 것과 데스크탑 환경에 맞춰 제작한 뒤 모바일 환경에 맞게 점진적으로 줄여 나가는 것을 비교해 보자. 전자의 경우 인터넷 연결 속도와 화면 사이즈가 커져도 메시지, 콘텐츠 그리고 기능이 손상되지 않고 그대로 남는다. 하지만 점진적으로 줄여 나간다면, 모바일 환경까지 갔을 때는 핵심 메시지와 기능이 손상을 입을 위험이 커진다.

참고: 모바일 웹을 완전히 디자인하는 것은 힘들기 때문에 여기서는 조금 단순화했다. 그건 진짜 힘들다. [유능한 사람들][7]조차 모바일 웹의 문제들 때문에 계속 고생할 것이다. 그래서 결론은 [&#8220;이거 힘들다&#8221;][4]는 것이다. 그러나, 모바일은 확장중이고, 그 결과 모바일 경험도 계속 나아지고 있다. 절망하지 마라!

### 환경에 최적화하기

이제 모바일 사이트가 마련됐고, 반응형의 기반이 마련됐다. 이제 사이트의 레이아웃과 기능, 그리고 (어쩌면 심지어) 내용을 [데스크탑 쪽을 향해 - 역자] 점진적으로 향상시킬 때다. 이걸 도와 줄 수 있는 테크닉과 툴은 엄청나게 많다. (예를 들면 [responsive images][8], [Sencha.io Src][9] 등으로 이미지를 동적으로 교체할 수 있다.) 그러나 다시 말하자면, 이것이 정말로 단지 점진적 향상이기 때문에, 최고의 방법은 전문가를 따르는 것이다. (but again because this is really just progressive enhancement at it’s finest I’ll defer to the experts.)

[<img class="alignleft" title="dwpe-bookcover" src="/uploads/legacy/mobile-first/dwpe-bookcover.jpg" alt="Designing with Progressive Enhancement" width="150" height="192" />][10][<img class="alignleft" title="adaptive-web-design" src="/uploads/legacy/mobile-first/adaptive-web-design.jpg" alt="adaptive-web-design" width="150" height="232" />][11]

Aaron Gustafson이 쓴 *[Adaptive Web Design][11]*은 점진적 향상에 대해 정말 최고의 방법, 예시, 테크닉을 알려 준다. Filament Group의 *<a href="http://filamentgroup.com/dwpe/" rel="external">Designing with Progressive Enhancement</a>*은 점진적 향상의 아름다운 세계로 우리를 깊이 끌고 간다. 이 책에서 토론되는 주제들은 웹의 미래에 관한 것이다. 즉, 유저의 환경이 미래의 물결이라는 점에 초점을 맞춘 것이다.

### 지원 vs 최적화(support vs. optimize)

**지원**과 **최적화**의 차이를 감지하는 것은 중요하다. 웹에 접속할 수 있는 지구상에 존재하는 모든 기기에 최적화하는 것은 불가능하다. 그래서 결국 우리는 어떤 기기와 브라우저에 맞춰 최적화 할지 전략(비즈니스라고 읽는다)을 결정해야 한다. 사이트 분석 툴을 통해 방문자를 좀더 잘 이해할 수 있다. 하지만 사이트 분석 툴에는 오차가 있다. (사이트 분석 툴은 자바스크립트 의존적이다. 또한 분석 툴이 다 로딩될 때까지 기다리지 않는 사람들을 추적할 수 없다. 등등) 따라서 우리는 방문자들에게 무엇이 최고의 최적화인지 엄밀한 연구를 해야 한다.

모순적인 경험들이 엄청 많을 거다. 이 길을 가면서 또한 우리는 진짜 이상한 브라우저의 반응과 버그들에 부딪힐 거다. 하지만 궁극적으로, 잘 구조화된 콘텐츠는 존재하는 최악의 브라우저조차 이해하기 쉬울 거다.

### 환경에 관한 몇 마디(a quick note about context)

반응형 웹 디자인에 관해 모바일 전문가들이 내놓는 제기가 그렇게 많은 이유는, 얄팍한 디자이너들이 이미 있는 사이트를 간단히 모바일에 맞춰 끌어내린 다음, 그것은 &#8220;모바일 최적화&#8221;라고 선언하기 때문이다. 모바일 환경은 스크린 사이즈 이상을 의미한다. 모바일-퍼스트 반응형 웹디자인은 최고로 어려운 환경에 최적화한다는 것을 의미한다. 좋은 환경에 놓인 사용자를 가정하지 않음으로써(사용자들 인터넷 속도는 당연히 빠를 거야! 사용자들은 당연히 AJAX가 지원되는 환경일 거야!), 사용자들이 졸라 쉽게 목적을 성취하도록 할 수 있다. 어떤 스크린 사이즈와 기기 성능이든 이용할 수 있도록 하는 것은 어디서든 통하는 더 나은 사용자 경험을 만들어낼 수 있다. 모두가 이기는 거다. (Win win win.)

또한, &#8220;환경(context)&#8221;이라는 것은 본질적으로 모호하다. 모바일 환경이라는 것은 예전에 비해 점점 더 넓어져서 더 많은 사람들이 자신의 모바일 폰에서 온전한 경험을 할 수 있기를 기대한다. 정말로 m.site.com, tablet.site.com, tv.site.com 따위가 계속되기를 바라야 할까? 물론, 각각의 경험들이 많이 있을 것이다. 하지만 고기와 감자에 관한 콘텐츠를 위해 그렇게 반복작업을 계속 해야 할까?

## 무한&#8230; 그리고 넘어서기!(to infinity…and beyond!)

바로 지금 던질 질문은, [&#8220;모바일 퍼스트 반응형 웹 디자인이 어디에 와 있는가?&#8221;][12] 이다. 제대로 구현된 반응형 웹사이트는 극소수다. [(최고로 잘 된 곳 중 하나는 이거다.)][13] 그리고 모바일 웹이 (많은 사람들의 마음에) 초창기 기술로서 (아직) 관심을 기울일 필요가 없다고 여겨진다는 사실로 인해 갈 길이 멀다. 데스크톱 웹은 더 성숙해 있고, 따라서 자연히 모든 사람들은 이미 존재하는 데스크탑 웹사이트를 작은 화면에 구겨 넣어서 보고 있다. 이런 추세에 거스르려 하는 우리에게 [미래가 - 역자] 달려 있다. 숫자는 거짓말을 하지 않는다. 그리고 그 숫자들은 모두 모바일, 타블렛, 그리고 또다른 신기술을 가리키고 있다.

모바일-퍼스트 관점에 적응하고, 점진적 향상의 방법으로 웹사이트를 만들기 시작하는 것은 빠를 수록 좋다. 우리 앞에 놓은 어떤 디지털 풍경에 대해서도 대응할 수 있도록 미리 준비하는 것은 빠를수록 좋다.

-[@brad_frost][14]

 [1]: http://bradfrostweb.com/wp-content/uploads/2011/06/real_web.jpg
 [2]: http://www.lukew.com/presos/preso.asp?26
 [3]: http://www.alistapart.com/articles/responsive-web-design/
 [4]: http://www.slideshare.net/yiibu/muddling-through-the-mobile-web
 [5]: http://bagcheck.com/blog/8-bagchecking-in-the-command-line
 [6]: http://www.slideshare.net/stephenhay/structured-content-first
 [7]: http://www.cloudfour.com/
 [8]: http://filamentgroup.com/examples/responsive-images/
 [9]: http://www.sencha.com/products/io/
 [10]: http://www.filamentgroup.com/dwpe/
 [11]: http://easy-readers.net/
 [12]: http://www.cloudfour.com/where-are-the-mobile-first-responsive-web-designs/
 [13]: http://yiibu.com/
 [14]: http://twitter.com/brad_frost