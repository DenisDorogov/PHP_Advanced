<h2>Корзина</h2>
<?php //TODO Реализовать отображение корзины.
foreach ($basket as $key => $value) :?>
<b>id товара: <?=$basket[$key]['product_id']?></b><br>
<!--    <a href="?&a=card&id=--><?//=$basket[$key]['id']?><!--">-->
<!--        <b>--><?//=$basket[$key]['name']?><!--</b><br>-->
<!--        --><?//=$basket[$key]['description']?><!--<br> Цена:-->
<!--        --><?//=$basket[$key]['price']?><!--<br>-->
    </a>
<!--Не доделал-->
    <br>

<?php endforeach;?>
