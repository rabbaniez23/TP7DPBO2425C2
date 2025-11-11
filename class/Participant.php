<?php
// class/Participant.php
class Participant {
    private $conn;
    private $table_name = "participants";

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create($name, $phone) {
        $query = "INSERT INTO " . $this->table_name . " (name, phone) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$name, $phone]);
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
    public function update($id, $name, $phone) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, phone = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$name, $phone, $id]);
    }

    // DELETE
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>