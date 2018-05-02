# 도커 명령


## host ip를 알기

host ip를 알려면 container에서 다음 명령을 실행한다.

    route | awk '/^default/ { print $2 }'



## network 구성

고정 network를 구성하려면 아래 명령어로 만든다. 근데 사실 기본 네트워크를 사용하면 된다. (`172.17.0.*`) expose를 하면 된다.

    docker network create -d bridge --subnet 192.168.0.0/24 --gateway 192.168.0.1 dockernet

참고글은 https://forums.docker.com/t/accessing-host-machine-from-within-docker-container/14248/5

오히려 중요한 건 [Dockerfile의 EXPOSE 포트](http://pyrasis.com/book/DockerForTheReallyImpatient/Chapter04/02)다. 여기서 80 포트를 노출해 두면 `http://172.17.0.2/`로 접속 가능하다.


## commit

도커에서 커밋하는 것은 컨테이너다.

    docker commit  -a "name <email@domain.com>"  -m "your message"  컨테이너-이름이나-아이디  만들-도커-이미지-이름:태그

위와 같은 명령어로 커밋한다. `-a` 뒤엔 커밋한 사람 정보를 쓴다. 필수는 아니다. `-m` 뒤엔 커밋 메시지를 적는다. 실례를 든다면 이렇다. 현재 돌아가는 컨테이너 이름은 `php5`, 만들려고 하는 도커 이미지 이름은 `mytory-php5`로 골랐다. 태그는 `0.1`로 붙이려고 한다.

    docker commit  -a "mytory <mail@mytory.net>"  -m "my first commit"  php5  mytory-php5:0.1

