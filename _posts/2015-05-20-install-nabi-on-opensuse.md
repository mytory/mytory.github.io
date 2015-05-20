---
layout: post
title: "오픈수세에서 uim 사용하기"
categories:
- etc
tag:
- program
- linux

---

우선 root 권한으로 들어가자.

    sudo su

그리고 `/etc/X11/xim` 파일을 본다. 나는 `less`로 봤다.

    less /etc/X11/xim

설명이 잘 돼 있다. 입력기(input method)를 바꾸는 4가지 방법이 나온다. 내가
번역한 것이다. 

<pre>
# 기본값을 바꾸려면, 다음과 같은 선택지가 있다.
#
#    1) /etc/sysconfig/language 에서 INPUT_METHOD 변수를 설정한다.
#       예를 들면:
#           INPUT_METHOD="scim"
#       이것은 모든 사용자의 기본 설정을 바꾼다.
#    2) set and export the variable "INPUT_METHOD" in ~/.profile in the
#    2) 사용자 홈 디렉토리에 있는 ~/.profile 파일(csh 사용자인 경우
#       ~/.login)에 "INPUT_METHOD" 값을 설정하고 export 한다. 예를 들면:
#           export INPUT_METHOD="scim"
#       이러면 해당 사용자의 기본값만 변경한다.
#    
#    The possible values for the variable INPUT_METHOD are the names
#    INPUT_METHOD에 들어갈 수 있는 값은 /etc/X11/xim.d/ 디렉토리에 존재하는
#    스크립트 파일의 이름이다. 예컨대, 만약 /etc/X11/xim.d/scim 파일이 있고,
#    INPUT_METHOD 값을 "scim"으로 설정했다면, 이 스크립트를 맨처음 실행하게 될
#    것이다. 그리고 이 스크립트 실행에 실패하는 경우에만 다른 스크립트를 실행하게 된다.
#
#    3) 만약 /etc/X11/xim.d 에 있는 다른 가능한 스크립트가 실행되길 원치
#       않는다면, ~/.xim 에 선호하는 입력기를 실행하는 코드를 적고
#       저장한다. 만약 ~/.xim 파일이 있다면, 오직 이 파일만 입력기 시작에
#       사용되고, 다른 것은 아무 것도 사용하지 않는다.
#       보통은 몇 줄만 적으면 된다. 시스템 전체 입력기를 시작하는 파일인,
#       /etc/X11/xim 은 너무 복잡하다. 언어와 설치된 입력기를 바탕으로 최선의
#       선택을 하려고 돼 있기 때문이다.
# 
#       예컨대, "scim"을 입력기로 사용하고 싶다면, ~/.xim 파일에 다음 5줄을
#       추가하는 것으로 충분하다(더이상 할 건 없다).
#
#       export XMODIFIERS="@im=SCIM"
#       export GTK_IM_MODULE=scim
#       export QT_IM_SWITCHER=imsw-multi
#       export QT_IM_MODULE=scim
#       scim -d 
</pre>

그래서 위에 시키는대로 하면 된다. 나는 uim으로 변경했다. uim은 이미
`/etc/X11/xim.d/uim` 파일이 있었기 때문에 `/etc/sysconfig/language` 파일에
`INPUT_METHOD`만 `uim`으로 설정해 주면 됐다.

nabi도 사용하려고 했는데 emacs gui 프로그램에서 한글 띄어쓰기가 제대로 안 돼서
때려 치웠다.

nabi는 오픈수세 저장소에 없기 때문에 소스코드를 내려받아 컴파일한 뒤,
스크립트를 만들어 `/etc/X11/xim.d/` 폴더에 넣고 `/etc/sysconfig/language`
파일에 `INPUT_METHOD="nabi"` 라고 채워 넣었다. `/etc/X11/xim.d/nabi`
스크립트의 내용은 아래와 같다.

<pre>
OLD_PATH=$PATH
PATH=/usr/bin:/opt/kde3/bin:$PATH

if ! type -p nabi > /dev/null 2>&1 ; then
    echo "nabi is not available."
    return 1
fi

export XMODIFIERS=@im=nabi
export GTK_IM_MODULE="nabi"
export QT_IM_SWITCHER=imsw-multi
export QT_IM_MODULE=nabi
case "$WINDOWMANAGER" in
    /opt/kde3/bin/startkde)
        if ! type -p skim > /dev/null 2>&1 \
          || grep -i -q "^[[:space:]]*Autostart.*=.*false" $HOME/.kde/share/config/skimrc
        then
            nabi -wm -wait &
        else
        # skim will be  used. But we don't start it here,
    	# we rely on the KDE3 autostart
    	# mechanism used in the skim package instead.
        # skim -d
    	:
        fi
    ;;
    *)
        nabi &
    ;;
esac

PATH=$OLD_PATH

# success:
return 0
</pre>

내가 뭘 짠 건 아니고, 같은 폴더에 있는 `scim` 파일을 복사한 뒤 명령어만 약간
수정한 것이다. 
