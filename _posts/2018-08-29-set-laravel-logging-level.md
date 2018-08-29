---
title: "Laravel, 로그 기록 레벨 설정하기"
layout: post
tags:
  - PHP
  - Laravel
---

라라벨의 로그 파일 기본 경로는 `storage/logs/laravel.log`다. 별다른 설정을 하지 않으면 여기에 단일 파일로 저장된다.

개발시엔 `debug` 레벨로 메시지를 보고 싶지만, 제품으로 내보냈을 때는 `warning` 레벨 정도로 로그를 기록하는 편이 좋을 것이다.

## 로그 레벨을 기록해야 하는 곳

라라벨 5.6부터 `config/logging.php` 파일이 등장했다. 이 파일에 로그 설정이 기록된다. 

파일을 보면 기본적으로 `stack` 타입 로그를 사용하겠다고 하는데, 여러 로그 드라이버를 동시에 쓰겠다는 뜻이다.

`$chnnels` 배열을 보면 각 로그 드라이버의 설정값이 기록돼 있다. `stack` 채널만 항목이 조금 다른데, `stack` 밑에 `channels`라는 항목이 있고, 거기에 `single`, `daily`, `syslog` 따위의 로깅 드라이버 이름을 배열로 넘겨 주게 돼 있다. 즉, 여러 개의 로그 드라이버를 사용할 수 있도록 해 주는 기능이다. (아래 코드 참조.)

~~~ php
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            <mark>'channels' => ['single'],</mark>
        ],
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 7,
        ],
        // 후략
    ],
~~~

로그 레벨은 `stack`은 관리하지 않는다. 그 외의 `single`, `daily` 같은 설정에 `level` 항목이 있다. `single` 항목을 보자. `level`이 `debug`로 돼 있다. `Log::debug($message)`까지 모두 기록한다는 뜻이다. 

~~~ php
'single' => [
    'driver' => 'single',
    'path' => storage_path('logs/laravel.log'),
    <mark>'level' => 'debug',</mark>
]
~~~

개발할 때야 디버그 메시지를 보는 게 좋지만, 제품단에서는 디버그 메시지는 기록할 필요가 없다. 이걸 `warning` 정도로 바꿔 보자.

## .env를 활용하자

그냥 문자열로 `warning`을 박으면 금방 끝나겠지만, 개발환경에선 `debug`로, 제품환경에선 `warning`으로 하는 편이 좋다. 이럴 때 쓰라고 있는 게 `.env`다. 설정을 아래처럼 바꾸자.

~~~ php
'single' => [
    'driver' => 'single',
    'path' => storage_path('logs/laravel.log'),
    <mark>'level' => env('LOG_LEVEL', 'debug'),</mark>
]
~~~

`env($key, $default)` 함수는 인자를 두 개 받는데 앞은 키값이고 뒤는 찾지 못했을 때의 기본값이다. `.env`에서 `LOG_LEVEL`이란 키값을 찾아서 값으로 사용하고, 없다면 `$default` 값을 사용한다. 

이제 `.env` 파일에 다음 줄을 써넣자. 아무데나 넣으면 된다.

~~~
LOG_LEVEL=warning
~~~

이러면 로그 레벨이 `warning`으로 설정된다.


## 8단계 로그 레벨

PHP에서 사용하는 로그 레벨은 총 8단계다. [PSR-3에 정의돼 있다.](https://www.php-fig.org/psr/psr-3/#5-psrlogloglevel)

~~~ php
namespace Psr\Log;

/**
 * Describes log levels
 */
class LogLevel
{
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';
}
~~~


## 주의! 백그라운드 프로그램

백그라운드에서 도는 프로그램은 `artisan queue:work`를 작동시킨 시점의 코드를 기준으로 돈다. 따라서 `.env`의 `LOG_LEVEL`을 변경했다면 큐를 재시작해 줘야 적용된다.

