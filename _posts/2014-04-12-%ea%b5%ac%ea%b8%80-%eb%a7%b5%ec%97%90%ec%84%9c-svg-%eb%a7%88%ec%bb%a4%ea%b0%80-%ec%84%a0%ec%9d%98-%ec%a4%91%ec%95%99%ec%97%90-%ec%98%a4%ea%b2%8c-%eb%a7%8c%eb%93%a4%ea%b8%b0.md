---
title: 구글 맵에서 SVG 마커가 선의 중앙에 오게 만들기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12907
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/google-map-marker.md
categories:
  - 기타
  - 웹 퍼블리싱
tags:
  - API
  - google map
  - plain javascript
---
구글 지도는 굉장히 유연하게 커스터마이징을 할 수 있도록 API를 제공한다. [Google Maps JavaScript API v3][1]에 가 보면 다 있다.

선을 표시하고 마커를 찍는 건 기본적인 기능인데, 문제는 구글에서 기본으로 제공하는 화살표 마커를 사용하면 선 위에 마커가 놓이는 게 아니라 마커 끄트머리랑 선이 닿게 된다는 거다. 나 같은 사람은 별 문제 없다고 생각하고 사용하겠지만, 클라이언트들 중 민감한 사람은 마커를 선 위에 올려달라고 한다. 뭐 그런 것까지 신경쓰나 하는 생각이 들기도 하지만, 아예 틀린 말은 아니니 그렇게 하는 걸 시도해 봤다.

비트맵 이미지로 마커를 사용하는 경우에는 회전각을 표시할 수 없다. 회전각을 표시하지 않아도 되는 경우엔 그냥 비트맵 이미지를 사용해도 나쁠 거 없을 거다.

결과물은 아래 작업 전과 작업 후 이미지를 참고하라. 좌측이 작업 전, 우측이 작업 후 이미지다.

![][2]

## 구글이 제공하는 기본 마커 아이콘

마커의 아이콘을 지정하는 기본 문법은 아래와 같다.

    marker = new google.maps.Marker({
      position: new google.maps.LatLng(-37, 127),
      icon: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10
      },
      map: map
    });
    

`icon` 항목의 `path`를 보면 `google.maps.SymbolPath.CIRCLE`이라고 들어 있다. 이건 구글이 기본적으로 제공하는 SVG 아이콘이다. [구글이 기본 제공하는 아이콘은 총 세 개][3]다. 다섯 개가 있는데 나머지 두 개는 화살표의 방향만 바꾼 것이므로 모양으로는 의미가 없다.

*   BACKWARD\_CLOSED\_ARROW
*   BACKWARD\_OPEN\_ARROW
*   CIRCLE
*   FORWARD\_CLOSED\_ARROW
*   FORWARD\_OPEN\_ARROW

원은 기본적으로 경로의 한 가운데 오게 되는데, 화살표들은 화살표 끝이 경로에 오게 되는 문제가 있다.

## SVG를 그리자

구글 API 문서에 보면 마커로 [벡터 아이콘(SVG)을 사용하는 방법][4]이 나와 있다. 이 벡터 아이콘을 이용해서 마커의 위치를 조정한 것이다. 설명은 이렇다.

> 벡터 경로를 표시하려면 원하는 경로를 사용하여 `Symbol` 객체 리터럴을 마커의 `icon` 속성으로 전달합니다 [`google.maps.SymbolPath`][3]에서 사전 정의한 경로 중 하나를 사용하거나 [SVG 경로 표기법][5]을 사용하여 맞춤 경로를 정의할 수 있습니다.

그래서 SVG 경로 표기법을 진지하게 읽었다. 그래서 대충 알게 된 사실을 설명한다. SVG의 경로 표시 기법은 아래와 같다.

    M 0 0
    L 2 0
    L 1 2
    z
    

`M`과 `L`은 각각 moveto와 lineto를 의미하는 키워드다. 그 뒤에 나오는 두 숫자는 각각 좌측 상단부터 표시한 x,y 좌표다. `z`는 현재 subpath의 작업이 끝났다는 것을 의미하며 첫 번째 점과 마지막 점을 연결하라는 뜻이다. 구체적이고 자세한 설명까지 기대하진 마시라. 한 SVG가 여러 개의 subpath로 이루어지는가 보다 하고 추측 정도나 하면 되겠다.

그러니까 위의 코드를 한 줄씩 살펴 보면 이렇다.

*   `M 0 0`: x=0, y=0 좌표로 이동! 점을 찍어라! (물론 점은 모양으로 표현되지는 않는다. 실제 점을 그리고 싶다면 작은 원을 그려야 겠지.)
*   `L 2 0`: x=0, y=0 좌표(바로 전 좌표)에서 x=2, y=0 좌표까지 선을 그어라! 즉, 2&#215;2 사각형이 있다고 상상하고, 좌측 위 모서리에서 우측 위 모서리까지 선을 긋는 걸 상상하면 되겠다.
*   `L 1 2`: 바로 전 좌표에서 x=1, y=2 좌표까지 선을 그어라!
*   `z`: 바로 전 좌표에서 첫 좌표(0,0)로 선을 긋고 끝!

자, 이러면 역삼각형이 그려진다.

SVG 문법에서 이걸 넣는 방법은 `path` 태그의 `d` 속성으로 넣는 것이다. 아래처럼 말이다. 위에 쓴 것처럼 여러 줄로 넣어도 되고 한 줄로 넣어도 된다.

    <path d="M 0 0 L 2 0 L 1 2 z"
            fill="yellow" stroke="black" stroke-width="1" />
    

이게 역삼각형이 맞는지 확인하고 싶으면 아래 코드를 복사해서 에디터에 붙여 넣고 `example.svg` 따위로 저장한 다음 브라우저로 열어 봐라. (브라우저 위로 드래그해 떨구면 열린다.) 사이즈를 2픽셀로 하면 너무 작게 나올 테니 100을 곱해서 표현한 코드다.

    <?xml version="1.0" standalone="no"?>
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" 
      "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
    <svg width="200px" height="200px" viewBox="0 0 200 200"
         xmlns="http://www.w3.org/2000/svg" version="1.1">
      <title>역삼각형 예시</title>
      <rect x="0" y="0" width="200" height="200"
            fill="none" stroke="black" />
      <path d="M 0 0 L 200 0 L 100 200 z"
            fill="yellow" stroke="black" stroke-width="1" />
    </svg>
    

참고로 `svg` 태그 안의 `viewBox` 속성이 캔버스를 지정하는 태그다. `rect`는 사각형을 그려 주는 놈이다.

그리고 위 SVG를 구글 맵에서 사용하려면 아래처럼 적어 주면 된다.

    marker = new google.maps.Marker({
      position: new google.maps.LatLng(-37, 127),
      icon: {
        path: 'M 0 0 L 2 0 L 1 2 z',
        scale: 10
      },
      map: map
    });
    

## 구글 맵은 아이콘의 어느 부분을 좌표에 오게 할까?

자, 그럼 이제 구글 맵의 입장으로 가자. 38, 100이라는 GPS 좌표가 있다고 하자. 2&#215;2짜리 사각형에 들어있는 마커 아이콘이 있다. 좌표에는 이 사각형의 어느 부분을 닿게 할까? 답은 (0,0) 좌표다. 그러니까 위에서 그린 사각형을 구글맵에 놓게 되면 좌측 위 모서리가 선의 경로에 닿게 되는 거다. 회전 역시 (0,0) 좌표를 중심으로 하게 된다.

그러면 우리가 취할 수 있는 방법은? 마이너스 좌표를 사용하는 것이다. (0,0) 좌표가 캔버스의 중앙에 오게 하면 되는 거다. 어떻게 하라는 건가?

    M -1 -1
    L 1 -1
    L 0 1
    z
    

이렇게 x좌표 y좌표에서 모두 1씩을 빼 주면 (0,0) 좌표가 캔버스의 중앙에 오게 된다. 그리고 이렇게 하면 구글맵에서 경로를 그리면 아이콘의 중앙이 경로 위에 놓이게 된다.

 [1]: https://developers.google.com/maps/documentation/javascript/tutorial?hl=ko
 [2]: https://dl.dropboxusercontent.com/u/15546257/blog/mytory/google-map-marker-position.png
 [3]: https://developers.google.com/maps/documentation/javascript/reference?hl=ko#SymbolPath
 [4]: https://developers.google.com/maps/documentation/javascript/overlays?hl=ko#VectorIcons
 [5]: http://www.w3.org/TR/SVG/paths.html#PathData