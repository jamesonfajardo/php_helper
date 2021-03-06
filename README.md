# php_helper
helper framework for PHP

# TABLE OF CONTENTS:

**PDO NOTES** - perform CRUD operations using PDO  

**php_trim_chars** - trim string by character  

**open_graph** - easily integrate open graph to a webpage  

**twitter_card** - easily integrate twitter cards to a webpage

---

# Usage  

**php_trim_chars(string, int)**  
* string: the string to trim  
* int: only allow x characters according to this value  
```
php_trim_chars('this is a very long string that should be truncated', 10);
// returns 'this is a ...'
```
  
**open_graph([title, description, img_url, img_alt])**  
* title        - the title of the webpage and rich media (60 chars max)
* description  - the title of the webpage and rich media (80 chars min - 320 chars max)
* img_url      - url of the rich media image (absolute url, dimension: 1200x630 or 600x315 pixels)
* img_alt      - a text description of what is in the image (for users who are visually impaired, 320 chars max)
```
open_graph([
  "title"       => "COVID-19 Live Tracker",
  "description" => "We believe in the power of internet",
  "img_url"     => 'https://url-path/to-my/image.png',
  "img_alt"     => "We believe in the power of internet",
]);
```
  
**twitter_card([handle, title, description, img_url, img_alt])**  
* handle       - the twitter @username the card should be attributed to
* title        - the title of the webpage and twitter card (60 chars max)
* description  - the description of the webpage and twitter card (80 chars min - 320 chars max)
* img_url      - url of the twitter card image (absolute url, dimension: 800x420 pixels)
* img_alt      - a text description of the image (for users who are visually impaired, 320 chars max)
```
twitter_card([
    "handle"      => "@99porings",
    "title"       => "COVID-19 Live Tracker",
    "description" => "We believe in the power of the internet",
    "img_url"     => 'https://url-path/to-the/image.png',
    "img_alt"     => "We believe in the power of the internet",
]);
```
