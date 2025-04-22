<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller {
    private $reportModel;

    public function __construct() {
        $this->reportModel = $this->model('OrderModel');
    }

    public function getRevenueData() {
        $type = $_GET['type'] ?? '7days';
        $response = [];

        if ($type === 'custom') {
            $fromDate = $_GET['from'] ?? '';
            $toDate = $_GET['to'] ?? '';
            
            if (empty($fromDate) || empty($toDate)) {
                $response['error'] = 'Vui lòng chọn khoảng thời gian';
                echo json_encode($response);
                return;
            }

            $data = $this->reportModel->getRevenueByDateRange($fromDate, $toDate);
        } else {
            $data = $this->reportModel->getRevenueByType($type);
        }

        // Nếu data trống thì cũng không cần báo lỗi
        // Format dữ liệu cho biểu đồ
        $categories = [];
        $revenue = [];

        foreach ($data as $row) {
            if ($type === 'thisYear') {
                $categories[] = 'Tháng ' . date('m', strtotime($row['date']));
            } else {
                $categories[] = date('d/m/Y', strtotime($row['date']));
            }
            $revenue[] = (float)$row['revenue'];
        }

        $response['categories'] = $categories;
        $response['revenue'] = $revenue;
        ob_clean();
        echo json_encode($response);
    }

    public function exportExcel() {
        // Tắt output buffering
        ob_end_clean();
        
        // Set header cho Excel 2007 trở lên (.xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="bao-cao-doanh-thu-' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        
        $type = $_GET['type'] ?? '7days';
        
        // Lấy dữ liệu
        if ($type === 'custom') {
            $fromDate = $_GET['from'] ?? '';
            $toDate = $_GET['to'] ?? '';
            if (empty($fromDate) || empty($toDate)) {
                echo "Vui lòng chọn khoảng thời gian";
                return;
            }
            $data = $this->reportModel->getRevenueByDateRange($fromDate, $toDate);
        } else {
            $data = $this->reportModel->getRevenueByType($type);
        }

        // Tạo spreadsheet mới
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set tiêu đề
        $sheet->setCellValue('A1', 'BÁO CÁO DOANH THU');
        $sheet->setCellValue('A2', 'Thời gian: ' . ($type === 'custom' ? "$fromDate đến $toDate" : $type));
        
        // Set header cho bảng
        $sheet->setCellValue('A4', 'Ngày');
        $sheet->setCellValue('B4', 'Doanh thu (VNĐ)');

        // Đổ dữ liệu
        $row = 5;
        $totalRevenue = 0;
        $highestRevenue = 0;
        $firstRevenue = null;
        $lastRevenue = null;

        $count = count($data);
        foreach ($data as $item) {
            $date = $type === 'thisYear' 
                    ? 'Tháng ' . date('m', strtotime($item['date']))
                    : date('d/m/Y', strtotime($item['date']));
                    
            $revenue = (float)$item['revenue'];
            
            // Lưu giá trị đầu và cuối
            if ($firstRevenue === null) {
                $firstRevenue = $revenue;
            }
            $lastRevenue = $revenue;
            
            $sheet->setCellValue('A' . $row, $date);
            $sheet->setCellValue('B' . $row, $revenue);
            $totalRevenue += $revenue;
            if($revenue > $highestRevenue) {
                $highestRevenue = $revenue;
            }
            $row++;
        }

        $averageRevenue = $totalRevenue / ($count ?? 1);

        // Tính tăng trưởng
        $growth = $firstRevenue > 0 
            ? (($lastRevenue - $firstRevenue) / $firstRevenue * 100) 
            : 0;

        // Thêm tổng
        $row++;  
        $sheet->setCellValue('A' . $row, 'Tổng doanh thu');
        $sheet->setCellValue('B' . $row, $totalRevenue);

        // Thêm trung bình doanh thu
        $row++; 
        $sheet->setCellValue('A' . $row, 'Doanh thu trung bình');
        $sheet->setCellValue('B' . $row, $averageRevenue);

        // Thêm doanh thu cao nhất
        $row++;  
        $sheet->setCellValue('A' . $row, 'Doanh thu cao nhất');
        $sheet->setCellValue('B' . $row, $highestRevenue);

        // Thêm tăng trưởng
        $row++;
        $sheet->setCellValue('A' . $row, 'Tăng trưởng (%)');
        $sheet->setCellValue('B' . $row, round($growth, 2));

        // Style cho phần tổng hợp
        $summaryRange = 'A' . ($row-3) . ':A' . $row;
        $sheet->getStyle($summaryRange)->getFont()->setBold(true);

        // Thêm màu cho tăng trưởng
        $growthCell = 'B' . $row;
        if ($growth > 0) {
            $sheet->getStyle($growthCell)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('008000')); // Màu xanh
        } else if ($growth < 0) {
            $sheet->getStyle($growthCell)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF0000')); // Màu đỏ
        }

        // Style
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A4:B4')->getFont()->setBold(true);
        $sheet->getStyle('B5:B' . ($row - 1))->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('B' . $row)->getNumberFormat()->setFormatCode('0.00');

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(20);

        // Save file
        $writer = new Xlsx($spreadsheet);
        
        // Ghi trực tiếp vào output
        $writer->save('php://output');
        exit;
    }
}
?>