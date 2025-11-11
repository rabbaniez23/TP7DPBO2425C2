<?php
// class/Course.php
class Course {
    private $conn;
    private $table_name = "courses";

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create($topic, $instructor, $schedule) {
        $query = "INSERT INTO " . $this->table_name . " (topic, instructor, schedule) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$topic, $instructor, $schedule]);
    }

    // READ (All)
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // READ (One)
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // UPDATE
    public function update($id, $topic, $instructor, $schedule) {
        $query = "UPDATE " . $this->table_name . " SET topic = ?, instructor = ?, schedule = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$topic, $instructor, $schedule, $id]);
    }

    // DELETE
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>