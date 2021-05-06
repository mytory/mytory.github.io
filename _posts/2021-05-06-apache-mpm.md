---
title: '아파치 MPM 유형 설명 - prefork, worker, event'
layout: post
tags: 
    - apache
description: event가 가장 빠르다. prefork는 쓰레드를 지원하지 않는 어플리케이션을 사용하는 경우 쓰는데 느리다. worker는 중간.
---

아파치 웹서버 최적화를 수행하면서 조금 공부한 것을 공유한다.

일단 아파치가 여러 요청을 동시에 처리해 성능을 향상시키기 위해 사용하는 것은 MultiProcess Module(MPM, 다중 처리 모듈)이다. 

이 모듈은 자식 프로세스와 스레드를 생성해 여러 요청에 대응하는데, 자식 프로세스와 스레드를 어떻게 활용하는가에 따라 몇가지 종류로 나뉜다. 프로세스만 사용하면 메모리 사용은 높아지지만 한 프로세스가 한 커넥션만 처리해 스레드를 사용하지 못하는 어플리케이션을 안전하게 돌릴 수 있다. 스레드를 적극 활용하면 메모리 사용은 낮아지고 성능이 높아지지만 한 프로세스가 여러 연결을 처리하게 되므로 한 연결이 오염됐을 때 다른 연결이 함께 오염될 수 있다고 한다(이 이상 구체적으로 파지는 않았다).

내가 아는 바로는 `mod_php`는 스레드를 안전하게 처리하지 못한다([출처][mod-php-thread]). 스레드를 사용하려면 PHP FPM을 사용해야 한다.

리눅스에서는 세 가지 MPM 모듈을 지원한다.[^fn] 아래는 디지털오션에 있는 [한 튜토리얼의 설명][digitalocean]을 번역한 것이다. 

[^fn]: 아파치 문서를 보면 윈도우는 `mpm_winnt`라는 모듈을 지원한다고 나온다. 아래 세 모듈은 아마도 Unix 계열 운영체제에서만 사용할 수 있는다는 거 같은데, 정확하지는 않다.

> **프리포크(pre-fork)**: 서버에 들어오는 커넥션마다 프로세스를 생성한다. 각 프로세스는 다른 프로세스와 분리돼 있고, 따라서 실행의 특정 단계에서 완전히 동일한 요청을 수행하더라도 메모리를 공유하지 않는다. (대체로 오래된 어플리케이션이나 라이브러리 같은) 쓰레딩을 지원하지 않는 라이브러이와 연결된 어플리케이션을 실행하는 데 안전하다.
> 
> **워커(worker)**: 부모 프로세스가 자식 프로세스 실행을 책임진다. 자식들 중 일부는 새로 들어오는 커넥션을 수신하고, 다른 자식들은 요청받은 내용을 내어준다. 각 프로세스는 스레드를 사용하기 때문에 (스레드 하나가 연결 하나를 제어한다) 한 프로세스가 여러 요청을 동시에 제어할 수 있다. 이런 식으로 커넥션을 다루면 안정성을 유지하면서도 자원 활용에 더 유리하다. 새로운 커넥션을 즉시 제공할 준비가 돼 있는 자유로운 스레드를 보유한 프로세스들이 있게 되기 때문이다.
> 
> **이벤트(event)**: 이 MPM 방식은 워커에 기반해서 한 단계 더 나간 방법이다. 자식 프로세스와 그에 연결된 스레드의 작업을 부모 프로세스가 관리하는 방법을 최적화했다. 기본적으로 한 연결은 5초 동안 열려 있다가 아무런 이벤트가 일어나지 않으면 닫힌다. 이것이 해당 커넥션과 연관된 스레드가 유지되는 시간을 가리키는 keep-alive 지시자의 기본값이다. 이벤트 MPM은 프로세스가 스레드를 관리하게 하므로 어떤 스레드들이 살아있는 커넥션들을 유지하고 있는 동안 또다른 스레드들은 새로 들어오는 커넥션들을 자유롭게 처리할 수 있다. 할당된 작업을 스레드에 재배포할 수 있게 하면 리소스 활용도와 성능이 향상된다. [`mpm_evnet`는 아파치 2.4부터 사용 가능 - 안형우]

나는 우분투 서버를 사용하는데, 우분투에서 아파치를 설치하면 기본적으로 `mpm_prefork` 모듈을 사용한다. `/etc/apache2/mods-enabled/` 폴더를 보면 `mpm_prefork.conf`와 `mpm_prefork.load` 파일이 링크(즉, 활성화)돼 있는 것을 볼 수 있다.

## 나의 경우는...

나 같은 경우는 apache의 `mod_php`를 비활성화하고 `php-fpm`을 사용할 목적으로 작업하던 와중에 `mpm_event` 모듈을 사용하게 됐다. 

그래서 apache `mod_php`를 사용하면서 `mpm_event`를 사용하는 것에 대해서는 아는 바가 없다. 아마 될 것 같긴 하지만 제품 레벨에서 사용을 권장하지 않는다고 하니 굳이 알아 보지 않았다.

우분투에서 `mpm_event`와 PHP FPM을 사용하려면 이 튜토리얼을 참고하라: [How To Configure Apache HTTP with MPM Event and PHP-FPM on Ubuntu 18.04][digitalocean]


## 우분투 명령어

여하간 `mpm_prefork` 모듈을 끄고 `mpm_event` 모듈을 활성화하는 명령은 다음과 같다.

```bash
sudo a2dismod mpm_prefork
sudo a2enmod mpm_event
```

반대로 `mpm_prefork` 모듈을 켜고 `mpm_event` 모듈을 끄는 명령은 다음과 같다.

```bash
sudo a2dismod mpm_event
sudo a2enmod mpm_prefork
```

[digitalocean]: https://www.digitalocean.com/community/tutorials/how-to-configure-apache-http-with-mpm-event-and-php-fpm-on-ubuntu-18-04
[mod-php-thread]: https://wiki.modernpug.org/questions/25234435/apache-threaded-mpm-+-modphpzts%EB%A5%BC-production-%EB%A0%88%EB%B2%A8%EC%97%90%EC%84%9C-%EC%82%AC%EC%9A%A9%ED%95%98%EC%A7%80-%EB%A7%90%EB%9D%BC%EA%B3%A0-%EA%B6%8C%ED%95%98%EB%8A%94-%EC%9D%B4%EC%9C%A0