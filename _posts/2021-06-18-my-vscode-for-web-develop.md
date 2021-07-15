---
title: '웹 개발을 위한 나의 VSCode 세팅(프론트+PHP)'
layout: post
tags: 
    - VSCode
description: VSCode 세팅을 지속적으로 기록해 나가기 위한 문서다. PHP 개발자로서 핵심은 PHP Intelephense 유료 버전이었다. 그리고 PhpStorm에서 내가 유용하게 사용했던 기능들을 모두 이식하기 위해 노력할 예정이다.
---

VSCode를 많이들 사용하게 되면서 나도 VSCode로 갈아탈만 하지 않을까 생각하게 됐다. 

개인적으로는 PhpStorm이 가장 좋다고 생각한다. PHP 지원 때문만이 아니다. HTML, CSS, js 지원이 강력하기 때문이다. 

VSCode를 쓰려는 이유는 무료라서다. 나에게도 좋지만, 동영상 강의를 촬영할 때 아무래도 유료 프로그램보다는 무료가 나을 것 같아서다.

[3년 전에도 VSCode를 사용하려고 시도][3years-ago]한 적이 있다. 그 때는 다른 강의를 보면서 공부한 것을 정리했다. 이번에는 실제 쓰면서 정리를 할 예정이다.


## 필수: PHP Intelephense 유료 버전(12달러)

VSCode도 기본적으로 PHP를 지원하지만 [PHP Intelephense][1]가 가장 강력하다. 12달러(약 13500원)를 내면 [유료 라이센스][license]를 살 수 있다. 

유료 버전을 필수로 꼽은 결정적 이유는 rename 기능(<kbd>F2</kbd>) 때문이다. 중요한 변경에서 결정적으로 속도가 빨라진다(아래 영상).

![](/uploads/2021/rename.webp)

부차적이지만 유료 버전엔 스마트 셀렉션 기능이 있다. 단어 → 단어를 감싼 괄호 → 괄호 너머 블럭 순서로 선택을 확장해 주는 기능이다(아래 영상). PhpStorm에서 유용하게 쓴 기능이라 없어서 아쉬웠는데 뜻하지 않게 다시 쓸 수 있게 됐다.

![](/uploads/2021/smart-select.webp)

### 주목 - 설치 후처리

설치 후 설명에 따라 VSCode의 기본 PHP 지원을 꺼야 한다. 확장 설치 패널에서 `@builtin PHP`로 검색한 뒤 **PHP Language Features**를 disable로 만든다. PHP Language Basics는 건드리지 않는다.

그리고 유료 라이센스를 구입했다면 라이센스 키를 입력해야 한다. <kbd>Cmd</kbd>/<kbd>Ctrl</kbd>-<kbd>Shift</kbd>-<kbd>p</kbd>를 눌러 명령 패널을 연 뒤 `intelephense enter licence key`라고 검색하면 바로 나온다. 입력해 주면 된다.


## 필수: PHP Namespace Resolver

[PHP Namespace Resolver][php-namespace-resolver]는 클래스를 임포트하거나 네임스페이스를 확장해 준다. PHP 개발을 하려면 필수 확장이다. 

임포트하지 않은 클래스를 사용하면 빨간 줄이 그어진다. 이 때 빨간 줄 위에서 <kbd>Cmd</kbd>/<kbd>Ctrl</kbd>-<kbd>.</kbd>(VSCode의 빠른 수정 기본 단축키다)을 눌러서 수정을 시도하면 임포트할 후보들을 보여 준다. 적절한 클래스를 선택해 주면 된다.

아래는 공식 페이지의 영상.

![](/uploads/2021/php-namespace-resolver.gif)


## Code Spell Checker

[Code Spell Checker][2]는 사전에 없는 영어 단어에 밑줄을 그어 주는 플러그인이다. 오타를 잡는 효과적인 수단을 제공해 준다.

![](/uploads/2021/spell-checker.webp)

사전에 없지만 내 프로젝트에서는 사용하는 단어는 밑줄에서 <kbd>Cmd</kbd>/<kbd>Ctrl</kbd>-<kbd>.</kbd>을 눌렀을 때 나오는 user dictionary 혹은 workspace dictionary에 추가해 준다. 화면에서 밑줄을 없애는 습관을 들이면 오타를 거의 없앨 수 있다.


## 설정: Auto Save

PhpStorm에서 자동 저장에 의존하는 습관을 들이는 바람에 VSCode에서도 윈도우를 떠나면 자동으로 저장이 되게 설정했다. 설정에서 Auto Save로 검색하면 금방 나온다. `onWindowChange`를 선택했다.

![](/uploads/2021/vscode-auto-save.png)


## 설정: PHP 단어 구분자에서 $ 없애기

단어별로 블럭을 씌울 때 `$`에서 멈추는 일이 생긴다. 그러나 PHP의 경우에는 `$`까지 한꺼번에 선택이 되는 게 좋다.

<kbd>Cmd</kbd>/<kbd>Ctrl</kbd>-<kbd>Shift</kbd>-<kbd>p</kbd>를 눌러 명령 패널을 연 뒤, `Preferences: Open Settings (JSON)`이라고 입력해 JSON으로 된 설정 편집기를 연 뒤 아래 항목을 추가한다.

```json
// 앞부분 생략
"[php]": {
    "editor.wordSeparators": "`~!@#%^&*()-=+[{]}\\|;:'\",.<>/?"
},
// 뒷부분 생략
```
![](/uploads/2021/php-word-separator.webp)


## 확장 - 단축키로 파일을 여는 확장 [Open file][open-file]

PhpStorm 등 IDE에서는 심볼(함수, 변수 등) 정의로 점프하는 단축키로 PHP 인클루드 파일이나 SASS 임포트 파일도 열 수 있는데 이상하게 VSCode에서는 심볼 정의로 점프하는 단축키인 F12로 파일을 열 수가 없다.

[Open file][open-file]을 설치하면 <kbd>Alt</kbd>-<kbd>p</kbd>로 파일을 열 수 있다. 확장이 경로를 확실히 찾지 못하면 <kbd>Ctrl</kbd>/<kbd>Cmd</kbd>-<kbd>p</kbd>에 경로의 문자열을 자동으로 넣어 줘서 수동으로 찾는 것을 도와 준다.


## 찾는 확장

- 좋은 SASS 확장을 찾고 있다.


[3years-ago]: https://mytory.net/2018/08/26/vscode-study.html
[1]: https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client
[license]: https://intelephense.com/
[2]: https://marketplace.visualstudio.com/items?itemName=streetsidesoftware.code-spell-checker
[open-file]: https://marketplace.visualstudio.com/items?itemName=Fr43nk.seito-openfile
[php-namespace-resolver]: https://marketplace.visualstudio.com/items?itemName=MehediDracula.php-namespace-resolver