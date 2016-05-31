---
title: '우분투에서 서브라임의 ctrl+alt+down/up 작동하게 하기'
layout: post
tags:
  - ubuntu
---

사무실에선 오픈수세를 사용한다. 집에선 윈도7을 사용하다가 최근에 SSD가 하나 더 생겨서 우분투를 설치했다. 그런데 서브라임 텍스트에서 <kbd>ctrl</kbd>+<kbd>alt</kbd>+<kbd>up</kbd>/<kbd>down</kbd> 키가 안 먹는 것이다. 커서를 위로, 아래로 확장시켜 주는 키다. 서브라임을 사용하는 사람들이면 누구나 한 번쯤 사용해 봤을 것이다. 이 키를 작동하게 만드는 방법이다.

우선 dconf-editor를 설치한다.

    sudo apt-get install dconf-editor

dconf-editor를 실행한 다음, <kbd>ctrl</kbd>+<kbd>f</kbd>를 눌러서 keybinding을 찾는다. 찾기를 반복하면 아래 화면이 나온다.

![](/uploads/2016-05-21/add-previous-line.png)

직접 찾아 가려면 `org > gnome > desktop > wm > keybindings`으로 간다.

거기에서 위 그림에서 찾아볼 수 있는 대로, `<Primary><Alt>KP_Up`과 `<Primary><Alt>KP_Down`을 삭제한다. `<Control><Alt>Up`과 `<Control><Alt>Down`도 찾아서 없앤다. 더블클릭한 뒤 `[]`만 남기면 된다.

## 서브라임 텍스트의 우분투 키바인딩

그리고, 서브라임 텍스트의 키바인딩을 변경해야 한다. 서브라임 텍스트로 와서 **Preperences > Key Bindings(User)**로 들어간다. 그리고 아래 두 줄을 맨 마지막에 끼워 넣는다.

    { "keys": ["ctrl+alt+up"], "command": "select_lines", "args": {"forward": false} },
    { "keys": ["ctrl+alt+down"], "command": "select_lines", "args": {"forward": true} }

알겠지만, 각 줄은 쉼표로 구분돼야 하고, 마지막 줄엔 쉼표가 없어야 한다. 만약 이 설정 전에 아무 설정도 하지 않았다면 아래처럼 보일 것이다.

<pre>
[
    { "keys": ["ctrl+alt+up"], "command": "select_lines", "args": {"forward": false} },
    { "keys": ["ctrl+alt+down"], "command": "select_lines", "args": {"forward": true} }
]
</pre>

이러면 이제 작동하기 시작한다.
	  
	  


