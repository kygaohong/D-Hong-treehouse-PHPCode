<?php
$flavor = "vanilla";
echo "<p>Your favorite flavor of ice cream is ";
echo $flavor;
echo ".</p>";
if ($flavor == "cookie dough"){
  echo "<p>Hal's favorite flavor is cookie dough, also!</p>";
}

?>
<?php
$letters = array();
$letters[] = "A";
$letters[] = "C";
$letters[] = "M";
$letters[] = "E";
$len = count($letters);


echo "Today's challenge is brought to you by the ";
echo $len;
echo " letters: ";
foreach ($letters as $item){
  echo $item;
}
echo ".";

?>

<?php

$movie = [
  "title" => "The Empire Strikes Back",
  "year" => 1980, 
  "director" => "Irvin Kershner", 
  "imdb_rating" => 8.8,
  "imdb_ranking" =>11
];
?>
<h1><?php echo $movie["title"] ?><?php echo $movie["year"] ?></h1>

<table>
  <tr>
    <th>Director</th>
    <td><?php echo $movie["director"]; ?></td>
  </tr>
  <tr>
    <th>IMDB Rating</th>
    <td><?php echo $movie["imdb_rating"]; ?></td>
  </tr>
  <tr>
    <th>IMDB Ranking</th>
    <td><?php echo $movie["imdb_ranking"]; ?></td>
  </tr>
</table>

<?php

$numbers = array(1,5,8);

$sum = 0;
foreach($numbers as $number) {
    $sum = $sum + $number;
}

echo $sum;

?>

//same as the following code

<?php

$numbers = array(1,5,8);

$sum = 0;

$sum = array_sum($numbers);

echo $sum;

?>
//php code challenge datatype.php
<?php 

function convert_to_int($input){
	return intval($input);
}

echo convert_to_int(3.5);
echo '<br>';


function convert_to_float($input){
	return floatval($input);
}

echo convert_to_float(5);
echo '<br>';

function convert_to_string($input){
	if(gettype($input) === "array") {
		$res = '';
		foreach ($input as $item ){
			if ($res === ""){
				$res = $item;
			} else {
				$res .= ', ' . $item;
			}
		} 
		return $res;
	}
	return strval($input);
}

echo convert_to_string([1, 2, 3]);
echo gettype(convert_to_string(5));

function convert_to_bool($input){
	return boolval($input);
}

echo convert_to_bool(0);
echo gettype(convert_to_bool(0));
echo '<br>';

function convert_to_array($input){
	return (array)($input);
}

print_r(convert_to_array(5.2));
echo '<br>';

function convert_to_null($input){
	if (floatval($input) === 0.0){
		return null;		
	} 
	return $input;
}

echo convert_to_null("");
?>

<body>
    <h1>Five Great Books</h1>
    <ul>
        <?php foreach($books as $isbn =>$book) { ?>
            <li><?php echo $book . "". "(" . "$isbn"  . ")"; ?></li>
        <?php } ?>
    </ul>
</body>

</head>
<body>
    <h1>Five Great Books</h1>
    <ul>
        <?php foreach($books as $isbn =>$book) { ?>
            <li><?php echo $book . "". "$isbn"; ?></li>
        <?php } ?>
    </ul>
</body>
</html>

<?php
include("flavor.php");

 $flavor = get_flavor();

echo "Hal's favorite flavor of ice cream is" . " $flavor" . ".";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ye Olde Ice Cream Shoppe</title>
</head>
<body>

    <p>Your order has been created. What flavor of ice cream would you like to add to it?</p>

    <form method = "post" action = "process.php";>
     

        <label for="flavor">Flavor</label>
        <select id="flavor" name="flavor">
            <option value="">&#8212; Select &#8212;</option>
            <option value="Vanilla">Vanilla</option>
            <option value="Chocolate">Chocolate</option>
            <option value="Strawberry">Strawberry</option>
            <option value="Cookie Dough">Cookie Dough</option>
        </select>
        <input type='hidden' name='order_id' value='7546'/>
        <input type="submit" value="Update Order">
        
    </form>

</body>
</html><?php

//concatenation

$title = "Dr.";
$firstName = "David";
$lastName = "Bowman";
$fullName = $title . " " . $firstName . " " . $lastName;



echo "The lead character from 2001: A Space Odyssey is named" . " " . $fullName . "!";

?>

//code challenge
<?php

require("class.palprimechecker.php");
$checker = new PalprimeChecker;
$checker->number = 17;

echo "The number $checker->number  ";
if ($checker->isPalprime() === TRUE){
  echo "is";
} else {
  echo "is not";
}

echo " a palprime.";

?>
//catalog.php
<?php 
include("inc/data.php");
include("inc/functions.php");

$pageTitle = "Full Catalog";
$section = null;

if (isset($_GET["cat"])){
	if ($_GET["cat"] == "books"){
		$pageTitle = "Books";
		$section = "books";
	} else if ($_GET["cat"] == "movies"){
		$pageTitle = "Movies";
		$section = "movies";
	} else if ($_GET["cat"] == "music"){
		$pageTitle = "Music";
		$section = "music";
	}
}
include("inc/header.php"); ?>

<div class="section catalog page">
	<div class="wrapper">
		<h1><?php 
		if($section != null){
			echo "<a href='catalog.php'>Full Catalog</a> &gt;";
		}
		echo $pageTitle; ?></h1>
		<ul class="items">
			<?php
			$categories = array_category($catalog, $section);
			foreach($categories as $id){
				echo get_item_html($id, $catalog[$id]);
			}
			?>
		</ul>
	</div>
	
</div>	
	
<?php include("inc/footer.php"); ?>

//details.php
<?php 
include("inc/data.php");
include("inc/functions.php");

if (isset($_GET["id"])){
	$id = $_GET["id"];
	if (isset($catalog[$id])){
		$item = $catalog[$id];
	}
}
if (!isset($item)){
	header("location:catalog.php");
	exit;	
}

$pageTitle = $item["title"];
$section = null;

include("inc/header.php"); ?>

<div class="section page">
	<div class="wrapper">
		<div class="breadcrumbs">
			<a href="catalog.php">Full Catalog</a>
			&gt; <a href="catalog.php?cat=<?php echo strtolower($item["category"]); ?>">
			<?php echo $item["category"]; ?> </a>
			&gt; <?php echo $item["title"]; ?>
		</div>
		<div class="media-picture">
		<span>
			<img src="<?php echo $item["img"]; ?>" alt ="<?php echo $item["title"]; ?>" />
		</span>
		</div>
		<div class="media-details">
			<h1><?php echo $item["title"]; ?></h1>
			<table>
				<tr>
					<th>Category</th>
					<td><?php echo $item["category"]; ?></td>
				</tr>
				<tr>
					<th>Genre</th>
					<td><?php echo $item["genre"]; ?></td>
				</tr>
				<tr>
					<th>Format</th>
					<td><?php echo $item["format"]; ?></td>
				</tr>
				<tr>
					<th>Year</th>
					<td><?php echo $item["year"]; ?></td>
				</tr>
				<?php if (strtolower($item["category"]) == "books"){ ?>
				<tr>
					<th>Authors</th>
					<td><?php echo implode(", ", $item["authors"]); ?></td>
				</tr>
				<tr>
					<th>Publisher</th>
					<td><?php echo $item["publisher"]; ?></td>
				</tr>
				<tr>
					<th>ISBN</th>
					<td><?php echo $item["isbn"]; ?></td>
				</tr>
				<?php } else if (strtolower($item["category"]) == "movies"){ ?>		
				<tr>
					<th>Director</th>
					<td><?php echo $item["director"]; ?></td>
				</tr>
				<tr>
					<th>Writers</th>
					<td><?php echo implode(", ", $item["writers"]); ?></td>
				</tr>
				<tr>
					<th>Stars</th>
					<td><?php echo implode(", ", $item["stars"]); ?></td>
				</tr>
				<?php } else if (strtolower($item["category"]) == "music"){ ?>	
				<tr>
					<th>Artist</th>
					<td><?php echo $item["artist"]; ?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>

//suggest.php
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$category = trim(filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING));
	$title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
	$format = trim(filter_input(INPUT_POST, "format", FILTER_SANITIZE_STRING));
	$genre = trim(filter_input(INPUT_POST, "genre", FILTER_SANITIZE_STRING));
	$year = trim(filter_input(INPUT_POST, "year", FILTER_SANITIZE_STRING));
	$details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

	if ($name == "" || $email == "" || $category == "" || $title == ""){
		$error_message = "Please fill in the required fields: Name, Email, Category and Title";
	}
	if (!isset($error_message) && $_POST["address"] != ""){
		$error_message = "Bad form input";
	}
	require("inc/phpmailer/class.phpmailer.php");
	
	$mail = new PHPMailer;
	
	if(!isset($error_message) && !$mail->ValidateAddress($email)){
		$error_message = "Invalid Email Address";
	}
	
	if(!isset($error_message)){
		$email_body = "";
		$email_body .= "Name " . $name . "\n";
		$email_body .= "Email " . $email . "\n";
		$email_body .= "Suggested Item\n";
		$email_body .= "Category " . $category . "\n";
		$email_body .= "Title " . $title . "\n";
		$email_body .= "Format " . $format . "\n";
		$email_body .= "Genre " . $genre . "\n";
		$email_body .= "Year " . $year . "\n";
		$email_body .= "Details " . $details . "\n";
		
		$mail->setFrom($email, $name);
		$mail->addAddress('zhengzhi@localhost', 'Hong');     // Add a recipient
		
		$mail->isHTML(false);                                  // Set email format to HTML

		$mail->Subject = 'Personal Media Library Suggestoin from' . $name;
		$mail->Body    = $email.body;
		

		if(!$mail->send()) {
			header("location:suggest.php?status=thanks");
			exit;
		}
			$error_message = 'Message could not be sent.';
			$error_message .= 'Mailer Error: ' . $mail->ErrorInfo;
		}
		
	}

$pageTitle = "Suggest a Media Title";
$section = "suggest";

include("inc/header.php"); 

?>

<div class="section page">
	<div class="wrapper">
		<h1>Suggest a Media Item</h1>
		<?php if (isset($_GET["status"]) && $_GET["status"] == "thanks"){
			echo "<p>Thanks for the email! I&rsquo;ll check out your suggestion shortly!</p>";
		} else { 
			if (isset($error_message)){
			echo "<p class='message'>" .$error_message . "</p>";
		} else {
			echo "<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to
		send me an email. </p>";
		}
		?>
		<form method="post" action="suggest.php">
			<table>
			<tr>
				<th><label for="name">Name (required)</label></th>
				<td><input type="text" id="name" name="name" value="<?php if (isset($name)) {
				echo $name; } ?>" /></td>
			</tr>
			<tr>
				<th><label for="email">Email (required)</label></th>
				<td><input type="text" id="email" name="email" value="<?php if (isset($email)) {
				echo $email; } ?>" /></td>
			</tr>
			<tr>
				<th><label for="category">Category (required)</label></th>
				<td><select id="catetory" name="category">
					<option value="">Select One</option>
					<option value="Books"<?php if (isset($category) && $category == "Books") {
					echo " selected"; } ?>>Book</option>
					<option value="Movies"<?php if (isset($category) && $category == "Movies") {
					echo " selected"; } ?>>Movie</option>
					<option value="Music"<?php if (isset($category) && $category == "Music") {
					echo " selected"; } ?>>Music</option>
				</select></td>
			</tr>
			<tr>			
				<th><label for="title">Title (required)</label></th>
				<td><input type="text" id="title" name="title" value="<?php if (isset($title)) {
				echo $title; } ?>" /></td>
			</tr>
			<tr>
                <th>
                    <label for="format">Format</label>
                </th>
                <td>
                    <select name="format" id="format">
                        <option value="">Select One</option>
                        <optgroup label="Books">
                            <option value="Audio"<?php
                            if (isset($format) && $format=="Audio") {
                                echo " selected";
                            } ?>>Audio</option>
                            <option value="Ebook"<?php
                            if (isset($format) && $format=="Ebook") {
                                echo " selected";
                            } ?>>Ebook</option>
                            <option value="Hardcover"<?php
                            if (isset($format) && $format=="Hardcover") {
                                echo " selected";
                            } ?>>Hardcover</option>
                            <option value="Paperback"<?php
                            if (isset($format) && $format=="Paperback") {
                                echo " selected";
                            } ?>>Paperback</option>
                        </optgroup>
                        <optgroup label="Movies">
                            <option value="Blu-ray"<?php
                            if (isset($format) && $format=="Blu-ray") {
                                echo " selected";
                            } ?>>Blu-ray</option>
                            <option value="DVD"<?php
                            if (isset($format) && $format=="DVD") {
                                echo " selected";
                            } ?>>DVD</option>
                            <option value="Streaming"<?php
                            if (isset($format) && $format=="Streaming") {
                                echo " selected";
                            } ?>>Streaming</option>
                            <option value="VHS"<?php
                            if (isset($format) && $format=="VHS") {
                                echo " selected";
                            } ?>>VHS</option>
                        </optgroup>
                        <optgroup label="Music">
                            <option value="Cassette"<?php
                            if (isset($format) && $format=="Cassette") {
                                echo " selected";
                            } ?>>Cassette</option>
                            <option value="CD"<?php
                            if (isset($format) && $format=="CD") {
                                echo " selected";
                            } ?>>CD</option>
                            <option value="MP3"<?php
                            if (isset($format) && $format=="MP3") {
                                echo " selected";
                            } ?>>MP3</option>
                            <option value="Vinyl"<?php
                            if (isset($format) && $format=="Vinyl") {
                                echo " selected";
                            } ?>>Vinyl</option>
                        </optgroup>
                    </select>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="genre">Genre</label>
                </th>
                <td>
                    <select name="genre" id="genre">
                        <option value="">Select One</option>
                        <optgroup label="Books">
                            <option value="Action"<?php
                            if (isset($genre) && $genre=="Action") {
                                echo " selected";
                            } ?>>Action</option>
                            <option value="Adventure"<?php
                            if (isset($genre) && $genre=="Adventure") {
                                echo " selected";
                            } ?>>Adventure</option>
                            <option value="Comedy"<?php
                            if (isset($genre) && $genre=="Comedy") {
                                echo " selected";
                            } ?>>Comedy</option>
                            <option value="Fantasy"<?php
                            if (isset($genre) && $genre=="Fantasy") {
                                echo " selected";
                            } ?>>Fantasy</option>
                            <option value="Historical"<?php
                            if (isset($genre) && $genre=="Historical") {
                                echo " selected";
                            } ?>>Historical</option>
                            <option value="Historical Fiction"<?php
                            if (isset($genre) && $genre=="Historical Fiction") {
                                echo " selected";
                            } ?>>Historical Fiction</option>
                            <option value="Horror"<?php
                            if (isset($genre) && $genre=="Horror") {
                                echo " selected";
                            } ?>>Horror</option>
                            <option value="Magical Realism"<?php
                            if (isset($genre) && $genre=="Magical Realism") {
                                echo " selected";
                            } ?>>Magical Realism</option>
                            <option value="Mystery"<?php
                            if (isset($genre) && $genre=="Mystery") {
                                echo " selected";
                            } ?>>Mystery</option>
                            <option value="Paranoid"<?php
                            if (isset($genre) && $genre=="Paranoid") {
                                echo " selected";
                            } ?>>Paranoid</option>
                            <option value="Philosophical"<?php
                            if (isset($genre) && $genre=="Philosophical") {
                                echo " selected";
                            } ?>>Philosophical</option>
                            <option value="Political"<?php
                            if (isset($genre) && $genre=="Political") {
                                echo " selected";
                            } ?>>Political</option>
                            <option value="Romance"<?php
                            if (isset($genre) && $genre=="Romance") {
                                echo " selected";
                            } ?>>Romance</option>
                            <option value="Saga"<?php
                            if (isset($genre) && $genre=="Saga") {
                                echo " selected";
                            } ?>>Saga</option>
                            <option value="Satire"<?php
                            if (isset($genre) && $genre=="Satire") {
                                echo " selected";
                            } ?>>Satire</option>
                            <option value="Sci-Fi"<?php
                            if (isset($genre) && $genre=="Sci-Fi") {
                                echo " selected";
                            } ?>>Sci-Fi</option>
                            <option value="Tech"<?php
                            if (isset($genre) && $genre=="Tech") {
                                echo " selected";
                            } ?>>Tech</option>
                            <option value="Thriller"<?php
                            if (isset($genre) && $genre=="Thriller") {
                                echo " selected";
                            } ?>>Thriller</option>
                            <option value="Urban"<?php
                            if (isset($genre) && $genre=="Urban") {
                                echo " selected";
                            } ?>>Urban</option>
                        </optgroup>
                        <optgroup label="Movies">
                            <option value="Action"<?php
                            if (isset($genre) && $genre=="Action") {
                                echo " selected";
                            } ?>>Action</option>
                            <option value="Adventure"<?php
                            if (isset($genre) && $genre=="Adventure") {
                                echo " selected";
                            } ?>>Adventure</option>
                            <option value="Animation"<?php
                            if (isset($genre) && $genre=="Animation") {
                                echo " selected";
                            } ?>>Animation</option>
                            <option value="Biography"<?php
                            if (isset($genre) && $genre=="Biography") {
                                echo " selected";
                            } ?>>Biography</option>
                            <option value="Comedy"<?php
                            if (isset($genre) && $genre=="Comedy") {
                                echo " selected";
                            } ?>>Comedy</option>
                            <option value="Crime"<?php
                            if (isset($genre) && $genre=="Crime") {
                                echo " selected";
                            } ?>>Crime</option>
                            <option value="Documentary"<?php
                            if (isset($genre) && $genre=="Documentary") {
                                echo " selected";
                            } ?>>Documentary</option>
                            <option value="Drama"<?php
                            if (isset($genre) && $genre=="Drama") {
                                echo " selected";
                            } ?>>Drama</option>
                            <option value="Family"<?php
                            if (isset($genre) && $genre=="Family") {
                                echo " selected";
                            } ?>>Family</option>
                            <option value="Fantasy"<?php
                            if (isset($genre) && $genre=="Fantasy") {
                                echo " selected";
                            } ?>>Fantasy</option>
                            <option value="Film-Noir"<?php
                            if (isset($genre) && $genre=="Film-Noir") {
                                echo " selected";
                            } ?>>Film-Noir</option>
                            <option value="History"<?php
                            if (isset($genre) && $genre=="History") {
                                echo " selected";
                            } ?>>History</option>
                            <option value="Horror"<?php
                            if (isset($genre) && $genre=="Horror") {
                                echo " selected";
                            } ?>>Horror</option>
                            <option value="Musical"<?php
                            if (isset($genre) && $genre=="Musical") {
                                echo " selected";
                            } ?>>Musical</option>
                            <option value="Mystery"<?php
                            if (isset($genre) && $genre=="Mystery") {
                                echo " selected";
                            } ?>>Mystery</option>
                            <option value="Romance"<?php
                            if (isset($genre) && $genre=="Romance") {
                                echo " selected";
                            } ?>>Romance</option>
                            <option value="Sci-Fi"<?php
                            if (isset($genre) && $genre=="Sci-Fi") {
                                echo " selected";
                            } ?>>Sci-Fi</option>
                            <option value="Sport"<?php
                            if (isset($genre) && $genre=="Sport") {
                                echo " selected";
                            } ?>>Sport</option>
                            <option value="Thriller"<?php
                            if (isset($genre) && $genre=="Thriller") {
                                echo " selected";
                            } ?>>Thriller</option>
                            <option value="War"<?php
                            if (isset($genre) && $genre=="War") {
                                echo " selected";
                            } ?>>War</option>
                            <option value="Western"<?php
                            if (isset($genre) && $genre=="Western") {
                                echo " selected";
                            } ?>>Western</option>
                        </optgroup>
                        <optgroup label="Music">
                            <option value="Alternative"<?php
                            if (isset($genre) && $genre=="Alternative") {
                                echo " selected";
                            } ?>>Alternative</option>
                            <option value="Blues"<?php
                            if (isset($genre) && $genre=="Blues") {
                                echo " selected";
                            } ?>>Blues</option>
                            <option value="Classical"<?php
                            if (isset($genre) && $genre=="Classical") {
                                echo " selected";
                            } ?>>Classical</option>
                            <option value="Country"<?php
                            if (isset($genre) && $genre=="Country") {
                                echo " selected";
                            } ?>>Country</option>
                            <option value="Dance"<?php
                            if (isset($genre) && $genre=="Dance") {
                                echo " selected";
                            } ?>>Dance</option>
                            <option value="Easy Listening"<?php
                            if (isset($genre) && $genre=="Easy Listening") {
                                echo " selected";
                            } ?>>Easy Listening</option>
                            <option value="Electronic"<?php
                            if (isset($genre) && $genre=="Electronic") {
                                echo " selected";
                            } ?>>Electronic</option>
                            <option value="Folk"<?php
                            if (isset($genre) && $genre=="Folk") {
                                echo " selected";
                            } ?>>Folk</option>
                            <option value="Hip Hop/Rap"<?php
                            if (isset($genre) && $genre=="Hip Hop/Rap") {
                                echo " selected";
                            } ?>>Hip Hop/Rap</option>
                            <option value="Inspirational/Gospel"<?php
                            if (isset($genre) && $genre=="Inspirational/Gospel") {
                                echo " selected";
                            } ?>>Insirational/Gospel</option>
                            <option value="Jazz"<?php
                            if (isset($genre) && $genre=="Jazz") {
                                echo " selected";
                            } ?>>Jazz</option>
                            <option value="Latin"<?php
                            if (isset($genre) && $genre=="Latin") {
                                echo " selected";
                            } ?>>Latin</option>
                            <option value="New Age"<?php
                            if (isset($genre) && $genre=="New Age") {
                                echo " selected";
                            } ?>>New Age</option>
                            <option value="Opera"<?php
                            if (isset($genre) && $genre=="Opera") {
                                echo " selected";
                            } ?>>Opera</option>
                            <option value="Pop"<?php
                            if (isset($genre) && $genre=="Pop") {
                                echo " selected";
                            } ?>>Pop</option>
                            <option value="R&B/Soul"<?php
                            if (isset($genre) && $genre=="R&B/Soul") {
                                echo " selected";
                            } ?>>R&amp;B/Soul</option>
                            <option value="Reggae"<?php
                            if (isset($genre) && $genre=="Reggae") {
                                echo " selected";
                            } ?>>Reggae</option>
                            <option value="Rock"<?php
                            if (isset($genre) && $genre=="Rock") {
                                echo " selected";
                            } ?>>Rock</option>
                        </optgroup>
                    </select>
                </td>
            </tr>
			<tr>
				<th><label for="year">Year</label></th>
				<td><input type="text" id="email" name="year" value="<?php if (isset($year)) {
				echo $year; } ?>" /></td>
			</tr>
			<tr>
				<th><label for="email">Suggest Item Details</label></th>
				<td><textarea name="details" id="details"><?php if (isset($details)) {
				echo htmlspecialchars($_POST["details"]); } ?></textarea></td>
			</tr>
			<tr style="display: none">
				<th><label for="address">Address</label></th>
				<td><input type="text" id="address" name="address" />
				<p>Please leave this field blank</p></td>
			</tr>
			</table>
			<input type="submit" value="Send" />
		</form>
		<?php } ?>
	</div>
</div>

<?php include("inc/footer.php"); ?>
//inc/data.php
<?php

$catalog = [];
//books
$catalog[101] = [
	"title" => "A Design Patterns: Elements of Reusable Object-Oriented Software",
	"img" => "img/media/design_patterns.jpg",
    "genre" => "Tech",
    "format" => "Paperback",
    "year" => 1994,
    "category" => "Books",
    "authors" => [
        "Erich Gamma",
        "Richard Helm",
        "Ralph Johnson",
        "John Vlissides"
    ],
    "publisher" => "Prentice Hall",
    "isbn" => '978-0201633610'
];
$catalog[102] = [
    "title" => "Clean Code: A Handbook of Agile Software Craftsmanship",
    "img" => "img/media/clean_code.jpg",
    "genre" => "Tech",
    "format" => "Ebook",
    "year" => 2008,
    "category" => "Books",
    "authors" => [
        "Robert C. Martin"
    ],
    "publisher" => "Prentice Hall",
    "isbn" => '978-0132350884'
];
$catalog[103] = [
    "title" => "Refactoring: Improving the Design of Existing Code",
    "img" => "img/media/refactoring.jpg",
    "genre" => "Tech",
    "format" => "Hardcover",
    "year" => 1999,
    "category" => "Books",
    "authors" => [
        "Martin Fowler",
        "Kent Beck",
        "John Brant",
        "William Opdyke",
        "Don Roberts"
    ],
    "publisher" => "Addison-Wesley Professional",
    "isbn" => '978-0201485677'
];
$catalog[104] = [
    "title" => "The Clean Coder: A Code of Conduct for Professional Programmers",
    "img" => "img/media/clean_coder.jpg",
    "genre" => "Tech",
    "format" => "Audio",
    "year" => 2011,
    "category" => "Books",
    "authors" => [
        "Robert C. Martin"
    ],
    "publisher" => "Prentice Hall",
    "isbn" => '007-6092046981'
];
//Movies
$catalog[201] = [
    "title" => "Forrest Gump",
    "img" => "img/media/forest_gump.jpg",
    "genre" => "Drama",
    "format" => "DVD",
    "year" => 1994,
    "category" => "Movies",
    "director" => "Robert Zemeckis",
    "writers" => [
        "Winston Groom",
        "Eric Roth"
    ],
    "stars" => [
        "Tom Hanks",
        "Rebecca Williams",
        "Sally Field",
        "Michael Conner Humphreys"
    ]
];
$catalog[202] = [
    "title" => "Office Space",
    "img" => "img/media/office_space.jpg",
    "genre" => "Comedy",
    "format" => "Blu-ray",
    "year" => 1999,
    "category" => "Movies",
    "director" => "Mike Judge",
    "writers" => [
        "William Goldman"
    ],
    "stars" => [
        "Ron Livingston",
        "Jennifer Aniston",
        "David Herman",
        "Ajay Naidu",
        "Diedrich Bader",
        "Stephen Root"
    ]
];
$catalog[203] = [
    "title" => "The Lord of the Rings: The Fellowship of the Ring",
    "img" => "img/media/lotr.jpg",
    "genre" => "Drama",
    "format" => "Blu-ray",
    "year" => 2001,
    "category" => "Movies",
    "director" => "Peter Jackson",
    "writers" => [
        "J.R.R. Tolkien",
        "Fran Walsh",
        "Philippa Boyens",
        "Peter Jackson"
    ],
    "stars" => [
        "Ron Livingston",
        "Jennifer Aniston",
        "David Herman",
        "Ajay Naidu",
        "Diedrich Bader",
        "Stephen Root"
    ]
];
$catalog[204] = [
    "title" => "The Princess Bride",
    "img" => "img/media/princess_bride.jpg",
    "genre" => "Comedy",
    "format" => "DVD",
    "year" => 1987,
    "category" => "Movies",
    "director" => "Rob Reiner",
    "writers" => [
        "William Goldman"
    ],
    "stars" => [
        "Cary Elwes",
        "Mandy Patinkin",
        "Robin Wright",
        "Chris Sarandon",
        "Christopher Guest",
        "Wallace Shawn",
        "AndrÃ© the Giant",
        "Fred Savage",
        "Peter Falk",
        "Billy Crystal"
    ]
];
//Music
$catalog[301] = [
    "title" => "Beethoven: Complete Symphonies",
    "img" => "img/media/beethoven.jpg",
    "genre" => "Clasical",
    "format" => "CD",
    "year" => 2012,
    "category" => "Music",
    "artist" => "Ludwig van Beethoven"
];
$catalog[302] = [
    "title" => "Elvis Forever",
    "img" => "img/media/elvis_presley.jpg",
    "genre" => "Rock",
    "format" => "Vinyl",
    "year" => 2015,
    "category" => "Music",
    "artist" => "Elvis Presley"
];
$catalog[303] = [
    "title" => "No Fences",
    "img" => "img/media/garth_brooks.jpg",
    "genre" => "Country",
    "format" => "Cassette",
    "year" => 1990,
    "category" => "Music",
    "artist" => "Garth Brooks"
];
$catalog[304] = [
    "title" => "The Very Thought of You",
    "img" => "img/media/nat_king_cole.jpg",
    "genre" => "Jaz",
    "format" => "MP3",
    "year" => 2008,
    "category" => "Music",
    "artist" => "Nat King Cole"
];

//php closing tag is not required. Maybe preferred in some occations. 

//inc/header.php
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="./">Personal Media Library</a></h1>

			<ul class="nav">
                <li class="books <?php if ($section == "books") {echo "on";} ?>"><a href="catalog.php?cat=books">Books</a></li>
                <li class="movies <?php if ($section == "movies") { echo "on";} ?>"><a href="catalog.php?cat=movies">Movies</a></li>
                <li class="music <?php if ($section == "music") {echo "on";} ?>"><a href="catalog.php?cat=music">Music</a></li>
                <li class="suggest <?php if ($section == "suggest") {echo "on";} ?>"><a href="suggest.php">Suggest</a></li>
            </ul>

		</div>

	</div>

	<div id="content">
	
	//inc.footer.php
	</div> <!-- end content -->

	<div class="footer">

		<div class="wrapper">

			<ul>		
				<li><a href="http://twitter.com/treehouse">Twitter</a></li>
				<li><a href="https://www.facebook.com/TeamTreehouse">Facebook</a></li>
			</ul>

			<p>&copy;<?php echo date("Y"); ?> Personal Media Library</p>

		</div>
	
	</div>

</body>
</html>
//inc.functions.php
<?php
function get_item_html($id, $item){
	$output = "<li><a href='#'><img src='"
		. $item["img"] . "' alt='"
		. $item["title"]. "' />" 
		. "<p>View Details</p>"
		. "</a></li>";
			
	return $output;
}

function array_category($catalog, $category){
	$output = array();
	foreach ($catalog as $id => $item){
		if ($category == null OR strtolower($category) == strtolower($item["category"])){
			$sort = $item["title"];
			$sort = ltrim($sort, "The ");
			$sort = ltrim($sort, "A ");
			$sort = ltrim($sort, "An ");
			$output[$id] = $sort;			
		}
	}
	asort($output);
	return array_keys($output);
}

