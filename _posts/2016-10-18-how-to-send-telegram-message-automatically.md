---
title: '텔레그램으로 웹사이트 새 글 발행 알림 보내기(봇과 채널 이용)'
layout: post
tags:
  - snippet
author: 안형우
---

## 장점

텔레그램 메신저로 웹사이트 새 글 발행 알림을 보내는 것은 다음 세 가지 장점이 주요하다.

1. 멀티 플랫폼이다.
2. 클라이언트 프로그램을 만들지 않아도 된다.
3. 심지어 서버쪽 코드도 간편하다.


## 기본 개념

텔레그램 봇의 기본 개념을 알고 싶다면 [공식 페이지 설명](https://core.telegram.org/bots)을 보는 게 가장 좋겠다. 

봇으로 할 수 있는 건 무지 많다. 예시로 들고 있는 포브스 같은 곳의 봇은 끝내 준다. 상호작용이 있다.

그러나 여기서 우리가 할 것은 그냥 새 글 알림만 보내 주는 것이니, 매우 일부 기능만 사용하는 것이다. 그만큼 구현도 간편하고 제약도 적다.

예컨대 상호작용을 하려면 사용자의 응답을 받는 우리 웹사이트의 서버도 `https` 프로토콜을 사용해야 한다(그래야 사용자의 응답이 중간에 노출되지 않을 테니). 그러나 일방적으로 보내기만 할 것이라면 우리 웹사이트는 `https`를 사용할 필요가 없다.

마지막으로, 이 문서는 상호작용하는 봇을 만드는 법을 전혀 설명하고 있지 않다. 이 점 염두에 두고 보라.


## 준비

다음 두 단계는 준비된 것으로 친다. 알아서 하자.

1. `@BotFather`를 만나 봇을 만들고 API 코드를 받자.[^fn1] (참고: [6. BotFather](https://core.telegram.org/bots#6-botfather))
2. 공개 채널을 개설하고, 아까 만든 봇을 관리자로 집어넣자.


## 가정

- 내가 만든 봇의 API 코드는 `281680794:AAEQdVBa1aEEPIn9-DQ4LDlIVUSsmtUdiHc`이라고 가정한다.
- 내가 만든 채널의 주소는 `@mytorychannel`이라고 가정한다.


## 개념잡기

웹브라우저로 아래 주소에 접속해 보자(즉, 요청(Request)을 보내 보자).

    https://api.telegram.org/bot{api_code}/sendMessage?chat_id={@channel_name}&text=Hello%20World%21
    
URL을 잘 보면 알겠지만, `sendMessgae`는 명령어다. [명령어 목록](https://core.telegram.org/bots/api#available-methods)은 텔레그램 봇 API를 찾아 보면 될 거다. 

내가 위에서 가정한 내 API 코드와 채널명을 사용하면 실제 주소는 이렇게 나온다. (채널명 앞에 `@`를 붙여야 한다는 걸 유의하라.)

    https://api.telegram.org/bot281680794:AAEQdVBa1aEEPIn9-DQ4LDlIVUSsmtUdiHc/sendMessage?chat_id=@mytorychannel&text=Hello%20World%21
    
아까 봇을 관리자로 집어 넣은 `@mytorychannel`로 "Hello World!"라는 메시지가 오면 성공이다.

개념은 간단하다. URL로 요청을 보내면, 봇이 그대로 한다. 위 예에선 지정한 채팅방으로 메시지를 보내게 한 것이다.


## 구현

구현은 위 과정을 서버단 코드를 이용해 하는 것에 불과하다. PHP로 짠 코드는 이렇다.

    // 재료 준비
    $post_title = "3년 10개월째 사용하는 아이폰 5에서 iOS 10을 돌리는 건 나쁘지 않은 듯";
    $post_url = "http://mytory.net/2016/10/01/latest-iOS-is-good-on-iphone5.html";
    $api_code = '281680794:AAEQdVBa1aEEPIn9-DQ4LDlIVUSsmtUdiHc';
    
    // 보낼 텍스트를 구성. 줄바꿈은 "\n"으로. GET 요청을 할 테니 urlencode.
    $telegram_text = urlencode("※ 새 글이 나왔습니다\n{$post_title}\n{$post_url}");
    $request_url = "https://api.telegram.org/bot{$api_code}/sendMessage?chat_id=@mytorychannel&text={$telegram_text}";
    
    // curl로 접속
    $curl_opt = array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $request_url,
    );
    $curl = curl_init();
    curl_setopt_array($curl, $curl_opt);
    
    // 텔레그램의 응답을 받아서 저장.
    save_telegram_response($post_id, curl_exec($curl));

설명은 주석으로 달았으니 됐고. 

나머지는 이 코드를 응용하는 것에 불과하니 각자 사정에 맞게 활용하면 되겠다.


## 단점과 주의사항

텔레그램 알림에는 단점도 있다. 다음 두 가지 중 특히 **소유권**을 유의하라.

- 2016년 10월 18일 현재 봇과 채널의 소유권을 이전할 수 없다. 최초로 만든 사람이 모든 권한을 가진다. 이게 좀 치명적이라고 할 수 있다. 서비스 책임자를 잘 지정해야 한다.
- 텔레그램은 여전히 점유율이 낮다. 텔레그램을 많이 사용하는 특정 그룹이 아니라면, 모든 사용자에게 가장 편리한 방법은 문자 메시지, 메일, 그리고 앱의 푸시 알림일 것이다.

이상이다.


[^fn1]: 봇을 그룹에 집어넣을 수 있게 설정돼 있어야 한다. `@BotFather`한테 `/setjoingroups`이라고 보내면 설정 가능하다. 값은 `Enabled`로 돼 있어야 하는데, 아마 기본값이 `Enabled`일 거라, 끈 적이 없다면 따로 설정해 줄 필요가 없을 것이다.
