---
title: 'ufw 방화벽 로그를 ufw.log에 따로 기록하게 하기'
layout: post
tags: 
  - etc
  - linux
---

ufw(**U**ncomplicated **F**ire**w**all, 손쉬운 방화벽)는 데비안 계열 리눅스에서 사용하는 쉬운 방화벽 관리 프로그램이다. (iptable 관리 인터페이스라고 생각하면 된다.)

여기서 방화벽 설정을 하면 `dmesg` 결과나 `/var/log/syslog` 파일, `/var/log/kern.log` 파일에 방화벽 차단 로그가 남는다. 그런데 방화벽으로 누굴 차단하는 경우가 많다면 방화벽 로그가 너무 많아져 다른 로그들을 살피기가 매우 힘들어진다. 내 경우 `kern.log` 파일을 다운받고 ufw 관련 로그를 삭제했더니 9MB짜리 파일이 882바이트로 줄어들었다. 3만 6779줄짜리 로그가 6줄로 줄어든 것이다.


## 해결책

해결책은 ufw 로그가 커널 로그와 섞이지 않게 하는 것이다. 우분투에는 기본적으로 이런 설정값이 포함돼 있다. 

`/etc/rsyslog.d/20-ufw.conf` 파일을 열어서 맨 마지막 줄의 주석을 해제해 준다. (에디터는 선호하는 걸 사용하자. 초보라면 nano로 열면 된다. 열 때 관리자 권한이 있어야 하니 `sudo`를 앞에 붙이자. 즉, 초보라면 `sudo nano /etc/rsyslog.d/20-ufw.conf`)

그리고 rsyslog 재부팅하면 완료. (`sudo systemctl restart rsyslog`)


### 따라하기

아래가 `20-ufw.conf` 파일의 내용인데, 작업 결과로 마지막줄은 `& stop`이 됐다. 원래 처음에 열어 보면 `# & stop`이라고 주석처리가 돼 있다. 여기서 `# `을 지우고 `& stop`만 남기는 것이다. (사실 이미 파일의 주석에 친절하게 설명이 씌어 있다. 대충 해석하면 "아래 stop을 주석해제하면 kern.*과 같은 파일에 로그가 쌓이지 않게 됩니다.")

~~~
# Log kernel generated UFW log messages to file
:msg,contains,"[UFW " /var/log/ufw.log

# Uncomment the following to stop logging anything that matches the last rule.
# Doing this will stop logging kernel generated UFW log messages to the file
# normally containing kern.* messages (eg, /var/log/kern.log)
& stop
~~~

그리고 아래 명령어로 rsyslog 재부팅을 해 준다. (rsyslog는 리눅스의 로그 관리 프로그램이다. 이 프로그램 자체가 궁금하면 [rsyslog](https://www.rsyslog.com/) 사이트 참고.)

~~~ bash 
sudo systemctl restart rsyslog
~~~

잘 됐는지 확인하려면 ufw가 로그를 기록할 만한 일이 발생한 뒤에 `/var/log/ufw.log` 파일이 생겼는지 확인해 본다. 그리고 `dmesg`를 쳐서 ufw 로그가 `kern.log`에 쌓이고 있는지도 확인해 본다. 안 쌓이고 있다면 성공. (예전에 쌓인 걸 새로 쌓인 걸로 착각하지는 말자.)

## 참고 자료

- [askubuntu.com의 "Redirect UFW logs to own file?" 답변](https://askubuntu.com/a/896349)
- [위키피디아 UFW 항목](https://ko.wikipedia.org/wiki/UFW)