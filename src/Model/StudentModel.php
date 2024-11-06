<?php

namespace App\Model;

use App\Model\Database;

class StudentModel extends Database {
    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function getStudentsWithCenterNames() {
        $query = "
            SELECT c.id, c.name, centres.name as centre_name, centres.id as centre_id 
            FROM candidates c 
            INNER JOIN centres ON c.centre_id = centres.id
        ";
        try {
            $statement = $this->conn->query($query);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            return 'Error:' . $e->getMessage();
        }
    }

    public function getStudentsByCategory($categoryId) {
        $query = "SELECT * FROM candidates WHERE category_id = :category_id";
        try {
            $statement = $this->conn->prepare($query);
            $statement->execute([
                'category_id' => $categoryId,
            ]);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\Throwable $e) {
            return 'Error:' . $e->getMessage();
        }
    }
}
