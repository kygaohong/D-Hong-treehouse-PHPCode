<?php 
$names = array('Mike', 'Chris', 'Jane', 'Bob');
 foreach($names as $name){
  echo $name;
}
?>

$bool = TRUE;
var_dump($bool);

//constants:

define("YEAR", 2014);
define("JOB_TITLE", "teacher");
define("MAX_BADGES", 150000);

$array_example = array();
  $eye_colors = array('blue', 'green', 'brown');
  print_r($eye_colors);
  
  $eye_colors[1] = 'hazel';  //modify the array key values
  echo $eye_colors[1];

$hampton = array(12, 'grey', 2.5, TRUE);
print_r($hampton);

$greeting = "Hello, Friends!\n";
$greeting_secondary = "How are you?";
echo $greeting;
echo $greeting_secondary;

$array_example = array();
  $eye_colors = array(
    'chris' => 'blue',
    'tom' => 'green',
    'jim' => 'brown');
  print_r($eye_colors);
  $eye_colors['jim'] = 'green';
  echo $eye_colors['jim'];
  
<?php
  define("YEAR", 2014);
  define("JOB_TITLE", "teacher");
  define("MAX_BADGES", 150000);

  //invalid constant name
  //define("2LEGIT", "to quit");
  //This is my first name
  $name = "Hong";
  $location = "Orlando, FL";
  $full_name = "Mike The Frog";
  $name = $full_name;
?>

<?php 
					
  $a = 10;
  $b = 10;

  $sum = $a + $b;
  $diff = $a - $b;
  $product = $a * $b;
  $quotient = $a / $b;

  $product = $product +1;
  $product ++;
  $product --;
  
<?php
  define("USE_FULL_NAME",  TRUE);
  define("MAX_BADGES", 150000);

  $first_name = "Hampton";
  $last_name = "Paulk";
  $location = "Orlando, FL";
  $role = "Foo";

  if ( USE_FULL_NAME == TRUE) {
    $name = $first_name . ' ' . $last_name;
  } else {
    $name = $first_name;
  }

  if($role == 'Teacher'){
    $info = "I am a Teacher at Treehouse";
  } elseif ($role == 'Student'){
    $info = "I am a Student at Treehouse";
  } else {
    $info = "I am just visiting";
  }
?>

<?php
  define("USE_FULL_NAME",  TRUE);
  define("MAX_BADGES", 20);

  $first_name = "Hampton";
  $last_name = "Paulk";
  $location = "Orlando, FL";
  $role = "Foo";

  if ( USE_FULL_NAME == TRUE) {
    $name = $first_name . ' ' . $last_name;
  } else {
    $name = $first_name;
  }

  if($role == 'Teacher'){
    $info = "I am a Teacher at Treehouse";
  } elseif ($role == 'Student'){
    $info = "I am a Student at Treehouse";
  } else {
    $info = "I am just visiting";
  }
?>

<?php
  define("USE_FULL_NAME",  TRUE);
  define("MAX_BADGES", 20);

  $first_name = "Hampton";
  $last_name = "Paulk";
  $location = "Orlando, FL";
  $role = "Foo";

  if ( USE_FULL_NAME == TRUE) {
    $name = $first_name . ' ' . $last_name;
  } else {
    $name = $first_name;
  }

  if($role == 'Teacher'){
    $info = "I am a Teacher at Treehouse";
  } elseif ($role == 'Student'){
    $info = "I am a Student at Treehouse";
  } else {
    $info = "I am just visiting";
  }

  $social_icons = array('twitter', 'instagram', 'google');
?>

<?php

function hello(){
  echo 'Hello, World!';
}
$current_user = 'Hong';

function is_mike(){
  global $current_user;
  if($current_user == 'Mike'){
    echo 'It is Mike!';
  } else {
    echo 'Nope, it is not Mike';
  }
}

is_mike();


function hello($arr){
  if(is_array($arr)){
    foreach($arr as $name){
      echo "Hello, $name, how's it going?</br>";
     }
  } else {
    echo 'Hello, friends!';
  
  }//end of if statement
} 
//end of hello function

<?php

function add_up($a, $b){
  $arr = array(
    $a, 
    $b, 
    $a + $b
  );
  return $arr;
}

$value = add_up(2, 4);

print_r($value);

echo $value[2];

function add_up($a, $b){
  return $a + $b;
}

$value = add_up(2, 4);

echo $value;

function hello($name){
  if($name == 'Mike'){
    return 'Hello, Mike!';
  } else {
    return 'Hello, stranger!';
  }
  
}

$greeting = hello('Hong');

echo $greeting;

$name = "Mike";

$greet = function() use($name){
  echo "Hello, $name";
};

$greet();

function answer(){
  return 42;
}

//function add_up($a, $b){
//  return $a + $b;
//}
//
////$func = 'answer';
//
//$func = 'add_up';
//$num = $func(5, 10);
//
//echo $num;

//function add_up($a, $b){
//  return $a + $b;
//}
//
//$value = add_up(2, 4);
//
//echo $value;
//
//function hello($name){
//  if($name == 'Mike'){
//    return 'Hello, Mike!';
//  } else {
//    return 'Hello, stranger!';
//  }
//  
//}
//
//$greeting = hello('Hong');
//
//echo $greeting;

<?php
$phrase = "We only hit what we aim for";

$len = strlen($phrase);

echo $len;
//substr
echo substr()$phrase, 0, 5);

//strpos

var_dump(strpos($phrase, 'hit'));

<?php
$phrase = "We only hit what we aim for";

$len = strlen($phrase);

//echo $len;
//substr
//echo substr()$phrase, 0, 5);

//strpos

//echo strpos($phrase, 'hit');
//ar_dump(strpos($phrase, 'hit'));
$start = strpos($phrase, 'hit');

echo substr($phrase, $start);

$names = array(
    'Mike' => 'Frog',
    'Chris' => 'Teacher',
    'Hampton' => 'Teacher'
 );
 
 var_dump(array_keys($names));
 
 foreach(array_keys($names) as $name){
     echo "Hello, $name</br>";
   }
   
function print_info($value, $key){
    echo "$key is a $value</br>";
  }
  
array_walk($names, 'print_info');
?>
