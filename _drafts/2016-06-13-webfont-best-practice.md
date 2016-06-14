---
title: '웹 폰트를 로컬 스토리지에 저장해서 안정성 높이기'
layout: post
tags:
  - tip
  - webfont
---

요샌 웹 폰트를 사용할 만한 것 같다. 그러던 차 최근 프로젝트에서 웹 폰트를 사용해서, 오래 전에 눈여겨 봤던 [스매싱 매거진의 웹 폰트 적용 방식](https://www.smashingmagazine.com/2014/09/improving-smashing-magazine-performance-case-study/#webfonts)을 사용해 보기로 했다.[^fn2] 정확히 말하면 스매싱 매거진이 [가디언의 선례](https://github.com/ahume/webfontjson)를 따라 적용한 방식이다.

여기서는 웹 폰트 최적화에 대해서만 다루는데, 스매싱 매거진의 흥미진진한 이야기를 요약하면 이렇다.

- 보이는 모양은 중요하기 때문에 모바일에서 웹 폰트를 사용하지 않게 하는 것은 고려사항이 아니었다.
- 웹 폰트가 6개(글꼴 두 개 각각의 레귤러, 이탤릭, 볼드)로 300KB나 됐다.
- 잦은 FOUT[^fn1] 현상을 피하기 위해 웹 폰트는 `<head>`에서 불러와야 한다.
- 그러나 HTTP 캐시는 매우 불안정했다. 때때로 다시 다운로드하더라. 이것이 야기하는 가장 큰 문제는, [폰트를 다 다운로드할 때까지 글자가 보이지 않게 된다](http://ianfeather.co.uk/web-fonts-and-the-critical-path/)는 것이다. 심지어 웹폰트 제공 서버에 문제가 생기면 아예 다운로드가 안 되고, 글자는 전혀 나타나지 않았다. [즉, 텅 비어 있었다. - 역자]
- 글자 공백 현상을 막기 위해, ajax로 글꼴을 로딩하는 타입킷과 구글 웹 폰트 로더를 사용해 봤는데, FOUT 현상이 너무 자주 일어나 읽기 경험을 파괴하는 수준이었다. 역시나 HTTP 캐시는 매우 불안정했다. 다만, 웹 폰트를 모두 다운로드하기 전까지 표시되도록 지정했던 대체 글꼴 목록(iOS, 안드로이드, 윈도우폰...)은 여전히 사용하고 있다.
- 미디어쿼리를 사용해서 데스크톱에서만 웹 폰트를 다운로드하게 해 봤다. 모바일 성능은 확실히 개선됐지만, 만족스럽지 않았다. 우리 정체성을 생각할 때 옳은 방법이 아니라고 느꼈다. 그래서 다시 포기.
- 남은 방법은 캐시를 개선하는 것밖에 없었다. `localStorage`를 사용하거나, `AppCache`를 사용하거나. 제이크 아치발드(Jake Archibald)가 [앱 캐시의 복잡성](http://alistapart.com/article/application-cache-is-a-douchebag)에 대해 쓴 훌륭한 글을 보고 나서 로컬 스토리지를 사용하기로 결정했다.
- 로컬 스토리지는 도메인당 5메가 정도로 용량 제한이 있다. 그래서 스매싱 매거진 도메인으로 저장할 수 있도록 허락해 달라고 폰트덱에 요청했는데, 폰트덱에서 흔쾌히 허락해 줬다.
- 로컬 스토리지에 폰트를 캐시했다가 꺼내 쓰는 것은, 브라우저의 캐시를 꺼내 쓰는 것보다 꽤 느린데, 대신 훨씬 안정적이었다. 완벽한 해법은 아니지만 성능을 비약적으로 올렸다.
- 브라우저가 로컬 스토리지를 지원하지 않는다면, 그 땐 woff 폰트를 내장한 CSS 파일의 링크를 제공하고 솔직히 운에 맡겼다. [woff 파일 포맷을 지원하지 않는 브라우저](http://caniuse.com/#search=woff)(IE8, Opera Mini, Android <= 4.3)에 대해서는 폰트덱의 외부 URL을 제공한다.
- `<head>` 쪽에 짧은 자바스크립트 코드를 둬서, FOUT를 방지했다. 쿠키를 체크해서 로컬 스토리지 글꼴 저장 여부를 알아낸다. 저장하지 않았다면 우선 페이지를 렌더링한 뒤, base64[^fn5]로 woff 글꼴을 엠베드한 CSS 파일 내용을 ajax로 가져와 `<head>`에 뿌리고, 그걸 로컬 스토리지에 저장한다. FOUT는 이 때 한 번 일어난다(관련 코드는 스매싱 매거진 페이지와 [gist](https://gist.github.com/hdragomir/8f00ce2581795fd7b1b7)에서 볼 수 있다). 이후 방문 페이지에서는 `localStorage`에 저장된 CSS 내용을 꺼내서 `<head>`에 박기 때문에 FOUT가 일어나지 않는다.
- 물론 첫 번째 방문 때는 로컬 스토리지에 저장만 하고 웹 폰트로 전환하지 않도록 해서 아예 FOUT를 방지할 수도 있었다. 하지만, 타이포그라피는 우리 정체성에서 중요하다. 한 번 정도 전환이 일어나는 것은 받아들일 만했다.
- 테스트하며 알게 된 황당한 문제들. 웹뷰의 캐시는 영속적이지 않아서, 트윗덱과 페이스북에서는 글꼴을 계속 비동기적으로 다운로드했다. 구형 블랙베리는 배터리가 완전 방전되면 쿠키와 캐시를 모두 날리는 것으로 보인다. 설정에 따라서는 모바일 사파리에서도 글꼴이 영속적이지 않는 경우가 있었다.
- **결과**: 첫 페이지 방문에서 700ms를 절약했다. 로컬 스토리지를 이용한 이어지는 방문에선 웹 폰트 적용에 40~50ms밖에 걸리지 않았다. 우리 웹사이트 개선에서 가장 중요했던 게 뭐냐고 묻는다면 단연 웹 폰트 개선이라고 할 수 있다.
- [woff2는 브라우저 지원이 충분치 않아서](http://caniuse.com/#search=woff2) 아직 고려하지 않고 있다. [2016년 6월 14일 현재 크롬, 파이어폭스, 오페라, 안드로이드 브라우저, 안드로이드 크롬만 지원하고 있다. IE11, 엣지, 사파리, 모바일 사파리, 오페라 미니는 지원하지 않는다. - 역자]


## 한글 글꼴 경량화

그럼 이제 실제 적용에 대해 이야기해 보자! 여기부턴 나의 이야기다.

적용해야 했던 글꼴은 나눔고딕이다. 내가 별로 좋아하는 글꼴은 아니다. 난 바른고딕이나 코펍돋움을 더 좋아한다. 그러나 클라이언트는 나눔고딕을 요구했으니 나눔고딕을 할 밖에.

웹폰트를 위해서 나눔고딕의 경량화 버전을 만들었다. 경량화란 자주 사용하는 한글 2,350자와 숫자, 영문, 특수문자를 뽑아서 웹폰트를 만드는 것을 말한다. 물론 이 2,350자 안에는 '똠'이나 '뷁' 같은 글자가 들어가 있지 않아서 해당 글자는 기본 폰트로 나오게 될 것이다.[^fn4]

경량화하니 나눔고딕 레귤러 버전을 기준으로 ttf는 759kb, woff는 237kb, eot는 165kb, woff2는 136kb가 나왔다.[^fn3] 일단, 나도 스매싱 매거진 팀처럼 woff2까지 사용하진 않기로 한다.


## 로직

위에서 스매싱 매거진 팀이 설명한 로직을 반복하면 이렇다. 차후에 자세히 설명할 테니 이해가 안 되도 용어를 꼼꼼히 읽으며 이해하도록 한다.

`localStorage`를 지원하지 않거나, ajax를 지원하지 않는 브라우저는 그냥 일반적인 웹폰트 CSS를 사용하게 하고, 쿠키에 표시를 한다.

최신 브라우저라면 아래처럼 한다.

1. `localStorage`에 CSS가 저장돼 있고, 파일이 이전에 받았던 파일인지 확인한다(즉, CSS 파일명을 바꾸면 새로 받는다).
2. 저장돼 있지 않으면 woff를 base64로 인코딩해서 `@font-face`에 설정해 둔 CSS 파일을 ajax로 불러 와서 `<head>`에 `<style>`을 만들고 집어 넣는다.
3. 이후 `localStorage`에 해당 내용과 파일명을 집어 넣는다.
4. 저장돼 있다면, 꺼내 와서 바로 `<head>`에 `<style>` 태그를 만들고 뿌린다.

IE8은 로컬 스토리지를 지원하면서 woff는 지원하지 않는다. 그래서 위처럼 로컬 스토리지 지원 여부만 검사하게 되면, IE8은 사용하지도 않을 woff 스타일시트를 다운받는다. 스매싱 매거진은 IE8은 포기했다고 하니... 단 한 번 다운받은 뒤엔 로컬 스토리지로 처리하게 되므로 트래픽 부하를 엄청나게 주는 건 아니다. woff와 eot를 모두 다운받게 하는 문제 정도다.

그래도 IE8까지 따로 대응하려면 하자. 난 이번엔 안 했다. [Stat Counter](http://gs.statcounter.com/)에 따르면 IE8 한국 점유율은 2016년 5월 기준 2.74퍼센트다.


## 기본 `@font-face` 준비

`@font-face`야 어디서든 구할 수 있으니 설명 안 할까도 했지만, 간단히 짚고 넘어가자. 아래는 로컬 스토리지를 지원하지 않는 브라우저를 위한 `@font-face`다. 다른 스타일과 다른 별도 파일로 만들어서 저장하도록 한다. 여기서는 `webfont.normal.css`로 저장했다.

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

위 코드에서 `?#iefix`는 단지 URL을 다르게 하기 위한 장치다. [IE 구버전에서는 URL이 같은 파일이 있으면 못 찾는다.](http://stackoverflow.com/a/8636675)

## woff를 내장한 `@font-face` 준비

이제 `webfont.woff.css`를 준비해 보자. `woff` 파일의 base64 버전을 만들어야 하는데, 리눅스 터미널을 사용하고 있다면 간단하게 만들 수 있다.

    base64 NanumGothic-Regular.woff -w 0 > NanumGothic-Regular.base64.txt

위 명령어로 줄바꿈하지 않은 base64 텍스트를 얻을 수 있다. `-w 0`이 줄바꿈하지 말라는 옵션이다.

[윈도우에선 CERTUTIL이라는 프로그램을 사용](http://stackoverflow.com/a/16946681)하면 되나 보다.

    certutil -encode NanumGothic-Regular.woff NanumGothic-Regular.base64.txt

base64 인코딩으로 웹폰트를 첨부한 CSS 파일 내용은 아래와 같을 것이다. base64 인코딩 텍스트가 무지하게 길기 때문에 아래 코드에선 중략했다. 가로가 길기 때문에 `format("woff")` 코드도 줄바꿈했다.

```css
@font-face {
  font-family: "Nanum Gothic";
  font-style: normal;
  font-weight: 500;
  src: url(fonts/NanumGothic-Regular.eot); /* for IE8 */
  src: url("data:application/font-woff;base64,d09GRgAB...중략...==")
       format("woff");
}
```

다시 설명하자면, `url()` 안에 `data:application/font-woff;base64,`라고 쓰고 그 뒤부터 base64 인코딩 문자열을 넣으면 된다. 외부 파일 경로를 넣지 않고 base64 인코딩을 넣는 기법인데, `<img src="data:image/png;base64,...==">` 하는 식으로 쓸 수도 있고, `background-image: url(data:image/png;base64,...==)` 하는 식으로 사용할 수도 있다. 간단한 불릿 같은 것은 요청수를 줄이기 위해 이렇게 사용하는 경우가 꽤 있다.

woff 포맷 앞에는 format 꼬리가 없는 eot를 넣었다. 로컬 스토리지는 지원하지만, woff는 지원하지 않는 IE8을 위한 최소한의 조치다.[^fn6]

사실 woff2를 내장한 CSS, eot를 내장한 CSS 식으로 파일들을 준비하고 js에서 분기시킬 수도 있을 것이다. 스매싱 매거진 팀은 그렇게 하지 않았고, 나도 그렇게 하지 않았다.

## 자바스크립트

이제 파일 두 개가 준비됐으니, 자바스크립트를 사용해 보자. 아래 코드를 차근차근 살펴 보는 수밖에 없겠다. 주석을 달았다.

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

    // localStorage 에 글꼴이 저장돼 있거나, 네이티브 브라우저 캐시를 이용해 저장했다면...
    if ((window.localStorage && localStorage.font_css_cache) || document.cookie.indexOf('font_css_cache') > -1) {
        // 캐시된 버전을 사용한다.
        injectFontsStylesheet();
    } else {
        // 아니면, 페이지 로딩을 막지 않고 기다렸다가 웹폰트를 받는다.
        on(window, "load", injectFontsStylesheet);
    }

    /**
     * css 파일이 브라우저에 저장됐는지 확인.
     * @param href
     * @returns {Storage|string|*|boolean}
     */
    function fileIsCached(href) {
        return window.localStorage && localStorage.font_css_cache && (localStorage.font_css_cache_file === href);
    }

    /**
     * 실제 css 내용을 넣는 코드
     */
    function injectFontsStylesheet() {
        // 로컬 스토리지나 ajax를 지원하지 않는 구형 브라우저라면 link 요소를 만들어서 head에 때려 박는다.
        // 이 때는 css_href_normal을 사용한다.
        if (!window.localStorage || !window.XMLHttpRequest) {
            var stylesheet = document.createElement('link');
            stylesheet.href = css_href_normal;
            stylesheet.rel = 'stylesheet';
            stylesheet.type = 'text/css';
            // 네이티브 브라우저 캐시 사용. 서버에 만료일을 잘 설정해 두자.
            document.getElementsByTagName('head')[0].appendChild(stylesheet);
            // 쿠키에 표시한다.
            document.cookie = "font_css_cache";

            // 구형 브라우저가 아니라면
        } else {
            // 로컬 스토리지에 캐시한 버전이 있다면 그걸 쓴다
            if (fileIsCached(css_href)) {
                injectRawStyle(localStorage.font_css_cache);
                // 아니면, ajax 로 불러온다.
            } else {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", css_href, true);
                // ajax 에서 addEventListener 나 attachEvent 를 지원하지 않는 IE8을 위한 조치
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        // css 내용을 집어넣는다.
                        injectRawStyle(xhr.responseText);
                        // 그리고 css 내용을 로컬 스토리지에 넣어 나중에도 쓸 수 있게 한다.
                        // 기존에 저장된 것이 있다면 덮어쓴다는 점을 주의.
                        localStorage.font_css_cache = xhr.responseText;
                        localStorage.font_css_cache_file = css_href;
                    }
                };
                xhr.send();
            }
        }
    }

    /**
     * css 텍스트를 집어넣는 간단한 툴
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



[^fn1]: FOUT는 "기본 글꼴 깜빡임(flash of unstyled text)"의 약어다. 웹 폰트를 아직 다 다운로드하기 전에, 기본 글꼴로 콘텐츠가 표시됐다가 웹 폰트를 다 다운로드하면 웹 폰트로 전환되면서 내용이 한 번 깜빡이는 현상을 말한다. 2009년에 폴 아이리쉬(Paul Irish)가 이 이름을 붙였다([Fighting the @font-face FOUT](http://www.paulirish.com/2009/fighting-the-font-face-fout/)). 이후 각양 각색의 해결책은 CSS-TRICKS의 [FOUT, FOIT, FOFT](https://css-tricks.com/fout-foit-foft/) 에 잘 나와 있다.  
현재는 모든 주요 브라우저가 FOIT로 불리는 해결책을 적용한 상태다. FOIT란 "텅 비어있다가 나타남(Flash of Invisible Text)" 방식이다. 이 방식은, 웹 폰트를 전부 다운로드하기 전까지는 글자를 아예 표시하지 않다가 다운로드가 끝나면 표시하는 방법인데, 개인적으론 FOUT보다 더 짜증난다. 한국어 웹 폰트는 용량이 커서, 다운로드 속도가 느리면 아주 오랫동안 화면이 비어 있게 된다.  
스매싱 매거진이 사용한 방법은 페이지를 처음 불러올 때 FOUT를 한 번 허용하고(즉, 기본 글꼴로 콘텐츠를 읽을 수 있게 놔두다가 한 번 깜빡 하면서 웹 폰트로 전환하고), 그 뒤 웹 폰트를 `localStorage`에 저장해서 이어지는 페이지부터는 안정적으로 FOUT 현상을 회피하는 방법이다. 위 CSS-TRICKS의 글에서 맨 아래 소개돼 있다.

[^fn2]: 내가 인용한 링크를 클릭하면 글의 '웹 폰트 지연(Deferring Web Fonts)' 항목으로 이동하게 되는데, '웹 폰트 지연' 파트 외에도 글 전체가 다 좋다. 맨 앞부터 읽어 보는 것도 추천한다. 2014년 9월에 씌어져 그리 오래 된 글도 아니고, 여러 모로 웹사이트 최적화에 대한 통찰을 준다.

[^fn3]: woff2를 만드는 방법은 두 가지다. [google/woff2](https://github.com/google/woff2)를 컴파일해서 터미널에서 ttf를 woff2로 만드는 방법이 있고, ttf to woff2 같은 검색어로 검색해서 웹 서비스를 이용하는 방법이다. 당연한 이야기일 테지만, 개발자라면 전자를 사용해 볼 수 있겠지만, 일반인이라면 검색해서 해 보는 수밖에 없다. 그런데 웹 서비스들은 용량 제한이 있더라. 물론 400kb 정도가 제한이니 경량화 버전을 사용한다면 용량이 문제되진 않을 것 같다.

[^fn4]: 자세한 내용은 [한글 웹 폰트 경량화해 사용하기](http://blog.coderifleman.com/post/111825720099/%ED%95%9C%EA%B8%80-%EC%9B%B9-%ED%8F%B0%ED%8A%B8-%EA%B2%BD%EB%9F%89%ED%99%94%ED%95%B4-%EC%82%AC%EC%9A%A9%ED%95%98%EA%B8%B0)와 [스포카 한 산스와 글꼴 경량화](https://spoqa.github.io/2015/10/14/making-spoqa-han-sans.html)에 잘 나와 있으니 참고.

[^fn5]: base64는 말 그대로 하면 64진법. 위키피디아의 [베이스64](https://ko.wikipedia.org/wiki/%EB%B2%A0%EC%9D%B4%EC%8A%A464) 항목에 설명이 잘 돼 있으니 뭔지 궁금하면 참조하라.

[^fn6]: `webfont.normal.css`에 붙어 있는 주석은 Fontspring의 ['Further Hardening Of The Bulletproof Syntax'](http://blog.fontspring.com/2011/02/further-hardening-of-the-bulletproof-syntax/)를 참고한 것인데, 거길 보면 `format('embedded-opentype')`이 붙어 있는 것이 IE6-8을 위한 것이라고 씌어 있다. 그런데 IE11의 IE8 모드로 돌렸을 때는 `format` 표시가 없는 경우에 폰트를 인식하더라. 그래서 일단 경험적인 것을 택했다. 나중에 XP의 IE8에서 테스트할 기회가 있으면 하겠는데... 굳이 세팅해서 하진 않으련다.
