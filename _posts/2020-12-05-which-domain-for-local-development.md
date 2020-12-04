---
title: '개발용 로컬 도메인을 저는 localhost로 사용합니다'
layout: post
tags: 
	- Web Development
---

나는 로컬 개발시 도메인을 `localhost`의 서브도메인으로 만들어 사용한다. `wspaper.localhost` 같은 식으로 말이다. 

`localhost`는 자기 자신을 가리키는 루프백 도메인으로, 네트워크 상에서는 사용되지 않는다. 그래서 로컬 개발용 도메인으로 사용하기에 안전하다.

안전하다는 것은 중요하다. 예컨대 `.dev` 도메인은 많은 개발자들이 로컬 개발용 주소로 사용하다가 정식 도메인으로 사용이 되기 시작했고, [구글이 크롬에서 `.dev` 도메인에 접속할 때 https를 강제][1]하는 바람에 많은 개발자들이 멘붕에 빠진 적이 있다. 

다만 유의할 점이 있다. hosts 파일에 반드시 IP주소를 적어 줘야 한다. `video.localhost` 같은 `localhost`의 서브도메인은 `/etc/hosts` 파일에 적어 주지 않아도 접속되는 경우가 있다. `localhost`는 이미 `/etc/hosts` 파일에 주소가 매핑돼 있기 때문에 브라우저에서는 `localhost`의 서브 도메인 주소를 `127.0.0.1`로 해석해 낸다. (맥에서 그랬는데 리눅스는 기억이 잘 안 난다.)

그런데 이걸 적어 주는 걸 빼먹었다가 라라벨의 `npm run watch` [브라우저 싱크 기능이 제대로 작동하지 않아 낭패][2]를 본 적이 있다. 생각해 보니 `localhost`의 서브 도메인이 `localhost`와 동일한 IP를 사용한다고 보장할 수 없다. 브라우저에서 접속이 된다고 hosts 파일에 도메인 주소를 추가하지 않고 쓰다가 낭패를 본 것이다.

## 참고

- [Don't Use .dev For Development][1]
- [라라벨, npm run watch가 헛돌며 작동하지 않을 때][2]


[1]: https://iyware.com/dont-use-dev-for-development/
[2]: https://mytory.net/2020/12/04/laravel-npm-run-watch-infinite-loop.html