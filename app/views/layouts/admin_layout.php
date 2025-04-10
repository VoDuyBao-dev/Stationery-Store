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
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/menu.css" />
  <!-- footer css -->
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
  <!-- main css -->
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/app.min.css" />
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/styles.css" />
  <link type="text/css" rel="stylesheet" href=".<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/components.css" />
  <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/custom.css" />
  <!-- main js -->
  <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/app.min.js"></script>
  <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/apexcharts.min.js"></script>
  <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/index.js"></script>
  <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/scripts.js"></script>
  <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/admin/custom.js"></script>
  <!-- header js -->
  <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
  <style>
    main {
      margin-left: 280px;
    }
  </style>
</head>

<body>
  <header>
    <?php require_once _DIR_ROOT . "/app/views/blocks/header-admin.php"; ?>
  </header>

  <menu>
    <?php require_once _DIR_ROOT . "/app/views/blocks/menu-admin.php"; ?>
  </menu>
  <main>
    <div id="app">
      <div class="main-wrapper main-wrapper-1">
        <div class="main-content">
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
                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/1.png" alt="">
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
                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/2.png" alt="">
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
                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/3.png" alt="">
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
                            <h5 class="font-15">SP sắp hết hàng</h5>
                            <h2 class="mb-3 font-18">10</h2>
                            <p class="mb-0">Giảm <span class="col-orange">12%</span></p>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/4.png" alt="">
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
                    <div class="row">
                      <div class="col-lg-9">
                        <div id="chart1"></div>
                        <div class="row mb-0">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="list-inline text-center">
                              <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                  class="col-green"></i>
                                <h5 class="m-b-0">1,032,000 VNĐ</h5>
                                <p class="text-muted font-14 m-b-0">Thu nhập hằng tuần</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="list-inline text-center">
                              <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
                                  class="col-orange"></i>
                                <h5 class="m-b-0">3,587,000 VNĐ</h5>
                                <p class="text-muted font-14 m-b-0">Thu nhập hằng tháng</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="list-inline text-center">
                              <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                  class="col-green"></i>
                                <h5 class="mb-0 m-b-0">45,965,000 VNĐ</h5>
                                <p class="text-muted font-14 m-b-0">Thu nhập hằng năm</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="row mt-5">
                          <div class="col-7 col-xl-7 mb-3">Tổng khách hàng</div>
                          <div class="col-5 col-xl-5 mb-3">
                            <span class="text-big">1,206</span>
                            <sup class="col-green">+25%</sup>
                          </div>
                          <div class="col-7 col-xl-7 mb-3">Tổng thu nhập</div>
                          <div class="col-5 col-xl-5 mb-3">
                            <span class="text-big">45,965</span>
                            <sup class="col-green">+08%</sup>
                          </div>

                          <div class="col-7 col-xl-7 mb-3">Đơn hàng</div>
                          <div class="col-5 col-xl-5 mb-3">
                            <span class="text-big">1,000</span>
                            <sup class="text-danger">-09%</sup>
                          </div>
                          <div class="col-7 col-xl-7 mb-3">Khách hàng mới</div>
                          <div class="col-5 col-xl-5 mb-3">
                            <span class="text-big">184</span>
                            <sup class="col-green">+12%</sup>
                          </div>
                        </div>
                      </div>
                    </div>
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
        </div>
      </div>

      <?php require_once _DIR_ROOT . "/app/views/blocks/footer.php"; ?>
  </main>




</body>

</html>