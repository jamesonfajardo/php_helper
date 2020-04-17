<?php

// TALBE OF CONTENTS:
// PDO NOTES - perform CRUD operations using PDO
// php_trim_chars - trim string by character
// open_graph - easily integrate open graph to a webpage
// twitter_card - easily integrate twitter cards to a webpage

//! ----------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------

/*

// database handler - this script is responsible for giving connection to the DB
class Dbh { 
    protected function connect(){
        $sv = "localhost";          //CONNECTION INFO
        $un = "root";               //CONNECTION INFO
        $pw = "";                   //CONNECTION INFO
        $db = "your_database_name"; //CONNECTION INFO
        $cs = "utf8mb4";	        //CONNECTION INFO
        
        try {   // ALWAYS EXECUTE CONNECTIONS INSIDE TRY&CATCH OR ELSE YOU WILL EXPOSE THE CONNECTION INFO(UN, PW, ETC..)
            
           $dsn = "mysql:host=$sv;dbname=$db;charset=$cs"; //DataSourceName is driver(mysql): host(your server); dbname(your db name); charset(utf8mb4);
           $pdo = new PDO($dsn, $un, $pw); //INSTANTIATE PDO AND INCLUDE THE DSN, UN, PW AS PARAMETERS
           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //SET ATTRIBUTES TO CATCH ERRORS
           return $pdo; //RETURN CONNECTION
           $pdo = null; //DESTROY INSTANCE AFTER FINISHING TASK
           
        } catch(PDOException $PDO_Error){ //PDOException is a php function to catch errors and not just a made up variable/property
            echo "Connection Failed: ".$PDO_Error->getMessage(); //GET ERROR MESSAGE
        }
        
    }
}

// inherit a database connection handler
class User extends Dbh {
	
	//SELECT ALL DATA
	public function getAllUsers(){
		$stmt = $this->connect()->query("select * from poringadmin");
		while($row = $stmt->fetch()){
			$un = $row['poring_un'];
			return $un;
			
			// OTHER METHOD: INSERT RECORD TO ARRAY USING WHILE LOOP, THEN CALL DATA OUTSIDE OF WHILE LOOP
			// step 1: $un[] = $row['poring_un'];
		}
			// step 2: var_dump($un);
		$stmt = null; //ALWAYS DESTROY VARIABLE/PROPERTY WHO USED USED THE PDO OBJECT. THIS PROPERTY USED connect() WHICH HOLDS PDO OBJECT
	}
	
	//SELECT DATA BASED ON USER INPUT
	public function getUsersWithCountCheck(){
		$id = 2;        //SAMPLE USER INPUT
		$un = "enc_me"; //SAMPLE USER INPUT
		
		$stmt = $this->connect()->prepare("select * from poringadmin where id=? and poring_un=?"); //QUERY USING PLACEHOLDERS
		$stmt->execute([$id, $un]); //BIND PARAMETERS TO PLACEHOLDERS
		
		if($stmt->rowCount()){ //THIS LINE SIMPLY MEANS "IF THERE'S A MATCH" RETURN IT
			while($row = $stmt->fetch()){ //CREATE A VAR THAT WILL HOLD THE FETCHED COLUMN DATA
				return $row['poring_un']."_".$row['poring_pw']; //"return" RETURNS 1 DATA WHILE "echo" spits all the data
			}
		} else { //EXECUTE IF THERE'S NO MATCH
			echo "No records";
		}
		
		$stmt = null; //ALWAYS DESTROY VARIABLE/PROPERTY WHO USED USED THE PDO OBJECT. THIS PROPERTY USED connect() WHICH HOLDS PDO OBJECT
	}
	
}

*/

//! ----------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------

// php_trim_chars - trim string by character

// php_trim_chars(string, int);
// - string: the string to trim
// - int: only allow x characters according to this value

//* php_trim_chars('this is a very long string that should be truncated', 10);

function php_trim_chars($string = null, $limit = null) {
    $stringData = [];
    $i = 0;
    if(strlen($string) > $limit) {
        for($i; $i < $limit; $i++) {
            $stringData[] = $string[$i];
        }
        return implode('', $stringData) . '...';
    } else {
        return $string;
    }
}

//! ----------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------

// open_graph - easily integrate open graph to a webpage

// title        - the title of the webpage and rich media (60 chars max)
// description  - the title of the webpage and rich media (80 chars min - 320 chars max)
// img_url      - url of the rich media image (absolute url, dimension: 1200x630 or 600x315 pixels)
// img_alt      - a description of what is in the image (for users who are visually impaired, 320 chars max)

//* open_graph([
//*     "title" => "COVID-19 Live Tracker",
//*     "description" => "We believe in the power of the internet and at times like these, we want to make the world(wide web) a better place",
//*     "img_url" => 'https://url-path/to-my/image.png',
//*     "img_alt" => "We believe in the power of the internet and at times like these, we want to make the world(wide web) a better place",
//* ]);

function open_graph($data = NULL) {
    echo "
        <link rel='canonical' href='https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]' />
        <meta property='og:url' content='https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]' />
        <title>".($data['title'] ?? null)."</title>
        <meta property='og:title' content='".($data['title'] ?? null)."' />
        <meta name='Description' content='".($data['description'] ?? null)."' />
        <meta property='og:description' content='".($data['description'] ?? null)."' />
        <meta property='og:image' content='".($data['img_url'] ?? null)."' />
        <meta property='og:image:alt' content='".($data['img_alt'] ?? null)."' />
        <meta property='og:site_name' content='".str_replace('.com', '', $_SERVER['HTTP_HOST'])."' />
        <meta property='og:type' content='website' />
    ";
}

//! ----------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------

// twitter_card- easily integrate twitter cards to a webpage

// handle       - The Twitter @username the card should be attributed to.
// title        - the title of the webpage and twitter card (60 chars max)
// description  - the description of the webpage and twitter card
// img_url      - url of the twitter card image (absolute url, dimension: 800x420 pixels)
// img_alt      - a text description of the image (for users who are visually impaired, 320 chars max)

//* twitter_card([
//*     'handle' => '@99porings',
//*     "title" => "COVID-19 Live Tracker",
//*     "description" => "We believe in the power of the internet and at times like these, we want to make the world(wide web) a better place",
//*     "img_url" => 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'twitter.png',
//*     "img_alt" => "We believe in the power of the internet and at times like these, we want to make the world(wide web) a better place",
//* ]);

function twitter_card($data = NULL) {
    echo "
        <meta name='twitter:card' content='summary_large_image' />
        <meta name='twitter:site' content='".($data['handle'] ?? null)."' />
        <meta name='twitter:title' content='".($data['title'] ?? null)."' />
        <meta name='twitter:description' content='".($data['description'] ?? null)."' />
        <meta name='twitter:image' content='".($data['img_url'] ?? null)."' />
        <meta name='twitter:image:alt' content='".($data['img_alt'] ?? null)."' />
    ";
}

//! ----------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------