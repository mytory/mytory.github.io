# php7에서 옛 mysql 함수 쓰기

https://ckon.wordpress.com/2015/08/06/put-mysql-functions-back-into-php-7/

0. 설치

        apt install php-dev


1. 소스코드 받기

        $ git clone https://github.com/php/pecl-database-mysql --recursive
        $ cd pecl-database-mysql

2. 컴파일하기

        $ phpize
        $ ./configure
        $ make
        $ make test
        $ sudo make install

3. `php.ini`에 다음 내용을 추가

        extension = <mysql.so 파일의 경로> ; 나의 경우는 /usr/lib/php/20151012/mysql.so 였음




