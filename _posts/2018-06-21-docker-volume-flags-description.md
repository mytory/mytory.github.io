---
title: 'Docker 각 볼륨 플래그(delegated, cached, consistent)의 의미'
author: Docker
translator: 안형우
layout: post
tags:
  - docker
description: "컨테이너쪽으로 변경이 바로바로 반영돼야 하면 delegated 사용, 호스트로 변경사항이 바로바로 반영돼야 하면 cached 사용. 보통은 호스트에서 코드를 수정하고, 컨테이너에서 서버를 돌릴 테니 delegated로 하면 된다."
---

## 요약

- `delegated`: 컨테이너쪽 파일시스템 내용이 최신이다. 컨테이너쪽 변경사항이 호스트쪽에 반영되는 데 시간이 걸릴 수 있다.
- `cached`: 호스트쪽 파일시스템의 내용이 최신이다. 호스트쪽 변경사항이 컨테이너에 반영되는 데 시간이 걸릴 수 있다.
- `consistent`: 컨테이너와 호스트가 완전히 동기화된다.
- `default`: `consistent`와 같다. 플래그를 주지 않으면 `default`다. `consistent`와 결정적 차이가 있다. `consistent`를 주면 마운트 볼륨이 겹칠 경우 `deleagted`와 `cached`를 덮어쓰는 반면, `default`인 경우 덮어 쓰지 않는다.

음... 난 컨테이너 안에서 gradle 빌드를 돌리고, 웹서버도 컨테이너 안에서 돌리니 컨테이너쪽 변경사항이 최신이어야 한다. 호스트의 코드 변경사항은 곧장 컨테이너에 반영돼야 한다. 그래서 난 `delegated`를 사용하면 된다. 각자 상황에 맞게 잘 골라 보자.

사용 방법은 `-v host-folder:container-folder:flag`다. 예를 들면, `-v /Users/mytory/workspace:/var/www:cached` 형식으로 사용하면 된다.

명세 번역이므로, must는 '반드시'로 직역하고, may는 '수도'라고 번역했다. '파일시스템'은 file system의 번역인데, '파일 시스템'으로 띄워서 번역하면 파일과 시스템을 각각 따로 인지할 위험이 있는 것 같아 붙여 번역했다. 

'파일시스템'은 FAT, FAT32, NTFS 등 하드디스크에 파일을 저장장치에 기록하는 체계를 의미한다. 아래 글에서 파일시스템이라는 용어가 사용된 이유는 도커에서 호스트의 파일시스템과 컨테이너의 파일시스템이 다른 경우 발생하는 성능 문제를 해결하기 위해 사용하는 옵션을 다루고 있기 때문이다. 도커 컨테이너는 EXT4(리눅스) 파일시스템인데, 호스트는 NTFS(윈도우)나 APFS(맥)인 경우 말이다.

'파일시스템 상태'는 file system state를 번역한 것이다. 'state'는 일상어로서 상태가 아니라 특정 상태들이 있는 거 같은데, 정확히 어떤 게 있는지는 모르겠다. 그것까지 알 필요는 없으니 넘어가자. 

이하는 [Performance tuning for volume mounts (shared filesystems)](https://docs.docker.com/docker-for-mac/osxfs-caching/)의 의미(Semantics) 부분을 번역한 것이다.

----

파일시스템 작업시 관찰되는 효과들에 관해 무엇을 보장할 수 있는지에 따라 각 설정의 의미가 정해진다. 이 명세에서, "호스트"는 사용자의 도커 클라이언트의 파일시스템을 가리킨다.

## delegated

`delegated` 설정은 보장하는 것이 가장 적다. `delegated`로 마운트한 디렉토리에 대해서는 컨테이너쪽 파일시스템 내용이 믿을만 하다. 그리고 컨테이너가 수행한 기록은 호스트의 파일시스템에 즉시 반영되지 않을 수도 있다. NFS(Network File System) 비동기 모드 같은 상황에서, 만약 `delegated`로 마운트한 채로 실행한 컨테이너가 뻑나면, 기록이 유실될 수 있다.

그러나 일관성을 포기함으로써, `delegated` 마운트는 다른 설정에 비해 현저하게 성능이 향상된다. 임시 파일들의 공간이나 파일들을 빌드하는 곳처럼, 작성된 데이터가 임시적인 곳이나 금세 재현가능한 곳에서 `delegated`는 아마도 올바른 선택일 것이다.

`delegated`는 컨테이너는 실행시에 다음 규약들을 보장한다. 

1. 구현이 파일시스템 이벤트를 발생하면, 관련 파일시스템 상태(state)와 연관해 컨테이너측 수정이 없는 경우, '해당 이벤트와 관련이 있는 컨테이너의 상태(state)'는 '이벤트 발생 시점의 호스트 파일시스템 상태(state)'를 *반드시* 반영해야 한다.

2. 플러시[^flush]나 동기화 작업이 수행되는 경우, 관련 데이터는 반드시 호스트 파일시스템에도 기록돼야 한다. 컨테이너는 기록된 데이터나 수정된 메타데이터, 바뀐 디렉토리 구조를 플러시하거나 동기화하기 전에 캐시해 둘 *수도* 있다.

3. 동일한 실행시간에 모든 컨테이너는 *반드시* 마운트의 캐시를 일관되게 공유해야 한다.

4. `delegated`로 마운트한 볼륨을 공유하는 컨테이너가 종료되면, 마운트한 볼륨에서 일어난 변경사항은 호스트쪽 파일시스템에 *반드시* 기록돼야 한다.

5. `cached`나 `consistent` 마운트가 `delegated`로 마운트한 볼륨을 덮어써서 공유하는 경우, `delegated` 마운트는 `cached`나 `consistent` 마운트의 문법을 *반드시* 따라야 한다.

6. 컨테이너는 (디렉토리 구조, 노드의 존재 등을 포함해) 파일 데이터와 메타데이터를 무한정 붙잡고 있을 *수도* 있다. 이 캐시가 호스트쪽 파일시스템 내용을 동기화하지 않게 만들 *수도* 있다. 호스트쪽 파일시스템에 변경이 발생하면 구현자는 [이] 캐시를 만료시켜야 한다. 하지만 플랫폼의 한계로 인해 보장된 시간 안에 하는 것이 어려울 수도 있다.

7. 만약 마운트한 소스 디렉토리에 호스트 파일시스템 쪽의 변경사항이 존재하면, `delegated`로 마운트한 볼륨이 호스트쪽 소스 디렉토리와 동기화될 때 이 변경사항들은 유실될 *수도* 있다.

8. 6-7번 동작은 소켓, 파이프나 디바이스 파일 유형에는 적용되지 *않는다*.

[^flush]: 아직 기록하지 않고 캐시만 해 둔 파일시스템 변경 내용을 기록하는 작업.


## `cached`

`cached` 설정은 `delegated`가 보장하는 것들을 모두 보장한다. 그리고 컨테이너가 수행한 기록이 나타나는 것에 관련해 추가로 몇 가지를 더 보장한다. 예를 들면, 보통 `cached`는 호스트와 컨테이너 사이의 일시적인 불일치를 감수하는 대신 읽기가 많은 작업의 성능을 개선한다.

`cached`로 마운트한 디렉토리는 호스트쪽 파일시스템의 내용이 믿을만 하다. 컨테이너가 수행한 기록은 호스트에 즉시 반영되지만, 호스트 쪽에서 수행한 기록은 컨테이너 쪽에 보이기까지 딜레이가 있을 수 있다.

(팁: `cached`에 대해 더 알아 보려면, [Docker for Mac 캐싱 사용자 설명서](https://blog.docker.com/2017/05/user-guided-caching-in-docker-for-mac/)를 보시오.)

1. 구현은 `delegated` 의미 설명 1-5항을 *반드시* 준수해야 한다.

2. 구현이 파일시스템 이벤트를 발생하면, '해당 이벤트와 관련이 있는 컨테이너의 상태(state)'는 '이벤트 발생 시점의 호스트 파일시스템 상태(state)'를 *반드시* 반영해야 한다.

3. 컨테이너 마운트들은 메타데이터 수정, 디렉토리 구조 변경, 데이터 기록을 호스트쪽 파일시스템에 맞춰 일관되게 반드시 수행해야 한다. 

4. 만약 `cached` 마운트가 `consistent` 마운트와 공유되면, 겹치는 부분은 *반드시* `consistent` 마운트의 규칙을 따라야 한다.
  
  `delegated` 설정의 유연성 중 일부는 유지된다. 즉:

5. 구현은 `delegated` 규칙 6항을 허용할 *수도* 있다.


## consistent

`consistent` 설정은 컨테이너 실행시간에 가장 엄격한 제한을 건다. `consistent`로 마운트된 디렉토리들은 컨테이너에서나 호스트에서나 늘 동기화돼야 한다. 컨테이너에서 수행한 기록은 즉시 호스트에 반영돼야 하고, 호스트에서 수행한 기록은 즉시 컨테이너에 반영돼야 한다.

`consistent` 설정은 리눅스의 바인드 마운트(bind mount)의 동작과 가장 유사하다. 그러나, 강력한 일관성을 보장하는 대신 몇몇 경우에는 맞지 않다. 성능이 중요하고 완전한 일관성은 부차적인 경우처럼 말이다.

1. 구현은 *반드시* `cached` 규칙 1-4항을 준수해야 한다.

2. 컨테이너츠 마운트들은 *반드시* 호스트쪽 파일시스템의 메타데이터 수정, 디렉토리 구조 변경, 데이터 기록을 즉시 반영해야 한다.


## default

`default` 설정은 `consistent` 설정과 이름만 빼고 동일하다. 결정적으로, 이것은 `cached` 규칙 4항과 `delegated` 규칙 5항에 있는 내용 - 겹치는 경우 더 강력한 제약을 거는 것이 `default` 마운트에는 적용되지 않는다는 것을 의미한다. `state` 플래그가 제공되지 않으면 `default` 설정이다.