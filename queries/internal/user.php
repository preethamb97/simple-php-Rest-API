<?php
class user {
  public function getUsersDetail()
  {
    $sql = "SELECT *
            FROM user";

    $result = database::getAll($sql, array());
    return $result;
  }
  
  public function getOneUserDetail($userId, $options=array())
  {
    $sql = "SELECT *
            FROM user
            WHERE user_id=:userId";
    
    $result = database::getOne($sql, array('userId'=>$userId));
    return $result;
  }

  public function insertUser($options)
  {
    $sql = "INSERT INTO user ";
    $sql .= "( ".implode(", ", array_keys($options))." ) VALUES ";
    $sql .= "( :".implode(", :", array_keys($options))." )";

    $result = database::insertOne($sql, $options);
    return $result;
  }

  public function updateUser($userId, $options)
  {
    $sql = "UPDATE user SET ";
    foreach ($options as $key => $value) {
      $sql .= $key."=".$value.", ";
    }
    $sql = rtrim($sql, ', ');
    $sql = "WHERE user_id=:userId";
    $options['user_id'] = $userId;
    $result = database::updateOne($sql, $options);
  }

  public function deleteUser($userId)
  {
    $sql = "DELETE FROM user
            WHERE user_id = :userId"; 
    
	  $result = database::deleteOne($sql, array('userId'=>$userId));
    return $result;
  }

  public function getLoginUserDetail($userId, $password, $options=array())
  {
    $sql = "SELECT *
            FROM user
            WHERE user_id=:userId AND password=:password";
    
    $result = database::getOne($sql, array('userId'=>$userId, 'password'=>$password));
    return $result;
  }

  public function checkIfUserNameExists($username, $options=array())
  {
    $sql = "SELECT *
            FROM user
            WHERE user_name=:username";
    
    $result = database::getOne($sql, array('username'=>$username));
    return $result;
  }
}

?>