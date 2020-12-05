---
title: 'Cron에서 HTTpie stdin 오류 - http: error: Request body (from stdin or a file) and request data (key=value) cannot be mixed.'
layout: post
tags: 
    - cron
    - linux
    - httpie
description: 터미널 없이 HTTPie를 실행하는 경우 자동으로 표준 입력을 읽기 때문에 발생하는 에러. --ignore-stdin 플래그를 주면 해결된다.
---

HTTPie[httpie][^fn1] 실행이 포함돼 있는 bash 스크립트를 cron에서 돌리는데, 커맨드라인에서 실행하면 잘 되는데 cron에서는 실행이 안 되고 에러가 났다. 에러 메시지는 아래와 같았다.

[^fn1]: 커맨드라인에서 http 호출을 할 수 있는 편리한 프로그램이다.

```
http: error: Request body (from stdin or a file) and request data (key=value) cannot be mixed. Pass --ignore-stdin to let key/value take priority. See https://httpie.org/doc#scripting for details.

http: 에러: 요청 body(표준 입력 혹은 파일에서 온)와 요청 데이터(키=값)는 동시에 사용할 수 없습니다. 키/값 쌍을 우선해서 받게 하려면 --ignore-stdin을 넘겨 주세요. 자세한 내용은 https://httpie.org/doc#scripting 문서를 참고하세요.
```

일단 에러 메시지가 안내하는 대로 명령에 `--ignore-stdin` 플래그를 주면 문제가 해결된다.

## stdin

에러 메시지중 [stdin은 표준 입력][stdin]을 말한다. 커맨드라인에서 키보드로 입력을 하는 것이 대표적인 표준 입력이다. 그러나 스크립트가 실행되는 와중에는 키보드로 입력을 하는 경우가 거의 없다. 

스크립트가 받는 표준 입력 중 대표적인 것은 파이프로 넘겨 주는 데이터다. 예컨대 아래와 같이 데이터를 파이프로 넘겨 준다면 cat은 `Hello World!`를 표준 입력으로 받게 된다.

``` bash
echo 'Hello World!' | cat
```

내가 스크립트 명령어에 `키=값`으로 데이터를 넘기기는 했지만, 표준 입력을 넘기지는 않았다. 명령어는 아래와 같은 형식이었다.

``` bash
http post https://test.com a=b
```

그런데 내가 표준 입력을 http로 넘겨 줬다니 완전히 혼란스러웠다. 


## 문서

구글에 한참을 검색했지만 결국 에러 메시지에 안내돼 있는 문서(<https://httpie.org/doc#scripting>)에 들어가서 대략이나마 상황을 이해할 수 있었다. 물론 여전히 완전한 이해가 되지는 않는다. 

아래는 베스트 프랙티스 부분을 번역한 것이다.

> ### 베스트 프랙티스
> 
> 자동으로 표준입력(stdin)을 읽는 기본 동작은 보통 상호작용 없는(non-interactive) 실행에서는 요구되지 않는다. 표준입력을 읽는 동작을 끄기 위해 `--ignore-stdin` 옵션을 사용할 수 있습니다.
> 
> 이 옵션이 없이 [터미널 없는 맥락에서 - 안형우] 실행했을 때 HTTPie는 겉보기에 멈춘 것처럼 보이는데, 이것은 보통은 오류인 것처럼 생각할 수도 있지만 정상적인 동작([gotcha][1])입니다. 이 상황은 HTTPie가 예컨대 크론잡에서 실행됐을 때 발생합니다. 크론잡의 맥락에서 표준입력은 터미널에 연결되지 않고, 따라서 \[HTTPie]는 [리디렉트 입력][2]에 대한 규칙을 적용합니다. 즉, HTTPie는 요청 본문(body)를 기대하면서 표준 입력을 읽기 시작합니다. 그리고 아무런 데이터도, [EOF(End Of File, 파일 끝을 가리키는 문자)][eof]도 없기 때문에 멈춰 있게 됩니다. 그래서 HTTPie에 파이프로 데이터를 넘겨주지 않는 한 스크립트에서는 이 플래그를 사용해야 합니다. 
> 
> 또한 커넥션 `--timeout` 제한을 설정하는 것도 좋을 것입니다. 이 옵션을 사용하면 서버가 영영 응답하지 않아 프로그램이 멈추는 경우를 방지할 수 있습니다.
> 
> ### Best practices
> 
> The default behaviour of automatically reading stdin is typically not desirable during non-interactive invocations. You most likely want to use the --ignore-stdin option to disable it.
> 
> It is a common gotcha that without this option HTTPie seemingly hangs. What happens is that when HTTPie is invoked for example from a cron job, stdin is not connected to a terminal. Therefore, rules for redirected input apply, i.e., HTTPie starts to read it expecting that the request body will be passed through. And since there’s no data nor EOF, it will be stuck. So unless you’re piping some data to HTTPie, this flag should be used in scripts.
> 
> Also, it might be good to set a connection --timeout limit to prevent your program from hanging if the server never responds.

[httpie]: https://httpie.io/
[stdin]: https://ko.wikipedia.org/wiki/%ED%91%9C%EC%A4%80_%EC%8A%A4%ED%8A%B8%EB%A6%BC#%ED%91%9C%EC%A4%80_%EC%9E%85%EB%A0%A5_(stdin)
[1]: https://en.wikipedia.org/wiki/Gotcha_(programming)
[2]: https://httpie.io/docs#redirected-input
[eof]: https://ko.wikipedia.org/wiki/%ED%8C%8C%EC%9D%BC_%EB%81%9D