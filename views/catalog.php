<h2>Каталог</h2>
<!--TODO Реализовать TWIG-->
<?php foreach ($catalog as $key => $value) :?>
    <a href="/product/card/?id=<?=$catalog[$key]['id']?>">
        <img src="<?=IMG_PATH_MIN . $catalog[$key]['img']?>" alt=""><br>
        <b><?=$catalog[$key]['name']?></b><br>
        <?=$catalog[$key]['description']?><br> Цена:
        <?=$catalog[$key]['price']?><br>
    </a>
    <br>
<?php endforeach;?>
