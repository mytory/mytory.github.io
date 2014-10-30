---
title: '[윈도우] 폴더별 하드디스크 사용량을 시각적으로 분석해 주는 프로그램'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2338
aktt_notify_twitter:
  - yes
daumview_id:
  - 36618952
categories:
  - 기타
tags:
  - Program
---
500기가나 되는 하드 용량이 간당간당했다. 아무리 생각해 봐도 그정도로 사용하지는 않았는데 말이다.

처음엔 탐색기에서 폴더 속성을 봐서 용량을 체크했다. 그러다 문득 프로그램이 있지 않을까 하는 생각이 들었다. [&#8216;하드 사용량 분석 프로그램&#8217;으로 검색][1]해 봤다. 역시나 나왔다.

하나를 써 봤는데 정말 맘에 들었다. 프로그램은 [SpaceSniffer][2]다. 프리웨어다.

<p style="text-align: center;">
  <a href="http://www.uderzo.it/main_products/space_sniffer/download.html">▶SpaceSniffer 다운로드</a>
</p>

프로그램은 포터블이다. 설치가 필요없다. 설치하고 드라이브를 선택하면 아래처럼 분석해 준다.

<img class="aligncenter" src="http://dl.dropbox.com/u/15546257/blog/mytory/spacesniffer.png" alt="" width="640" height="611" />

네모 칸을 선택하고 마우스 우클릭을 하면 탐색기 폴더에서 마우스 우클릭을 했을 때와 마찬가지의 컨텍스트 메뉴가 나온다. &#8216;열기&#8217;를 누르면 탐색기 폴더가 열린다.

이걸로 분석을 해서 쓸모없는 놈은 지우고 자주 사용하지 않는 놈은 외부 저장매체로 옮겼다. 그래서 일단 백업 드라이브에서 70기가를 확보했고, 윈도우가 깔려 있는 드라이브는 분석중이다.

## 기능 몇 가지 소개

위 이미지에서 네모를 더블클릭하면 해당 폴더의 내용을 좀더 상세히 보여 준다.

상단 메뉴바 바로 아래 있는 Filter 라는 입력칸에 \*.jpg 형식으로 적으면 필터에 해당하는 파일들의 용량만 보여 준다. 물론 어느 폴더에 있는지 잘 나온다. \*.jpg;*.mp4 식으로 적을 수도 있다.

색깔도 4가지로 분류할 수 있고 태깅도 할 수 있다는데, 더 알고 싶다면 [특징을 소개한 페이지][3]를 직접 보시라. [팁 앤 트릭을 소개한 페이지][4]도 있다.

 [1]: https://www.google.co.kr/search?sourceid=chrome&ie=UTF-8&q=%ED%95%98%EB%93%9C+%EC%82%AC%EC%9A%A9%EB%9F%89+%EB%B6%84%EC%84%9D+%ED%94%84%EB%A1%9C%EA%B7%B8%EB%9E%A8
 [2]: http://www.uderzo.it/main_products/space_sniffer/download.html
 [3]: http://www.uderzo.it/main_products/space_sniffer/features.html
 [4]: http://www.uderzo.it/main_products/space_sniffer/tips_and_tricks.html