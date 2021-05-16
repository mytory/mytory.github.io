---
title: '워드프레스 예약 포스트 기능이 작동하지 않을 때(Missed schedule, 예약을 놓쳤습니다)'
layout: post
tags: 
    - wordpress
description: 서버 설정을 할 수 없다면 플러그인을 사용한다. 서버 설정을 직접 할 수 있다면 매분 cron을 실행하게 하자.
---

## 증상

포스트 예약했는데 발행되지 않고 목록에 에러 메시지만 나오는 경우가 있다. 에러 메시지는 "예약을 놓쳤습니다(Missed schedule)"이다.

## 원인

확인해 보니 예약 포스트가 발행으로 변경되는 것은 wp cron이 하는 작업이다. 스케쥴 작업 이름은 `publish_future_post`다. 

워드프레스의 예약 작업(wp cron)은 운영체제의 예약 작업(리눅스의 경우 cron)과 다르게 작동한다. 사이트에 누군가가 방문을 하면 예약 작업을 점검해 실행하는 방식이다. 사이트 방문자가 많으면 매분 무리없이 작동하겠지만 방문자가 적은 사이트라면 실행되지 않는 예약 작업이 생길 수 있다. 

이런 점에 비추어 보면 예약 포스트 발행 기능은 예약한 해당 시각에 방문자가 없으면 실패하는 것 같다.

물론 이유가 이것만 있는 것은 아닐 테고 다른 이유들도 있을 테지만, 이 경우가 가장 대표적인 이유일 것이다.


## 해결책

그렇다면 해결은 두 가지 경로로 접근해 볼 수 있다.

1. 예약 발행 시각이 지나 wp cron이 실행돼도 발행을 하게 한다.
2. 매분 wp cron 실행을 보장한다.

## 예약 발행 시각이 지나면 발행하게 하기 - 플러그인 사용

[Scheduled Post Trigger][plugin] 플러그인을 사용하면 된다. 자세한 설명은 생략하겠다.


## 리눅스 cron을 이용하기

리눅스 cron 사용법은 이 글의 관심사를 벗어나므로 다른 글을 추천하는 것으로 대신한다.

👉 [리눅스 예약 작업 관리, cron][cron]

자, 그럼 매분 워드프레스 cron을 실행하도록 리눅스 cron에 등록하는 방법을 알아 보자.

### 워드프레스의 cron 비활성화

cron 예약을 하기 전에 우선 워드프레스의 cron을 비활성화하자. 그게 효율적일 것이다.

자신의 `wp-config.php` 파일을 열어서 `/* That's all, stop editing! Happy publishing. */` 바로 위에 아래처럼 `define( 'DISABLE_WP_CRON', true );`라고 적어주자.

```php
define( 'DISABLE_WP_CRON', true );

/* That's all, stop editing! Happy publishing. */
```

### wget을 이용한 방법

그리고 cron에 아래 명령을 등록해 준다.

```bash
wget -q -O - http://tw.mytory.net/wp-cron.php?doing_wp_cron >/dev/null 4>&2
```

`/etc/crontab`을 편집한다면 아래처럼 매 분 실행하게 하면 된다. 여기서는 사용자명을 `ubuntu`라고 적었다.

```bash
* *     * * *   ubuntu 	wget -q -O - http://my-wordpress-site.com/wp-cron.php?doing_wp_cron >/dev/null 4>&2
```

만약 `crontab -e`를 이용해 설정하고 있다면 아래처럼 적으면 된다.

```bash
* *     * * *   wget -q -O - http://my-wordpress-site.com/wp-cron.php?doing_wp_cron >/dev/null 4>&2
```

여기서 워드프레스 사이트의 url은 `my-wordpress-site.com`으로 가정했다. 감안해서 자신의 상황에 맞게 명령어를 수정해 사용하도록 한다.

### wp-cli를 이용한 방법

wp-cli를 이용한 방법도 있다. wp-cli는 워드프레스 사이트를 커맨드라인으로 조작하게 해 주는 프로그램이다. [설치 매뉴얼을 보고 설치][wp-cli]한 뒤에 cron 명령어는 이렇게 등록한다.

``` bash
cd /var/www/wordpress; wp cron event run --due-now >/dev/null 2>&1
```

그렇다면 `/etc/crontab`에는 아래처럼 적으면 될 것이다. 

``` bash
* *     * * *   ubuntu 	cd /var/www/wordpress; wp cron event run --due-now >/dev/null 2>&1
```

여기서 실행 사용자는 `ubuntu`로 가정했고 워드프레스가 설치된 경로를 `/var/www/wordpress`라고 가정했다. 자신의 상황에 맞게 수정해서 쓰라.

`crontab -e` 명령어로 설정한다면 실행 사용자를 빼고 아래처럼 적는다.

``` bash
* *     * * *   cd /var/www/wordpress; wp cron event run --due-now >/dev/null 2>&1
```

## 결론

이렇게 해서 매분 wp cron이 돌게 해주면 예약 포스팅이 정상적으로 잘 등록되는 것을 확인할 수 있다.

[plugin]: https://wordpress.org/plugins/scheduled-post-trigger/
[cron]: https://mytory.net/archives/601
[wp-cli]: https://wp-cli.org/#installing
