<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 15/06/2018
 * Time: 13:48
 */

namespace Code\Demo5;


class DBLogger implements ILogger {
	private $db;

	public function __construct(\PDO $db){
		$this->db = $db;
	}

	public function log($request, $priority) {
		$sql = "INSERT INTO transaction_log(priority, timestamp, data) VALUES (:priority, :timestamp, :data)";

		$statement = $this->db->prepare($sql);

		$statement->bindParam(':priority', $priority);
		$statement->bindParam(':timestamp', time());
		$statement->bindParam(':data', $request);

		return $statement->execute();
	}
}