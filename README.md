# averageImageColor
This is a simple PHP class for getting the average color of an image and getting a contrasting color

# How to use
```php
// Create new object of class
// First parametr is link to image
// Second parametr is transparency color. If you don't want transparency, set this to null
$newImage = new Image('rocket.jpg', 'db');

// Returns an array containing the width, height, and image type of the image
var_dump($newImage->getImageInfo());

// If you want get average color of your image you can use
var_dump($newImage->getImageColor());

// If you want get contrast text of average color you can use
var_dump($newImage->getContrastTextColor());
```
