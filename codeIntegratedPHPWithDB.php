
//challenge question
$db = new PDO('sqlite::memory:');

SQL query:
SELECT name, price FROM products;
SELECT first_name, last_name FROM users;

/*The company you work for wants to send an email to its member base. They want the email to contain a complementary offer based on their membership level.

There is a send_offer function ready for you to use that accepts the following arguments: $member_id, $email, $fullname, $level

The data from the database is currently in a PDOStatement object named $results. Loop through those results and pass them to the send_offer function.*/

<?php
include "helper.php";

$user = $results->fetchAll(PDO::FETCH_ASSOC);

foreach ($user as $key)
{
    echo send_offer($key['member_id'],$key['email'],$key['fullname'],$key['level']);
}


SELECT * FROM Media JOIN Media_Genres ON Media.media_id = Media_Genres.media_id
JOIN Genres ON Genres.genre_id = Media_Genres.genre_id
WHERE Media_Genres.media_id = Media.media_id

<?php
function get_member($member_id) {
    include("connection.php");

    try {
      $results = $db->query(
          "SELECT member_id, email, fullname, level
          FROM members
          WHERE member_id = $member_id"
      );
      $results->bindParam(1, $member_id, PDO::PARAM_INT);
      $results->execute();
    } catch (Exception $e) {
      echo "bad query";
    }
  
    $members = $results->fetchAll();
    return $members;
}

<?php

include "helper.php";

while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
  $item["genres"][] = $row["genre_id"] = $row["genre"];
}

SELECT first_name, last_name FROM users WHERE username = "wig_lady";
SELECT * FROM products WHERE price <> 9.99;
SELECT username FROM users WHERE last_name = "Holligan";

SELECT * FROM books ORDER BY title ASC LIMIT 10 OFFSET 10;

SELECT * FROM phone_book ORDER BY last_name, first_name LIMIT 20 OFFSET 40;

<?php
include "pagination.php";

/* add function here */
function pagination($total_pages, $current_page, $section, $search){
/* setting pagination variable */
  $pagination = "<div class=\"pagination\">";
  $pagination .= "Pages: ";  
  for ($i = 1;$i <= $total_pages;$i++) {
      if ($i == $current_page) {
          $pagination .= " <span>$i</span>";
      } else {
          $pagination .= " <a href='catalog.php?";
          if (!empty($search)) {
              $pagination .= "s=".urlencode(htmlspecialchars($search)) . '&' ;
          } else if (!empty($section)) {
              $pagination .= "cat=".$section . '&';
          }
          $pagination .= "pg=$i'>$i</a>";
      }
  }
  $pagination .= "</div>";
  return $pagination;
}
/* displaying the pagination */
echo pagination($total_pages, $current_page, $section, $search);

SELECT * FROM products WHERE name LIKE "%t-shirt%";
SELECT * FROM users WHERE first_name like "L%";
SELECT * FROM People WHERE fullname LIKE "%Tolkien";

SELECT title FROM People
JOIN Media_People ON Media_People.media_id = Media.media_id
JOIN Media ON Media_People.people_id = People.people_id
WHERE fullname LIKE '%Tolkien';

SELECT title FROM Media 
JOIN Media_People ON Media.media_id = Media_People.media_id
JOIN People ON Media_People.people_id = People.people_id
WHERE fullname LIKE '%Tolkien'AND category = 'Books';

treehouse project: 
//index.php
<?php 
include("inc/functions.php");

$pageTitle = "Personal Media Library";
$section = null;

include("inc/header.php"); ?>
		<div class="section catalog random">

			<div class="wrapper">

				<h2>May we suggest something?</h2>

        <ul class="items">
            <?php
            $random = random_catalog_array();
            foreach ($random as $item) {
                echo get_item_html($item);
            }
            ?>							
				</ul>

			</div>

		</div>

<?php include("inc/footer.php"); ?>

//catalog.php
<?php 
include("inc/functions.php");

$pageTitle = "Full Catalog";
$section = null;
$search = null;
$items_per_page = 8;

if (isset($_GET["cat"])) {
    if ($_GET["cat"] == "books") {
        $pageTitle = "Books";
        $section = "books";
    } else if ($_GET["cat"] == "movies") {
        $pageTitle = "Movies";
        $section = "movies";
    } else if ($_GET["cat"] == "music") {
        $pageTitle = "Music";
        $section = "music";
    }
}


if (isset($_GET["s"])){
	$search = 
	filter_input(INPUT_GET, "s", FILTER_SANITIZE_STRING);
}

if (isset($_GET["pg"])){
	$current_page = 
	filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
}
if(empty($current_page)){
	$current_page = 1;
}

$total_items = get_catalog_count($section,$search);
$total_pages = 1;
$offset = 0;
if ($total_items > 0){
	$total_pages = ceil($total_items / $items_per_page);

//limit results in redirect
$limit_results = "";
if (!empty($search)){
		$limit_results =
		"s=".urlencode(htmlspecialchars($search))."&";
	} else if (!empty($section)){
	$limit_results = "cat=" . $section . "&";
}
//redirect too-large pgae numbers to the last page
if ($current_page > $total_pages){
	header("location: catalog.php?"
			. $limit_results
			. "pg=".$total_pages);
}
//redirect too-small page numbers to the first page
if ($current_page < 1){
	header("location:catalog.php?"
			. $limit_results
			. "pg=1");
}
//determine the offset (number of items to skip) for the current page
//for example: on page 3 with 8 item per page, the offset would be 16
	$offset = ($current_page - 1) * $items_per_page;

	$pagination = "<div class=\"pagination\">";
	$pagination .= "Pages: ";
					
			for ($i = 1; $i <= $total_pages;$i++){
				if ($i == $current_page){
					$pagination .= " <span>$i</span>";
				} else {
					$pagination .= " <a href='catalog.php?";
					if (!empty($search)){
						$pagination .= "s=".urlencode(htmlspecialchars($search))."&";
					} else if(!empty($section)){
						$pagination .= "cat=".$section."&";
					} 
					$pagination .= "pg=$i'>$i</a>";
				
				}
			}
			
	$pagination .= "</div>";
}

if(!empty($search)){
	$catalog = search_catalog_array($search,$items_per_page,$offset);
} else if (empty($section)){
	$catalog = full_catalog_array($items_per_page,$offset);
} else {
	$catalog = 
	category_catalog_array($section,$items_per_page,$offset);
}



include("inc/header.php"); ?>

<div class="section catalog page">
    
    <div class="wrapper">
        
        <h1><?php 
		if ($search != null){
			echo "Search Results for\"".htmlspecialchars($search)."\"";
		} else {
        if ($section != null) {
            echo "<a href='catalog.php'>Full Catalog</a> &gt; ";
        }
        echo $pageTitle; 
		}
		?></h1>
       <?php 
	   if ($total_items < 1){
		   echo "<p>No items were found matching that search term. </p>";
		   echo "<p>Search Again or "
		   . "<a href=\"catalog.php\">Browse the Full Catalog</a></p>";
	   } else {
	   echo $pagination; ?>
        <ul class="items">
            <?php
                foreach ($catalog as $item) {
                echo get_item_html($item);
            }
            ?>
        </ul>
       <?php echo $pagination;
	   } ?>
    </div>
</div>

<?php include("inc/footer.php"); ?>

//details.php
<?php 
include("inc/functions.php");

if (isset($_GET["id"])) {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
	$item = single_item_array($id); 
}

if (empty($item)) {
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
            <?php echo $item["category"]; ?></a>
            &gt; <?php echo $item["title"]; ?>
        </div>
        
        <div class="media-picture">
    
        <span>
            <img src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>" />
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
                <?php if (strtolower($item["category"]) == "books") { ?>
                <tr>
                    <th>Authors</th>
                    <td><?php echo implode(", ",$item["author"]); ?></td>
                </tr>
                <tr>
                    <th>Publisher</th>
                    <td><?php echo $item["publisher"]; ?></td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td><?php echo $item["isbn"]; ?></td>
                </tr>    
                <?php } else if (strtolower($item["category"]) == "movies") { ?>
                <tr>
                    <th>Director</th>
                    <td><?php echo implode(", ",$item["director"]); ?></td>
                </tr>

                <tr>
                    <th>Writers</th>
                    <td><?php echo implode(", ",$item["writer"]); ?></td>
                </tr>
                <tr>
                    <th>Stars</th>
                    <td><?php echo implode(", ",$item["star"]); ?></td>
                </tr>
                <?php } else if (strtolower($item["category"]) == "music") { ?>
                <tr>
                    <th>Artist</th>
                    <td><?php echo implode(", ", $item["artist"]); ?></td>
                </tr>
                <?php } ?>
            </table>
        
        </div>
    
    </div>

</div>

//suggest.php
<?php 
include("inc/functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
    $category = trim(filter_input(INPUT_POST,"category",FILTER_SANITIZE_STRING));
    $title = trim(filter_input(INPUT_POST,"title",FILTER_SANITIZE_STRING));
    $format = trim(filter_input(INPUT_POST,"format",FILTER_SANITIZE_STRING));
    $genre = trim(filter_input(INPUT_POST,"genre",FILTER_SANITIZE_STRING));
    $year = trim(filter_input(INPUT_POST,"year",FILTER_SANITIZE_STRING));
    $details = trim(filter_input(INPUT_POST,"details",FILTER_SANITIZE_SPECIAL_CHARS));
    
    if ($name == "" || $email == "" || $category == "" || $title == "") {
        $error_message = "Please fill in the required fields: Name, Email, Category and Title";
    }
    if (!isset($error_message) && $_POST["address"] != "") {
        $error_message = "Bad form input";
    }
    
    require("inc/phpmailer/class.phpmailer.php");
    
    $mail = new PHPMailer;
    
    if (!isset($error_message) && !$mail->ValidateAddress($email)) {
        $error_message = "Invalid Email Address";
    }
    
    if (!isset($error_message)) {
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
        $mail->addAddress('treehouse@localhost', 'Alena');     // Add a recipient
        
        $mail->isHTML(false);                                  // Set email format to HTML
        
        $mail->Subject = 'Personal Media Library Suggestion from ' . $name;
        $mail->Body    = $email_body;
        
        if($mail->send()) {
            header("location:suggest.php?status=thanks");
            exit;
        }
        $error_message = 'Message could not be sent.';
        $error_message .= 'Mailer Error: ' . $mail->ErrorInfo;
    }
    
}

$pageTitle = "Suggest a Media Item";
$section = "suggest";

include("inc/header.php"); 
?>

<div class="section page">
    <div class="wrapper">
        <h1>Suggest a Media Item</h1>
        <?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") {
            echo "<p>Thanks for the email! I&rsquo;ll check out your suggestion shortly!</p>";
        } else {
            if (isset($error_message)) {
                echo "<p class='message'>".$error_message . "</p>";
            } else {
                echo "<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an email.</p>";
            }
        ?>
        <form method="post" action="suggest.php">
            <table>
            <tr>
                <th><label for="name">Name (required)</label></th>
                <td><input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" /></td>
            </tr>
            <tr>
                <th><label for="email">Email (required)</label></th>
                <td><input type="text" id="email" name="email" value="<?php if (isset($email)) { echo $email; } ?>" /></td>
            </tr>
            <tr>
                <th><label for="category">Category (required)</label></th>
                <td><select id="category" name="category">
                    <option value="">Select One</option>
                    <option value="Books"<?php if (isset($category) && $category == "Books") { echo " selected"; } ?>>Book</option>
                    <option value="Movies"<?php if (isset($category) && $category == "Movies") { echo " selected"; } ?>>Movie</option>
                    <option value="Music"<?php if (isset($category) && $category == "Music") { echo " selected"; } ?>>Music</option>
                </select></td>
            </tr>
            <tr>
                <th><label for="title">Title (required)</label></th>
                <td><input type="text" id="title" name="title" value="<?php if (isset($title)) { echo $title; } ?>" /></td>
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
                       
		<?php
		$genre_array = genre_array();
		foreach ($genre_array as $category=>$options){
            echo "<optgroup label=\"$category\">";
			foreach ($options as $option){
				echo "<option value=\"$option\"";
                            if (isset($genre) && $genre=="$option") {
                                echo " selected";
                            } 
							echo ">$option</option>";
			}
                        echo "</optgroup>";
		}
		?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="year">Year</label></th>
                <td><input type="text" id="year" name="year" value="<?php if (isset($year)) { echo $year; } ?>" /></td>
            </tr>
            <tr>
                <th><label for="name">Suggest Item Details</label></th>
                <td><textarea name="details" id="details"><?php if (isset($details)) { echo htmlspecialchars($_POST["details"]); } ?></textarea></td>
            </tr>
            <tr style="display:none">
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
 
 //functions.php
 <?php
function get_catalog_count($category = null, $search = null){
	$category = strtolower($category);
	include("connection.php");
	try{
		$sql = "SELECT COUNT(media_id) FROM Media";
		if (!empty($search)){
			$result = $db->prepare(
				$sql
				. "WHERE title LIKE ?"
			);
			$result->bindValue(1,'%'.$search.'%',PDO::PARAM_STR);
		} else if(!empty($category)){
			$result = $db->prepare(
			$sql
			. " WHERE LOWER(category) = ?"
		);
		
		$result->bindParam(1,$category,PDO::PARAM_STR);
	} else {
		$result = $db->prepare($sql);
	}
		$result->execute();
	} catch(Exception $e){
		echo "bad query";
	}
	$count = $result->fetchColumn(0);
	return $count;
}
function full_catalog_array($limit = null, $offset = 0){
	include("connection.php");
	
	try {
		$sql = "SELECT media_id, title, category, img 
		FROM Media
		ORDER BY
		REPLACE(
			REPLACE(
				REPLACE(title, 'The ',''),
				'An ',
				''
				),
				'A ',
				''
				)";
		if (is_integer($limit)){
			$results = $db->prepare($sql . " LIMIT ? OFFSET ?");
			$results->bindParam(1,$limit,PDO::PARAM_INT);
			$results->bindParam(2,$offset,PDO::PARAM_INT);
		} else {
			$results = $db->prepare($sql);
		}
		$results->execute();
		
	} catch (Exception $e){
		echo "Unable to retrieve results";
		exit;
	}
	
	$catalog = $results->fetchAll();
	return $catalog;
}

function category_catalog_array($category, $limit = null, $offset = 0){
	include("connection.php");
	$category = strtolower($category);
	try {
		$sql = "SELECT media_id, title, category, img
		FROM Media
		WHERE LOWER(category) = ?
		ORDER BY
		REPLACE(
			REPLACE(
				REPLACE(title, 'The ',''),
				'An ',
				''
				),
				'A ',
				''
				)";
			if (is_integer($limit)){
			$results = $db->prepare($sql . " LIMIT ? OFFSET ?");
			$results->bindParam(1, $category,PDO::PARAM_STR);
			$results->bindParam(2,$limit,PDO::PARAM_INT);
			$results->bindParam(3,$offset,PDO::PARAM_INT);
		} else {
		$results = $db->prepare($sql);	
		$results->bindParam(1, $category,PDO::PARAM_STR);
		}
		$results->execute();
	} catch (Exception $e){
		echo "Unable to retrieve results";
		exit;
	}
	
	$catalog = $results->fetchAll();
	return $catalog;
}

function search_catalog_array($search, $limit = null, $offset = 0){
	include("connection.php");
	
	try {
		$sql = "SELECT media_id, title, category, img
		FROM Media
		WHERE title LIKE ?
		ORDER BY
		REPLACE(
			REPLACE(
				REPLACE(title, 'The ',''),
				'An ',
				''
				),
				'A ',
				''
				)";
			if (is_integer($limit)){
			$results = $db->prepare($sql . " LIMIT ? OFFSET ?");
			$results->bindValue(1, "%".$search."%",PDO::PARAM_STR);
			$results->bindParam(2,$limit,PDO::PARAM_INT);
			$results->bindParam(3,$offset,PDO::PARAM_INT);
		} else {
		$results = $db->prepare($sql);	
		$results->bindValue(1, "%".$search."%",PDO::PARAM_STR);
		}
		$results->execute();
	} catch (Exception $e){
		echo "Unable to retrieve results";
		exit;
	}
	
	$catalog = $results->fetchAll();
	return $catalog;
}
function random_catalog_array(){
	include("connection.php");
	
	try {
		$results = $db->query(
		"SELECT media_id, title, category, img
		FROM Media
		ORDER BY RAND()
		LIMIT 4"
		
		);
	} catch (Exception $e){
		echo "Unable to retrieve results";
		exit;
	}
	
	$catalog = $results->fetchAll();
	return $catalog;
}
/*function single_item_array($id){
	include("connection.php");
	
	try {
		$results = $db->prepare(
		"SELECT Media.media_id, title, category, img, format, year,
		genre, publisher, isbn
		FROM Media
		JOIN Genres ON Media.genre_id = Genres.genre_id
		LEFT OUTER JOIN Books 
		ON Media.media_id = Books.media_id
		WHERE Media.media_id = ?"
		);
		$results->bindParam(1, $id, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e){
		echo "Unable to retrieve results";
		exit;
	}
	$item = $results->fetch();
	if (empty($item)) return $item;
}
*/

function single_item_array($id){
	include("connection.php");
	try {
		$results = $db->prepare(
		"SELECT fullname, role
		FROM Media_People
		JOIN People ON Media_People.people_id = People.people_id
		WHERE Media_People.media_id = ?"
		);
		$results->bindParam(1, $id, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e){
		echo "Unable to retrieve results";
		exit;
	}
	while($row = $results->fetch(PDO::FETCH_ASSOC)){
		$item[$row["role"]][] = $row["fullname"];
	}
	return $item;
}

function genre_array($category = null){
	$category = strtolower($category);
	include("connection.php");
	
	try{
		$sql = "SELECT genre, category"
			. " FROM Genres "
			. "JOIN Genre_Categories "
			. "ON Genres.genre_id = Genre_Categories.genre_id";
		if (!empty($category)){
			$results = $db ->prepare($sql
				. " WHERE LOWER(category) = ?"
				. " ORDER BY genre");
			$results->bindParam(1,$category,PDO::PARAM_STR);
		} else {
			$results = $db ->prepare($sql . " ORDER BY genre");
		}
			$results->execute();
	} catch (Exception $e){
		echo "bad query";
	}
	$genres = array();
	while ($row = $results->fetch(PDO::FETCH_ASSOC)){
		$genres[$row["category"]][] = $row["genre"];
	}
	return $genres;
	}


function get_item_html($item) {
    $output = "<li><a href='details.php?id="
        . $item["media_id"] . "'><img src='" 
        . $item["img"] . "' alt='" 
        . $item["title"] . "' />" 
        . "<p>View Details</p>"
        . "</a></li>";
    return $output;
}

function array_category($catalog,$category) {
    $output = array();
    
    foreach ($catalog as $id => $item) {
        if ($category == null OR strtolower($category) == strtolower($item["category"])) {
            $sort = $item["title"];
            $sort = ltrim($sort,"The ");
            $sort = ltrim($sort,"A ");
            $sort = ltrim($sort,"An ");
            $output[$id] = $sort;            
        }
    }
    
    asort($output);
    return array_keys($output);
}

?>

//connection.php
<?php
try{
	$db = new PDO("sqlite:".__DIR__."/database.db");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e){
	echo "Unable to connect";
	echo $e ->getMessage();
	exit;
}

//data.php
<?php
include("connection.php");

/*$catalog = [];
//Books
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
        "André the Giant",
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
]; */
?>
//header.php
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="/">Personal Media Library</a></h1>

			<ul class="nav">
                <li class="books<?php if ($section == "books") { echo " on"; } ?>"><a href="catalog.php?cat=books">Books</a></li>
                <li class="movies<?php if ($section == "movies") { echo " on"; } ?>"><a href="catalog.php?cat=movies">Movies</a></li>
                <li class="music<?php if ($section == "music") { echo " on"; } ?>"><a href="catalog.php?cat=music">Music</a></li>
                <li class="suggest<?php if ($section == "suggest") { echo " on"; } ?>"><a href="suggest.php">Suggest</a></li>
            </ul>

		</div>

	</div>
	<div class="search">
	<form method="get" action="catalog.php"> 
		<label for="s">Search:</label>
		<input type="text" name="s" id="s" />
		<input type="submit" value="go" />
		
	</form>
	</div>

	<div id="content">
//footer.php
</div><!-- end content -->

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

