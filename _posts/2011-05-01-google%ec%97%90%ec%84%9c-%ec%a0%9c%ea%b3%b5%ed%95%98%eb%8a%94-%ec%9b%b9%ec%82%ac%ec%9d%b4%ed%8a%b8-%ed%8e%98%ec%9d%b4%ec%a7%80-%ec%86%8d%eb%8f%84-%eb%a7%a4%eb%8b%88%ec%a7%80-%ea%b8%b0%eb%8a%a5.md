---
title: Google에서 제공하는 웹사이트 페이지 속도 측정, 관리 기능
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1183
aktt_notify_twitter:
  - yes
daumview_id:
  - 36732625
categories:
  - 기타
tags:
  - 개발 방법론
---
우연히 트위터에서 보고 들어가서 해 보고 했던 건데, 나중에 다시 찾으려니까 찾기가 힘들었다.

그래서 기록해 둔다.

일단 내가 찾았던 것은 웹사이트로 제공해 주는 거다.

[Page Speed Online][1] : 이 링크로 들어가서 사이트 주소를 치면 사이트 속도에 영향을 미치는 다양한 요인을 분석해 준다.

다른 것도 있었다. 이건 파이어폭스와 크롬에 부가 기능을 붙이고 자신의 서버에 뭔가를 설치하면 측정을 해 주는 놈으로 보인다.

[Page Speed 홈][2] : 여기 들어가면 한글로 특징이 잘 설명돼 있으니 그냥 보고 하면 된다. 좀더 전면적으로 할 때 유용한 듯하다.

둘 중 앞에서 소개한 놈을 이용해 내가 관리하는 [레프트21][3] 사이트를 측정해 봤다. 88점이 나왔다. 참고로 구글은 70점이다. 네이버는 69점. 한겨레는 68점, 민중의 소리는 59점, 조선일보 70점.

아마도 내가 관리하는 [레프트21][4]은 이미지 요소를 거의 사용하지 않은 점이 득점요인으로 작용한 것 같다. 위 사이트들에서 공통적으로 지적되는 부분은 css sprite를 사용하라는 것과 브라우저 캐시를 사용하라는 것이었는데, [레프트21][3]에 대해서는 css sprite를 사용하라는 조언이 없었기 때문이다. [레프트21][3]이 css sprite를 사용하고 있는 것도 아닌데 말이다. 브라우저 캐시를 활용하라는 조언은 있었다.

([css sprite][5]: background로 들어간 이미지들을 하나의 통이미지에 박은 후 background-position을 이용해 필요한 곳에 사용하는 기법. 이렇게 하면 통으로 이미지를 한 번만 불러오기 때문에 request 수가 적어지고, 그래서 사이트 속도가 빨라진다)

가장 문제가 있다고 걸리는 건 브라우저 캐시 부분이었는데, 바로 정적 이미지와 js, css의 캐시 기간이 설정돼 있지 않다는 것이었다.

어떻게 설정해야 하는지 배운 적이 없기 때문에 learn more를 눌러 봤다. 나오는 문서의 제목은 [Leverage browser caching (브라우저 캐시를 활용하라)][6]. 역시나 다 영어다.

그래서 번역을 해 보기로 결심했는데 그건 나중에 해서 올리겠다.

언제나 사이트 속도는 나의 최대 관심사다.

 [1]: http://pagespeed.googlelabs.com
 [2]: http://code.google.com/speed/page-speed/
 [3]: http://left21.com/
 [4]: http://left21.com
 [5]: http://code.google.com/intl/ko-KR/speed/page-speed/docs/rtt.html#SpriteImages
 [6]: http://code.google.com/intl/ko-KR/speed/page-speed/docs/caching.html#LeverageBrowserCaching