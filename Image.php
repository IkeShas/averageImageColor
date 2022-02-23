<?php
class Image{
    private $imagePath;
    private $imageInfo;
    private $transparency = '';

    /**
     * The constructor function for the class
     * 
     * @param path The path to the image file.
     * @param transparency This is the transparency color. If you don't want transparency, set this to
     * null.
     */
    public function __construct($path, $transparency){
        $this->imagePath = $path;
        $this->imageInfo = getimagesize($this->imagePath);
        if($transparency != null)
            $this->transparency = $transparency;
    }

    /**
     * Returns an array containing the width, height, and image type of the image
     * 
     * @return An array with the width, height, and type of the image.
     */
    public function getImageInfo(){
        return array(
            'width' => $this->imageInfo[0],
            'height' => $this->imageInfo[1],
            'type' => $this->imageInfo[2]
        );
    }

    /**
     * This function will return the average color of an image
     * 
     * @return The hex value of the average color of the image.
     */

    public function getImageColor(){
        switch ($this->imageInfo[2]) { 
            case 1: 
                $img = imageCreateFromGif($this->imagePath);
                break;					
            case 2: 
                $img = imageCreateFromJpeg($this->imagePath); 
                break;	
            case 3: 
                $img = imageCreateFromPng($this->imagePath); 
                break;
        }

        $width = ImageSX($img);
        $height = ImageSY($img);

        $red = $green = $blue = 0;
        for ($x = 0; $x < $width; $x++) {
            for ($y=0; $y<$height; $y++) {
                $c = ImageColorAt($img, $x, $y);
                $red += ($c>>16) & 0xFF;
                $green += ($c>>8) & 0xFF;
                $blue += $c & 0xFF;
            }
        }

        $rgb = array(
            round($red / $width / $height),
            round($green / $width / $height),
            round($blue / $width / $height)
        );
         
        $color = '#';
        foreach ($rgb as $row) {
            $color .= str_pad(dechex($row), 2, '0', STR_PAD_LEFT);
        }
         
        imageDestroy($img);
        return (string)$color.$this->transparency;
    }

    /**
     * This function takes in a hex value and returns the opposite color
     * 
     * @return The hex value of the color of the image.
     */

    public function getContrastTextColor(){
        $hex = trim((string)$this->getImageColor(), ' #');
    
        $size = strlen($hex);	
        if ($size == 3) {
            $parts = str_split($hex, 1);
            $hex = '';
            foreach ($parts as $row) {
                $hex .= $row . $row;
            }		
        }
    
        $dec = hexdec($hex);
        $rgb = array(
            0xFF & ($dec >> 0x10),
            0xFF & ($dec >> 0x8),
            0xFF & $dec
        );
        
        $contrast = (round($rgb[0] * 299) + round($rgb[1] * 587) + round($rgb[2] * 114)) / 1000;
        return ($contrast >= 125) ? '#000' : '#fff';
    }

}