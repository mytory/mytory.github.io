---
title: 스프링 시큐리티의 구조
layout: post
tags: 
	- java
	- spring
---

스프링 공식 문서 [Spring Security Architecture](https://spring.io/guides/topicals/spring-security-architecture)를 번역한 것이다.

---

이 가이드는 스프링 시큐리티의 입문서다. 프레임워크의 설계(design)와 기본 구축 단위들(building blocks)에 대한 이해를 제공한다. 어플리케이션 보안에 관해 아주 기본적인 사항만 다룰 것이지만, 그렇게 함으로써 우리는 개발자들이 스프링 시큐리티를 사용할 때 겪는 몇몇 혼란을 해소할 수 있다. 이것을 위해 우리는 필터와 더 일반적으로는 메서드 어노테이션을 사용하는 웹 어플리케이션에 보안이 적용되는 방법을 살펴 본다. 보안 어플리케이션이 어떻게 동작하는지, 그리고 어떻게 커스마이징할 수 있는지에 대한 더 높은 이해가 필요하거나 혹은 그냥 어플리케이션 보안에 대해 어떻게 생각해야 하는지 배우고 싶은 경우에 이 가이드를 활용하면 된다.

이 가이드는 가장 기본적인 문제 이상의 것을 해결하기 위한 매뉴얼이나 지침(recipe)으로서 의도된 것이 아니지만(이를 위해서는 다른 문서들을 참고하라) 초보자와 숙련자 모두에게 유용할 것이다. 또한 스프링부트를 추천한다. 스프링부트는 보안 어플리케이션을 위한 기본적인 행위를 제공하고 따라서 전반적인 구조에 보안이 적용되는 방식을 이해하는 데 유용할 수 있기 때문이다. 모든 원리는 스프링부트를 사용하지 않는 어플리케이션에도 똑같이 적용된다.

## 인증과 권한

어플리케이션 보안은 대략 두 가지 독립적인 문제로 요약된다. 인증(authentication)(당신은 누구입니까?)과 권한(authorization)(당신에게 허용된 것은 무엇입니까?). 때로 사람들은 "권한(authorization)"이란 용어 대신 "접근 제어(access control)"라고 부른다. 이런 용어 사용은 혼란을 줄 수 있지만, 권한이 무엇을 의미하는지 생각하는 데 도움이 될 수 있다. "권한"이란 용어가 다른 영역에서는 의미가 확장돼 사용되기 때문이다. 스프링 시큐리티의 구조는 권한과 인증을 분리 설계했고, 둘 모두에 대한 전략과 확장 지점이 있다.

### 인증

인증 전략에서 중심이 되는 인터페이스는 `AuthenticationManager`다. `AuthenticationManager`에는 메서드 하나만 있다.

~~~ java
public interface AuthenticationManager {

  Authentication authenticate(Authentication authentication)
    throws AuthenticationException;

}
~~~

`AuthenticationManager`는 `authenticate()` 메서드로 셋 중 한 가지 작업을 한다.

1. 입력값이 본인을 제대로 나타내는지 검증할 수 있다면 `Authentication`(보통은 `authenticated=true`와 함께)을 리턴한다.
2. 입력값이 본인을 제대로 나타내지 않는다고 여겨지면 `AuthenticationException`을 던진다.
3. 결정할 수 없다면 `null`을 리턴한다.

`AuthenticationException`은 실행시 발생하는 예외다. 이것은 일반적으로 어플리케이션이 자신의 양식과 목적에 따라 제어한다. 다시 말해 이 예외를 잡고 제어하는 데 일반적으로 사용자 코드가 필요하다고 여겨지지는 않는다는 것이다. 예컨대, 웹 UI는 인증이 실패했다고 말하는 페이지를 그릴 것이고, 백엔드 HTTP 서비스는 401 응답을 보낼 것이다. 맥락에 따라 `WWW-Authenticate` 헤더를 보낼 수도 있고 안 보낼 수도 있다.

가장 흔히 사용되는 `AuthenticationManager` 구현은 `AuthenticationProvider`체인으로 위임하는 `ProviderManager`다. `AuthenticationProvider`는 `AuthenticationManager`와 다소 유사하지만, `AuthenticationProvider`에는 주어진 `Authentication` 유형을 지원하는지 호출자가 질의하도록 해 주는 메서드가 더 있다. 다음을 보자.

~~~ java
public interface AuthenticationProvider {

	Authentication authenticate(Authentication authentication)
			throws AuthenticationException;

	boolean supports(Class<?> authentication);

}
~~~

`supports()` 메서드의 `Class<?>` 인자는 실제로는 `Class<? extends Authentication>`이다(어떤 것을 `authenticate()` 메서드로 전달해도 되는지만 확인하는 역할이다). `ProviderManager`는 한 어플리케이션 안에서도 `AuthenticationProviders` 체인에 위임하는 것을 통해 다양한 인증 방식을 지원할 수 있다. 만약 `ProviderManager`가 특정한 `Authentication` 인스턴스 유형을 식별하지 못하면 그것은 그냥 무시하게 된다(skip).

