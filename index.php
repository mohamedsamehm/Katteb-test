<?php

$marketplaceAllData = array(
  array(
    "date" => "15-02-2024",
    "name" => "Kakasi Hatake",
    "sales" => "1",
    "refunds" => 0,
    "revenue" => "59",
    "earnings" => "20",
  ),
  array(
    "date" => "16-02-2024",
    "name" => "Naruto Uzumaki",
    "sales" => "0",
    "refunds" => 1,
    "revenue" => "-49",
    "earnings" => "-49",
  ),
  array(
    "date" => "17-02-2024",
    "name" => "	Jerome Bell",
    "sales" => "1",
    "refunds" => 0,
    "revenue" => "59",
    "earnings" => "20",
  )
);

$marketplaceFebData = array(
  array(
    "date" => "15-02-2024",
    "name" => "Kakasi Hatake",
    "sales" => "1",
    "refunds" => 0,
    "revenue" => "59",
    "earnings" => "20",
  ),
  array(
    "date" => "16-02-2024",
    "name" => "Naruto Uzumaki",
    "sales" => "0",
    "refunds" => 1,
    "revenue" => "-49",
    "earnings" => "-49",
  ),
  array(
    "date" => "17-02-2024",
    "name" => "	Jerome Bell",
    "sales" => "1",
    "refunds" => 0,
    "revenue" => "59",
    "earnings" => "20",
  )
);
$totalRevenue = 0;
$totalPayableCodes = 0;
$totalRefundableCodes = 0;
$FebRevenue = 0;
$FebPayableCodes = 0;
$FebRefundableCodes = 0;
$salesTable = array();
$salesDateFrom = date("M-d-Y", strtotime($marketplaceAllData[0]['date']));
$salesDateEnd = date("M-d-Y", strtotime($marketplaceAllData[count($marketplaceAllData) - 1]['date']));
$marketplacLast90Days = array_slice($marketplaceAllData, count($marketplaceAllData) > 90 ? count($marketplaceAllData) - 90 : 0);
$marketplacLast15Days = array_slice($marketplaceFebData, count($marketplaceFebData) > 15 ? count($marketplaceFebData) - 15 : 0);

foreach ($marketplaceAllData as $key => $value) {
  $totalRevenue += $value['revenue'];
  $totalPayableCodes += $value['sales'];
  $totalRefundableCodes += $value['refunds'];
}

foreach ($marketplaceFebData as $key => $value) {
  $FebRevenue += $value['revenue'];
  $FebPayableCodes += $value['sales'];
  $FebRefundableCodes += $value['refunds'];
}
$salesTable = $marketplaceAllData;

function array2csv(array &$array)
{
  if (count($array) == 0) {
    return null;
  }
  ob_start();
  $df = fopen("php://output", 'w');
  fputcsv($df, array_keys(reset($array)));
  foreach ($array as $row) {
    fputcsv($df, $row);
  }
  fclose($df);
  return ob_get_clean();
}
function download_send_headers($filename)
{
  // disable caching
  $now = gmdate("D, d M Y H:i:s");
  header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
  header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
  header("Last-Modified: {$now} GMT");

  // force download  
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");

  // disposition / encoding on response body
  header("Content-Disposition: attachment;filename={$filename}");
  header("Content-Transfer-Encoding: binary");
}
if (isset($_GET['exportToCSV'])) {
  download_send_headers("data_export_" . date("Y-m-d") . ".csv");
  echo array2csv($marketplaceAllData);
  die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/css/datepicker.min.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <title>Document</title>
</head>

<body>
  <div class="scalify-analytics-page">
    <nav class="navbar">
      <button class="btn-toggle-sidebar" id="btn-toggle-sidebar"><i class="fa-solid fa-bars"></i></button>
      <a href="/" class="navbar-brand"><img src="assets/images/logo.svg"></a>
      <div class="navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Deals</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Courses</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Community</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Submit Your Product</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Events</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">PG VIP <span>NEW</span></a>
          </li>
        </ul>
        <div class="navbar-btn-icons">
          <button class="nav-item nav-item-icon"><i class="fa-regular fa-heart"></i></button>
          <button class="nav-item nav-item-icon"><i class="fa-regular fa-bell"></i></button>
          <button class="nav-item nav-item-icon"><i class="fa-regular fa-user"></i></button>
          <button class="nav-item nav-item-icon"><i class="fa-solid fa-cart-shopping"></i></button>
        </div>
      </div>
    </nav>
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-container">
        <div class="sidebar-info">
          <div class="profile-info">
            <div class="profile-info-photo">
              <img src="assets/images/user.png" alt="user">
            </div>
            <div class="profile-info-text">
              <h4 class="profile-info-name">Wade Warren</h4>
              <h5 class="profile-info-job-title">UI/UX Designer</h5>
            </div>
          </div>
          <div class="saving-progress">
            <h5 class="saving-progress-title"><span class="saving-progress-title-icon"><i
                  class="fa-regular fa-money-bill-1"></i></span> Saved <span
                class="saving-progress-title-price">$1266</span> per
              year</h5>
            <div class="progress">
              <div class="progress-bar" style="max-width: 75%;"></div>
            </div>
            <div class="progress-caption-wrapper">
              <span class="progress-caption progress-caption-savings">Savings</span>
              <span class="progress-caption progress-caption-spending">Spending</span>
            </div>
          </div>
          <a href="#" class="btn-share-my-savings">
            <span class="icon"><i class="fa-solid fa-share-nodes"></i></span> Share My Savings
          </a>
        </div>
        <ul class="sidebar-nav-items">
          <li class="sidebar-nav-item">
            <a href="#" class="sidebar-nav-link">
              <span class="sidebar-nav-link-icon"><i class="fa-solid fa-briefcase"></i></span>
              <span class="sidebar-nav-link-title">Purchases</span>
              <span class="sidebar-nav-link-caption">2</span>
            </a>
          </li>
          <li class="sidebar-nav-item">
            <a href="#" class="sidebar-nav-link">
              <span class="sidebar-nav-link-icon"><i class="fa-regular fa-file-lines"></i></span>
              <span class="sidebar-nav-link-title">Invoices</span>
              <span class="sidebar-nav-link-caption">2</span>
            </a>
          </li>
          <li class="sidebar-nav-item">
            <a href="#" class="sidebar-nav-link">
              <span class="sidebar-nav-link-icon"><i class="fa-regular fa-file-lines"></i></span>
              <span class="sidebar-nav-link-title">Wallet</span>
              <span class="sidebar-nav-link-caption">$408</span>
            </a>
          </li>
          <li class="sidebar-nav-item">
            <a href="#" class="sidebar-nav-link">
              <span class="sidebar-nav-link-icon"><i class="fa-solid fa-bowling-ball"></i></span>
              <span class="sidebar-nav-link-title">Affiliate</span>
            </a>
          </li>
          <li class="sidebar-nav-item dropdown" aria-expanded="false" aria-controls="sidebar-nav-dropdown-track-mysubs">
            <div href="#" class="sidebar-nav-link">
              <span class="sidebar-nav-link-icon"><i class="fa-regular fa-square"></i></span>
              <span class="sidebar-nav-link-title">Track My Subs</span>
            </div>
            <div class="sidebar-nav-dropdown-wrapper closed hide" id="sidebar-nav-dropdown-track-mysubs">
              <ul class="sidebar-nav-dropdown">
                <li class="sidebar-nav-dropdown-item">
                  <a href="#" class="sidebar-nav-dropdown-link">
                    <span class="sidebar-nav-dropdown-link-icon"><i class="fa-solid fa-chart-line"></i></span>
                    <span class="sidebar-nav-dropdown-link-title">Analytics</span>
                    <span class="sidebar-nav-dropdown-link-caption">Beta</span>
                  </a>
                </li>
                <li class="sidebar-nav-dropdown-item">
                  <a href="#" class="sidebar-nav-dropdown-link">
                    <span class="sidebar-nav-dropdown-link-icon"><i class="fa-solid fa-boxes-packing"></i></span>
                    <span class="sidebar-nav-dropdown-link-title">Products</span>
                    <span class="sidebar-nav-dropdown-link-caption">Beta</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-nav-item dropdown" aria-expanded="false"
            aria-controls="sidebar-nav-dropdown-partners-portal">
            <div href="#" class="sidebar-nav-link">
              <span class="sidebar-nav-link-icon"><i class="fa-solid fa-box"></i></span>
              <span class="sidebar-nav-link-title">Partners Portal</span>
            </div>
            <div class="sidebar-nav-dropdown-wrapper closed hide" id="sidebar-nav-dropdown-partners-portal">
              <ul class="sidebar-nav-dropdown">
                <li class="sidebar-nav-dropdown-item">
                  <a href="#" class="sidebar-nav-dropdown-link active">
                    <span class="sidebar-nav-dropdown-link-icon"><i class="fa-solid fa-chart-line"></i></span>
                    <span class="sidebar-nav-dropdown-link-title">Analytics</span>
                    <span class="sidebar-nav-dropdown-link-caption">Beta</span>
                  </a>
                </li>
                <li class="sidebar-nav-dropdown-item">
                  <a href="#" class="sidebar-nav-dropdown-link">
                    <span class="sidebar-nav-dropdown-link-icon"><i class="fa-solid fa-boxes-packing"></i></span>
                    <span class="sidebar-nav-dropdown-link-title">Products</span>
                    <span class="sidebar-nav-dropdown-link-caption">Beta</span>
                  </a>
                </li>
                <li class="sidebar-nav-dropdown-item">
                  <a href="#" class="sidebar-nav-dropdown-link">
                    <span class="sidebar-nav-dropdown-link-icon"><i class="fa-solid fa-file-invoice"></i></span>
                    <span class="sidebar-nav-dropdown-link-title">Billing</span>
                  </a>
                </li>
                <li class="sidebar-nav-dropdown-item">
                  <a href="#" class="sidebar-nav-dropdown-link">
                    <span class="sidebar-nav-dropdown-link-icon"><i class="fa-regular fa-message"></i></span>
                    <span class="sidebar-nav-dropdown-link-title">Q&A</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-nav-item sidebar-nav-item-logout">
            <a href="#" class="sidebar-nav-link">
              <span class="sidebar-nav-link-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
              <span class="sidebar-nav-link-title">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <main>
      <div class="main-header">
        <h1>Scalify Analytics</h1>
        <div class="btns-wrapper">
          <button><span class="icon"><i class="fa-regular fa-bell"></i></span>
            Email Me Daily Summary</button>
          <button><span class="icon"><i class="fa-solid fa-user-group"></i></span> Share</button>
        </div>
      </div>
      <button class="btn btn-change-product">
        <span class="icon">
          <i class="fa-solid fa-repeat"></i></span>
        Change Product</button>
      <em>* Analytics is in beta stage and there may be some incorrect
        stats. Please contact support if you notice something wrong.</em>
      <div class="overviews">
        <div class="campaign-overview">
          <h2 class="overview-title">Campaign Overview</h2>
          <div class="overview-blocks">
            <div class="overview-block overview-block-total-revenue">
              <h3 class="overview-block-title">Total Revenue</h3>
              <span class="overview-block-subtitle">All Time</span>
              <div class="overview-block-price">
                <?php echo '$' . $totalRevenue; ?>
              </div>
              <h5 class="overview-earning-title">Your Earnings</h5>
              <p class="overview-earning-desc">(90% Rev Share) : $20,000</p>
            </div>
            <div class="overview-block overview-block-monthly-revenue">
              <h3 class="overview-block-title">Monthly Revenue</h3>
              <span class="overview-block-subtitle">Last 3 Months</span>
              <div class="monthly-revenue-chart" id="monthly-revenue-chart"></div>
            </div>
            <div class="overview-block overview-block-total-payable">
              <h3 class="overview-block-title">Total Payable Codes</h3>
              <span class="overview-block-subtitle">All Time</span>
              <div class="overview-block-price">
                <?php echo $totalPayableCodes; ?>
              </div>
            </div>
            <div class="overview-block overview-block-total-refundable">
              <h3 class="overview-block-title">Total Refundable Codes</h3>
              <span class="overview-block-subtitle">All Time</span>
              <div class="overview-block-price">
                <?php echo $totalRefundableCodes; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="monthly-overview">
          <h2 class="overview-title">Monthly Overview</h2>
          <div class="overview-blocks">
            <div class="overview-block overview-block-total-revenue">
              <h3 class="overview-block-title">Total Revenue</h3>
              <span class="overview-block-subtitle">on Febrarury</span>
              <div class="overview-block-price">
                <?php echo '$' . $FebRevenue; ?>
              </div>
              <h5 class="overview-earning-title">Your Earnings</h5>
              <p class="overview-earning-desc">(90% Rev Share) : $6,078</p>
            </div>
            <div class="overview-block overview-block-daily-sales">
              <h3 class="overview-block-title">Daily Sales</h3>
              <span class="overview-block-subtitle">Last
                <?php echo count($marketplacLast15Days); ?> days
              </span>
              <div class="daily-sales-chart" id="daily-sales-chart"></div>
            </div>
            <div class="overview-block overview-block-total-payable">
              <h3 class="overview-block-title">Total Payable Codes</h3>
              <span class="overview-block-subtitle">on Febrarury</span>
              <div class="overview-block-price">
                <?php echo $FebPayableCodes; ?>
              </div>
            </div>
            <div class="overview-block overview-block-total-refundable">
              <h3 class="overview-block-title">Total Refundable Codes</h3>
              <span class="overview-block-subtitle">on Febrarury</span>
              <div class="overview-block-price">
                <?php echo $FebRefundableCodes; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <em>* These numbers are estimates due to pending refunds. Payable
        amount is calculated without processing fees here.</em>
      <div class="table-sales">
        <div class="table-sales-header">
          <h2>Sales</h2>
          <div class="table-controls d-flex align-items-center">
            <div class="sales-datepicker" id="sales-datepicker">
              <div class="sales-datepicker-input">
                <span class="datepicker-icon"><i class=" fa-regular fa-calendar"></i></span>
                <input type="text" name="start" value="<?php echo $salesDateFrom; ?>">
              </div>
              <span>&nbsp;&mdash;&nbsp;</span>
              <div class="sales-datepicker-input">
                <span class="datepicker-icon"><i class=" fa-regular fa-calendar"></i></span>
                <input type="text" name="end" value="<?php echo $salesDateEnd; ?>">
              </div>
            </div>
            <a href="?exportToCSV" class="btn-export-csv"><i class="fa-solid fa-cloud-arrow-down"></i> Export
              CSV</a>
          </div>
        </div>
        <div class="table">
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Purchased By</th>
                <th>Sales</th>
                <th>Refunds</th>
                <th>Revenue</th>
                <th>Your Earnings</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < count($salesTable); $i++) { ?>
                <tr>
                  <td>
                    <?php echo date("M d, Y", strtotime($salesTable[$i]['date'])); ?>
                  </td>
                  <td>
                    <?php echo $salesTable[$i]['name']; ?>
                  </td>
                  <td>
                    <?php echo $salesTable[$i]['sales']; ?>
                  </td>
                  <td>
                    <?php echo $salesTable[$i]['refunds']; ?>
                  </td>
                  <td>
                    <?php echo $salesTable[$i]['revenue']; ?>
                  </td>
                  <td>
                    <?php echo $salesTable[$i]['earnings']; ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
  <script>
    let marketplacLast90Days = <?php echo json_encode($marketplacLast90Days); ?>;
    let marketplacLast15Days = <?php echo json_encode($marketplacLast15Days); ?>;
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.2/echarts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/datepicker-full.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>