---
title: '웹 폰트를 로컬 스토리지에 저장하는 기법 - 캐시 안정성 증가, 글꼴 깜빡임 현상 제거'
layout: post
tags:
  - tip
  - webfont
---

최근 프로젝트에서 웹 폰트를 사용해서, 오래 전에 눈여겨 봤던 [스매싱 매거진의 웹 폰트 적용 방식][1]을 사용해 보기로 했다.[^fn2] 정확히 말하면 스매싱 매거진이 [가디언의 선례][2]를 따라 적용한 방식이다.

여기서는 웹 폰트 최적화에 대해서만 다루는데, 스매싱 매거진의 흥미진진한 이야기를 요약하면 이렇다.

- 보이는 모양은 중요하기 때문에 모바일에서 웹 폰트를 사용하지 않게 하는 것은 고려사항이 아니었다.
- 웹 폰트가 6개(글꼴 두 개 각각의 레귤러, 이탤릭, 볼드)로 300KB나 됐다.
- 잦은 FOUT(기본 글꼴 깜빡임)를 피하기 위해 웹 폰트는 `<head>`에서 불러와야 한다.
    - **역자:** FOUT는 "기본 글꼴 깜빡임(flash of unstyled text)"의 약어다. 웹 폰트를 아직 다 다운로드하기 전에, 기본 글꼴로 콘텐츠가 표시됐다가 웹 폰트를 다 다운로드하면 웹 폰트로 전환되면서 내용이 한 번 깜빡이는 현상을 말한다. 2009년에 폴 아이리쉬(Paul Irish)가 이 이름을 붙였다([Fighting the @font-face FOUT](http://www.paulirish.com/2009/fighting-the-font-face-fout/)). 이후 각양 각색의 해결책은 CSS-TRICKS의 [FOUT, FOIT, FOFT](https://css-tricks.com/fout-foit-foft/) 에 잘 나와 있다.   
    현재는 모든 주요 브라우저가 FOIT로 불리는 해결책을 적용한 상태다. FOIT란 "텅 비어있다가 나타남(Flash of Invisible Text)" 방식이다. 이 방식은, 웹 폰트를 전부 다운로드하기 전까지는 글자를 아예 표시하지 않다가 다운로드가 끝나면 표시하는 방법인데, 개인적으론 FOUT보다 더 짜증난다. 한국어 웹 폰트는 용량이 커서, 다운로드 속도가 느리면 아주 오랫동안 화면이 비어 있게 된다.   
    스매싱 매거진이 사용한 방법은 페이지를 처음 불러올 때 FOUT를 한 번 허용하고(즉, 기본 글꼴로 콘텐츠를 읽을 수 있게 놔두다가 한 번 깜빡 하면서 웹 폰트로 전환하고), 그 뒤 웹 폰트를 `localStorage`에 저장해서 이어지는 페이지부터는 안정적으로 FOUT 현상을 회피하는 방법이다. 위 CSS-TRICKS의 글에서 맨 아래 소개돼 있다.
- 그러나 HTTP 캐시는 매우 불안정했다. 때때로 다시 다운로드하더라. 이것이 야기하는 가장 큰 문제는, [폰트를 다 다운로드할 때까지 글자가 보이지 않게 된다][3]는 것이다. 심지어 웹폰트 제공 서버에 문제가 생기면 아예 다운로드가 안 되고, 글자는 전혀 나타나지 않았다.
- 글자 공백 현상을 막기 위해, ajax로 글꼴을 로딩하는 타입킷과 구글 웹 폰트 로더를 사용해 봤는데, FOUT 현상이 너무 자주 일어나 읽기 경험을 파괴하는 수준이었다. 역시나 HTTP 캐시는 매우 불안정했다. 다만, 웹 폰트를 모두 다운로드하기 전까지 표시되도록 지정했던 대체 글꼴 목록(iOS, 안드로이드, 윈도우폰...)은 여전히 사용하고 있다.
- 미디어쿼리를 사용해서 데스크톱에서만 웹 폰트를 다운로드하게 해 봤다. 모바일 성능은 확실히 개선됐지만, 만족스럽지 않았다. 우리 정체성을 생각할 때 옳은 방법이 아니라고 느꼈다. 그래서 다시 포기.
- 남은 방법은 캐시를 개선하는 것밖에 없었다. `localStorage`를 사용하거나, `AppCache`를 사용하거나. 제이크 아치발드(Jake Archibald)가 [앱 캐시의 복잡성][5]에 대해 쓴 훌륭한 글을 보고 나서 로컬 스토리지를 사용하기로 결정했다.
- 로컬 스토리지는 도메인당 5메가 정도로 용량 제한이 있다. 그래서 스매싱 매거진 도메인으로 저장할 수 있도록 허락해 달라고 폰트덱에 요청했는데, 폰트덱에서 흔쾌히 허락해 줬다.
- 로컬 스토리지에 폰트를 캐시했다가 꺼내 쓰는 것은, 브라우저의 캐시를 꺼내 쓰는 것보다 꽤 느린데, 대신 훨씬 안정적이었다. 완벽한 해법은 아니지만 성능을 비약적으로 올렸다.
- 브라우저가 로컬 스토리지를 지원하지 않는다면 그냥 폰트덱의 외부 URL을 제공하고 운에 맡기기로 했다.
- FOUT를 방지하기 위해 웹폰트를 불러오는 자바스크립트 코드는 `<head>`에 뒀다. [요샌 html 맨 아래에 자바스크립트를 두기 때문에 `<head>`에 뒀다고 굳이 언급하는 것이다. `<head>`에 자바스크립트를 두면 그걸 파싱하는 동안 렌더링이 멈추기 때문에, 페이지를 늦게 렌더링한다. - 역자]   
  자바스크립트는 로컬 스토리지 글꼴 저장 여부를 알아낸다. 저장하지 않았다면 우선 페이지를 렌더링한 뒤, base64로 인코딩[뒤에 설명해 주겠다 - 역자]한 woff 글꼴을 내장한 CSS[이후부턴 woff 내장 CSS라고 부르겠다 - 역자] 파일 내용을 ajax로 가져와 `<head>`에 뿌리고, 그걸 로컬 스토리지에 저장한다. FOUT는 이 때 한 번 일어난다(관련 코드는 스매싱 매거진 페이지와 [gist][6]에서 볼 수 있다). 이후 방문에서는 `localStorage`에 저장된 CSS 내용을 꺼내서 `<head>`에 박기 때문에 FOUT가 일어나지 않는다.
- 물론 첫 번째 방문 때는 아예 웹 폰트를 다운로드만 하고 적용하지 않는 방법도 있다. 로컬 스토리지에 저장만 하고 웹 폰트로 전환하지 않도록 하면 아예 FOUT를 방지할 수도 있다. 하지만, 타이포그라피는 우리 정체성에서 중요하다. 한 번 정도 깜빡임이 발생나는 것은 받아들일 만했다.
- 테스트하며 알게 된 황당한 문제들. 웹뷰의 캐시는 영속적이지 않아서, 트윗덱과 페이스북에서는 글꼴을 계속 비동기적으로 다운로드했다. 구형 블랙베리는 배터리가 완전 방전되면 쿠키와 캐시를 모두 날리는 것으로 보인다. 설정에 따라서는 모바일 사파리에서도 글꼴이 영속적이지 않는 경우가 있었다.
- **결과:** 첫 페이지 방문에서 700ms를 절약했다. 로컬 스토리지를 이용한 이어지는 방문에선 웹 폰트 적용에 40~50ms밖에 걸리지 않았다. 우리 웹사이트 개선에서 가장 중요했던 게 뭐냐고 묻는다면 단연 웹 폰트 개선이라고 할 수 있다.
- [woff2는 브라우저 지원이 충분치 않아서][7] 아직 고려하지 않고 있다. [2016년 6월 14일 현재 크롬, 파이어폭스, 오페라, 안드로이드 브라우저, 안드로이드 크롬만 지원하고 있다. IE11, 엣지, 사파리, 모바일 사파리, 오페라 미니는 지원하지 않는다. - 역자]


## 한글 글꼴 경량화

그럼 이제 실제 적용에 대해 이야기해 보자! 여기부턴 나의 이야기다.

적용해야 했던 글꼴은 나눔고딕이다. 내가 별로 좋아하는 글꼴은 아니다. 난 나눔바른고딕이나 코펍돋움을 더 좋아한다. 그러나 클라이언트는 나눔고딕을 요구했으니 나눔고딕을 할 밖에.

웹폰트를 위해서 나눔고딕의 경량화 버전을 만들었다. 경량화란 자주 사용하는 한글 2,350자와 숫자, 영문, 특수문자를 뽑아서 웹폰트를 만드는 것을 말한다. 물론 이 2,350자 안에는 '똠'이나 '뷁', '햏' 같은 글자가 들어가 있지 않아서 해당 글자는 기본 폰트로 나오게 될 것이다.[^fn4]

경량화하니 나눔고딕 레귤러 버전을 기준으로 ttf는 759kb, woff는 237kb, eot는 165kb, woff2는 136kb가 나왔다.[^fn3] 일단, 나도 스매싱 매거진 팀처럼 woff2까지 사용하진 않기로 한다(사용해 보고 싶은 사람은 [woff2-feature-test](https://github.com/filamentgroup/woff2-feature-test)란 프로젝트가 있던데 한 번 살펴 보라).


## 로직

위에서 스매싱 매거진 팀이 설명한 로직을 좀더 정리해 반복 설명하면 이렇다.

`localStorage`를 지원하지 않거나, ajax를 지원하지 않는 브라우저는 그냥 일반적인 웹폰트 CSS를 사용하게 하고, 쿠키에 표시를 한다.

최신 브라우저라면 아래처럼 한다.

1. `localStorage`에 CSS가 저장돼 있고, 파일이 이전에 받았던 파일인지 확인한다(즉, CSS 파일명을 바꾸면 새로 받는다).
2. 저장돼 있지 않으면 woff 내장 CSS 파일을 ajax로 불러 온다. 그 내용을 `<head>`에 `<style>` 요소로 만들어 넣는다. 이후 `localStorage`에 해당 내용과 파일명을 각각 저장한다.
3. 저장돼 있다면, 꺼내 와서 바로 `<head>`에 `<style>` 태그를 만들고 뿌린다.

IE8은 로컬 스토리지를 지원하면서 woff는 지원하지 않는다. 그래서 위처럼 로컬 스토리지 지원 여부만 검사하게 되면, IE8은 사용하지도 않을 woff 스타일시트를 다운받는다. 스매싱 매거진은 IE8은 그냥 포기한 듯한데, IE8까지 따로 대응하려면 하자. [Stat Counter](http://gs.statcounter.com/)에 따르면 IE8 한국 점유율은 2016년 5월 기준 2.74퍼센트다. 난 IE8 대응 코드를 넣었다.


## 기본 `@font-face` 준비

`@font-face` 예제야 어디서든 구할 수 있으니 설명 안 할까도 했지만, 간단히 짚고 넘어가자. 아래는 로컬 스토리지를 지원하지 않는 브라우저를 위한 `@font-face`다. woff를 내장한 CSS 파일과 다른 별도 파일로 만들도록 한다. 여기서는 `webfont.normal.css`로 저장했다.

```css
@font-face {
    font-family: "Nanum Gothic";
    font-style: normal;
    font-weight: 500;
    src: url(fonts/NanumGothic-Regular.eot); /* IE9 Compat Modes */
    src: url(fonts/NanumGothic-Regular.eot?#iefix) format("embedded-opentype"), /* IE6-8 */
         url(fonts/NanumGothic-Regular.woff) format("woff"), /* Mordern Browsers */
         url(fonts/NanumGothic-Regular.ttf) format("truetype"); /* If not support woff */
}
```

위 코드에서 `?#iefix`는 단지 URL을 다르게 하기 위한 장치다. `?` 뒤에 어느 문자열을 써도 상관없다. [IE 구버전에서는 src URL이 중복되면 파일을 찾지 못하는 버그가 있다고 한다.](http://stackoverflow.com/a/8636675)

주석은 Fontspring의 ['빈틈없는 문법 더 강화하기(Further Hardening Of The Bulletproof Syntax)'](http://blog.fontspring.com/2011/02/further-hardening-of-the-bulletproof-syntax/)를 참고한 것인데, `format('embedded-opentype')`이 붙어 있는 eot가 IE6-8을 위한 것이라고 씌어 있다. 그런데 IE11의 IE8 모드로 돌렸을 때는 `format` 표시가 없는 eot를 다운로드 하더라. 나중에 XP의 IE8에서 테스트할 기회가 있으면 하겠는데... 굳이 세팅해서 해 보진 않았다.

## woff를 내장한 `@font-face` 준비

이제 woff 내장 CSS인 `webfont.woff.css`를 준비해 보자. 이 CSS 파일엔 base64로 인코딩한 woff 파일을 통째로 넣는다. base64는 말 그대로 하면 64진법. base64 인코딩이란, 바이너리든 뭐든 무조건 아스키 문자 64개로 표현하는 표기 방식을 말한다. 바이너리도 문자열로 만들어서 교환할 수 있는 편리함, 인코딩이 다른 문자열을 깨질 염려 없이 교환할 수 있는 편리함을 준다. 위키피디아의 [베이스64][8] 항목에 설명이 한글로 잘 돼 있으니 더 자세히 알고 싶으면 참조하라.

웹개발에서 자주 활용하는 base64 인코딩은 작은 이미지를 base64로 인코딩해서 CSS에 포함시키는 것이다. 이러면 브라우저가 서버에 보내는 요청 수를 한 번 줄일 수 있으므로 성능을 개선하는 데 도움이 된다.

    background-image: url(data:image/png;base64,...==)

잘 사용하진 않지만, 아예 `img` 태그에 들어가는 이미지를 base64로 넣을 수도 있다.

    <img src="data:image/png;base64,...==">

작은 이미지를 base64로 인코딩해 주는 사이트는 검색하면 많이 나온다. 그런데 이번 경우는 수백 키로바이트 짜리 `woff` 폰트 파일을 base64로 인코딩해야 한다. 이럴 땐 로컬 프로그램을 사용하는 편이 더 나을 것이다. 리눅스 터미널에선 간단하게 만들 수 있다.

    base64 NanumGothic-Regular.woff -w 0 > NanumGothic-Regular.base64.txt

위 명령어를 사용하면 줄바꿈하지 않은 base64 텍스트를 얻을 수 있다. `-w 0`이 줄바꿈하지 말라는 옵션이다.

[윈도우에선 CERTUTIL이라는 프로그램을 사용](http://stackoverflow.com/a/16946681)하면 되나 보다.

    certutil -encode NanumGothic-Regular.woff NanumGothic-Regular.base64.txt

woff 내장 CSS 파일의 내용은 아래와 같을 것이다. base64 인코딩 텍스트가 무지하게 길기 때문에 아래 코드에선 중략했다. 가로가 길기 때문에 `format("woff")` 코드도 줄바꿈했다. (팁을 하나 주자면, 보통 편집기는 가로로 엄청나게 긴 줄이 있으면 느려진다. 미리 줄바꿈 옵션을 켜고 작업하면 랙, 심하면 다운을 방지하는 데 도움이 될 것이다. 아님 vim으로 작업하든가...)

```css
@font-face {
  font-family: "Nanum Gothic";
  font-style: normal;
  font-weight: 500;
  src: url("data:application/font-woff;base64,d09GRgAB...중략...==")
       format("woff");
}
```

## 글꼴 지정

워낙 기본적인 것이긴 하지만 그래도 짚고 넘어가자. 브라우저는 `font-family`에서 앞에 적힌 것부터 찾아서 사용한다. 나눔고딕이 컴퓨터에 설치돼 있는 사람까지 웹 폰트를 다운로드하게 할 필요는 없으므로, 설치돼 있는 나눔고딕을 먼저 사용하게 하자. (이건 CSS 팁인데, 글꼴은 `<body>`에만 지정해 쓰고, 예외적인 경우에만 따로 지정하도록 한다. `<input>`이나 `<button>`, `<select>`, `<textarea>` 같은 폼 요소들은 `font-family: inherit`로 지정해 주면 `<body>`의 글꼴 지정을 상속받는다.)

```css
body {
  font-family: "NanumGothic", "NanumGothicOTF", "Nanum Gothic", "Apple SD Gothic Neo", "Malgun Gothic", sans-serif;
}
```

위에서 두 번째로 적은 게 웹 폰트다. 위처럼 적으면 일단 컴퓨터에 설치한 나눔고딕을 찾는다(`NanumGothic OTF`는 맥에 제공하는 인쇄용 나눔고딕이다). 없으면 웹 폰트를 찾는다. 웹 폰트가 있는 경우 웹 폰트로 표시하고 끝나게 된다. 웹 폰트를 아직 다 다운로드하지 않은 시점엔 웹 폰트도 없으므로 그 다음 글꼴을 찾게 되는데, 애플 제품군이라면 애플 SD 고딕 네오가 있으므로 일단 애플 SD 고딕 네오로 내용을 표시하게 될 것이다. 윈도우라면 맑은 고딕으로 내용을 표시하게 된다. 이후 웹 폰트를 다 다운로드하면 브라우저는 나눔고딕 웹 폰트로 내용을 다시 렌더링한다.


## IE8 지원

IE8을 지원하는 최상의 방법은 eot를 내장한 CSS를 준비하고 js에서 분기시키는 방법일 것이다. 그러나 스매싱 매거진 팀은 woff만 내장했고, 나도 스매싱 매거진 팀을 따랐다. 다만, IE8을 위해 `webfont.normal.css`를 추가로 준비한 것이 스매싱 매거진 팀과 다르다.

위에서도 말했듯, IE8은 로컬 스토리지를 지원한다. 로컬 스토리지 지원 여부를 기준으로 어떤 CSS를 사용할 지 결정하는 스매싱 매거진 팀의 원래 js 코드를 따르면 IE8은 woff CSS를 전부 다운받은 뒤 사용하지 않는다. 사실 현재 스매싱 매거진은 아예 사이트 자체가 IE8 지원을 포기한 상태인 듯하다. 이 선택이 나쁘진 않다. IE8의 세계 점유율은 1퍼센트다.

그런데 한국은 2.74퍼센트는 된다. 애매하긴 한데, 우리는 IE8을 반쯤만 지원해 주자. `webfont.normal.css` 파일은 IE8을 위한 것인데, eot를 내장하진 않았다. 그냥 외부 eot 파일을 사용하게 했으므로 IE8의 로컬 스토리지 지원은 없는 셈 친 것이다.

IE8을 감지하기 위해선 IE의 조건 태그를 사용하자. 문서의 맨 위 `html` 태그를 뿌릴 때 아래와 같은 코드를 사용하는 것이 가장 편리한 방법이다([IE만을 위한 몸통 클래스 추가(Add Body Class Just For IE)][9] 참고).

```html
<!DOCTYPE html>
<!--[if IEMobile 7 ]>
<html dir="ltr" lang="ko" class="iem7">
<![endif]-->
<!--[if lt IE 7 ]>
<html dir="ltr" lang="ko" class="ie6 oldie">
<![endif]-->
<!--[if IE 7 ]>
<html dir="ltr" lang="ko" class="ie7 oldie">
<![endif]-->
<!--[if IE 8 ]>
<html dir="ltr" lang="ko" class="ie8 oldie">
<![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html dir="ltr" lang="ko">
<!--<![endif]-->
<head>
  (후략)
```

위 코드를 보면 IE 버전에 따라 `html` 태그에 붙는 클래스명이 달라진다. 괜히 js에서 브라우저 탐지하느라 고생하지 말고, 이 방식을 쓰자. js에선 `html` 요소에 붙은 `oldie`라는 클래스명을 보고 구형 브라우저인지를 알 수 있다.


## 자바스크립트

이제 CSS 파일 두 개를 준비했으니, 자바스크립트를 이용해 적용하자. jQuery로 짜지 않았는데, `localStorage`에 들어있는 웹폰트를 최대한 빨리 꺼내 와야 하기 때문이다. jQuery로 짜면 우선 jQuery를 `<head>`에 박아야 하는 문제가 있다. js를 파싱하는 동안 브라우저는 렌더링을 멈추므로, 요새는 죄다 js를 html 맨 아래 `</body>` 근처에 두는데 그걸 끌어올려야 하는 것이다. jQuery 3.0 압축 버전이 84kb다. `<head>`에서 받긴 부담이 있다. 그래서 속칭 바닐라 js - plain js로 구현한 것을 쓸 수밖에 없었다. 이벤트 핸들러랑 ajax를 제외하면 사실 jQuery가 특별히 해 주는 게 없기도 했고...

코드는 앞서 설명한 로직을 구현한 것인데, 이해하려면 꼼꼼히 읽는 수밖에 없다. 주석을 달아 뒀으니 코드를 꼼꼼히 보자([gist에서 보기][10]).

```javascript
(function () {
    "use strict";
    // 스매싱 매거진의 '지연된 웹폰트 불러오기' javascript를 안형우가 수정한 것.
    // https://gist.github.com/hdragomir/8f00ce2581795fd7b1b7

    // 한 번 캐시하면 css 파일은 클라이언트 측에 저장한다.
    // 아래 css_href 가 바뀌면 그 때 다시 받는다.
    // woff base64를 내장한 css
    var css_href = 'css/webfont.woff.css';
    // localStorage 를 지원하지 않는 브라우저를 위한 css
    var css_href_normal = 'css/webfont.normal.css';

    // 간단한 이벤트 핸들러 함수
    function on(el, ev, callback) {
        if (el.addEventListener) {
            el.addEventListener(ev, callback, false);
        } else if (el.attachEvent) {
            el.attachEvent("on" + ev, callback);
        }
    }

    // localStorage 에 글꼴이 저장돼 있거나, 네이티브 브라우저 캐시를 이용해 저장했다면...
    if (
        (window.localStorage && localStorage.font_css_cache)
        || document.cookie.indexOf('font_css_cache') > -1
    ) {
        // 캐시된 버전을 사용한다.
        injectFontsStylesheet();
    } else {
        // 캐시된 버전이 없으면 페이지 로딩을 막지 않고 기다렸다가
        // 페이지가 전부 load 되면 웹폰트를 다운로드한다.
        on(window, "load", injectFontsStylesheet);
    }

    /**
     * css 파일이 브라우저에 저장됐는지 확인하는 함수.
     * @param href
     * @returns {Storage|string|*|boolean}
     */
    function isFileCached(href) {
        return (
            window.localStorage
            && localStorage.font_css_cache
            && (localStorage.font_css_cache_file === href)
        );
    }

    /**
     * 구형 브라우저 탐지 함수.
     * 로컬 스토리지나 ajax 를 지원하지 않는 경우
     * <html> 태그에 oldie 클래스가 붙은 경우
     * (IE8 이하인 경우 <html class="oldie  ie8"> 하는 식으로 미리 처리해 둬야 한다.
     * https://css-tricks.com/snippets/html/add-body-class-just-for-ie/ 참고)
     * @returns {boolean}
     */
    function isOldBrowser(){
        return (
            !window.localStorage
            || !window.XMLHttpRequest
            || (document.getElementsByTagName('html')[0].className.indexOf('oldie') > -1) // IE8 이하
        );
    }

    /**
     * 실제 css 내용을 넣는 함수
     */
    function injectFontsStylesheet() {
        // 구형 브라우저라면 link 요소를 만들어서 head에 때려 박는다.
        // 이 때는 css_href_normal 을 사용한다.
        if (isOldBrowser()) {
            var stylesheet = document.createElement('link');
            stylesheet.href = css_href_normal;
            stylesheet.rel = 'stylesheet';
            stylesheet.type = 'text/css';
            // 네이티브 브라우저 캐시 사용. 오래 가도록 서버에 만료일을 최대한 길게 설정하자.
            document.getElementsByTagName('head')[0].appendChild(stylesheet);
            // 쿠키에 표시한다.
            document.cookie = "font_css_cache";
        } else {

            // 구형 브라우저가 아닌 경우
            if (isFileCached(css_href)) {
                // 로컬 스토리지에 캐시한 버전이 있다면 그걸 <head>에 박는다.
                injectRawStyle(localStorage.font_css_cache);
            } else {
                // 아니면, ajax 로 불러온다.
                // jQuery 만 쓴 분들은 생소하겠지만, 이게 plain js로 구현한 ajax 다.
                var xhr = new XMLHttpRequest();
                xhr.open("GET", css_href, true);

                // ajax 에서 addEventListener 나 attachEvent 를 지원하지 않는 IE8을 위한 조치
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        // ajax 로 받은 css 내용을 <head>에 박는다.
                        injectRawStyle(xhr.responseText);
                        // 그리고 css 내용을 로컬 스토리지에 집어 넣어 나중에도 쓸 수 있게 한다.
                        // 기존에 저장된 것이 있다면 덮어쓴다는 점을 알아 둬라.
                        localStorage.font_css_cache = xhr.responseText;
                        localStorage.font_css_cache_file = css_href;
                    }
                };
                xhr.send();
            }
        }
    }

    /**
     * css 텍스트를 <head>에 집어넣는 간단한 함수
     * @param text
     */
    function injectRawStyle(text) {
        var style = document.createElement('style');
        // style.innerHTML 을 지원하지 않는 IE8을 위한 조치
        style.setAttribute("type", "text/css");
        if (style.styleSheet) {
            style.styleSheet.cssText = text;
        } else {
            style.innerHTML = text;
        }
        document.getElementsByTagName('head')[0].appendChild(style);
    }

}());
```

위 자바스크립트를 `webfont.js`에 저장하고, `<head>`에 넣었다. 그리고 바로 아래에는 `<noscript>` 태그로 CSS 파일을 넣어 js를 끈 경우에도 대응하게 했다.

```html
<head>
  ...
  <script src="js/webfont.js"></script>
  <noscript>
      <link rel="stylesheet" href="css/webfont.normal.css">
  </noscript>
</head>
```

이러면 완성.

## 잘 적용됐는지 확인해 보자

잘 적용됐는지 확인해 볼 때다. 우리가 목표했던 것은 아래와 같다.

- 처음 웹 폰트를 로딩할 때 한 번만 기본 글꼴 깜빡임 현상이 있게 하고, 두 번째 페이지부터는 없게 한다.
- 그럼으로써 인터넷 속도가 느린 경우에도 웹 폰트를 안정적으로 사용할 수 있게 한다.

테스트용 브라우저는 크롬으로 하자. 크롬 개발자 도구는 [느린 인터넷(Throttling) 테스트][4]를 할 수 있는 기능을 갖추고 있다. <kbd>F12</kbd>를 눌러 개발자 도구를 열고 네트워크 탭으로 가서, No throttling이라고 적힌 곳을 누른 다음 Regular 3G를 선택하면 초당 750kb 다운로드 속도일 때 웹사이트에 어떤 일이 벌어지는지 살펴볼 수 있다.

웹폰트 테스트를 해야 하니, 로컬에 설치된 글꼴명은 CSS에서 지우자(아니면 로컬에 설치된 글꼴을 지우든가). 그리고 기왕이면 No throttling 옆에 있던 Disable cache에도 체크해서 브라우저의 캐시 기능도 지우도록 하자.

로컬 스토리지도 정리해야 한다. 개발자 도구의 콘솔 탭에 가서 `localStorage.clear()`라고 입력한 뒤 엔터. 리턴값이 없으므로 `undefined`가 찍힐 것이다.

이제 다시 네트워크 탭으로 가서 새로고침을 해 보자. 눈여겨서 화면을 보고 있다면 글꼴이 깜빡이면서 교체되는 순간을 볼 수 있을 것이다.

아마 맨 밑에서 두 번째, 크롬 확장에서 사용하는 파일들의 바로 위에 `webfont.woff.css`를 다운로드한 것이 보일 것이고, 맨 아래에 base64 글꼴이 보일 것이다. 크롬 확장에서 사용하는 파일들은 캐시를 껐음에도 불구하고 캐시에서 왔다고 표시되므로 신경쓰지 말자. 캐시에서 올 수밖에 없는 파일들이니.

![](/uploads/2016-06/network-test.jpg)

이제 다시 콘솔 탭으로 가서 `localStorage`라고 입력하고 엔터를 쳐 보자. 돌려주는 값을 열어 보면, CSS의 내용이 저장된 것을 볼 수 있다.

`localStorage`가 잘 활용되는지 확인해 볼 차례다. 다시 새로고침을 해 보든가, 아니면 다른 페이지로 이동해 보자. 이번엔 글꼴 깜빡임 현상이 없는 것을 알 수 있다.

이상.




[1]: https://www.smashingmagazine.com/2014/09/improving-smashing-magazine-performance-case-study/#webfonts
[2]: https://github.com/ahume/webfontjson
[3]: http://ianfeather.co.uk/web-fonts-and-the-critical-path/
[4]: http://mytory.net/2016/06/09/throttling-test.html
[5]: http://alistapart.com/article/application-cache-is-a-douchebag
[6]: https://gist.github.com/hdragomir/8f00ce2581795fd7b1b7
[7]: http://caniuse.com/#search=woff2
[8]: https://ko.wikipedia.org/wiki/%EB%B2%A0%EC%9D%B4%EC%8A%A464
[9]: https://css-tricks.com/snippets/html/add-body-class-just-for-ie/
[10]: https://gist.github.com/mytory/88a0d05c57b101c4865a8b0c2fc0b11a

[^fn2]: 내가 인용한 링크를 클릭하면 글의 '웹 폰트 지연(Deferring Web Fonts)' 항목으로 이동하게 되는데, '웹 폰트 지연' 파트 외에도 글 전체가 다 좋다. 맨 앞부터 읽어 보는 것도 추천한다. 2014년 9월에 씌어져 그리 오래 된 글도 아니고, 여러 모로 웹사이트 최적화에 대한 통찰을 준다.

[^fn3]: woff2를 만드는 방법은 두 가지다. [google/woff2](https://github.com/google/woff2)를 컴파일해서 터미널에서 ttf를 woff2로 만드는 방법이 있고, ttf to woff2 같은 검색어로 검색해서 웹 서비스를 이용하는 방법이다. 당연한 이야기일 테지만, 개발자라면 전자를 사용해 볼 수 있겠지만, 일반인이라면 검색해서 해 보는 수밖에 없다. 그런데 웹 서비스들은 용량 제한이 있더라. 물론 400kb 정도가 제한이니 경량화 버전을 사용한다면 용량이 문제되진 않을 것 같다.

[^fn4]: 자세한 내용은 [한글 웹 폰트 경량화해 사용하기](http://blog.coderifleman.com/post/111825720099/%ED%95%9C%EA%B8%80-%EC%9B%B9-%ED%8F%B0%ED%8A%B8-%EA%B2%BD%EB%9F%89%ED%99%94%ED%95%B4-%EC%82%AC%EC%9A%A9%ED%95%98%EA%B8%B0)와 [스포카 한 산스와 글꼴 경량화](https://spoqa.github.io/2015/10/14/making-spoqa-han-sans.html)에 잘 나와 있으니 참고. 경량화 버전을 쓰면 표시되지 않는 글꼴이 있으므로 절대 사용하지 말라는 글도 있던데, 현재 크롬에서 테스트해 본 결과 기본 글꼴로 대체해 표시한다. IE 구버전 테스트는 해 보지 않았다.
