<?php
/**
 * @var \app\models\Products $product
 */
?>
<h2><?=$product->name?></h2>
<p><?=$product->description?></p>
<p>Цена: <?=$product->price?></p>

<a href="?с=basket&a=basket&id=<?=$catalog[$key]['id']?>">В корзину</a>