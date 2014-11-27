---
title: 'SVG 활용 3 &#8211; 웹 문서에 SVG를 넣는 다양한 방법, 온갖 예외 피하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/11213
daumview_id:
  - 50333742
categories:
  - 웹 퍼블리싱
tags:
  - SVG 활용
  - 마법 나무 테마
---
이 글은 [블로그 디자인을 개편하면서 얻은 경험을 공유하는 글][1]이다. 첫 번째로, [SVG 활용에 대한 글][2]을 여러 편으로 나눠서 쓰고 있다.

## 필요에 따라 선택하기

SVG를 웹문서에 넣는 방법은 다양하다. 앞선 글에서 밝혔듯이 HTML 태그처럼 인라인으로 넣을 수도 있고, `img`, `iframe`, `object`, `embed` 태그를 이용해서 넣을 수도 있다. 필요에 따라 선택을 하면 된다.

나는 SVG에 링크를 걸고, `:hover` 상태에 따라 스타일이 변하게 하고, CSS3 transition 효과를 주고 싶었다. 인라인 SVG를 이용하면 쉽게 할 수 있다.

`object`나 `iframe`으로 넣어도 원하는 효과를 얻을 방법이 있긴 하다. SVG 내부에서 링크를 걸고, script나 SVG 애니메이션을 사용하는 방법이다. 확실히 번거로운 방법이라서 이 방법을 택하지는 않았다. `object`나 `iframe` 안의 링크를 검색엔진이 잘 긁어 갈지도 확신이 없었다.

그래서 일단은 SVG 파일을 만들고 인라인 태그로 넣었다. (지금은 트래픽 때문에 `img`로 변경했다.)

## 인라인 태그로 넣기

인라인 태그로 넣는다는 것은 HTML 문서에 SVG도 그냥 태그로 포함시킨다는 말이다. `div`나 `ul`을 사용하듯, `svg` 태그를 사용한다는 말이다. 처음엔 내 블로그의 소스를 아래처럼 해 놨었다. 이런 방식을 인라인 방식이라고 부르는 것이다.

    <li>
      <a href="http://mytory.net/feed/rss" title="RSS">
        <svg data-png-path="/images/icon-rss.png" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
          <circle fill="#34495E" cx="12" cy="12" r="12"/>
          <path fill="#FFFFFF" d="M7.029,11.515c1.571,0,3.047,0.615,4.157,1.73c1.112,1.116,1.723,2.604,1.723,4.187h2.421
            c0-4.596-3.724-8.335-8.301-8.335V11.515L7.029,11.515z M7.033,7.225c5.599,0,10.154,4.58,10.154,10.208h2.42
            c0-6.962-5.641-12.627-12.574-12.627L7.033,7.225L7.033,7.225z M10.38,15.742c0,0.926-0.75,1.677-1.676,1.677
            c-0.926,0-1.676-0.751-1.676-1.677c0-0.924,0.75-1.676,1.676-1.676C9.629,14.066,10.38,14.816,10.38,15.742z"/>
        </svg>
      </a>
    </li>
    

(위 코드는 RSS 아이콘 코드인데, `circle` 태그와 `path` 태그로 이뤄져 있다. `circle`은 원이고, `path`는 원이 아닌 대부분의 것을 표현하는 태그다. 좌표 묶음이 `d` 속성에 들어가 있는 것을 볼 수 있다.)

SVG 파일을 텍스트 편집기에서 연 뒤 xml 선언을 하는 부분은 빼고 `svg` 태그 시작부터 끝까지만 복사해서 사용하면 된다.

## 인라인 태그 방식

이 방식의 장점은 앞서 밝힌대로 일반 HTML 태그처럼 HTML 문서의 script와 CSS로 제어할 수 있다는 것이다.

단점은? 이미지 캐시가 안 된다는 점이다. HTML 문서의 일부기 때문이다. 그러니까 정확히 말하면 문서 전체로만 캐시가 되는 거다. 1번 글을 보고 2번 글로 넘어갔을 때, 만약 이미지가 `img`/`object`/`emebed`/`iframe` 태그로 들어가 있다면 이미지는 캐시돼 있기 때문에 문서만 새로 읽어들이고, 이미지는 캐시된 것을 사용하게 된다. 그런데 인라인 SVG는 문서의 일부기 때문에 그냥 새로운 문서를 읽는 과정에서 함께 새로 읽어들이게 되는 것이다.

예컨대, 한 사람이 들어와서 10페이지를 보고 나간다면, 이미지가 캐시되는 경우 이미지 트래픽은 1회만 소모된다. 심지어 이미지를 드롭박스에 넣어서 쓰면 유료 트래픽 소모는 0이다([드롭박스의 공개 링크 하루 트래픽 허용량은, 무료 계정의 경우 10기가][3]다).

내가 사용하는 SVG를 모두 gzip으로 압축하면 28kb가 나오는데, SVG를 인라인으로 박은 경우에 10페이지 보면 속절없이 280kb가 소모된다. 이 탓에 블로그를 인라인 SVG로 개편한 뒤 계속 트래픽이 초과됐다. 10일을 버티다가 결국 `img` 태그를 이용해 집어넣는 방식으로 변경했다. 로고 위에 마우스를 댔을 때 색이 변하게 하는 것은 포기했다.

단점 하나를 더 말하자면, iOS의 오페라 미니7이 인라인 SVG를 지원하지 않는다는 점이다.

## 너비와 높이를 원하는대로 변경하고 싶다면

`svg` 태그에 적용하는 CSS의 `width`와 `height` 값이 작동하려면 `svg`에 `viewBox`란 속성이 있어야 하고, 높이와 너비를 모두 지정해 줘야 한다. **높이를 `auto`로 하면 안 된다.**

물론 `img` 태그는 예외다. SVG에 `viewBox` 속성만 있다면 `height`를 `auto`로 줘도 모든 브라우저에서 제대로 작동한다.

정확히 말하면, 현재 내가 사용하는 크롬29와 파이어폭스 24에서는 `viewBox` 속성이 없어도 `img` 태그는 알아서 이미지를 늘린다. 그런데, IE9, IE10은 `viewBox`가 없으면 `img` 태그라 해도 이미지를 늘리지 않는다.

`viewBox` 속성은 SVG의 캔버스 사이즈를 지정하는 속성이고, 아래처럼 쓴다. 물론, 일러스트레이터에서 작업했다면 기본적으로 들어가 있을 것이다.

    <svg viewBox="0 0 84 84" ...>
    

앞의 숫자 두 개는 사각형 좌측 상단의 x,y값이고 뒤의 숫자 두 개는 너비와 높이다. 그러니까 좌표값 0 0에서 시작하는 너비 84px, 높이 84px의 캔버스를 만들라는 이야기다. 이 속성을 줘야 css에서 `svg`, `object`, `embed` 태그에 매긴 높이와 너비가 적용된다. 그렇지 않으면 캔버스만 늘어나고 실제 이미지는 커지지 않는다.

`iframe`의 경우엔 크롬29와 사파리6, iOS7 모바일 사파리(즉, 웹킷 계열)에선 이미지가 커지고, 파이어폭스24와 IE9, IE10, iOS 오페라 미니7에선 커지지 않는다.(각 브라우저 버전은 그냥 현재 내가 사용하는 버전을 말하는 것뿐이다. 특정한 의미가 있는 버전은 아니다. 판단할 때 도움이 되라고 적어 둔 것이다.)

아래는 각 삽입 태그별로 `viewBox` 속성 유무, `height` 지정 유무에 따른 네 가지 경우를 보여 주는 예제다. 태그별로 script가 작동하는지, CSS가 작동하는지도 알 수 있다.

**[▶SVG 포함하기 예시 링크][4]** : 각 브라우저로 들어가서 체크해 보기 바란다.

동그라미가 20개나 그려져 있어서 복잡하게 느껴질 텐데, 자세히 볼 건 없다. 그냥 이거만 외우면 된다.

**&#8220;SVG를 원래 크기가 아닌 다른 크기로 사용하고 싶은 경우 `img` 빼고는 `width`, `height`를 모두 특정값으로 지정해 줘야 한다.&#8221;, &#8220;`img`에선 `script`가 작동하지 않는다.&#8221;**

`viewBox`는 일러스트레이터 같은 SVG 제작 프로그램이 알아서 넣을 테니 신경쓰지 않아도 될 것이다.

## `img`로 넣기

이제부터 태그로 삽입하는 방법을 설명한다.

이미지 태그를 이용해 넣는 것은 일반적인 이미지들을 넣는 것과 똑같다.

    <img src="vector-img.svg" alt="">
    

그냥 이런 식으로 넣으면 된다.

`img`를 이용해 SVG를 넣으면, SVG 안의 script가 전혀 작동하지 않게 된다. style은 작동한다.

## `object`, `embed`, `iframe`으로 넣기

<pre>&lt;object data="vector-img.svg" type="image/svg+xml"&gt;&lt;/object&gt;</pre>

<pre>&lt;embed src="vector-img.svg" type="image/svg+xml"&gt;</pre>

<pre>&lt;iframe src="vector-img.svg"&gt;&lt;/iframe&gt;</pre>

`object`와 `emebed`로 넣을 때는 `type`을 `image/svg+xml`로 해 주는 게 특이사항이다. `object`로 넣을 때 파일 경로는 `src`가 아니라 `data` 속성에 적어 준다는 점도 기억하자.

위 세 개의 태그를 사용하면 밖에서 감싸는 `a` 태그가 작동하지 않는다. 밖에서 건 링크가 작동하는 SVG는 인라인 SVG와 `img` 태그밖에 없다. 물론  [SVG 파일 안에서 링크를 거는 방식][5]을 사용할 수 있다.

## 요약정리

<table>
  <tr>
    <th>
    </th>
    
    <th>
      scale
    </th>
    
    <th>
      외부 <code>a</code> link
    </th>
    
    <th>
      <code>height:auto</code>
    </th>
    
    <th>
      CSS style
    </th>
    
    <th>
      script
    </th>
  </tr>
  
  <tr>
    <th scope="row">
      inline <code>svg</code>
    </th>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
  </tr>
  
  <tr>
    <th scope="row">
      <code>img</code>
    </th>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
    
    <td>
      x
    </td>
  </tr>
  
  <tr>
    <th scope="row">
      <code>object</code>
    </th>
    
    <td>
      o
    </td>
    
    <td>
      x
    </td>
    
    <td>
      x
    </td>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
  </tr>
  
  <tr>
    <th scope="row">
      <code>embed</code>
    </th>
    
    <td>
      o
    </td>
    
    <td>
      x
    </td>
    
    <td>
      x
    </td>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
  </tr>
  
  <tr>
    <th scope="row">
      <code>iframe</code>
    </th>
    
    <td>
      x(webkit o)
    </td>
    
    <td>
      x
    </td>
    
    <td>
      x
    </td>
    
    <td>
      o
    </td>
    
    <td>
      o
    </td>
  </tr>
</table>

 [1]: http://mytory.net/archives/tag/%eb%a7%88%eb%b2%95-%eb%82%98%eb%ac%b4-%ed%85%8c%eb%a7%88
 [2]: http://mytory.net/archives/tag/svg-%ed%99%9c%ec%9a%a9
 [3]: http://mytory.net/archives/2314
 [4]: http://mytory.net/wp-content/uploads/svg-ex/
 [5]: http://tutorials.jenkov.com/svg/a-element.html