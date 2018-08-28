---
title: "PHP 개발자를 위한 VSCode 확장과 팁, 단축키"
layout: post
tags:
  - Tip
  - Editor
---

최고의 PHP 개발툴[^editor]은 누가 뭐래도 PhpStorm이다. 다만 1달 1~2만 원 꼴 되는 사용료가 진입장벽이 된다. 최근 핫한 VSCode는 PhpStorm만큼은 아니지만 꽤 괜찮은 대안이 될 수 있는 것 같다.

[^editor]: 더 정확히 말하면 통합 개발 환경(IDE, Integrated Development Environment)

그래서 라라캐스트의 [Visual Studio Code for PHP Developers][video]를 보고 공부했다. 무료다. 아래는 보면서 정리한 내용이다.

[video]: https://laracasts.com/series/visual-studio-code-for-php-developers/

단축키는 맥 기준이다. 윈도우/리눅스에서는 <kbd>Cmd</kbd>는 <kbd>Ctrl</kbd>로, <kbd>Opt</kbd>는 <kbd>Alt</kbd>로 하면 얼추 맞을 거다.


## 단축키

강의에서 나온 단축키들도 많지만, 아래는 내가 생각하기에 기본적으로 알아야 하는 단축키도 넣었다.

- <kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>P</kbd>: 커맨드 입력창 열기
- <kbd>Cmd</kbd>+<kbd>P</kbd>: 파일 찾기. <kbd>Cmd</kbd>+<kbd>P</kbd>를 누른 후 <kbd>P</kbd>를 연타치면 선택 영역이 이동하고, <kbd>Cmd</kbd> 버튼을 떼면 해당 파일이 열린다. 화살표 키에 손을 가져가지 않고 좀더 쉽게 파일을 여는 방법이다.
- <kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>O</kbd>: 현재 파일에서 함수명, 변수명, 클래스명 등 기호(Symbol) 찾기.
- <kbd>Cmd</kbd>+<kbd>T</kbd>: 전체 프로젝트에서 기호(Symbol) 찾기.
- <kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>K</kbd>: 줄 삭제
- <kbd>Opt</kbd>+<kbd>Shift</kbd>+<kbd>↑</kbd> 또는 <kbd>↓</kbd>: 현재 줄을 위, 아래로 복사
- <kbd>Opt</kbd>+<kbd>↑</kbd> 또는 <kbd>↓</kbd>: 현재 줄을 위, 아래로 이동
- <kbd>Cmd</kbd>+<kbd>D</kbd>: 현재 단어를 찾아서 추가로 선택(다중 커서 기능)
- <kbd>Cmd</kbd>+<kbd>Opt</kbd>+<kbd>↑</kbd> 또는 <kbd>↓</kbd>: 다중 커서를 위, 아래로 하나씩 생성
- <kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>L</kbd>: 현재 단어 전체를 다중 커서로 선택.
- <kbd>Cmd</kbd>+<kbd>1<kbd>: 편집기에 포커스. (정확히는 첫 번째 편집기 그룹에 포커스)
- <kbd>Cmd</kbd>+<kbd>K</kbd>, <kbd>Cmd</kbd>+<kbd>S</kbd>: 키보드 단축키 설정
- <kbd>Ctrl</kbd>+<kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>←</kbd> 또는 <kbd>→</kbd>: 선택 범위를 논리적으로 줄이거나 늘린다.
- F2: 기호 이름 변경
- <kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>E</kbd>: 좌측 사이드바에 탐색기를 열고 포커스
- <kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>X</kbd>: 좌측 사이드바에 확장 프로그램 설치 탐색기를 열고 포커스
- <kbd>Ctrl</kbd>+<kbd>`</kbd>: 내장 터미널을 연다.
- <kbd>F12</kbd>: 정의로 이동
- <kbd>Opt</kbd>+<kbd>F12</kbd>: 정의를 살짝 들여다 보기(peek).
- <kbd>Shift</kbd>+<kbd>F12</kbd>: 모든 참조 찾기(해당 함수나 변수가 정의되거나 사용된 모든 곳을 찾아 띄워 준다.)
- <kbd>Shift</kbd>+<kbd>F10</kbd>: 컨텍스트 메뉴(강의에선 <kbd>Opt</kbd>+<kbd>Enter</kbd>로 변경하라고 권함.)


## Git

- Git는 내장돼 있고, 변경사항이 있는 경우 줄번호 옆에 파란 표시가 되는데, 이걸 클릭하면 뭐가 변경된 것인지 알려 준다.
- <kbd>Ctrl</kbd>+<kbd>Shift</kbd>+<kbd>G</kbd>: 사이드바에 Git 패널을 연다. 변경된 파일을 클릭하면 변경사항을 보여 주고, 파일을 add하거나 revert할 수 있는 등 여러 작업을 할 수 있다.
- 커맨드 입력창에 Git를 입력하면 여러 명령이 뜬다.


## 커맨드라인 실행 파일 설치

커맨드 입력창에서 'Shell Command: Install 'code' command in PATH' 실행. 이후 `code`라는 명령어로 실행 가능.


## 추천 환경설정

- `"explorer.openEditors.visible": 0` - 좌측 사이드바에서 열려 있는 파일들 목록을 날린다.
- `"editor.tabCompletion": true` - 탭을 이용해 자동완성을 한다.
- `"workbench.activityBar.visible": true` - 맨 좌측의 세로 아이콘이 있는 게 activityBar다. 그걸 감출지 여부. 동영상에선 감추라고 한다. 난 아직 초보라 열어 뒀다.


## 추천 확장

- advanced-new-file(by patbenatar): 커맨드 입력창(<kbd>Shift</kbd>+<kbd>Cmd</kbd>+<kbd>P</kbd>)에서 간편하게 새 파일을 만들 수 있게 해 준다. 당연히 새 파일 단축키도 제공한다. 커맨드를 실행하면, 새 파일을 만들 폴더를 고르고, 파일명을 입력한다.

- File Utils(by Steffen Leistner): 커맨드 입력창에서 파일 생성, 복제, 이동, 이름 변경, 삭제를 할 수 있게 해 준다. 새 파일 생성은 advanced-new-file와 겹친다. 편한 걸 골라 쓰면 될 듯.

- PHP Intelephense(by Ben Mewburn): 클래스, 변수나 함수 등 PHP의 Symbol을 스캔해서 찾을 수 있게 해 준다. 현재 파일에서 찾을 때는 <kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>O</kbd>, 전체 프로젝트에서 찾을 때는 <kbd>Cmd</kbd>+<kbd>T</kbd>. `use`로 클래스를 임포트할 때도 자동완성을 제공한다.

- snippet-creator(by nikitaKunevich): 코드조각(Snippet) 만드는 걸 쉽게 도와 주는 프로그램. 이미 있는 코드를 선택한 뒤 커맨드 입력창에서 Create Snippet을 선택하면 Snippet을 만들 수 있다. 커맨드 팔레트에서 Configure User Snippets를 고르고 php를 선택하면 생성한 php용 코드조각을 볼 수 있다. 자동완성을 쉽게 하려고 `"editor.tabCompletion": true` 설정을 이용. 상세한 코드조각 작성법은 [VSCode 사용자 설명서](https://code.visualstudio.com/docs/editor/userdefinedsnippets)에 나와 있다. 

- Git Lens(by GitSupercharged): VSCode의 Git 지원 기능을 강화해 준다. 

- Laravel Artisan(by Ryan Naddy): artisan 관련 기능을 커맨드 입력창에서 처리할 수 있게 해 준다. 

- Better PHPUnit(by calebporzio): 커맨드 입력창에서 phpunit을 실행할 수 있게 해 준다. 클래스별, 함수별 테스트를 기본적으로 지원하며 직전 테스트 다시 하기 기능도 지원한다. 단축키를 잘 매핑해서 사용하면 좋다.

- php cs fixer(by junstyle): 지정된 형식에 맞게 코드 포맷을 정리해 준다. `"php-cs-fixer.onsave": true` 설정을 하면 저장할 때마다 그렇게 한다. (php-cs-fixer가 설치돼 있어야 한다. 확장 설명에 있는 설정 파일 내용을 복사한 다음, 파일 경로를 `"php-cs-fixer.config": "/Users/mytory/.vscode/.php_cs"`에 넣어 주면 설정을 입맛대로 고칠 수 있다.)

- Vim(by vscodevim): vim 스타일 편집을 가능하게 해 준다. vim 마니아라면...




## 디버깅

xdebug와 연동해서 중단점(Break Point)를 찍고 그 시점의 변수값 등을 보는 방법인데, 여기서 모두 설명할 수는 없다. 아래 사항들을 참고하고 따로 공부한다. ([해당 동영상][debug-video]을 봐도 된다. 4분밖에 안 된다.)

[debug-video]: https://laracasts.com/series/visual-studio-code-for-php-developers/episodes/13

[Debugging: Configure VS Code + XDebug + PHPUnit](https://tighten.co/blog/configure-vscode-to-debug-phpunit-tests-with-xdebug)을 참고해서 설치하고 설정한다.

사용하는 VSCode 플러그인은 PHP Debug(by Felix Becker)다. 

디버그 패널을 여는 단축키는 <kbd>Cmd</kbd>+<kbd>Shift</kbd>+<kbd>D</kbd>다. 환경변수에 `export XDEBUG_CONFIG="idekey=VSCODE"`를 넣어 줘야 하고(윈도우는 어떻게 넣는지 설명 안 돼 있으니 찾아 보길), 터미널에서 phpunit을 실행하면 중단점을 설정한 곳에서 멈춘다. 중단점은 줄번호 왼쪽을 클릭해서 만든다.



## js용 확장

- Vetur(by Pine Wu): Vue 문법 강조 등.

- Import Cost(by Wix): js import 키워드로 임포트하는 것의 용량이 얼마나 되는지 표시해 준다. `*.vue` 파일에서도 표시를 해 주려면 아래 설정이 필요하다. 타입스크립트 확장자에 vue를 추가.   
  ~~~
  "importCost.typescriptExtensions": [
      "\\.vue?$"
  ]
  ~~~

- ESLint: 문법 검사. 역시 vue를 위해 설정에 vue와 vue-html을 추가해야 한다. 그런데 npm으로 설치도 해야 하고 복잡하다. 따로 공부를 하셔야 함. 그래도 js 문법 검사를 하려면 필수적 플러그인.
  ~~~
  "eslint.validate": [
    "javascript",
    "javascriptreact",
    "vue",
    "vue-html"
  ]
  ~~~
