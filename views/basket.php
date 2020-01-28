<h2>Корзина</h2>
<?php
foreach ($basket as $key => $value) :?>
    <a href="?&a=card&id=<?=$basket[$key]['id']?>">
        <b><?=$basket[$key]['name']?></b><br>
        <?=$basket[$key]['description']?><br> Цена:
        <?=$basket[$key]['price']?><br>
    </a>
<!--Не доделал-->
    <br>

<?php endforeach;?>
