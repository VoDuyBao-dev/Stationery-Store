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
        $result = $this->fetch("SELECT * FROM $this->table WHERE transport_id = ?", [$id]);
        return $result ? $result : null;
    }


    public function addTransport($data)
    {
        // Kiểm tra xem tên phương thức vận chuyển đã tồn tại chưa
        $exists = $this->fetch("SELECT * FROM $this->table WHERE name = ?", [$data['name']]);

        if ($exists) {
            return false; // Tên đã tồn tại, không thêm nữa
        }

        $sql = "INSERT INTO $this->table (name, price) VALUES (?, ?)";
        return $this->execute($sql, array_values($data));
    }


    public function updateTransport($id, $data)
    {
        // Kiểm tra ID có tồn tại không
        $exists = $this->fetch("SELECT * FROM $this->table WHERE transport_id = ?", [$id]);
        if (!$exists) {
            return false; // Không có ID này, không thể cập nhật
        }

        // Kiểm tra xem tên mới có bị trùng không
        $duplicate = $this->fetch("SELECT * FROM $this->table WHERE name = ? AND transport_id != ?", [$data['name'], $id]);
        if ($duplicate) {
            return false; // Tên đã tồn tại, không cập nhật
        }

        $sql = "UPDATE $this->table SET name=?, price=? WHERE transport_id=?";
        return $this->execute($sql, array_merge(array_values($data), [$id]));
    }

    public function deleteTransport($id)
    {
        // Kiểm tra ID có tồn tại không
        $exists = $this->fetch("SELECT * FROM $this->table WHERE transport_id = ?", [$id]);
        if (!$exists) {
            return false; // ID không tồn tại, không thể xóa
        }

        return $this->execute("DELETE FROM $this->table WHERE transport_id = ?", [$id]);
    }
}
