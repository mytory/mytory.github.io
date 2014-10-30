---
title: JAVA Spring 공부 요약 1 (《스프링을 이용한 RESTful 웹 서비스 구축하기》)
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/13185
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13185-spring-study.md
categories:
  - 서버단
tags:
  - JAVA
  - spring
---
스프링을 이용한 프로젝트를 해야 해서 Spring 공식 웹사이트에서 maven, gradle 튜토리얼을 따라하고 몇 가지 튜토리얼을 따라한 다음, 본격적으로 개발을 하려면 역시 책을 봐야 겠구나 하고 한빛 리얼타임 시리즈의 [《스프링을 이용한 RESTful 웹 서비스 구축하기 &#8211; 실전 예제로 배우는 REST 방식의 스프링 웹 서비스》][1]를 샀다. 1만 2천 원이나 했는데, 다행히 전자 캐시가 4천 9백 원이나 있어서 7천 백 원에 샀다.

데이터베이스를 다루는 데까지 했는데, 정리를 좀 해 본다. 지금까진 거의 세팅만 했다. 이 세팅을 헷갈려 하면 안 되니까 한 번 정리를 하고 넘어가는 것이다.

## 메이븐 프로젝트 생성

메이븐 프로젝트 생성 명령은 아래와 같다.

    mvn archetype:generate
    

기본 정보들을 인자값으로 넘겨 주면 아래와 같다.

    mvn archetype:generate -DgroupId=com.mycompany.app -DartifactId=my-app -DarchetypeArtifactId=maven-archetype-webapp -DinteractiveMode=false
    

`-DarchetypeArtifactId`의 값으로 `maven-archetype-webapp`을 주면 웹 애플리케이션 기반 프로젝트를 생성한다. 즉, 이건 프로젝트의 타입을 고르는 옵션이다.

`pom.xml`에 컴파일러 플러그인과 리소스 플러그인은 기본적으로 추가해 줘야 한다.

메이븐이 생성하는 기본 디렡토리 구조는 아래와 같다.

*   `src/main/java`
*   `src/main/resources`
*   `src/main/webapp`
*   `src/test/java`
*   `src/test/resources`
*   `target`

## 로깅 라이브러리

로깅 라이브러리로 Log4J를 많이 사용하는데, 더 뒤에 나온 Logback이 더 좋다. 속도도 10배 빠르고, 서버 재부팅 없이 로그 레벨을 변경할 수 있다.

로그 라이브러리를 뭘 사용하건 간에 상관없게 만들려면 SLF4J를 사용하면 된다. 이놈은 로그를 감싸서 API를 통일하는 놈인 것 같다. Log4j, Logback, JUL 같은 로깅 라이브러리를 지원한다.

`logback.xml`은 resources 패키지에 둔다.

## 인간 친화적 개발환경을 만들어 주는 Pojomatic 라이브러리

`equals(Obj)`, `hashCode()`, `toString()` 메서드를 오버라이드해 주는 라이브러리인 것 같은데, 아직 나온 건 `toString()` 메서드를 덮어쓴 거다. 객체 주소를 출력해 주지 않고 내용을 출력하게 변경한다. 아놔 이런 걸 원했다고!

## web.xml

`maven-archetype-webapp`로 생성한 프로젝트에서 `web.xml` 파일의 위치는 `src/main/webapp/WEB-INF/`다.

Spring Web MVC를 이용해서 웹 어플리케이션을 개발하려면 `web.xml`에 서블릿을 스프링 걸로 설정해 준다.

    <servlet-class>
    org.springframework.web.servlet.DispatcherServlet
    </servlet-class>
    

스프링에서 사용하는 이 `DispatcherServlet`은 초기화 값(`init-param`)으로 두 개를 설정해 줘야 한다.

*   컨텍스트 클래스(contextClass) : 설정 클래스를 파싱해서 설정값을 가져오는 역할을 하는 클래스라고 한다. 설정 클래스엔 `@Configuration`이라는 어노테이션을 붙여 주는 것 같다.
*   컨텍스트 설정 위치(contextConfigLocation) : 설정 클래스 위치. package를 써 주더라.

서블릿이 잡아챌 URI 모양도 설정해 준다. 서블릿은 이름을 지정해서 여러 개 설정한 뒤, 각 서블릿별로 잡아챌 URI를 다르게 할 수 있다.

이 때 두 개의 서블릿은 독립적인 서블릿이 되는데, 그럼 각자의 Bean을 공유할 수 없게 된다. 만약 공유를 해야 한다면 listener를 설정하면 된다. 자세한 내용은 44~46p에 나와 있다. 필요할 때 찾아 보련다.

## Mapper

이 책은 MyBatis를 사용하는데, MyBatis는 DAO를 Mapper라고 부른다. 그래서 이 책에선 Mapper라고 용어를 쓴다.

DataSource는 설정 클래스에서 설정하면 된다.

자바 인터페이스를 만들고, 그걸 고대로 따라서 매퍼 xml을 만들면 된다. 예컨대 `net.mytory.common.mapper.PersonMapper` 인터페이스를 만들고, 그 안에 메서드로 `List<Book> select();` 라고 적었다면, 이 xml에서는 `mapper` 태그의 `namespace` 프로퍼티에 이 인터페이스 경로를 적어 주고 `select` 태그 안에 쿼리를 적는다. 자세한 내용은 생략.77~81p에 잘 나와 있다.

근데 이렇게만 하면 안 되고 또 설정 클래스(`contextConfigLocation`에 설정한 패키지에 있는 자바 클래스. `@Configuration` 어노테이션이 있는 클래스)에 `@MapperScan(패키지 경로)` 어노테이션을 적어 준다.

그니까 스프링은 각각 만들고 죄다 설정 클래스에다 적어 주는 거다. 그럼 설정 클래스가 지휘를 한다.

이 외에 설정 클래스에 다음을 적어 준다.

*   트랜잭션 매니저
*   sql 세션 팩토리

## 테스트

테스트 코드는 `src/test/java` 폴더 하위에 작성한다. 패키지명은 동일하게 하고, 테스트할 클래스명 뒤에 `Test`라고 접미사를 붙인다.

테스트 클래스 상단에 `@RunWith(SpringJUnit4ClassRunner.class)` 어노테이션을 붙여야 한다.

설정 클래스가 뭔지도 적어 줘야 한다. `@ContextConfiguration(classes={클래스명.class})` 이렇게. 근데 여기선 패키지 경로 넘기고 스캔하는 방법은 없나?

테스트 결과를 볼 때는 아래 명령어를 사용한다.

    mvn -e test
    

`-e` 옵션은 실행 중 발생한 오류를 출력하도록 하는 것이다.

특정 테스트케이스만 실행하고 싶으면 아래처럼 쓴다.

    mvn -e test -Dtest=테스트클래스명

 [1]: http://www.hanbit.co.kr/ebook/look.html?isbn=9788968486890