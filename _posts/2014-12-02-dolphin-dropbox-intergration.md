---
title: "돌핀(KDE 파일 관리자)에 드롭박스 통합하기"
layout: "post"
category: "etc"
tags: 
    - TIP
    - linux
---

리눅스 데스크톱 환경은 크게 [GNOME](http://www.gnome.org/)과 [KDE](https://www.kde.org/)가 있다. 윈도우만 사용해서 처음엔 이 개념이 낯설었는데... 우리가 사용하는 GUI를 구성해 주는 시스템이다. 리눅스 운영체제가 있고, 그걸 그래픽 유저 인터페이스(GUI)로 조작할 수 있게 해 주는 게 데스크톱 환경이라고 말할 수 있을 것 같다. GNOME이나 KDE 외예또 XFCE나 LXDE 데스크톱 환경도 있다. XFCE와 LXDE는 저사양에서 잘 돌아가는 데스크톱 환경이다. 

우분투는 기본적으로 GNOME을 사용하는데, KDE를 사용할 수도 있다. KDE를 사용하는 우분투를 쿠분투라고 부른다. XFCE를 사용하는 우분투는 Xubuntu라고 부르고, LXDE를 사용하는 우분투는 Lubuntu라고 부른다.

오픈수세는 KDE를 기본으로 사용하는데, GNOME도 사용할 수 있다. 그런데 난 KDE가 좋다. 예쁘니까. 그리고 사실 운영체제가 기본적으로 지원하는 데스크톱 환경을 사용하는 편이 더 좋을 것이다.

우분투는 파일 탐색기로 노틸러스(Nautilus)를 사용하고 오픈수세는 파일 탐색기로 돌핀(Dolphin)을 사용한다. 아마 각각 GNOME과 KDE에서 사용하는 놈인 것 같다. 


드롭박스 통합
-------------

우분투를 사용할 때는 드롭박스를 깔면 노틸러스에 드롭박스 컨텍스트 메뉴가 나타났다. 그런데 오픈수세를 사용하니까 돌핀에 드롭박스 컨텍스트 메뉴가 안 나타나는 거다. 가장 많이 사용하는 게 파일 공유 URL을 뽑는 건데 안 되니까 불편했다. 그래서 나야 뭐 개발자니까 아래 명령어로 해결해 왔다.

    dropbox puburl 파일명

물론 Public 폴더에 있는 파일에만 명령이 먹는다. 요새 드롭박스에서 밀고 있는 공유 URL은 명령어로는 만들 방법이 없다. 리눅스용 드롭박스 자체가 그걸 지원 안 하는 건지까지는 모르겠다.

그래도 Public URL을 뽑을 때마다 터미널로 들어가서 명령을 쳐야 하니까 번거로웠는데, 오늘 검색을 한 번 해 봤다. `Dolphin Dropbox Plugin` 뭐 이런 단어로 검색을 했는데 누가 만든 게 있는 거다. 근데 뭐 컴파일을 하란다. 그래서 시도했는데 뭐 잘 안 된다. 오픈수세는 설치파일로 rpm을 사용하는데 이 사람이 컴파일에 올려 놓은 건 deb다. 에잇. 근데 이 사람이 써 놓은 설명 중에 '설치한 뒤 서비스에 가서 활성화하시오(사실 기본으로 켜지긴 할 텐데)' 뭐 이런 말이 있었다. '서비스'는 뭐 확장 혹은 플러그인 정도로 생각하면 된다.

흠, 그래서 한 번 돌핀의 '서비스' 목록에 가 봤다. 와우 각종 서비스를 다운받을 수 있게 시스템에 마련돼 있었다. 아래 이미지에 보면 'Download New Services...'가 있다. 그걸 클릭하면 서비스들을 검색할 수 있다.

![](https://dl.dropboxusercontent.com/u/15546257/blog/mytory/dolphin-dropbox-1.png)

Dropbox로 검색했더니 세 개가 나온다. 내가 세 개 다 설치해 봤는데, hash87이 만든 Dropbox ServiceMenu가 가장 낫다. kde-services는 rpm 설치 파일을 다운받는 링크로 안내하는데, 일단 오픈수세에 설치가 안 된다;; 그리고 온갖 기능들 중 하나로 dropbox 통합이 들어가 있는 거라 왠지 싫다. dropbox-servicemenu-kde는 공개 링크를 생성하지 못하는 위치에 있는 파일로 공개 링크를 얻으려고 할 때 에러 메시지가 나오지 않는다. 그러니 hash87이 만든 Dropbox ServiceMenu를 설치하자.

![](https://dl.dropboxusercontent.com/u/15546257/blog/mytory/dolphin-dropbox-2.png)

설치만 하면 그냥 완료된다. 그리고 서비스 항목에 보면 Dropbox 관련 항목들이 생긴 것을 알 수 있다.

자, 이제 Dropbox의 Public 폴더로 가서 마우스 우클릭을 해 보자. 그러면 아래 이미지처럼 Dropbox 관련 항목들이 나온다. 

![](https://dl.dropboxusercontent.com/u/15546257/blog/mytory/dolphin-dropbox-3.png)

각 항목은 이런 건데...

친절하게 Move to Public folder and paste URL to Klipper 같은 항목이 있다. 이건 일단 공개 링크를 생성할 수 있는 Public 폴더로 파일을 옮기고, URL을 클리퍼(KDE의 클립보드 프로그램)에 복사하는 기능이다. 나머지는 굳이 설명하지 않아도 되겠지.