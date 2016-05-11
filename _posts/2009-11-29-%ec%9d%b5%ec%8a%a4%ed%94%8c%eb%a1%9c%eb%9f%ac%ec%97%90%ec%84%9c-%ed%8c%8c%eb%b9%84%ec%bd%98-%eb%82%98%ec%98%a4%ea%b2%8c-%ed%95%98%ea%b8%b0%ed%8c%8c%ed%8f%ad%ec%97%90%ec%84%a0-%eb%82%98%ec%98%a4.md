---
title: 익스플로러에서 파비콘 나오게 하기(파폭에선 나오는데 익스에선 안나올 경우)
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/100
aktt_notify_twitter:
  - yes
daumview_id:
  - 37218030
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/100-ie-favicon.md
categories:
  - 웹 퍼블리싱
tags:
  - IE:인터넷 익스플로러
---
## 어떻게 하면 익스플로러에서도 파비콘이 나오는가?

보통은 파비콘의 파일형식을 `gif`로 해도 된다. `png`으로 해도 된다. ico로 해도 된다.

그런데 익스플로러는 `ico` 중에서도 특별한 `ico` 형식으로 해야 되는 것이었다. 예컨대, 내 경험으로는 [converticon.com][1]에서 만든 `ico` 파일은 무슨 이유인지는 모르겠으나 익스에서 뜨지 않는다.

정확히 어떤 `ico`를 원하는 것인지는 모르겠으나, [&#8216;IE7 파비콘 설정후 적용되지 않을 경우는?&#8217;][2]이란 글의 저자는 포토샵 플러그인을 사용하면 된다고 한다.

## 아이콘 파일 저장 포토샵 플러그인

포토샵 플러그인은 <http://www.telegraphics.com.au/svn/icoformat/trunk/dist/README.html>의 오른쪽 상단 [Download the latest version here.][3]에서 받을 수 있다.

이부분을 클릭하면 아주 복잡한 부분이 나오는데, 운영체제별 다운로드 종류다. 자기 운영체제에 맞는 것을 고르면 되지만 대부분은 윈도우XP일 것이다. 윈도우XP를 사용할 경우 [Windows (standard ICO/favicon)][4]을 선택하면 된다.

![][5]아직도 바로 다운로드되지는 않는다. 뭔가 제출하라고 나온다. 가볍게 무시하고 그냥 오른쪽 하단의 Download 버튼을 누르면 된다. ![][6]다운받으면 `ICOFormat-1.6f9-win.zip`이라는 파일이 있을 것이다. 풀어 본다. 그러면 세 가지 파일이 나온다. 그 중 `ICOFormat.8bi`를 복사해서 포토샵의 플러그인 폴더에 넣으면 된다.

포토샵 플러그인 폴더는 나 같은 경우 `C:\Program Files\Adobe\Photoshop 7.0\Plug-Ins` 였고, 나는 `Icon`이라는 폴더를 만든 다음 그 안에 집어넣었다.

그렇게 하고 포토샵에서 아이콘으로 만들 그림파일을 불러온 다음 &#8216;새 이름으로 저장'(`Ctrl+Shift+S`)을 선택하고 아래 그림과 같이 ICO 포맷을 선택한다.

![][7]

그리고 그것을 파비콘으로 `<head></head>` 사이에 집어넣어 주면 되는 것이다.

다 알겠지만 저 헤드 부분은 눈에 보이지는 않지만, 중요한 정보들을 넣어주는 곳이다. 더 길게 설명하진 않겠다.

간단히 파비콘 코드만 말하자면 다음과 같다.

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    

`xhtml`을 사용한다면 맨 뒤에 `/>`로 끝내는 것을 잊지 말기 바란다.

다른 방법도 있다. 그냥 웹사이트의 루트 폴더(`http://url.com/`에 해당하는 폴더)에 `favicon.ico`로 파일명을 붙여서 넣어 두면 코드에 박지 않아도 알아서 긁어 간다.

## 다른 포맷의 경우엔?

png나 svg 포맷은 아래처럼 넣는다.

    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="icon" type="image/svg+xml" href="favicon.svg"/>

 [1]: http://converticon.com/
 [2]: http://bluebreeze.co.kr/313
 [3]: http://www.telegraphics.com.au/sw/#icoformat
 [4]: http://www.telegraphics.com.au/sw/dl.php?file=ICOFormat-1.6f9-win.zip
 [5]: /uploads/legacy/old-images/1/cfile22.uf.1249634F4D4BC8712D1719.jpg
 [6]: /uploads/legacy/old-images/1/cfile26.uf.155BBC4D4D4BC871259596.jpg
 [7]: /uploads/legacy/old-images/1/cfile30.uf.154B164C4D4BC8712CC89A.png