---
title: 'Outline VPN 서버 certSha256 fingerprint 구하기'
layout: post
tags: 
  - etc
  - vpn
---

[아웃라인VPN](https://getoutline.org/)은 꽤 설치도 편하고 인터페이스도 괜찮다. 스스로 설치해 사용하기 좋은 VPN 서버다.

그런데 서버와 서버 매니저를 연결할 때 입력하는 문자열을, 설치할 때만 알려 주고 다시 알려 주지 않는다는 게 나중에 조금 난감한 문제가 될 수 있다. 아마도 보안 때문인 것 같다. 그래서 설정 문자열을 따로 보관해 두지 않으면 처음 서버 매니저를 설치한 컴퓨터에서만 키를 발급할 수 있다.

설정 문자열을 잃어버렸더라도 다시 만들 수 있는 방법을 찾았다.

아웃라인VPN을 설치한 서버로 접속해서 아래 명령을 차례대로 입력하면 얻을 수 있다. 

아웃라인VPN은 설치가 매우 간편한데, 뜯어 보면 도커를 통해 설치하는 것이다. 그래서 도커에 설치된 아웃라인VPN의 서버에 들어가서 작업을 해야 한다. 

도커에 명령을 내리려면 관리자 권한이 필요하므로 관리자로 들어가 작업했다(`sudo su`). 아니면 그냥 아래의 docker 명령어 앞에 `sudo`를 붙이면 된다.

~~~ bash
sudo su
docker cp shadowbox:/opt/outline/persisted-state/shadowbox-selfsigned.crt .
openssl x509 -in "shadowbox-selfsigned.crt" -noout -sha256 -fingerprint | tr --delete :
# 결과값: SHA256 Fingerprint=3B538730...
rm shadowbox-selfsigned.crt
~~~

위 결과값에서 `Fingerprint=` 이후부터 복사하면 된다. `rm`은 당연히 안전을 위한 조치.

## 서버 설정 문자열 재구성

서버 설정 문자열은 아래 형식이다. 아래에서 "서버 설정의 관리 API URL"은 아웃라인 매니저의 서버 설정에 가면 얻을 수 있다.

~~~ json
{"apiUrl":"서버 설정의 관리 API URL","certSha256":"3B538730..."}
~~~

이미 설치한 아웃라인 매니저가 지워져서 어디서도 아웃라인 매니저에 접속할 수 없다면? ... 음... 그건 또 다른 이야긴데... 아래 "찾은 방법"을 참고해서 코드를 뜯어 봐야 할 것이다. 아웃라인 매니저와 통신하는 포트도 따로 찾아야 할 것이고... :D 나는 이미 설치한 아웃라인 매니저가 유실되지 않았으므로 이것까지는 패스하겠다.

## 찾은 방법

[아웃라인 서버 코드](https://github.com/Jigsaw-Code/outline-server)를 클론받은 다음 다음 명령어를 연달아 치고 코드를 해석하면서 fingerprint를 만드는 명령을 찾았다. 이후 docker 안의 outline 폴더를 찾아서 `crt` 확장자의 파일을 찾아서 넣어 보는 과정을 거쳤다.

~~~ bash
ack certSha256
ack CERT_HEX_FINGERPRINT
ack CERT_OPENSSL_FINGERPRINT
~~~

ack 대신 `grep 문자열 -r .`을 사용해도 될 거다.