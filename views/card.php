<?php
/**
 * @var \app\models\Products $product
 */

?>
<h2><?=$product->name?></h2>
<img width="200" src="/img/<?=$product->image?>"><br>
<p><?=$product->description?></p>
<p>Цена: <?=$product->price?></p>
