<?php

  $sql="SELECT precio FROM productos WHERE id_producto = '$idProd'";
  $row=$dbo->prepare($sql);
  $row->execute();
  $result=$row->fetchAll(PDO::FETCH_ASSOC);

  $main = array('data'=>$result);
  echo json_encode($main);

 ?>
