<?php
class TransportModel extends Model
{
    private $table = 'transport';

    // Lấy danh sách phương thức vận chuyển
    public function getAllTransports()
    {
        return $this->fetchAll("SELECT * FROM $this->table ORDER BY transport_id ASC");
    }

    // Lấy thông tin phương thức vận chuyển theo ID
    public function getTransportById($id)
    {
        return $this->fetch("SELECT * FROM $this->table WHERE transport_id = ?", [$id]);
    }

    // Thêm phương thức vận chuyển mới
    public function addTransport($data)
    {
        $sql = "INSERT INTO $this->table (name, price) VALUES (?, ?)";
        return $this->execute($sql, array_values($data));
    }

    // Cập nhật phương thức vận chuyển
    public function updateTransport($id, $data)
    {
        $sql = "UPDATE $this->table SET name=?, price=? WHERE transport_id=?";
        return $this->execute($sql, array_merge(array_values($data), [$id]));
    }

    // Xóa phương thức vận chuyển
    public function deleteTransport($id)
    {
        return $this->execute("DELETE FROM $this->table WHERE transport_id = ?", [$id]);
    }
}
