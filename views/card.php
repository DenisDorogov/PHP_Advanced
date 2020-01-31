<?php
/**
 * @var \app\models\Products $product
 */
?>
<img src="<?=IMG_PATH_MIN . $product->props['img'][0]?>" alt="<?=$product->props['name'][0]?>">
<h2><?=$product->props['name'][0]?></h2>
<p><?=$product->props['description'][0]?></p>
<p>Цена: <?=$product->props['price'][0]?></p>

<a href="?с=basket&a=basketAdd&id=<?=$product->id?>">В корзину</a>