---
title: '라라벨, npm run watch가 헛돌며 작동하지 않을 때'
layout: post
tags: 
  - PHP
  - Laravel
---

맥에서 라라벨 새 프로젝트를 만들고 `npm run watch`를 돌렸는데 작동하지 않았다. 커맨드라인에서는 컴파일이 끝나고 브라우저가 떴는데, 브라우저에 사이트가 나오지 않는 것이다. `localhost:3000`으로 접속하면 안 되고, 본래의 도메인(`video.localhost`)으로 접속하면 잘 됐다. 프록시 URL이 틀리게 들어간 것도 아니었다. 

`node_modules`을 지운 뒤 다시 설치도 해보고 nodejs 버전업도 해 보는 등 여러 삽질을 해도 안 됐다.

원인은 어이없게도 `/etc/hosts` 파일에 DNS 설정을 해 주지 않은 데 있었다. 이렇게 추가해 주니 잘 돌아갔다.

```
# (앞부분 생략)
127.0.0.1	video.localhost
```

기본을 잊지 말자.


## `/etc/hosts`란 무엇인가

리눅스와 맥의 `/etc/hosts`는 도메인의 IP를 찾을 때 컴퓨터가 맨 처음 조사하는 파일이다(그러니깐 DNS 파일인 것이다). 윈도우는 이 파일이 `C:\Windows\System32\Drivers\etc\hosts` 경로에 있다.

`video.localhost`라는 도메인은 어디에도 없는 도메인이므로 컴퓨터가 찾지 못한다. 그래서 이 도메인은 `127.0.0.1` IP를 가리킨다고 `hosts` 파일에 써 줘야 하는 것이다(물론 맥은 알아서 찾는다. 그래도 방금 전같은 일을 방지하기 위해 적어 줘야 한다). 


## 참고

로컬 개발용 도메인을 `video.localhost`으로 사용하는 이유가 궁금하다면 다음 글을 보자.

👉 [개발용 로컬 도메인을 저는 localhost로 사용합니다](https://mytory.net/2020/12/05/which-domain-for-local-development.html)
