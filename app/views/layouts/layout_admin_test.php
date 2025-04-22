<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery - Admin</title>
    <!--header css  -->
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

    <!-- menu css -->
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/blocks/menu.css"/>
    <!-- footer css -->
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <!-- main css -->
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/admin/app.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/admin/styles.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/admin/components.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/admin/custom.css"/>
</head>

<body>
    
    
    <main>
        <div class="card">
            <div class="card-header">
                <h4>Biểu đồ doanh thu</h4>
                <div class="card-header-form">
                    <!-- Filter options -->
                    <div class="filter-container d-flex align-items-center gap-3">
                        <!-- Chọn loại thống kê -->
                        <div class="form-group mb-0">
                            <select id="type-select" class="form-control">
                                <option value="today" selected>Hôm nay</option>
                                <option value="yesterday">Hôm qua</option>
                                <option value="7days" selected>tuần này</option>

                                <option value="thisMonth">Tháng này</option>
                                
                                <option value="thisQuarter">Quý này</option>
                               
                                <option value="thisYear">Năm này</option>
                               
                                <option value="custom">Tùy chỉnh</option>
                            </select>
                        </div>

                        <!-- Form tùy chỉnh thời gian -->
                        <div id="customDateRange" class="d-none">
                            <form id="filterForm" class="d-flex align-items-center gap-2">
                                <div class="form-group mb-0">
                                    <label class="mr-2">Từ:</label>
                                    <input type="date" id="fromDate" name="from_date" class="form-control" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="mr-2">Đến:</label>
                                    <input type="date" id="toDate" name="to_date" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Lọc</button>
                            </form>
                        </div>

                        <!-- Nút xuất báo cáo -->
                        <div class="export-buttons">
                            <button class="btn btn-light" onclick="exportExcel()">
                                <i class="fas fa-file-excel text-success"></i> Xuất báo cáo Excel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-9">
                        <div id="chart1"></div>
                    </div>
                </div>
                <!-- Giữ lại phần thống kê mới -->
                <div class="row mt-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Tổng doanh thu</h4>
                                </div>
                                <div class="card-body" id="totalRevenue">0 VNĐ</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Tăng trưởng</h4>
                                </div>
                                <div class="card-body" id="growth">0%</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Trung bình</h4>
                                </div>
                                <div class="card-body" id="avgRevenue">0 VNĐ</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Cao nhất</h4>
                                </div>
                                <div class="card-body" id="maxRevenue">0 VNĐ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
      var _WEB_ROOT = "<?php echo _WEB_ROOT; ?>";
    </script>
    <script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/chart-admin.js"></script>
   
    
    <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php" ?>
</body>
</html>
