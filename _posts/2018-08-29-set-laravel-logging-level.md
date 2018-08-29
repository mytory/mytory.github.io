---
title: "Laravel, 로그 기록 레벨 설정하기"
layout: post
tags:
  - PHP
  - Laravel
---

라라벨의 로그 파일 기본 경로는 `storage/logs/laravel.log`다. 별다른 설정을 하지 않으면 여기에 단일 파일로 저장된다.

개발시엔 `debug` 레벨로 메시지를 보고 싶지만, 제품으로 내보냈을 때는 `warning` 레벨 정도로 로그를 기록하는 편이 좋을 것이다. `var_dump()` 안 쓰고 `Log::debug()` 쓰는 큰 이유중 하나 아닌가.

PHP 표준 권고안[^psr]에는 [8단계의 로그 기록 레벨][logging-levels]이 있다. 로그 기록 레벨은 가장 낮은 단계인 `debug`부터 가장 높은 단계인 `emergency`까지 있는데, 로그 기록 레벨을 `emergency`로 하면 `Log::debug()`로 기록한 로그는 기록되지 않는다. 제품 환경에서는 보통 `warning`이나 `error` 정도로 맞춰 놓고 로그를 기록할 것이다.  

[^psr]: PHP Standards Recommendations. PHP 프레임워크 개발자들이 모여 만든 PHP-FIG란 그룹에서 상호 호환되는 프로그램들을 만들 수 있게 표준을 합의하고 발표하는 권고안. PHP-FIG는 PHP 프레임워크 상호 운용성 그룹(PHP Framework Interop Group)의 약자.

[logging-levels]: https://www.php-fig.org/psr/psr-3/#5-psrlogloglevel 

## 로그 레벨을 기록해야 하는 곳

라라벨 5.6부터 [`config/logging.php` 파일](https://github.com/laravel/laravel/blob/v5.6.0/config/logging.php)이 등장했다. 이 파일에 로그 설정이 기록된다. 

파일을 보면 기본적으로 `stack` 타입 로그를 사용하겠다고 하는데, 여러 로그 드라이버를 동시에 쓰겠다는 뜻이다.

~~~ php
'default' => env('LOG_CHANNEL', 'stack'),
~~~

`$chnnels` 배열을 보면 각 로그 드라이버의 설정값이 기록돼 있다. `stack` 채널만 항목이 조금 다른데, `stack` 밑에 `channels`라는 항목이 있고, 거기에 `single`, `daily`, `syslog` 따위의 로깅 드라이버 이름을 배열로 넘겨 주게 돼 있다. 즉, 여러 개의 로그 드라이버를 사용할 수 있도록 해 주는 기능이다. (아래 코드 참조.)

~~~ php
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['single'], // ← 여러 개의 드라이버를 배열로 받는다.
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

`stack` 드라이버에는 로그 레벨 옵션(`level`)이 없다. 그 외의 `single`, `daily` 같은 설정에 `level` 설정이 있다. `single` 항목을 보면 `level`이 `debug`로 돼 있다. `Log::debug($message)`까지 모두 기록한다는 뜻이다. 

~~~ php
'single' => [
    'driver' => 'single',
    'path' => storage_path('logs/laravel.log'),
    'level' => 'debug', // ← 기록 레벨값이 debug로 돼 있다.
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

PHP에서 사용하는 로그 레벨은 총 8단계다. [PSR-3에 정의돼 있다.][logging-levels]

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

