<?php


namespace App\Helpers;


use App\Logger;

class ImageUploadHelper
{
    // Các biến static để cấu hình chung
    private static $dinhDangChoPhep = ['png', 'jpg', 'jpeg', 'webp'];
    private static $kichThuocToiDa = 2097152; // 2MB 

    /**
     * Kiểm tra và upload ảnh
     * @param array $file Thông tin file từ $_FILES
     * @param string $duongDanLuu Đường dẫn lưu file
     * @param string|null $tenFile Tên file tùy chọn
     * @return array Kết quả upload
     */
    public static function kiemTraVaUploadAnh($file, $duongDanLuu)
    {
        $errors = [];

        // Kiểm tra lỗi upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            Logger::logError("Lỗi upload file: " . $file['error']);
            return [
                'thanhCong' => false,
                'loiNhan' => "Lỗi khi upload file"
            ];
        }

        // Kiểm tra định dạng file
        $dinhDangFile = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($dinhDangFile, self::$dinhDangChoPhep)) {
            Logger::logError("Định dạng file không hợp lệ: " . $dinhDangFile);
            return [
                'thanhCong' => false,
                'loiNhan' => "File không đúng định dạng cho phép"
            ];
        }

        // Kiểm tra kích thước
        if ($file['size'] > self::$kichThuocToiDa) {
            Logger::logError("File quá lớn: " . $file['size']);
            return [
                'thanhCong' => false,
                'loiNhan' => "File vượt quá kích thước cho phép (2MB)"
            ];
        }

        // Xóa hết khoảng trắng
        $tenFile = str_replace(' ', '', $file['name']);

        // Chuẩn bị đường dẫn
        $duongDanLuu = str_replace('/', '\\', $duongDanLuu);
        $document_root = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']);
        $duongDanDayDu = $document_root . "\\Stationery-Store\\" . $duongDanLuu;

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($duongDanDayDu)) {
            if (!mkdir($duongDanDayDu, 0777, true)) {
                Logger::logError("Không thể tạo thư mục: " . $duongDanDayDu);
                return [
                    'thanhCong' => false,
                    'loiNhan' => "Không thể tạo thư mục upload"
                ];
            }
        }

        // Di chuyển file
        $duongDanDich = $duongDanDayDu . $tenFile;
        if (!move_uploaded_file($file['tmp_name'], $duongDanDich)) {
            Logger::logError("Không thể di chuyển file đến: " . $duongDanDich);
            return [
                'thanhCong' => false,
                'loiNhan' => "Không thể lưu file"
            ];
        }

        return [
            'thanhCong' => true,
            'tenFile' => $tenFile,
            'duongDan' => "all_image_upload/" . $tenFile
        ];
    }
}
