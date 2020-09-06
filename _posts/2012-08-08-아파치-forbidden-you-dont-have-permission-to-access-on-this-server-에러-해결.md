---
title: '아파치 Forbidden  You don&#8217;t have permission to access / on this server. 에러 해결'
author: 안형우
layout: post
permalink: /archives/3143
categories:
  - 서버단
tags:
  - apache
date_modified: 2017-04-02 17:25
image: /uploads/2017/apache-directory.jpg
description: 아파치에서 웹 서버의 폴더에 접근할 수 없어서 뜨는 에러다. 우선 아파치 환경 설정에서 해당 폴더 접근을 허용하고, 아파치 사용자에게 폴더의 실행 권한과 파일의 읽기 권한을 줘야 한다.
---

[맥북에서 아파치 가상호스트 설정][1]에 성공했는데 이번에는 `Forbidden` 에러를 뿜었다.

    Forbidden
      You don't have permission to access / on this server.

에러 로그(`/var/log/apache2/error.log` 혹은 `/var/log/httpd/error_log` 식의 경로를 찾으면 된다)를 보면 아래처럼 생겨먹었다.

    client denied by server configuration : 폴더 경로

## 디렉토리 설정(아파치 2.4)

([아파치 2.2 설명](#아파치-22)은 아래 있다.)

이런 에러가 나오는 이유는 apache `<Directory>`설정에서 막아 둔 폴더에 접근하려 했기 때문이다. apache 기본 설정은 `/` 하위를 모두 막고, 열어둘 디렉토리만 지정하는 형식이다. 우분투 16.04, apache 2.4 기준으로 `/etc/apache2/apache2.conf` 파일을 보면 아래처럼 `/usr/share`와 `/var/www`만 열어 둔 것을 확인할 수 있다.

    <Directory />
        Options FollowSymLinks
        AllowOverride None
        Require all denied
    </Directory>

    <Directory /usr/share>
        AllowOverride None
        Require all granted
    </Directory>

    <Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
    </Directory>

우선 `/` 폴더에는 `Require all denied`라고 설정해 둔 것을 볼 수 있다. 전부 막는다는 뜻이다. 

`<Directory>` 설정에 대한 자세한 설명은 아파치 문서의 [`<Directory>` 지시](https://httpd.apache.org/docs/2.4/en/mod/core.html#directory) 항목을 보라.

여기서 주목할 것은 `Require` 지시인데, 접근 권한에 대한 설정이다. 여러 가지로 설정을 할 수 있지만, 대략 세 가지만 알아 두면 되지 싶다.

(근데 이건 아파치 2.4 문법이다. 2.4보다 낮은 버전이라면 좀 스크롤을 내려서 2.2 관련 설명을 봐라.)

- `Require all granted`: 무조건 허용
- `Require all denied`: 무조건 금지
- `Require ip 10 172.20 192.168.2`: 특정 아이피만 접근 허용. 여기서는 `10`으로 시작하는 아이피, `172.20`으로 시작하는 아이피, `192.168.2`로 시작하는 아이피 세 개를 허용한 것 같다.

모든 설정을 보고 싶다면 [Require Directive]를 보면 된다. 

[Require Directive]: https://httpd.apache.org/docs/2.4/en/mod/mod_authz_core.html#require


## 아파치 2.2

아파치 2.2에는 `Require` 지시가 아니라 `Allow` 지시와 `Deny` 지시가 적혀 있을 것이다. 아래처럼 말이다.

~~~
<Directory />
    # 모두 접근 금지
    Order Deny,Allow
    Deny from All
</Directory>

<Directory /var/www>
    # 모두 접근 허용
    Order allow,deny
    Allow from all
</Directory>
~~~

2.4는 `Require all granted`에 해당하는 것은 `Allow from All`, `Order allow,deny`고, `Require all denied`에 해당하는 것은 `Deny from All`, `Order Deny,Allow`라고 이해하면 맞다([Upgrading to 2.4 from 2.2 참고]). 키 말고 값으로 들어가는`from all`과 `deny,allow` 같은 것들은 대소문자 구분을 안 하는 듯하다.

[Upgrading to 2.4 from 2.2 참고]: https://httpd.apache.org/docs/2.4/upgrading.html

`Order`를 자세하게 이해하기는 좀 난해했는데, 2.4부터는 사용하지도 않아서 이해하고 싶은 의욕이 없다. 이해에 도전하고 싶다면 [Order Directive](https://httpd.apache.org/docs/2.2/ko/mod/mod_authz_host.html#order)를 참고하자.


## 자신의 웹서버 디렉토리에 접근해도 된다고 적어 주자

이해했다면, 자신의 웹서버 디렉토리를 허용해 주자. 나는 `apache2.conf`의 다른 디렉토리 설정들 밑에 아래처럼 추가했다.

    <Directory /home/mytory/workspace/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

`Require all granted`를 적으면 되는데, `Options`와 `AllowOverride` 설정도 알아 두자.

- `Options`: 각종 옵션이다. 위에서 나는 두 가지를 설정했는데 `Indexes`는 기본으로 접근할 파일이 없을 때 디렉토리 목록을 보여 주게 하는 것이다. 나는 개발 용도로 설정한 거라 이 옵션을 줬는데, 제품 서버에선 이 옵션을 켜 두면 안 된다. 보이면 지워라. `FollowSymLinks`는 심볼릭 링크[^symlink]를 따라가게 하는 옵션이다. 제품 서버에서 켤지 말지는 판단을 해야 한다. 다양한 옵션은 [Options 지시] 문서를 참고하라.
- `AllowOverride`: `.htaccess` 파일 작동을 허용할 조건을 설정한다. 보통 `All` 아니면 `None`을 쓴다. 자세한 내용은 [AllowOverride 지시] 문서를 참고하라.

[Options 지시]: https://httpd.apache.org/docs/2.4/ko/mod/core.html#Options
[AllowOverride 지시]: https://httpd.apache.org/docs/2.4/ko/mod/core.html#allowoverride

[^symlink]: 심볼릭 링크는 리눅스에서 사용하는 것인데, 다른 디렉토리(나 파일)을 특정 디렉토리에 연결해 주는 역할을 하는 파일이다. 예를 들면, `other-folder`를 `workspace` 밑에 `sym-folder`라는 이름을 가진 심볼릭 링크로 연결했다고 해 보자. 그러면 `workspace` 밑에 `sym-folder`라는 이름으로 `other-folder`가 연결된다. `workspace`에서 `cd sym-folder`라고 치면 `sym-folder`라는 이름을 가진 심볼릭 링크 폴더로 이동하게 되고, 해당 폴더의 내용은 `other-folder`의 내용이 나온다. `FollowSymLinks` 옵션을 켜면 아파치가 `sym-folder`를 폴더로 인식하고, 켜지 않으면 그냥 `sym-folder`라는 파일로 인식한다.


## 아파치 재시작

아파치 설정을 변경한 뒤 적용하려면 아파치를 재시작해야 한다. 아래 세 명령어 중 하나로 하면 된다.

    sudo apachectl restart # 맥북
    sudo service apache2 restart # 우분투
    sudo systemctl restart apache2 # 오픈수세


## 퍼미션 설정 ― 아파치 사용자가 실행/읽기 권한이 있어야 한다

아파치 설정에서 디렉토리 접근을 허용한 뒤에도 접속이 안 되고, 에러 로그를 봤는데 퍼미션이 없다고 나오면 이제 아파치 사용자에게 해당 폴더의 퍼미션을 주면 된다.

아파치 프로세스를 실행하는 사용자는 일반 사용자가 아니다. 아파치 서버 실행은 루트 권한으로 하지만, 아파치 프로세스가 루트 사용자 권한을 가지진 않는다. 아파치를 돌리는 아파치 전용 사용자가 프로세스를 소유하고(우분투의 경우 `www-data`) 아파치 프로세스는 이 전용 사용자의 권한을 가진다. 웹 서버가 일반 사용자의 파일을 함부로 읽거나 쓰면 안 되기 때문에, 딱 웹사이트 서비스에 필요한 디렉토리와 파일에만 접근하도록 사용자를 분리해서 권한을 주는 것이다. 그렇다면 웹서버용 폴더와 파일에는 당연히 아파치 사용자가 접근할 수 있어야 한다. 구체적으로는 폴더는 실행 권한, 파일은 읽기 권한, 업로드를 하거나 파일을 작성하거나 수정하려면 쓰기 권한까지 있어야 한다. 이를 위해 아래 세 가지 권한 전략 중 하나를 택할 수 있다.


### 파일과 폴더를 아파치 소유로 하는 방법

웹사이트 파일과 폴더를 몽땅 아파치 사용자의 소유로 하고 소유자 실행 권한, 읽기 쓰기 권한을 준다. 간편하지만 피곤하다. 내가 파일을 수정할 수가 없게 된다. 모든 파일에 아파치가 무제한 쓰기 가능하기 때문에 해커가 해킹에 취약해지는 점도 있다. 


### 소유는 내가 하고, 그룹을 아파치 그룹으로 설정하는 방법

소유는 내가 하고, 파일과 폴더의 그룹을 아파치 그룹으로 설정한다(우분투의 경우 `sudo chgrp -R www-data {폴더}`)[^curly-brace][^www-data]. 그리고 나서 **파일과 폴더별로** 아파치 그룹에 실행 권한, 읽기 권한, 쓰기 권한을 **각각 필요한 만큼** 준다. 예컨대, 모든 폴더엔 일단 그룹이 실행할 수 있는 권한을 줘야 할 것이다. (`find {폴더} -type d -exec chmod g+x {} \;`)[^find] 그리고 모든 파일과 폴더엔 읽기 권한을 줘야 할 것이다. (`chmod -R g+r {폴더}`) 업로드 폴더엔 쓰기 권한도 줘야 할 것이다. (`chmod -R g+w {업로드-폴더}`)


### 소유는 내가 하고, 전체 권한에 실행/읽기 권한을 주는 방법

소유는 내가 하고, 전체 권한에 실행 권한과 읽기 권한을 준다. 따로 아파치 사용자를 위한 권한 설정은 하지 않는다. 이렇게 하려면 위 명령어 예제에서 `chmod` 명령어의 `g+x`, `g+r`, `g+w`를 `a+x`, `a+r`, `a+w`로 바꿔서 사용하면 된다.

[^curly-brace]: `{폴더}` 전체를 원하는 폴더로 바꿔서 사용하면 된다. 폴더가 `~/workspace`라면 `sudo chgrp -R www-data ~/workspace/`라고 쓰는 것이다. `{폴더}`라는 표시는 `{`, `}`를 포함해서 전체를 다른 것으로 바꾸라는 뜻이다. `{`, `}`를 남겨 두고 안쪽만 바꾸라는 뜻이 아니다. 내가 초보 시절에 가장 헷갈렸던 부분이라서 굳이 적는다.

[^www-data]: 우분투에선 아파치의 그룹이 `www-data`라서 그렇게 예시 명령어를 적었다. 리눅스도 제품별로 아파치 사용자와 그룹이 다르다. 따라서 아파치 사용자와 그룹을 확인한 뒤 `www-data` 부분을 자신에 맞게 바꿔 적어야 한다. 아파치 사용자와 그룹을 확인하려면 설정 파일을 찾아 보면 된다. `User`, `Group` 항목에 씌어 있다. 그러나 그보다 간편한 방법은 `/var/www` 폴더의 소유자와 그룹을 확인하는 것이다.

[^find]: `-type d`는 디렉토리만 찾으라는 것, `-exec`는 찾은 파일을 가지고 실행할 명령어를 적어 주는 것, `{}`는 명령어에서 찾은 파일이 들어갈 자리, `\;`는 명령어가 끝났다는 표시다. 만약 제외하고 싶은 폴더가 있다면 `! -path "{폴더 출력 모양}"` 옵션을 사용한다. 옵션으로 넘기는 값이 까다로우니 따옴표를 꼭 쓰고 출력 모양을 잘 신경써야 한다. 예컨대 `.git` 폴더를 제외하고 싶다면 `! -path "./.git" ! -path "./.git/*"` 하고 두 번 써 줘야 한다. `{폴더 출력 모양}`은 `find` 명령을 내리는 위치에 따라 다르니 각자 환경에 맞춰 다르게 써 줘야 한다.

세 방법 중 하나를 좋을 대로 선택하자. 로컬 작업용일 땐 크게 신경쓸 게 없다(심지어 모든 폴더와 파일에 `777` 권한을 줘도 당장 별 문제가 되진 않을 것이다). 제품 서버에선 보안을 신경써야 하고, 따라서 2나 3중에 선택하자. 역시 3보단 2가 나을 것이다. 로컬 서버를 굴릴 때 제품 서버를 어떻게 굴릴지 연습하는 편이 좋을 테니, 로컬 서버도 2로 권한을 설정하자.

앞서 말했듯 디렉토리에는 실행 권한이 있어야 하고, 파일에는 읽기 권한이 있어야 한다. 

아파치 사용자나 그룹에 폴더와 파일의 권한을 부여했다면 이제 잘 될 것이다.

 [1]: https://mytory.net/archives/3135 "맥북 아파치 가상호스트 활성화를 위해선 ‘웹 공유’를 켜야 한다"
