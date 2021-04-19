---
title: '웹표준 - W3C와 WHATWG, HTML5.2와 HTML5.3 그리고 HTML Living Standard는 무엇인가?'
layout: post
tags: 
    - HTML
    - 웹표준
description: 2021년 현재 WHATWG가 발표하는 Living Standard가 웹표준이다.
image: /uploads/2021/html53.png
---

W3C와 WHATWG[^pronounce]는 다른 조직이다.

W3C는 2021년 4월 20일 현재 437개 회원사를 가진 조직이다. 웹의 창시자인 팀 버너스 리가 1994년에 만들었다. (참고: [한글 위키피디아 W3C](https://ko.wikipedia.org/wiki/W3C) )

WHATWG은 W3C가 의사결정이 느리다는 이유로 애플, 모질라 재단[^firefox], 오페라 소프트웨어[^opera]가 모여서 2004년에 만든 그룹이다. 지금은 구글과 마이크로소프트까지 해서 5개사가 중심적이라고 한다. (참고: [영문 위키피디아 WHATWG](https://en.wikipedia.org/wiki/WHATWG))

웹의 역사에서 WHATWG의 주요 역할은 2007년에 HTML5 명세를 W3C에 제안해 이를 기반으로 HTML5가 만들어지게 한 것이다. 

이후 2011년까지 W3C와 WHATWG는 같은 편집자(이안 힉슨)가 운영하며 협력하는 관계였다.(출처: [W3C HTML5.2 역사][html52])

2012년에 서로 목표가 다르다는 점을 밝히면서 편집팀을 분리했다. 주요 브라우저 벤더들로 구성된 WHATWG는 새로운 기능을 구현하는 데 더 관심이 있었던 것이다. 이후 2019년까지는 각자 표준을 발표했다. 

그리고 2019년에 결국 [WHATWG가 이겼다.][win] W3C와 WHATWG이 [양해각서][mou]를 체결하고, WHATWG의 Living Standard를 HTML과 DOM 명세 표준으로 삼기로 했다. 그래서 현재 [w3.org/TR/html5](https://www.w3.org/TR/html5)에 접속하면 [WHATWG의 Living Standard 페이지](https://html.spec.whatwg.org/)로 이동한다.

HTML5.3은 개발이 중단됐다. 현재 [HTML5.3 페이지][html53]에 접속하면 아래와 같은 경고문이 떠있다.

> 🚩 이 문서는 종료됐고 더이상 기술적 작업에 사용되면 **안 됩니다.** 대신에 [HTML Living Standard](https://html.spec.whatwg.org/)를 보세요. 그리고 [whatwg/html 레포지토리](https://github.com/whatwg/html/issues)에 이슈를 보고하세요.

![](/uploads/2021/html53.png)

W3C의 마지막 HTML 표준(Recommendation)[^recommendation]은 2017년에 발표한 HTML5.2가 됐다.

[^pronounce]: Web Hypertext Application Technology Working Group. 왓위지, 왓위그, 왓더블유지 등으로 읽는다. [출처: whatwg FAQ](https://whatwg.org/faq)
[^firefox]: 파이어폭스 브라우저의 개발사다.
[^opera]: 오페라 브라우저의 개발사다.
[^recommendation]: 온전히 번역하면 권고안이겠지만, 이게 웹표준을 말하는 것이므로 이해를 돕기 위해 여기서는 표준이라고 번역했다. MDN HTML 요소 설명 문서의 하단 표에 나와 있는 W3C의 Recommendation이 W3C가 발표했던 표준이다.

[win]: https://www.zdnet.com/article/browser-vendors-win-war-with-w3c-over-html-and-dom-standards/
[html52]: https://www.w3.org/TR/html52/introduction.html#introduction-history
[html53]: https://www.w3.org/TR/html53/
[mou]: https://www.w3.org/2019/04/WHATWG-W3C-MOU.html