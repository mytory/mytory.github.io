---
title: '[번역] 정말 읽기 쉬운 코드를 작성하는 최우선 15가지+ 최고의 방법'
author: 안형우
layout: post
permalink: /archives/1098
aktt_notify_twitter:
  - yes
daumview_id:
  - 36744566
categories:
  - 기타
tags:
  - 개발 방법론
---
원문은 &#8220;Nettuts+&#8221;에 실린 [&#8220;Top 15+ Best Practices for Writing Super Readable Code&#8221;][1]다.

번역은 내가 했고, 당연히 오역이 있을 수 있다.

&#8212;&#8212;- 번역 시작 &#8212;&#8212;&#8211;

<span style="font-weight: bold;">우리는 한 달에 2회 씩 Nettuts+에서 인기있었던 글을 재개제한다.</span>

코드 가독성은 프로그래밍 세계에서 보편적인 주제다. 이것은 우리가 개발자로서 가장 먼저 배우는 것들 중 하나다. 이 글은 코드 가독성에 관한 가장 중요한 예제 열 다섯 가지를 상세히 설명한다.

## 1.주석 & 문서화

IDE((Integrated Development Environment:통합 개발 환경)은 지난 몇 년간 괄목할 만한 발전을 했다. IDE는 예전보다 주석을 더 쓸모있게 달 수 있도록 해 준다. 다음과 같은 표준 주석은 IDE와 다른 툴이 이걸 쓸모있게 사용할 수 있도록 해 준다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/readable-code/readable_code_1.png" alt="" />
</p>

내가 추가한 함수 정의 주석은 내가 함수를 어디서 사용하든간에 보인다. 심지어 다른 파일에서도 보인다.

이건 또다른 예다. 내가 써드 파티 라이브러리에서 함수를 호출하는 경우다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/readable-code/readable_code_2.png" alt="" width="560" height="638" />
</p>

이 부분적인 예 들은 [PHPDoc][2]과 [Aptana][3]를 기반으로 했다.

## 2.일관된 들여쓰기

많은 사람들이 코드 들여쓰기를 해야 한다는 사실을 알고 있을 거라고 생각한다. 그러나, 또한 코드 들여쓰기를 일관되게 유지하는 게 좋은 생각이라는 것을 짚는 것은 가치가 있다.

코드 들여쓰기를 하는 몇 가지 방법이 있다.

### 스타일1

<pre class="brush:php">function foo() {
	if ($maybe) {
		do_it_now();
		again();
	} else {
		abort_mission();
	}
	finalize();
}</pre>

### 스타일2

<pre class="brush:php">function foo()
{
	if ($maybe)
	{
		do_it_now();
		again();
	}
	else
	{
		abort_mission();
	}
	finalize();
}</pre>

### 스타일3

<pre class="brush:php">function foo()
{	if ($maybe)
	{	do_it_now();
		again();
	}
	else
	{	abort_mission();
	}
	finalize();
}</pre>

나는 2번 스타일로 코드를 짜곤 했는데 최근엔 1번 스타일로 바꿨다. 하지만 이건 전적으로 선호 문제다. 모두가 따라야 하는 &#8220;최고의&#8221; 스타일은 없다. 실제로, 최고의 스타일은, 일관된 스타일이다. 만약 팀에 속해 있거나 프로젝트의 일부 코드만 짜서 넘겨야 하는 것이라면, 이미 작성된 코드의 스타일을 따라야 한다.

하나의 들여쓰기 스타일이 반드시 또 다른 스타일과 완전히 구분돼야 하는 것은 아니다. 때때로 몇몇 다른 규칙을 섞는 경우가 있다. 예들 들면, [PEAR 코딩 표준][4]에서 코드 부분을 여는 &#8220;{&#8220;가 [분기문][5]에서는 같은 줄에 있다. 하지만 [함수 정의][6]에서는 다음 줄에 있다.

PEAR 스타일:

<pre class="brush:php">function foo()
{                     // placed on the next line
    if ($maybe) {     // placed on the same line
        do_it_now();
        again();
    } else {
        abort_mission();
    }
    finalize();
}</pre>

들여쓰기를 위해서 탭 대신 그냥 공백을 사용한다는 점도 주목하라.

[다른 들여쓰기 스타일에 관한 위키피디아 글][7]도 참고하라.

## 3. 뻔한 주석은 달지 마라

코드에 주석을 다는 것은 좋은 습관이다. 그러나 그게 과도하거나 중복돼선 안 된다. 다음 예를 보자.

<pre class="brush:php">// get the country code  [번역:국가 코드를 가져온다]
$country_code = get_country_code($_SERVER[&#039;REMOTE_ADDR&#039;]);  

// if country code is US  [번역: 국가 코드가 US인 경우]
if ($country_code == &#039;US&#039;) {  

    // display the form input for state  [번역: 국가 코드를 위한 input 폼을 출력한다.]
    echo form_input_state();
}</pre>

명백한 것을 주석에서 반복하는 것은 쓸데없는 짓이다.

코드에 주석을 반드시 달아야겠다면, 한 줄로 이렇게 달면 된다.

<pre class="brush:php">// display state selection for US users  [번역: 미국 사용자를 위해 국가 선택 영역을 보여 준다.]
$country_code = get_country_code($_SERVER[&#039;REMOTE_ADDR&#039;]);
if ($country_code == &#039;US&#039;) {
    echo form_input_state();
}</pre>

## 4. 코드를 그룹으로 묶어라

종종, 특정한 일에는 코드 여러 줄이 필요하다. 이런 코드들을 빈 줄로 분리된 각각의 블럭으로 구분해 두는 것이 좋다.

여기 간단한 예제가 있다.

<pre class="brush:php">// get list of forums  [번역: 포럼 리스트를 가져온다]
$forums = array();
$r = mysql_query("SELECT id, name, description FROM forums");
while ($d = mysql_fetch_assoc($r)) {
    $forums []= $d;
}  

// load the templates  [번역: 템플릿을 불러 온다]
load_template(&#039;header&#039;);
load_template(&#039;forum_list&#039;,$forums);
load_template(&#039;footer&#039;);</pre>

## 5. 일관된 네이밍 규칙

PHP 자체가 일관된 네이밍 규칙을 따르지 않고 있다는 문제가 있다.

*   strpos() vs. str_split()
*   imagetypes() vs. image\_type\_to_extension()

무엇보다도, 이름을 지을 때는 단어의 경계를 명확히 해 줘야 한다. 가장 많이 사용하는 것은 다음 두 가지다.

*   **camelCase:** 첫 단어를 제외한 각 단어의 첫째 글자를 대문자로 한다.
*   **underscores:** 각 단어를 밑줄로 구분한다. mysql\_real\_escape_string() 하는 식으로.

다른 옵션이 있다는 것은, 내가 앞서 말한 대로, 들여쓰기 스타일과 비슷한 상황이 된다는 것을 의미한다. 이미 존재하는 프로젝트가 어떤 관습을 따르고 있다면, 당신은 반드시 그 관습을 따라야 한다. 또한, 어떤 언어가 특정한 네이밍 규칙을 따르는 경향이 있다면, 당신도 그렇게 해야 할 것이다. 예를 들면, 자바에서는 대부분의 코드가 camelCase로 돼 있다. 반면에 PHP에서는 대부분이 underscores 규칙을 따른다.

<pre class="brush:php">class Foo_Bar {  

    public function someDummyMethod() {  

    }  

}  

function procedural_function_name() {  

}</pre>

다시 말하지만, 명백한 &#8220;최고의&#8221; 스타일은 없다. 일관된 게 중요하다.

## 6. DRY 원칙

DRY는 Don’t Repeat Yourself(자신을 반복하지 말 것)의 약자다. DIE라고 하기도 한다 : Duplication is Evil.(중복은 악이다.)

이 원칙은 다음과 같다.

&#8220;모든 지식은 그 자체로 시스템 안에서 유일해야 하고, 모호해선 안 되며, 권위 있게 표현돼야 한다.&#8221;

일반적으로 대부분의 어플리케이션은 반복적인 일을 자동화하는 게 목적이다. (일반적으로 컴퓨터가 그렇다.) 이 원칙은 모든 코드에서 유지돼야 한다. 웹 어플리케이션에서조차 마찬가지다. 같은 코드가 어디서도 반복되면 안 된다.

예를 들면, 대부분의 웹 어플리케이션은 많은 페이지로 구성된다. 이 페이지들에는 공통 요소가 있을 가능성이 크다. 헤더와 푸터가 그럴 가능성이 가장 높다. 헤더와 푸터를 모든 페이지마다 복사해서 붙여넣기 하는 것은 좋지 않다. Jeffrey Way는 [여기][8]서 코드 이그니터(웹사이트 생성 툴:CMS의 일종)로 템플릿을 생성하는 방법을 설명한다.

<pre class="brush:php">$this-&gt;load-&gt;view(&#039;includes/header&#039;);
$this-&gt;load-&gt;view($main_content);
$this-&gt;load-&gt;view(&#039;includes/footer&#039;);</pre>

## 7. 코드가 깊숙이 들어가는 것을 피하라(Avoid Deep Nesting)

[역자 주 : Nesting은 분기문 등에서 {}로 감싸는 부분을 말하는 듯하다. if문 안의 if문 안의 if문 이런 것을 Deep Nesting이라고 하는 듯.]

코드가 너무 깊숙이 들어가면 읽고 따라가기 힘들다.

<pre class="brush:php">function do_stuff() {

// ...

	if (is_writable($folder)) {

		if ($fp = fopen($file_path,&#039;w&#039;)) {

			if ($stuff = get_some_stuff()) {

				if (fwrite($fp,$stuff)) {

					// ...

				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}</pre>

읽기 쉽게 하기 위해서는, 들어가는 레벨을 줄이면 된다.

<pre class="brush:php">function do_stuff() {

// ...

	if (!is_writable($folder)) {
		return false;
	}

	if (!$fp = fopen($file_path,&#039;w&#039;)) {
		return false;
	}

	if (!$stuff = get_some_stuff()) {
		return false;
	}

	if (fwrite($fp,$stuff)) {
		// ...
	} else {
		return false;
	}
}</pre>

## 8. 줄 길이를 제한하라

우리 눈은 좁고 위아래로 긴 열을 읽는 데 더 최적화돼 있다. 바로 이 때문에 신문이 이렇게 생긴 것이다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/readable-code/newspaper.jpg" alt="" />
</p>

수평으로 긴 줄을 작성하게 되는 걸 피하는 방법을 보여 주는 좋은 예제가 있다.

<pre class="brush:php">// bad
$my_email-&gt;set_from(&#039;test@email.com&#039;)-&gt;add_to(&#039;programming@gmail.com&#039;)-&gt;set_subject(&#039;Methods Chained&#039;)-&gt;set_body(&#039;Some long message&#039;)-&gt;send();

// good
$my_email
	-&gt;set_from(&#039;test@email.com&#039;)
	-&gt;add_to(&#039;programming@gmail.com&#039;)
	-&gt;set_subject(&#039;Methods Chained&#039;)
	-&gt;set_body(&#039;Some long message&#039;)
	-&gt;send();

// bad
$query = "SELECT id, username, first_name, last_name, status FROM users LEFT JOIN user_posts USING(users.id, user_posts.user_id) WHERE post_id = &#039;123&#039;";

// good
$query = "SELECT id, username, first_name, last_name, status
	FROM users
	LEFT JOIN user_posts USING(users.id, user_posts.user_id)
	WHERE post_id = &#039;123&#039;";</pre>

또한, [Vim을 사용하는 사람][9]처럼, 누군가 코드를 터미널 창으로 읽어야 한다면 줄의 길이를 80자로 제한하는 게 좋다.

## 9. 파일과 폴더를 조직화하라

기술적으로는, 어플리케이션의 모든 코드를 한 파일 안에 넣을 수 있다. 하지만 그렇게 하면 코드를 읽는 동안 악몽에 시달리게 된다는 걸 증명하게 될 것이다.

내가 처음 프로그래밍 프로젝트에 들어갔을 때, 나는 &#8220;인클루드 파일&#8221;에 대해 알고 있었다. 그러나 아직 조직화를 하기에는 모자랐다. 나는 &#8220;inc&#8221; 폴더를 만들고, 그 안에 db.php와 functions.php 파일을 넣어 뒀다. 어플리케이션은 점점 커졌고, functions 파일은 계속 거대해져서 더이상 유지할 수 없을 지경에 이르렀다.

최선에 가까운 방법은, [프레임워크를 사용][10]하거나, 그 구조를 모방하는 것이다. 여기 코드 이그니터의 구조가 있다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/readable-code/readable_code_3.png" alt="" />
</p>

## 10. 임시 변수의 이름을 일관된 규칙에 따라 정하라(Consistent Temporary Names)

보통, 변수명은 그걸 설명할 수 있는 한두 단어로 붙인다. 하지만 임시 변수는 그렇게 할 필요가 없다. 임시 변수는 한 글자로만 만들 수도 있다.

아래는 일관된 임시 변수명을 사용한 코드다. 임시 변수명에 일관된 규칙을 적용했다. 내가 사용하는 방법에 따라 몇 가지 예제를 가져왔다.

<pre class="brush:php">// $i for loop counters
for ($i = 0; $i &lt; 100; $i++) {

	// $j for the nested loop counters
	for ($j = 0; $j &lt; 100; $j++) { 	} } // $ret for return variables function foo() { 	$ret[&#039;bar&#039;] = get_bar(); 	$ret[&#039;stuff&#039;] = get_stuff(); 	return $ret; } // $k and $v in foreach foreach ($some_array as $k =&gt; $v) {

}

// $q, $r and $d for mysql
$q = "SELECT * FROM table";
$r = mysql_query($q);
while ($d = mysql_fetch_assocr($r)) {

}

// $fp for file pointers
$fp = fopen(&#039;file.txt&#039;,&#039;w&#039;);</pre>

## 11. SQL 문자에는 대문자를 사용하라

데이터베이스와 상호작용하는 부분은 대부분의 웹 어플리케이션에서 큰 부분이다. SQL 쿼리를 날것 그대로 쓰면 읽기 쉽다. 좋은 방법이다.

SQL 문자와 함수 이름은 대소문자를 구변하지 않지만, 그럼에도 불구하고 테이블명, 컬럼명과 구분하기 위해 대문자로 써 주는 것이 좋다.

<pre class="brush:sql">SELECT id, username FROM user;

UPDATE user SET last_login = NOW()
WHERE id = &#039;123&#039;

SELECT id, username FROM user u
LEFT JOIN user_address ua ON(u.id = ua.user_id)
WHERE ua.state = &#039;NY&#039;
GROUP BY u.id
ORDER BY u.username
LIMIT 0,20</pre>

## 12.코드와 데이터를 구분하라

이것은 모든 환경에서 거의 모든 언어에 적용되는 또다른 원칙이다. 웹 개발의 경우, &#8220;데이터&#8221;는 보통 HTML 출력을 의미한다.

몇 년 전, PHP가 처음 출시됐을 때는, 마치 템플릿 엔진 같았다. 커다란 HTML 파일 안에 PHP 코드가 몇 줄 들어가 있는 식이었다. 그러나 몇 년 동안 많은 것이 변했다. 웹사이트는 점점 더 다이나믹해졌고, 기능이 많아졌다. 웹 어프리리케이션 코드는 덩치가 커져서 더이상 HTML 코드와 함께 두는 것은 좋지 않다.

자기 자신만의 원칙을 세워서 그렇게 할 수도 있고, 써드 파티 툴(템플릿 엔진, 프레임워크나 CMS)과 그 협약을 따를 수도 있다.

많이 쓰이는 PHP 프레임워크는 다음과 같다.

*   [CodeIgniter][11]
*   [Zend Framework][12]
*   [Cake PHP][13]
*   [Symfony][14]

많이 쓰이는 템플릿 엔진은 다음과 같다.

*   [Smarty][15]
*   [Dwoo][16]
*   [Savant][17]

많이 쓰이는 CMS(Content Management Systems)

[역자 주: 이 부분은 본문에 없는데 날아간 듯. 내가 알기로는 [Drupal][18], [WordPress][19] 등이 있다.]

## 13. 템플릿 내의 대체 문법(Alternate Syntax Inside Templates)

[역자 주: [대체 문법][20]은 고유명사다. 표현부와 비지니스 로직을 분리하라는 12번 원칙을 지키지 못하더라도, 표현부 내에서 HTML 구조와 유사한 PHP 문법인 '제어 구조의 대체 문법'을 사용하면 된다는 설명이다.]

당신이 멋진 템플릿 엔진을 사용하지 않을 지도 모른다. 대신에 템플릿 파일[역자 주: 표현부 파일을 가리키는 듯] 안에 PHP 코드를 넣을 지도 모른다. 이게 반드시 &#8220;코드와 데이터를 구분하라&#8221;는 지침을 어기는 게 되는 것은 아니다. 인라인 코드가 [HTML] 출력과 직접 연관이 있고, 읽기 쉬운 한은 말이다. 이 경우 [제어구조 대체 문법][20] 사용을 고려해 봄직 하다.

예제를 보자.

<pre class="brush:php">&lt;div class="user_controls"&gt;
	&lt;?php if ($user = Current_User::user()): ?&gt;
		Hello, &lt;em&gt;&lt;?php echo $user-&gt;username; ?&gt;&lt;/em&gt; &lt;br/&gt;
		&lt;?php echo anchor(&#039;logout&#039;, &#039;Logout&#039;); ?&gt;
	&lt;?php else: ?&gt;
		&lt;?php echo anchor(&#039;login&#039;,&#039;Login&#039;); ?&gt; |
		&lt;?php echo anchor(&#039;signup&#039;, &#039;Register&#039;); ?&gt;
	&lt;?php endif; ?&gt;
&lt;/div&gt;

&lt;h1&gt;My Message Board&lt;/h1&gt;

&lt;?php foreach($categories as $category): ?&gt;

	&lt;div class="category"&gt;

		&lt;h2&gt;&lt;?php echo $category-&gt;title; ?&gt;&lt;/h2&gt;

		&lt;?php foreach($category-&gt;Forums as $forum): ?&gt;

			&lt;div class="forum"&gt;

				&lt;h3&gt;
					&lt;?php echo anchor(&#039;forums/&#039;.$forum-&gt;id, $forum-&gt;title) ?&gt;
					(&lt;?php echo $forum-&gt;Threads-&gt;count(); ?&gt; threads)
				&lt;/h3&gt;

				&lt;div class="description"&gt;
					&lt;?php echo $forum-&gt;description; ?&gt;
				&lt;/div&gt;

			&lt;/div&gt;

		&lt;?php endforeach; ?&gt;

	&lt;/div&gt;

&lt;?php endforeach; ?&gt;</pre>

이렇게 하면 중괄호({})가 많아지는 것을 피할 수 있다. 또한, 코드가 HTML의 구조와 들여쓰기랑 비슷해 보인다.

## 14. 객체지향 vs 절차지향

객체지향 프로그래밍은 코드 구조가 좋아지는 데 도움이 된다. 그러나 절차지향 프로그래밍을 완전히 버려야 한다는 건 아니다. 실제로, 두 개를 섞는 게 더 나을 수도 있다.

데이터베이스에 들어 있는 데이터를 나타낼 때 사용돼는 객체를 보자.

<pre class="brush: php">class User {

	public $username;
	public $first_name;
	public $last_name;
	public $email;

	public function __construct() {
		// ...
	}

	public function create() {
		// ...
	}

	public function save() {
		// ...
	}

	public function delete() {
		// ...
	}

}</pre>

절차지향 함수는 독립적으로 실행될 수 있는 분명한 작업에 사용된다.

<pre class="brush:php">function capitalize($string) {

	$ret = strtoupper($string[0]);
	$ret .= strtolower(substr($string,1));
	return $ret;

}</pre>

## 15. 오픈소스 코드를 읽어라

오픈소스 프로젝트는 많은 개발자들의 협업으로 이뤄진다. 이런 프로젝트들은 코드 가독성을 높게 유지해서 가능한 협업을 효과적으로 만들어야 한다. 따라서, 이 개발자들이 어떤 식으로 코드를 짜는지 보기 위해서 소스 코드를 살펴 보는 것은 좋은 방법이다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/readable-code/open_source.png" alt="" />
</p>

## 16. 코드를 리팩토링하라

리팩토링한다는[역자 주: refactor는 단순히 고친다는 것을 의미하는 게 아니라 리팩토링이라는 기법을 의미하는 것이기에 그냥 리팩토링이라고 번역했습니다.] 것은, 코드의 기능을 바꾸지 않으면서 코드를 변경하는 것을 말한다. 코드 가독성과 질을 높이기 위한 목적으로 &#8220;clean up&#8221;을 한다고 생각해도 된다.

리팩토링은 버그를 잡는다거나 기능을 추가한다거나 하는 게 아니다. 아마 바로 전날 작성한 코드를 리팩토링할 것이다. 아직 머리 속에 코드가 생생히 남아 있을 때 말이다. 두 달 후에도 여전히 코드가 읽기 쉽고 재사용하기 쉽게 만드는 것이다. 모토는 이거다. &#8220;빨리 고치고(refactor), 자주 고쳐라&#8221;

리팩토링 작업을 하는 동안 아마도 &#8220;최고의 방법&#8221;을 적용하게 될 것이다.

이 글이 흥미로웠기를 바란다! 내가 놓친 것이 있다면 댓글을 달아 주기 바란다.

<img class="alignleft" src="http://0.gravatar.com/avatar/6c1d4fe10f721b1c40a1fa205be25796?s=40&d=http%3A%2F%2Ftutsplus.s3.amazonaws.com%2Fgeneral%2Favatar.jpg%3Fs%3D40&r=PG" alt="" width="40" height="40" />필자는 [Burak Guzel][21]이다.

 [1]: http://net.tutsplus.com/tutorials/html-css-techniques/top-15-best-practices-for-writing-super-readable-code/
 [2]: http://www.phpdoc.org/
 [3]: http://aptana.org/
 [4]: http://pear.php.net/manual/en/standards.php
 [5]: http://pear.php.net/manual/en/standards.control.php
 [6]: http://pear.php.net/manual/en/standards.funcdef.php
 [7]: http://en.wikipedia.org/wiki/Indent_style
 [8]: http://screenr.com/YO7
 [9]: http://net.tutsplus.com/tutorials/other/venturing-into-vim-new-premium-video-series/
 [10]: http://net.tutsplus.com/sessions/codeigniter-from-scratch/
 [11]: http://codeigniter.com/
 [12]: http://framework.zend.com/
 [13]: http://cakephp.org/
 [14]: http://www.symfony-project.org/
 [15]: http://www.smarty.net/
 [16]: http://dwoo.org/
 [17]: http://phpsavant.com/
 [18]: http://drupal.org/
 [19]: http://wordpress.org/
 [20]: http://php.net/manual/kr/control-structures.alternative-syntax.php
 [21]: http://marketplace.tutsplus.com/user/BurakG?ref=NetPremium