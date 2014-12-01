---
title: "오픈수세에서 KMail(Akonadi) 이메일 검색 활성화"
layout: "post"
category: "etc"
tags: 
    - TIP
---

오픈수세 13.1을 사용한지 대충 6개월 지났다. 사소한 불편함들이 있다. 누가 오픈수세 쓴다고 하면 선뜻 추천해 줄 수 있을지는 모르겠다. 여튼간에 난 계속 쓰기로 결정했고, 새로 리눅스를 사용하려는 사람이 있다면 우분투를 추천해 주고 오픈수세의 장점에 대해 설명해 주고 선택하게 하겠다.

여튼간에, 요새 오픈수세의 기본 이메일 클라이언트인 kmail을 사용하고 있다. kmail은 오픈수세가 사용하는 데스크톱 환경인 KDE에서 붙인 이름인 듯하고 이 프로그램의 원래 명칭은 Akonadi다. Akonadi는 메일, 일정 관리, 연락처 관리 기능을 모두 갖고 있는 프로그램으로 KMail, kOrganiger, kAddressbook이 모두 Akonadi의 해당 기능을 사용하는 것이다. 여튼 지난 번에 kOrganiger 사용하면서 같은 프로그램을 사용하는구나 하는 생각은 했는데 그 프로그램 이름이 [Akonadi](https://userbase.kde.org/Akonadi)라는 건 오늘 또 처음 알았다.

여튼간에 KMail을 사용하는데 이게 이메일 검색이 제목으로만 되는 거다. 내용 검색(편집 > 메세지 찾기)을 하려고 하니까 전문 색인(fulltext indexing)을 활성화해야 한다면서 System Setting에서 활성화할 수 있다고 나오는 거다. 하지만 오픈수세엔 System Setting이 없는걸? KMail 설정엔 아무리 뒤져도 전문 색인에 대한 항목은 없고... 그건 Yast(오픈수세의 환경 설정)에도 없고. 이건 뭐지?

그런데 관련 검색을 하다 보니 Nepomuk이란 놈이 등장하는 거다. 찾아 보니 Networked Environment for Personal, Ontology-based Management of Unified Knowledge(개인을 위한 네트워크 환경, [온톨로지](http://ko.wikipedia.org/wiki/%EC%98%A8%ED%86%A8%EB%A1%9C%EC%A7%80) 기반의 통합 지식 관리)라는 제목의 약자인데... 아놔... 여튼간에, 이게 컴퓨터 안에 있는 정보들을 통합적으로 검색하는 프로그램인가 보다. KDE에 기본으로 딸려 있는 놈이라고 이해되고. 발음은 네포묵 정도로 하면 되나? 여튼 이게 이메일을 검색할 수 있게 활성화하면 된다는 것 같았다. 그래서 그런 프로그램이 있는지 보니까 있다. `Alt+F1`을 눌러서 nepomuk으로 찾아 보니 'Desktop Search'라는 놈이 나온다. 그걸 실행했더니 아래처럼 email 색인이 나온다.

![](https://dl.dropboxusercontent.com/u/15546257/blog/mytory/kmail-enable-email-indexing.png)

이렇게 해서 이메일 색인 시작 성공.

