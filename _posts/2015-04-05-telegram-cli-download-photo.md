---
title: "telegram-cli 사진 등 다운로드 방법"
layout: "post"
category: "program"
---

이런 매니악한 걸 적어도 되나 싶지만;;

텔레그램은 다들 뭔지 알 거다. 카톡 감청으로 한바탕 난리가 나고, 사람들이 보안이 튼튼한 외산 메신저로 이주해 간 것 말이다. 나도 텔레그램을 쓴다.

그런데 이 텔레그램은 다양한 프로그램이 나와 있는데 심지어 터미널 프로그램도 나와 있다. 이름하야 [telegram-cli](https://github.com/vysheng/tg). 리눅스와 맥에 설치할 수 있다. 컴파일을 통한 설치방법이 친절하게 설명돼 있으니 따라 하면 된다.

설치 후 실행할 때는 컴파일한 `tg` 폴더 밑의 `bin` 폴더에 있는 `telegram-cli` 파일을 실행하면 된다. 그리고 `tg` 폴더에 있는 `tg-server.pub` 파일이 공개키다. 이놈을 사용해서 실행하면 된다.

    $ bin/telegram-cli -k tg-server.pub

자, 이정도 설명하면 됐고. 그런데 이놈이 좋은데, 사진을 다운받아야 하는데, 아래처럼 설명이 돼 있다.

    view_photo <msg-id> Downloads file to downloads dirs. Then tries to open it with system default action

근데 `view_photo`는 알겠는데 `<msg-id>`는 대체 어디서 알아내는 거냐?!

검색을 해 보니 [답변](https://github.com/vysheng/tg/issues/220#issuecomment-49169290)이 있었다.

답변이 너무 심플(`set msg_num 1`)해서 반신반의하며 해 봤다. 아무 반응이 없었다. 그러나... 혹시나?! 하고 아래 명령을 쳐 봤다.

    history 방이름

아까와 달리 각 메시지 앞에 번호가 붙어 있었다. 나이스. 그래서 아래 명령어로 사진을 봤다.

    view_photo 4342

텔레그램 cli 사용기 끝!

