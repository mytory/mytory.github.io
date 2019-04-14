---
Title: SpringBoot 다국어 지원 설정 가이드
Tags:
  - java
  - spring
---

참고자료: [Guide to Internationalization in Spring Boot][baeldung]

[baeldung]: https://www.baeldung.com/spring-boot-internationalization

## 의존성 추가

[`spring-boot-starter-thymeleaf`를 추가][1]해야 한다. 사실 타임리프는 스프링부트에서 기본으로 의존성을 포함해 뒀을 것이므로 이 단계를 해야 하는 경우는 거의 없을 것이다.

[1]: https://search.maven.org/classic/#search%7Cgav%7C1%7Cg%3A%22org.springframework.boot%22%20AND%20a%3A%22spring-boot-starter-thymeleaf%22

만약 의존성이 포함돼 있지 않다면 포함시킨다. 메이븐이라면 아래 코드를 사용한다. 2019년 4월 14일 현재 최신 버전은 `2.1.4.RELEASE`다. 물론 자신의 스프링부트 버전을 따라야 하므로 최신 버전이 뭔지는 이 자체로는 큰 의미가 없다.

~~~
<dependency>
    <groupId>org.springframework.boot</groupId>
    <artifactId>spring-boot-starter-thymeleaf</artifactId>
    <version>2.1.4.RELEASE</version>
</dependency>
~~~

그래들(gradle)이라면 아래처럼 코드를 추가한다. 버전을 적지 않으면 스프링부트 버전을 따르는 듯.

~~~ groovy
compile('org.springframework.boot:spring-boot-starter-thymeleaf')
~~~


## Config 클래스를 만든다

아래 코드를 참고하면 된다. 

~~~ java
package com.tachyonlab.webclient.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.web.servlet.LocaleResolver;
import org.springframework.web.servlet.config.annotation.InterceptorRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurerAdapter;
import org.springframework.web.servlet.i18n.CookieLocaleResolver;
import org.springframework.web.servlet.i18n.LocaleChangeInterceptor;

import java.util.Locale;

@Configuration
public class LocaleConfig extends WebMvcConfigurerAdapter implements WebMvcConfigurer {

    @Bean
    public LocaleResolver localeResolver() {

        CookieLocaleResolver cookieLocaleResolver = new CookieLocaleResolver();
        cookieLocaleResolver.setDefaultLocale(Locale.KOREAN);
        cookieLocaleResolver.setCookieName("APPLICATION_LOCALE");
        return cookieLocaleResolver;
    }

    @Bean
    public LocaleChangeInterceptor localeChangeInterceptor() {
        LocaleChangeInterceptor lci = new LocaleChangeInterceptor();
        lci.setParamName("locale");
        return lci;
    }

    @Override
    public void addInterceptors(InterceptorRegistry registry) {
        registry.addInterceptor(localeChangeInterceptor());
    }

}
~~~

나는 기본 로케일을 한국어로 설정했다.

그리고 쿠키 기반 로케일 설정을 사용한다. [원래 예제][baeldung]는 페이지별로 url의 `lang` 파라미터를 받아서 판단하게 돼 있다(세션 기반).

쿠키 리졸버를 사용하는 것으로 설정하면 스프링이 알아서 쿠키를 처리한다.

아래부터는 위 코드의 각 부분에 대한 설명이다.


### 클래스 정의부 extends, implements

~~~ java
public class LocaleConfig extends WebMvcConfigurerAdapter implements WebMvcConfigurer {
	// ...
}
~~~

클래스 정의부인데, `extends WebMvcConfigurerAdapter`와 `implements WebMvcConfigurer`가 다 있어야 한다.

`implements WebMvcConfigurer`만 있으면 `WebMvcConfigurer` 인터페이스에 있는 메서드를 다 구현해야 한다. 그걸 해 놓은 게 `WebMvcConfigurerAdapter`이므로 이걸 상속받으면 해결된다.

`LocaleConfig`라는 클래스 이름은 임의로 정한 이름이므로 자유롭게 고칠 수 있다.


### 로케일 결정 Bean

~~~ java
@Bean
public LocaleResolver localeResolver() {

    CookieLocaleResolver cookieLocaleResolver = new CookieLocaleResolver();
    cookieLocaleResolver.setDefaultLocale(Locale.KOREAN);
    cookieLocaleResolver.setCookieName("APPLICATION_LOCALE");
    return cookieLocaleResolver;
}
~~~

로케일[^locale]을 결정하는 빈을 생성한다. 로케일 결정자(Resolver) 종류엔 세션(`SessionLocaleResolver`), 쿠키(`CookieLocaleResolver`), 헤더(`AcceptHeaderLocaleResolver`, 헤더의 `Accept-Language` 값 기반으로 판단), 고정값(`FixedLocaleResolver`) 리졸버가 있다. 내 코드에선 쿠키 기반 로케일 결정을 사용했다.

`setDefaultLocale()`을 사용해 쿠키명을 `APPLICATION_LOCALE`로 설정해 줬다. 언어를 변경하면 해당 쿠키가 설정된 것을 확인할 수 있다. (언어 변경법은 아래서 설명한다.)

`setDefaultLocale()`로 기본 로케일을 설정하는데, 인자값으로 `Locale` 클래스를 넣어 줘야 한다. 자동완성이 잘 되므로 원하는 로케일을 찾아서 `Locale.KOREAN` 식으로 넣어 주면 된다.

[^locale]: 로케일(Locale)의 뜻은 장소다. 개발에선 `{언어}_{지역}` 순으로 사용하는 언어 코드를 가리킨다. 같은 언어도 지역별로 차이가 있기 때문에 이런 구분이 필요하다. `en_US`는 미국 영어, `en_GB`는 영국 영어를 가리킨다. `ko_KR`은 한국어, `ko_KP`는 북한어를 가리킨다. 이 예제에서 보듯, 지역을 빼고 언어 코드만 사용하는 경우도 많다.


### 로케일 변경 Interceptor Bean

~~~ java
@Bean
public LocaleChangeInterceptor localeChangeInterceptor() {
    LocaleChangeInterceptor lci = new LocaleChangeInterceptor();
    lci.setParamName("locale");
    return lci;
}
~~~

url 파라미터를 받아서 로케일을 변경하는 방법을 설정하는 부분이다. 위 코드대로 하면 `https://domain.com?locale=en`으로 들어왔을 때, `APPLICATION_LOCALE` 쿠키가 `en`으로 설정되면서 로케일이 변경된다.

위 코드에선 인자값을 `locale`로 설정했지만, 원하는대로 설정하면 된다.


### 인터셉터 목록에 인터셉터를 등록

~~~ java
@Override
public void addInterceptors(InterceptorRegistry registry) {
    registry.addInterceptor(localeChangeInterceptor());
}
~~~

위 코드는 `localeChangeInterceptor()`를 스프링의 인터셉터 목록에 등록하는 코드다. 이렇게 하지 않으면 작동하지 않는다.

`@Override`라는 어노테이션을 통해 유추할 수 있겠지만, `WebMvcConfigurer`가 정의한 것을 구현한 것이다.


## 번역 파일 위치와 형식

번역 파일을 둘 위치는 `src/main/resources` 폴더다. 파일명을 규칙에 맞게 해야 하는데, 기본 로케일의 파일명은 `messages.properties`로 하면 된다. 다른 언어는 `messages_{locale code}.properties`로 만든다. 즉, 한국어라면 `messages_ko.properties`, 영어라면 `message_en.properties`로 파일을 만든다.

파일 내용은 자바의 프로퍼티 파일 형식을 따라 아래처럼 만든다. 

~~~
greeting=안녕하세요
lang.change=언어 변경
~~~

키값을 한글로 해도 작동하는데, 키값에 띄어쓰기가 들어가선 안 된다.

[파일명에 `.`이 들어가면 안 된다.](http://blog.hkwon.me/spring-boot-spring-i18n-configuration/)

찾아 보니 yaml로 하는 방법도 있는 듯한데, 해 보진 않아서 적지 않는다.

번역 메시지 파일에 찾는 키가 없으면 기본 로케일 메시지 파일의 값을 사용한다고 한다.


## HTML 페이지에서 사용하는 방법

thymeleaf를 사용하면, `#{key}` 문법을 사용하면 된다. 아래처럼.

~~~
<h1 th:text="#{greeting}"></h1>
~~~

jsp를 사용하면 아래처럼 쓴다.

~~~
<h1><spring:message code="greeting" text="default"/></h1>
~~~

