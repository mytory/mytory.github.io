도커 컨테이너에서 호스트로 들어오는 mysql 접속 허용이 목적.

    ufw allow proto tcp from 172.17.0.0/24 to any port 3306

1. ip에서 bit mask 사용해야 함.
2. to를 명시해야 함.
3. proto tcp
4. port 3306

이렇게 하니 완료.