<?php
require 'Slim.php';

$app = new \Slim\Slim();

/*  add your code below this line */
$app->get('/hello', function(){
  echo 'Hello There';
});

//index.php<?php
require 'vendor/autoload.php';
date_default_timezone_set('America/Kentucky/Louisville');


/*$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('app.txt', Monolog\Logger::WARNING));
$log->addWarning('oh Noes');*/


$app = new \Slim\Slim( array(
  'view' => new \Slim\Views\Twig()
));
$app->add(new \Slim\Middleware\SessionCookie());
$view = $app->view();
$view->parserOptions = array(
    'debug' => true
 );

 $view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
); 
/* $app->get('/hello/:name', function($name){
	echo "Hello, $name";
});*/


$app->get('/', function() use($app){
	$app->render('about.twig');
})->name('home');

$app->get('/contact', function() use($app){
	$app->render('contact.twig');
})->name('contact'); 

$app->post('/contact', function() use($app){
	$name = $app->request->post('name');
	$email = $app->request->post('email');
	$msg = $app->request->post('msg');
	
	if(!empty($name) && !empty($email) && !empty($msg)){
		$cleanName = filter_var($name, FILTER_SANITIZE_STRING);
		$cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
		$cleanMsg = filter_var($msg, FILTER_SANITIZE_STRING);
	} else {
		$app->flash('fail', 'All fields are required');
		$app->rediect('/contact');
	}
	$transport = Swift_SendmailTransport::newInstance('/user/sbin/sendmail -bs');
	$mailer = \Swift_Mailer::newInstance($transport);
	
	$message = \Swift_Message::newInstance();
	$message->setSubject('Email From Our Website');
	$message->setFrom(array(
		 $cleanEmail => $cleanName 
	));
	$message->setTo(array('honggaojob@gmail.com'));
	$message->setBody($cleanMsg);
	
	$result = $mailer->send($message);
	
	if($result > 0){
		$app->flash('success', 'Thanks so much');
		$app->redirect('/');
	} else {
		$app->flash('fail', 'Something went wrong');
		$app->redirect('/contact');
	}
}); 

$app->run();

//about.twig
{% extends 'main.twig' %}

{% block content %}
    <strong>About</strong>
    <h2>Ralph Waldo Emerson</h2>

    <p>Ralph Waldo Emerson <em>(May 25, 1803 – April 27, 1882)</em> was an American essayist, lecturer, and poet, who led the Transcendentalist movement of the mid-19th century. He was seen as a champion of individualism and a prescient critic of the countervailing pressures of society, and he disseminated his thoughts through dozens of published essays and more than 1,500 public lectures across the United States.</p>

    <p>Emerson gradually moved away from the religious and social beliefs of his contemporaries, formulating and expressing the philosophy of Transcendentalism in his 1836 essay, Nature. Following this ground-breaking work, he gave a speech entitled "The American Scholar" in 1837, which Oliver Wendell Holmes, Sr. considered to be America's "Intellectual Declaration of Independence".</p>

    <p>Emerson wrote most of his important essays as lectures first, then revised them for print. His first two collections of essays – Essays: First Series and Essays: Second Series, published respectively in 1841 and 1844 – represent the core of his thinking, and include such well-known essays as Self-Reliance, The Over-Soul, Circles, The Poet and Experience. Together with Nature, these essays made the decade from the mid-1830s to the mid-1840s Emerson's most fertile period.</p>

    <p>Emerson wrote on a number of subjects, never espousing fixed philosophical tenets, but developing certain ideas such as individuality, freedom, the ability for humankind to realize almost anything, and the relationship between the soul and the surrounding world. Emerson's "nature" was more philosophical than naturalistic: "Philosophically considered, the universe is composed of Nature and the Soul." Emerson is one of several figures who "took a more pantheist or pandeist approach by rejecting views of God as separate from the world.""
    </p>
    <p>He remains among the linchpins of the American romantic movement, and his work has greatly influenced the thinkers, writers and poets that have followed him. When asked to sum up his work, he said his central doctrine was "the infinitude of the private man." Emerson is also well known as a mentor and friend of fellow Transcendentalist Henry David Thoreau.</p>

    <p><em>Learn more about Ralph Waldo Emerson from <a href="http://en.wikipedia.org/wiki/Ralph_Waldo_Emerson">Wikipedia</a></em></p>

{% endblock content %}
  //contact twig
  {% extends 'main.twig' %}

{% block content %}
    <strong>Contact</strong>
    <h2>Ralph Waldo Emerson</h2>

    <p>Unfortately, Ralph Waldo Emerson has been deceased for over 100 years so he's not particularly expediant at replying to email but you can make an attempt below. However, if you require face to gravestone contact you can visit his remains at:</p>
    <address>
      <h4>Sleepy Hollow Cemetery</h4>
      <p>34 Bedford Street<br>
      Concord, MA 01742, United States<br>
    <a href="https://www.google.com/maps/place/Sleepy+Hollow+Cemetery/@42.464126,-71.343098,15z/data=!4m2!3m1!1s0x0:0x9c41d0f83df689a6?sa=X&ei=ZCgLVZb5Io_hoASc7oHwCQ&ved=0CH0Q_BIwCw">Google Map</a></p>
    </address>

    <form action="" method="post">
      <fieldset>
        <input name="name" type="text" placeholder="Full Name">
        <input name="email" type="email" placeholder="Email Address">
        <textarea name="msg" placeholder="Your message..."></textarea>
      </fieldset>
      <input type="submit" class="button">
    </form>
{% endblock content %}

//contact.twig
{% extends 'main.twig' %}

{% block content %}
    <strong>Contact</strong>
    <h2>Ralph Waldo Emerson</h2>

    <p>Unfortately, Ralph Waldo Emerson has been deceased for over 100 years so he's not particularly expediant at replying to email but you can make an attempt below. However, if you require face to gravestone contact you can visit his remains at:</p>
    <address>
      <h4>Sleepy Hollow Cemetery</h4>
      <p>34 Bedford Street<br>
      Concord, MA 01742, United States<br>
    <a href="https://www.google.com/maps/place/Sleepy+Hollow+Cemetery/@42.464126,-71.343098,15z/data=!4m2!3m1!1s0x0:0x9c41d0f83df689a6?sa=X&ei=ZCgLVZb5Io_hoASc7oHwCQ&ved=0CH0Q_BIwCw">Google Map</a></p>
    </address>

    <form action="" method="post">
      <fieldset>
        <input name="name" type="text" placeholder="Full Name">
        <input name="email" type="email" placeholder="Email Address">
        <textarea name="msg" placeholder="Your message..."></textarea>
      </fieldset>
      <input type="submit" class="button">
    </form>
{% endblock content %}

//main.twig
<!doctype html>

<html lang="en">
<head>
  {% block head %}
	  <meta charset="utf-8">
	  <title>{% block title %}Ralph Waldo Emerson{% endblock title %}</title>
	  <meta name="description" content="Ralph Waldo Emerson">
	  <meta name="author" content="Treehouse">
	  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	  <link rel="stylesheet" href="css/master.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	  <script src="js/global.js"></script>
  {% endblock head %}
</head>

<body>
{% include 'flash.twig' %}
  <header>
    <h1>Ralph Waldo Emerson</h1>
    <nav>
      <a href="{{ baseUrl()}}" class="selected">About</a>
      <a href="{{ siteUrl('/contact')}}">Contact</a>
    </nav>
  </header>

  <div class="emerson">
    {% block hero %}<img src="images/emerson.jpg" alt="Picture of Ralph Waldo Emerson">{% endblock hero %}
  </div>

  <main>
   {% block content %}
   {% endblock content %}
  </main>

  <footer>
	{% block footer %}
		<p>A project from <strong><a href="http://teamtreehouse.com">Treehouse</a></strong></p>
		<nav>
			<a href="{{ baseUrl()}}" class="selected">About</a>
			<a href="{{ siteUrl('/contact')}}">Contact</a>
		</nav>
	{% endblock footer %}
  </footer>

</body>
</html>
//flash.twig
<!doctype html>

<html lang="en">
<head>
  {% block head %}
	  <meta charset="utf-8">
	  <title>{% block title %}Ralph Waldo Emerson{% endblock title %}</title>
	  <meta name="description" content="Ralph Waldo Emerson">
	  <meta name="author" content="Treehouse">
	  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	  <link rel="stylesheet" href="css/master.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	  <script src="js/global.js"></script>
  {% endblock head %}
</head>

<body>
{% include 'flash.twig' %}
  <header>
    <h1>Ralph Waldo Emerson</h1>
    <nav>
      <a href="{{ baseUrl()}}" class="selected">About</a>
      <a href="{{ siteUrl('/contact')}}">Contact</a>
    </nav>
  </header>

  <div class="emerson">
    {% block hero %}<img src="images/emerson.jpg" alt="Picture of Ralph Waldo Emerson">{% endblock hero %}
  </div>

  <main>
   {% block content %}
   {% endblock content %}
  </main>

  <footer>
	{% block footer %}
		<p>A project from <strong><a href="http://teamtreehouse.com">Treehouse</a></strong></p>
		<nav>
			<a href="{{ baseUrl()}}" class="selected">About</a>
			<a href="{{ siteUrl('/contact')}}">Contact</a>
		</nav>
	{% endblock footer %}
  </footer>

</body>
</html>


 

 

