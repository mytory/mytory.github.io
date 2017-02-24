---
title: '[구글 아날리틱스] 여러 개의 URL을 하나의 URL로 통계 잡기(ex. /asdf.html 을 /asdf 로 잡기)'
author: 안형우
layout: post
permalink: /archives/2192
aktt_notify_twitter:
  - yes
daumview_id:
  - 36634306
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
얼마 전부터 <레프트21>이 다음 뉴스로 송고를 시작했다. 근데 골때리는 게 다음에서는 모든 기사의 URL에 .html 을 붙일 것을 요구했다는 점이다. 레프트21의 기사 URL은 http://left21.com/article/10809 형식이다. 그런데 http://left21.com/article/10809.html 형식으로 보내 달라고 했다는 거다. 이런 거야 뭐 .htaccess 파일을 사용하면 쉽게 바꿀 수 있다.

그런데 문제는 URL이 달라지면서 통계도 달라진다는 점이다. 10809번 기사는 몇 번 읽혔나? 이걸 한 눈에 보기가 어려워 진다.

그래서 일단 조치를 한 게 바로 [어제 쓴 표준 페이지 설정 태그 <link rel=canonical &#8230; >][1] 이었다. 그러나 십중 팔구 저놈은 검색엔진에만 영향을 줄 거다. 구글 아날리틱스는 여전히 뻘짓을 할 수 있다는 이야기다. 그래서 검색을 해 봤다. 어떻게?

일단 필터를 살펴 봤다. **필터 > 맞춤 필터 > 찾기 및 바꾸기**가 있었다. Request URI 를 바꿀 수 있었다. 이제 검색의 시간. 구글 아날리틱스 설정에 들어가서 영문으로 바꿨다. 영문 글이 훨씬 많으니 어쩔 수 없다. 위 메뉴의 영문 메뉴명은 **Filter > Custom filter > Search and Replace** 였다.

[google analytics custom filter request URI 로 검색][2]했다. 역시나 괜찮은 글이 발견됐다. 제목은 Improving the quality of your report&#8217;s data. [이 문서는 사라졌다;; - 2012-08-31 추가] 구글 아날리틱스 공식 문서지만 영어다. 이따위라니까. 개발하려면 영어부터 해야 하는 비극 &#8230; OTL;;

여튼 괴발개발 읽어 봤다. 위 영어 글의 1번 항목 &#8220;1. Eliminate Duplicate Data [데이터 중복 제거]&#8220;의 두 번째 항목인 &#8220;Different file extensions [서로 다른 파일 확장자]&#8220;를 보면 해답이 나와 있다.

방법은 아래와 같다. 이미지를 참고하면 빠를 거다.

*   우측 상단의 관리(Admin) 항목을 누른다.
*   사이트를 누르고 필터 탭을 선택한다.
*   그리고 아래처럼 세팅한다. 한글과 영어 둘 다 제공해 주겠다. ㅋ

<p style="text-align: center;">
  <img class="aligncenter" src="/uploads/legacy/ga-filter-english.png" alt="" width="692" height="722" />
</p>

<p style="text-align: center;">
  <img class="alignnone aligncenter" src="/uploads/legacy/ga-filter-korean.png" alt="" width="659" height="750" />
</p>

필터 이름은 내용에 맞게 잘 적도록 하고, 맞춤 필터(Custom filter)를 고른다. 그리고 고급(Advanced)을 골라 준다. 필드 A(Field A) -> 추출 A(Extract A) 에서 요청 URI(Request URI)를 골라 주고 거기다가는 `(.*)\.html` 이라고 적어 준다. 이건 정규식이다. 정규식이 뭔지 모르는 사람은 따라하는 거 말고 독창적인 건 하지 말기 바란다. 필드 B(Field B)는 비워 둔다.

출력 대상(Output To) -> 생성자(Constructor) 역시 요청 URI(Request URI)로 선택해 주고, `$A1`이라고 써 준다. 이건 &#8216;필드 A의 첫 번째 괄호&#8217; 라는 의미다. 즉, .html 앞까지의 문자열을 뜻한다. 그럼? 당연히 .html을 제외한 전체 문자열이다.

그러면 앞으로 http://left21.com/article/10809.html 도 http://left21.com/article/10809 로 통계를 잡을 거라고 하는데(!) 방금 적용했기 때문에 정말 그럴지는 내일 돼 봐야 안다. 내일 한 번 보고 결과를 써 드리겠다. ^^

## 결과 보고

다음날 오후 1시 50분에 추가한 내용이다. DAUM 검색을 통해 들어온 오늘 방문수는 143회다. 그런데 .html로 잡힌 방문수는 2회에 불과하다. 이 2회가 어떻게 잡힌 건지는 모르겠지만, 여튼간에 이러면 성공한 것이라고 볼 수 있을 것 같다.

단, 하나의 단점이 있는데, index.html 에서도 .html이 지워져서 index로 잡히게 된다는 거다. ㅡㅡ;; 이건 그냥 해결 안 할 생각이다;;

 [1]: https://mytory.net/archives/2184 "[링크] 표준 페이지 설정, link rel=canonical"
 [2]: http://www.google.co.kr/search?sourceid=chrome&ie=UTF-8&q=javascript+requestURI#pq=javascript+requesturi&hl=ko&cp=39&gs_id=ar&xhr=t&q=google+analytics+custom+filter+request+URI&pf=p&sclient=psy-ab&newwindow=1&source=hp&pbx=1&oq=google+analytics+custom+filter+request+URI&aq=f&aqi=&aql=&gs_sm=&gs_upl=&bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&fp=b2526321b7f52283&biw=1280&bih=675