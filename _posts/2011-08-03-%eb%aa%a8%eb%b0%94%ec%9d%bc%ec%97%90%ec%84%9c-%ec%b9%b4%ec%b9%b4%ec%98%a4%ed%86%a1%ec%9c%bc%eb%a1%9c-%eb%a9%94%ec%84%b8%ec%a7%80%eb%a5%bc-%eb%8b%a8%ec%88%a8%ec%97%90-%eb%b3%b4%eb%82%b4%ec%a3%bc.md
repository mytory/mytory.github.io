---
title: '이 페이지를 카카오톡으로 보내기 &#8211; 카카오링크'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1563
aktt_notify_twitter:
  - yes
daumview_id:
  - 36689235
categories:
  - 서버단
tags:
  - API
---
오늘 재밌는 걸 발견했다.

아래 코드를 보자.

<pre>&lt;a href="kakaolink://sendurl?msg=this-is-message&url=http://mytory.local&appid=mytory&appver=0.1"&gt;카카오톡으로 보내기&lt;/a&gt;</pre>

이런 코드를 웹페이지에 넣는다고 하자.

그러면? msg 변수에 넣어 준 놈이 메세지로 간다. url도 같이 붙어서 간다.

아래 링크를 카카오톡이 깔린 스마트폰으로 눌러 보시라. 브라우저에선 눌러 봐야 소용 없다.

[카카오톡으로 이 블로그 보내기][1]

재밌는 거 알았다 ㅋ

## 각 변수에 들어가는 내용은?

*   **msg :** 당연히 메세지다. URL인코딩을 해 줘야 한다. 예제 코드에서는 URL 인코딩을 안 하려고 영어를 썼는데, 한글을 보내려면 당연히 해야 한다.
*   **url:** 당연히 URL이다. 그냥 URL을 넣으면 된다.
*   **appid:** 이건 왜 있는지 잘 모르겠는데, 여튼 아이폰 어플마다 있는 고유 id다. 카카오링크는 외부 앱에서 카카오톡으로 링크를 보낼 때 사용하는 거다. (즉, 기본적으로는 웹용은 아니라는 거다.) 이 때 이 링크를 실행하게 되는 어플의 고유 id를 적으라는 거다. 이게 없으면 에러난다. 무슨 검증을 하고 그런 게 아니므로 알아서 대충 적자. 보통 보면 com.company.app 이런 식이더라.
*   **appver:** 이건 링크를 구동하게 되는 앱의 버전이다. 이것도 대충 때려 넣으면 된다.

이 API는 [카카오링크 API 항목][2]에서 볼 수 있다. 거기 가면 앱에 넣는 방법도 예제와 함께 친절히 설명돼 있다. 아이폰, 안드로이드 다 된다.

관리하는 사이트에 적용해 볼까 생각하고 있다. ㅋㅋㅋ

 [1]: kakaolink://sendurl?msg=%EB%85%B9%ED%92%8D%EC%9D%98%20%EB%B8%94%EB%A1%9C%EA%B7%B8%20'%EC%9B%B9%EC%9C%BC%EB%A1%9C%20%EB%A7%90%ED%95%98%EA%B8%B0'%EC%9E%85%EB%8B%88%EB%8B%A4.&url=http://mytory.local&appid=mytory&appver=0.1
 [2]: http://www.kakao.com/link/api?tab=mobileweb