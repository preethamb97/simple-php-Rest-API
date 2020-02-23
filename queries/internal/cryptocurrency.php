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

  public function getCryptocurrencyDetailByName($cryptocurrencyName)
  {
    $sql = "SELECT *
            FROM cryptocurrency_live
            WHERE cryptocurrency
            LIKE '" . $cryptocurrencyName . "'
             ORDER BY cryptocurrency_live_id DESC LIMIT 1";
             
    $result = database::getOne($sql, array());
    return $result;
  }
}
?>