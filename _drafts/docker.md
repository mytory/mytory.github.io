# 도커 명령어


## host ip를 알기

host ip를 알려면 container에서 다음 명령을 실행한다.

    route | awk '/^default/ { print $2 }'


## network 구성

고정 network를 구성하려면 아래 명령어로 만든다. 근데 위 명령어면 해결되서 굳이 만들어야 하나 싶기도 하다.

    docker network create -d bridge --subnet 192.168.0.0/24 --gateway 192.168.0.1 dockernet

참고글은 https://forums.docker.com/t/accessing-host-machine-from-within-docker-container/14248/5