<?
include 'Image.php';

$newImage = new Image('rocket.jpg', 'db');
?>
<style>
    .wrapper{
        width: 100%;
    }
    .image{
        height: min-content;
        z-index: 0;
        position: relative;
        border: solid #000 1px;
        border-radius: .50rem .50rem 0 0;
    }
    img{
        width: 100%;
        border-radius: .50rem .50rem 0 0;
    }
    .description{
        position: absolute;
        left: 0;
        bottom: 0;
        height: 100px;
        z-index: 1;
        border-radius: .50rem .50rem 0 0;
        background-color:<?=$newImage->getImageColor()?>;
        color:<?=$newImage->getContrastTextColor()?>;
        padding: 10px;
        font-size: 20px;
        overflow: auto;
    }
</style>
<div class="wrapper">
    <div class="image">
        <img src="rocket.jpg" alt="Soyuz Rocket">
        <div class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi deserunt autem et, molestiae laudantium eum neque esse! Minus, odio cupiditate? Ratione excepturi magni aperiam natus nostrum iure esse voluptatum dolorum.</div>
    </div>
</div>