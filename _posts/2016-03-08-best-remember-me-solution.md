---
title: '자동 로그인 구현 방법에 대해'
layout: post
categories: 
  - serverside
tags:
  - security
---

자동 로그인을 구현할 일이 있어서 좀 찾아 봤다. 몇 개를 찾았는데, 대동소이한 방법을 제시하는 것 같다. 그 중 ['Implementing Secure User Authentication in PHP Applications with Long-Term Persistence (Login with "Remember Me" Cookies)'](https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence)를 참고하면 될 것 같다. 아래는 내가 요약한 거다. 이 글은 Paragon Initiative라는 보안 업체가 작성한 글이다.

어떤 해시 함수를 사용해야 할까
------------------------------

MD5나 SHA1을 암호 해시 툴로 사용하는 것은 좋은 생각이 아니다. 허용할 수 있는 해시 방법은 아래와 같다.

- Argon2(암호 해시 대회에서 우승했다)
- bcrypt
- scrypt
- PBKDF2 (**P**assword-**B**ased **K**ey **D**erivation **F**unction #2)

`scrypt`는 PECL로 설치해야 한다. 만약 `scrypt`를 사용할 수 있다면 그렇게 하는 걸 추천한다. 그리고 `scrypt`를 쓸 수 없다면 `bcrypt`를 써야 하는데, `password_hash()`와 `password_verity()` 함수가 그걸로 구현돼 있다. 스스로 구현하지 말고 그걸 써라.

bcrypt는 72자 이상을 비워 버리고 `NUL` 문자도 없앤다. 그런데 이 문제를 해결하기 위해 암호를 sha-256을 이용해 해시로 만든 다음 `bcrypt`로 다시 암호화하는 경우가 있다. 좋지 않다. 특정 문자열에 특정 해시를 만들어내는 경우가 있어서 공격으로 풀어내는 속도를 엄청나게 빠르게 해 준다.

아래 코드는 위험한 코드다.

    $stored = password_hash(hash('sha256', $_POST['password'], true), PASSWORD_DEFAULT);

이 문제를 회피하기 위해서는 sha-256으로 암호화한 것은 다시 base64로 인코딩해라. 아래처럼.

```
$stored = password_hash(
    base64_encode(
        hash('sha256', $_POST['password'], true)
    ),
    PASSWORD_DEFAULT
);
```


암호에 후추를 뿌릴까?
---------------------

후추는 암호 문자열에다가 추가로 문자를 넣어서 길게 한 뒤 암호화하는 그런 문자열을 말한다. 보통은 소금(Salt)라고 부르니 여기선 그냥 Salt라고 쓰겠다. 암호가 "1234"고 Salt가 "!@#$"라면 이런 식으로 구현할 것이다.

    // 보통은 이럴 텐데, 이건 추천하지 않는다니까 하지 말자
    sha1('1234' . '!@#$');
    
    // sha256은 복호화를 쉽게 해 주는 취약점이 있다니까 쓰지 말아야 겠지
    hash('sha256', '1234' . '!@#$');
    
    // 어쨌든 이 글에서 예시로 든 것은 아래와 같은데 역시 추천하지 않는다고 한다.
    // 네 번째 인자값은 raw 출력 여부다
    hash_hmac('sha256', '1234', '!@#$', true)
    
이런 식의 Salt는 `password_hash()` 함수가 제공해 주는 Salt보다 보안성이 떨어진다. 그리고 데이터베이스와 PHP 소스코드가 한 하드웨어에 있는 경우, Salt도 쉽게 얻을 수 있다. 그러니까 DB랑 어플리케이션 서버를 분리하는 걸 추천한다. 그리고 위처럼 Salt를 추가하면 Salt를 바꿀 수가 없는 점도 문제다. 위처럼 해 놓고 Salt를 바꾸려면 전체 사용자의 암호를 재설정해야 한다. 

좋은 방법은, 특히 하드웨어가 분리돼 있을 때 가장 좋은데, 해시를 데이터베이스에 집어 넣기 전에 암호화하는 것이다. Salt를 변경하려면 암호화한 해시를 복호화한 다음 다시 암호화해서 집어넣으면 된다.

그러나 이걸 위해서도 스스로 라이브러리를 만들지 말아야 한다. [Defuse Security가 만든 PHP 암호화 라이브러리](https://github.com/defuse/php-encryption)를 추천한다.

그리고 Paragon에서 만든 것도 있다. [PasswordLock](https://github.com/paragonie/password_lock)이다. 아래는 예시코드.

```
## Hash Password, Encrypt Hash, Authenticate Ciphertext

use \ParagonIE\PasswordLock\PasswordLock;

$key = "\x00\x01\x02\x03\x04\x05\x06\x07\x08\x09\x0A\x0B\x0C\x0D\x0E\x0F";
$storeMe = PasswordLock::hashAndEncrypt($_POST['password'], $key);

## Verify MAC, Decrypt Ciphertext, Verify Password

if (PasswordLock::decryptAndVerify($_POST['password'], $storeMe, $key)) {
    // Success!
}

## Re-encrypt a hash with a different encryption key

$newKey = "\xFF\xFE\xFD\xFC\xFB\xFA\xF9\xF8\xF7\xF6\xF5\xF4\xF3\xF2\xF1\xF0";
$newHash = PasswordLock::rotateKey($storeMe, $key, $newKey);
```

암호 정책
----------

암호 정책은 잘못된 게 많다. 최소길이는 강제하는 게 좋지만 최대길이를 강제하는 건 나쁘다. 최소길이 외에는 아무런 조건도 걸지 말아야 한다.

암호 강도를 알려 주는 것은 드롭박스가 만든 [zxcvbn](https://github.com/dropbox/zxcvbn) 라이브러리가 좋다.

다음은 좋은 암호 정책의 예시다.

1. 암호 길이는 12자에서 4,096자여야 합니다.
2. 암호는 유니코드를 포함 어떤 글자여도 상관없습니다.
3. [KeyPass](http://keepass.info/)나 KeyPassX 같은 암호 관리 프로그램을 이용해서 암호를 생성하고 저장하는 것을 강력 추천합니다.
4. zxcvbn으로 암호 강도를 잰 결과가 레벨 3은 돼야만 합니다.

입력할 수 있는 문자에 제한을 두지 말고, 긴 패스워드를 권장하되 그 이상 제한을 두지 마라.


자동 로그인 취약점
------------------

짧은 기간의 인증은 세션을 사용한다. 긴 기간 인증은 쿠키를 쓰는데, 작은 노력만 들이면 꽤 안전하게 만들 수 있다.

일단 `remember_user=1337` 같은 쿠키는 절대 쓰지 마라. `remember_user=1` 하면 아마 관리자로 로그인하게 될 거다.

### 무작위로 생성한 문자열 ###

로그인 유지 토큰은 짐작할 수 없는, 무작위로 생성한 문자열로 이루어지게 해야 한다. 그런데 충분히 무작위로 해야지, 아래 같은 함수를 쓰면 안 된다.

```
function generateInsecureToken($length = 20)
{
    $buf = '';
    for ($i = 0; $i < $length; ++$i) {
        $buf .= chr(mt_rand(0, 255));
    }
    return bin2hex($buf);
}
```

`mt_rand()` 함수는 보안용 함수가 아니다. 아래와 같은 것들을 사용하라.

- [RandomLib](https://github.com/paragonie/random_compat)
- `random_bytes($length)` (PHP 7용, PHP 5라면 [random_compat](https://github.com/paragonie/random_compat) 라이브러리)
- `/dev/urandom`에서 raw 바이트를 읽기
- `mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);`
- `openssl_random_pseudo_bytes($length);`

올바른 방법은 아래와 같다.

```
function generateToken($length = 20)
{
    return bin2hex(random_bytes($length));
}
```

### 시간차 공격 ###

토큰을 `remember=W665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27aen` 식으로 만들게 되면, 마아 데이터베이스에서 이런 식으로 토큰을 검색하게 될 거다.

    SELECT * FROM auth_tokens WHERE token = 'W665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27aen';

쉽지는 않지만 이걸 뚫을 방법도 있다. 위 해시에서 맨 앞 `W`를 `X`로 변경하면, 맨 마지막의 `n`을 `o`로 변경한 것보다 검색 속도가 약간 빨라진다. 관련해서는 [시간이 문제다(It's All About Time)](http://blog.ircmaxell.com/2014/11/its-all-about-time.html)를 참고하라. 고작 몇 나노초 차이겠지만, 위험을 자처할 필요는 없지 않은가. 시간차 공격을 피하려면 `hash_equals()` 함수를 사용하면 되는데, 아래에서는 다른 방법을 사용한다.


자동 로그인 구현
----------------

무작위 생성 토큰으로 인증 여부를 검색하지 말고 `selector:validator` 형식으로 토큰을 만든 다음 `selector`로 검색하면 안전하고 빠르다. 이렇게 하면 서비스 거부 공격(트래픽 공격)도 막을 수 있다. (`hash_equals()` 함수를 쓰면 어쨌든 검색 시간이 늘어나 트래픽 폭탄 공격을 하는 경우 취약하다는 말인 듯하다.)

DB를 아래처럼 만들자. 사용자의 `id`를 `selector`로 사용하면 활성 사용자 숫자가 드러나게 되니까, `selector` 필드를 만들자.

```
CREATE TABLE `auth_tokens` (
    `id` integer(11) not null UNSIGNED AUTO_INCREMENT,
    `selector` char(12),
    `token` char(64),
    `userid` integer(11) not null UNSIGNED,
    `expires` datetime,
    PRIMARY KEY (`id`)
);
```

토큰의 `validator` 부분은 다 저장하지 말고 그것의 sha-256 해시를 저장하자. 쿠키엔 토큰이 평문으로 들어있지만 말이다. 이렇게 하면 `auth_tokens` 테이블이 유출되도 안전하다.

자동 로그인 알고리즘은 아래와 같다.

1. `selector`와 `validator`를 분리한다.
2. `selector`로 `auth_tocken`을 검색하고 없으면 취소한다.
3. `validator`는 사용자의 토큰을 sha-256으로 암호화해서 만든다.
4. 두 해시를 `hash_equals()` 함수로 비교하라.
5. 4번을 통과했다면 로그인 처리.

Paragon이 구현한 [Gatekeeper](https://github.com/psecio/gatekeeper) 솔루션이 있다.

물론, 사용자가 암호를 변경하면, 토큰을 다 비활성화해야 한다.


암호 재설정
-----------

암호 재설정 방법으로 현재 나와 있는 것들은 다 보안에 취약하다. "추억의 장소는?" 따위의 친구라면 알 정도의 재설정용 보안 질문을 하거나, 이메일이나 휴대폰 같은 다른 계정과 연동해서 암호를 재설정한다. 이건 아주 나쁜 방법이다.

1. 가능하다면 뒷문을 만들지 마라.
2. 어떤 보안 질문도 하지 말라. 사람들은 질문에 대한 답을 인터넷에 올려 놓곤 한다.
3. (선택사항) GnuPG 공개키를 프로필에 넣을 수 있게 하라. 암호를 재설정해야 한다면, 계정 복구 토큰을 공개키로 암호화해서 보내 줘라. 그러면 비밀키를 소유한 사람만 토큰을 풀 수 있다. **이 방법을 추천한다.**

암호 재설정 기능을 반드시 넣어야 하고 사용자가 GnuPG를 이용할 정도로 기술에 밝지 않다면, 할 수 있는 최선의 방법은 무작위로 생성한 토큰을 주는 것이다. 암호학적으로 안전한 난수 생성기를 이용하라. 이 토큰을 제시하면 새로운 암호를 설정할 수 있게 해 주는 것이다. **절대로 옛 암호를 전송해 주지 말라. 암호를 평문으로 저장하는 경우에만 할 수 있는 방법 아닌가.** 


나가며
------

위의 권장사항을 모두 지켜도 실수할 수 있다. 그러니 성공한 로그인 시도를 포함해 모든 로그인 시도를 기록하라.

Paragon Initiotive Enterprises는 [기술 자문 서비스](https://paragonie.com/services)를 제공한다. [보안](https://paragonie.com/service/appsec)에 관심을 기울여라. 우리는 웹 어플리케이션 보안을 선도하는 업체다. 이 글을 보면 알 수 있지 않나.

(도움을 받았으니 광고도 넣어 줬다 - 안형우)




