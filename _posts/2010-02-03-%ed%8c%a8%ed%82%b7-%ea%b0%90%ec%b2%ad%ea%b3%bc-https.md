---
title: 패킷 감청과 https
author: 안형우
layout: post
permalink: /archives/249
aktt_notify_twitter:
  - yes
daumview_id:
  - 37113304
categories:
  - 기타
tags:
  - 생각해 보기
---
요즘 패킷 감청으로 난리군요. <한겨레>도 패킷감청에 대한 사설을 썼습니다.

<a href="http://www.hani.co.kr/arti/opinion/editorial/402442.html" target="_blank">[사설] 패킷감청, &#8216;절대 금지&#8217;가 옳다 : 사설 : 사설.칼럼 : 뉴스 : 한겨레</a>

패킷 감청을 우회할 수 있는 방법으로 <a href="http://toolz.tistory.com/127" target="_blank">tor를 사용하면 된다</a>는 글도 확인했습니다.(<a href="http://toolz.tistory.com/121" target="_blank">tor 사용법</a>)

그런데 한 가지 궁금한 게 있습니다. https는 정보 자체를 암호화해서 전송하게 되는데, 그걸 중간에 국정원이 가로챈들 정보를 열람할 수 있는 걸까요?

해외 메일을 사용해도 소용 없다면서 gmail을 언급하는 걸 봤는데요, gmail은 http와 https 모드 두 가지를 제공합니다. https 모드를 기본으로 해서 메일을 주고받으면 중간에 해커가 가로채도 어떤 내용인지 알 수가 없거든요. 패킷 감청을 해도 소용없다는 거죠.

제 생각이 맞는 건지 틀린 건지 아시는 분 없나요?

## 도아님의 답변

내가 즐겨 찾는 블로그인 &#8216;도아의 사람사는 세상&#8217;에서 <a href="http://offree.net/entry/Changing-to-Gmail#comment72866" target="_blank">도아님께 답을 얻었다.</a>

> https를 패킷 감청으로 잡아내지 못합니다. 그렇게 쉽게 잡히는 것이라면 외국의 모든 금융권은 매일 해킹되야 정상입니다.

역시 내 생각이 맞았다. https를 지원하는 gmail은 안전하다. 단, <a href="http://hummingbird.tistory.com/1741" target="_blank">환경설정에서 항상 https로 접속하도록 설정</a>했을 때 얘기다.