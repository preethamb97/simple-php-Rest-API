<?php
class links {
  public function getLinkDetail()
  {
    $sql = "SELECT *
            FROM links";

    $result = database::getAll($sql, array());
    return $result;
  }
  
  public function getOneLinkrDetail($linkId, $options=array())
  {
    $sql = "SELECT *
            FROM links
            WHERE link_id=:linkId";
    
    $result = database::getOne($sql, array('linkId'=>$linkId));
    return $result;
  }

  public function insertLink($options)
  {
    $sql = "INSERT INTO links ";
    $sql .= "( ".implode(", ", array_keys($options))." ) VALUES ";
    $sql .= "( :".implode(", :", array_keys($options))." )";

    $result = database::insertOne($sql, $options);
    return $result;
  }

  public function updateLink($linkId, $options)
  {
    $sql = "UPDATE links SET ";
    foreach ($options as $key => $value) {
      $sql .= $key."=".$value.", ";
    }
    $sql = rtrim($sql, ', ');
    $sql = "WHERE link_id=:linkId";
    $options['user_id'] = $linkId;
    $result = database::updateOne($sql, $options);
  }

  public function deleteLink($linkId)
  {
    $sql = "DELETE FROM links
            WHERE link_id = :linkId"; 
    
	  $result = database::deleteOne($sql, array('linkId'=>$linkId));
    return $result;
  }

  public function checkIfLinkImageOrUrlAlreadyExists($linkUrl, $linkImg)
  {
    $sql = "SELECT *
            FROM links
            WHERE link_img=:linkImg OR link_url=:linkUrl";
    
    $result = database::getOne($sql, array('linkUrl'=>$linkUrl, 'linkImg'=>$linkImg));
    return $result;
  }
}

?>