<h2>Каталог</h2>
<?php foreach ($catalog as $key => $value) :?>
    <a href="?&a=card&id=<?=$catalog[$key]['id']?>">
        <b><?=$catalog[$key]['name']?></b><br>
        <?=$catalog[$key]['description']?><br> Цена:
        <?=$catalog[$key]['price']?><br>
    </a>
    <br>

<?php endforeach;?>
