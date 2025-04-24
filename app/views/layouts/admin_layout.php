<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery - Admin</title>
    <!--header css  -->
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <!-- menu css -->
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/blocks/menu.css"/>
    <!-- footer css -->
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <!-- main css -->
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/admin/app.min.css"/>
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/admin/styles.css"/>
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/admin/custom.css"/>
 <!-- main js -->
  <script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/app.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 
  <script type="text/javascript"  src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/scripts.js"></script>
  <script type="text/javascript"  src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/custom.js"></script>
  <!-- header js -->
  <script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/blocks/header.js"></script>
    <style>
      menu{
            top: -100px;
            margin-left: 0px;
        }
        main{
            margin-left: 280px;
            margin-top: 130px;
        }
    </style>
</head>

<body>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header-admin.php";?>
    <menu>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/menu-admin.php";?>
</menu>
<main>
        <section class="section">
          <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Đơn hàng</h5>
                          <h2 class="mb-3 font-18">1.000</h2>
                          <p class="mb-0">Giảm <span class="col-orange">10%</span> </p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15"> Khách hàng</h5>
                          <h2 class="mb-3 font-18">1,206</h2>
                          <p class="mb-0">Tăng <span class="col-green">25%</span></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Sản phẩm</h5>
                          <h2 class="mb-3 font-18">654</h2>
                          <p class="mb-0"> Tăng <span class="col-green">18%</span></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Sắp hết hàng</h5>
                          <h2 class="mb-3 font-18">10</h2>
                          <p class="mb-0">Giảm <span class="col-orange">12%</span></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
              <div class="card ">
                <div class="card-header">
                  <h4>Biểu đồ doanh thu</h4>
                </div>
                <div class="card-body">
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
                <!--  -->
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
                  <!--  -->
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
          <div class="col-md-6 col-lg-12 col-xl-6">
              <div class="card">
                <div class="card-header">
                  <h4>Khách hàng mới</h4>
                  <form class="card-header-form">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">
                  </form>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th>STT</th>
                          <th>Họ và tên</th>
                          <th>SĐT</th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Nguyễn Văn A </td>
                          <td>0912346382</td>
                          <td>nguyenvanA@gmail.com</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Vương Thị Bé </td>
                          <td>0893463821</td>
                          <td>vuongtBe@gmail.com</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Lý Văn Tèo </td>
                          <td>0324382946</td>
                          <td>teovanly@gmail.com</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Doãn Tùng </td>
                          <td>0911495960</td>
                          <td>doantung@gmail.com</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Trần Thiên Lộc </td>
                          <td>0366231077</td>
                          <td>locbaton@gmail.com</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-12 col-xl-6">
              <div class="card">
                <div class="card-header">
                  <h4>Đơn hàng mới</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th>STT</th>
                          <th>Mã đơn hàng</th>
                          <th>Ngày đặt đơn</th>
                          <th>Thanh toán bằng</th>
                          <th>Giá tiền</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>ACB123</td>
                          <td>11-03-2025</td>
                          <td>MoMo</td>
                          <td>50.000 VNĐ</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>LMN126 </td>
                          <td>11-03-2025</td>
                          <td>MoMo</td>
                          <td>250.000 VNĐ</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>QRS169 </td>
                          <td>11-03-2025</td>
                          <td>ACB</td>
                          <td>150.000 VNĐ</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>WXY224 </td>
                          <td>10-03-2025</td>
                          <td>Tiền mặt</td>
                          <td>550.000 VNĐ</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>ZBC109 </td>
                          <td>8-03-2025</td>
                          <td>ACB</td>
                          <td>300.000 VNĐ</td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>EFJ112 </td>
                          <td>03-03-2025</td>
                          <td>Tiền mặt</td>
                          <td>850.000 VNĐ</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
  <script>
    var _WEB_ROOT = "<?php echo _WEB_ROOT; ?>";
  </script>
  <script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/chart-admin.js"></script>


</body>
</html>