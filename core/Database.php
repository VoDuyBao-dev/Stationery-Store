<?php


class Database
{
    private $conn;

    public function __construct()
    {
        // global $config;
        $config = require __DIR__ . "/../configs/database.php";
        $this->conn = Connection::getInstance($config['database'])->getConnection();
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            Logger::logError("Lỗi khi chuẩn bị truy vấn!" . $this->conn->error);
            throw new \Exception("Lỗi khi chuẩn bị truy vấn");
        }
        $types = '';
        if (!empty($params)) {
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_string($param)) {
                    $types .= 's';
                } elseif (is_float($param)) {
                    $types .= 'd';
                }
            }
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;
    }

    //    Lấy 1 dòng dữ liệu
    public function fetch($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        $result = $stmt->get_result();

        $data = [];
        if ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $data[$key] = $value;
            }
        }
        $stmt->close();
        return $data;
    }

    //    Lấy nhiều dòng dữ liệu
    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $item = [];
            foreach ($row as $key => $value) {
                $item[$key] = $value;
            }
            $data[] = $item;
        }
        $stmt->close();
        return $data;
    }

    //    execute cho INSERT, UPDATE, DELETE
    public function execute($sql, $params = [])
    {

        try {
            $stmt = $this->query($sql, $params);
            $affectedRows = $stmt->affected_rows;
            $stmt->close();
            return $affectedRows;
        } catch (mysqli_sql_exception $e) {
            Logger::logError("Lỗi khi thực thi câu lệnh: " . $e->getMessage());
            throw $e;
        }
    }

    public function close()
    {
        Connection::getInstance([])->close();
        echo "🔌 Kết nối đã đóng từ Database!<br>";
    }
}
