<?php
class Database {
	private static $conn;
	//DB CONNECT
	public static function dbConnect($settings) {
		self::$conn = null;
		try {
			self::$conn = new PDO('mysql:host='.$settings['host'].';dbname='.$settings['database_name'],$settings['user_name'],$settings['password']);
			self::$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'Connection ERROR: ' . $e->getMessage();
		}
		// return $this->conn;
	}

	public static function close() {
		self::$conn = false;
		return false;
	}

	public static function getAll($sql, $options) {
		$resource = self::$conn->prepare($sql);
		foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value, PDO::PARAM_STR);
    }
		//Execute query
		$response = $resource->execute();
		
		if ($response) {
			$result = $resource->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		} else {
			return false;
		}
	}

	public static function getOne($sql, $options) {
		$resource = self::$conn->prepare($sql);
		foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value, PDO::PARAM_STR);
    }
		//Execute query
		$response = $resource->execute();
		
		if ($response) {
			$result = $resource->fetch(PDO::FETCH_ASSOC);
			return $result;
		} else {
			return false;
		}
	}

	// public static function insertAll() {

	// }

	public static function insertOne($sql, $options) {
		$resource = self::$conn->prepare($sql);
		foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value);
    }
		//Execute query
		$response = $resource->execute();
		
		if ($response) {
			$result = self::$conn->lastInsertId();
			return $result;
		} else {
			return false;
		}
	}

	// public static function updateAll() {
		
	// }

	public static function updateOne($sql, $options) {
		$resource = self::$conn->prepare($sql);
		foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value);
    }
		//Execute query
		$response = $resource->execute();
		
		if ($response) {
			$result = $resource->rowCount();
			return $result;
		} else {
			return false;
		}
	}

	// public static function deleteAll() {
		
	// }

	public static function deleteOne($sql, $options) {
		$resource = self::$conn->prepare($sql);
		foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value, PDO::PARAM_STR);
    }
		//Execute query
		$response = $resource->execute();
		
		if ($response) {
			$result = $resource->rowCount();
			return $result;
		} else {
			return false;
		}
	}

}
?>
