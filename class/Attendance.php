<?php
// class/Attendance.php
class Attendance {
    private $conn;
    private $table_name = "attendances";

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create($id_course, $id_participant, $date, $status) {
        $query = "INSERT INTO " . $this->table_name . " (id_course, id_participant, date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id_course, $id_participant, $date, $status]);
    }

    // READ (All with joins)
    public function read() {
        $query = "SELECT 
                    a.id, 
                    c.topic AS course_topic, 
                    p.name AS participant_name, 
                    a.date, 
                    a.status 
                  FROM " . $this->table_name . " a
                  LEFT JOIN courses c ON a.id_course = c.id
                  LEFT JOIN participants p ON a.id_participant = p.id
                  ORDER BY a.date DESC, c.topic";
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
    public function update($id, $id_course, $id_participant, $date, $status) {
        $query = "UPDATE " . $this->table_name . " SET id_course = ?, id_participant = ?, date = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id_course, $id_participant, $date, $status, $id]);
    }

    // DELETE
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>