<?php
class cryptocurrency {
  public function getCryptocurrencyDetail()
  {
    $sql = "SELECT *
            FROM cryptocurrency_live";

    $result = database::getAll($sql, array());
    return $result;
  }
  
  public function insertCryptocurrency($options)
  {
    $sql = "INSERT INTO cryptocurrency_live ";
    $sql .= "( ".implode(", ", array_keys($options))." ) VALUES ";
    $sql .= "( :".implode(", :", array_keys($options))." )";

    $result = database::insertOne($sql, $options);
    return $result;
  }
}
?>