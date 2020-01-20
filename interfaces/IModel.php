<?php
namespace app\interfaces;
echo "Included file IModel.php";
//Не подключается интерфейс. Файл видим, интерфейс не находится.
interface IModel {
  public function getOne($id);
  public function getAll();
  public function getError();
}