---
title: '코드를 그대로 출력해 주는 html 태그 &#8211; xmp'
author: 안형우
layout: post
permalink: /archives/18
aktt_notify_twitter:
  - yes
daumview_id:
  - 37268628
categories:
  - 웹 퍼블리싱
tags:
  - HTML
---
코드를 쓴 그대로 출력해 주는 태그는 xmp다. 다음 문서를 참고하라.

<http://www.htmlcodetutorial.com/_XMP.html>

보면 알겠지만, 이 태그는 사용 중지될 예정이다.

> This tag is officially deprecated. That means that this tag is being phased out, and it is strongly suggested that you not use it.

이렇게 써 있는데, 구글 번역기를 돌려보니 이렇게 나온다.

> **이 태그는 공식적으로 사용중지됨입니다. 즉,이 태그 아웃되는 단계이고, 그 말은 당신이 그것을 사용하지 [않기를] 강력히 추천합니다.**
> 
> <p style="text-align: right; ">
>   (꺽쇠 안은 내가 보완한 거다.)
> </p>

그러니까 그냥 알아 두고 사용하지는 마라. 간혹 이 태그가 사용된 경우도 볼 수 있으니까.

찾아보니까 W3C는 xmp 코드 대신 pre 태그를 사용하라고 권한다. (pre 태그는 줄바꿈만 그대로 보여 주는 태그다. &#8216;<&#8216;같은 글자는 < 이런 식으로 써 줘야 한다.)

다른 정보는 못 찾았는데, xmp가 코드를 그대로 보여주는 태그라 문제가 생기는 일이 종종 있나보다. <xmp>로 감싸면 아마 php나 java 코드 같은 것들도 그냥 노출되는 것 같다. 자세한 정보는 영어로 된 다음 사이트에서 볼 수 있을 듯하다.

<http://www.webmasterworld.com/forum21/8558.htm>