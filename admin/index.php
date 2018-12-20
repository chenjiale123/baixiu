


<?php
require_once '../function.php';

session_start();

if(empty($_SESSION["current_login_user"])){
  header("Location:/baixiu/admin/login.php");
}

$posts_count=  baixiu_fetch("select count(1) as num from posts;");
$categories_count=  baixiu_fetch("select count(1) as num from categories;");
$comments_count=  baixiu_fetch("select count(1) as num from comments;");
$posts_count_unactive= baixiu_fetch("select count(1) as num from posts where status = 'drafted' ;");
$comments_count_unactive= baixiu_fetch("select count(1) as num from comments where status = 'rejected' ;");

?>



<!DOCTYPE html>

<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/baixiu/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/baixiu/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/baixiu/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/baixiu/assets/css/admin.css">

  <script src="/baixiu/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
  <?php include "inc/navbar.php"; ?>
    <div class="container-fluid">
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.php" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><strong><?php echo $posts_count[0]['num']; ?></strong>篇文章（<strong><?php echo $posts_count_unactive[0]['num']; ?></strong>篇草稿）</li>
              <li class="list-group-item"><strong><?php echo $categories_count[0]['num']; ?></strong>个分类</li>
              <li class="list-group-item"><strong><?php echo $comments_count[0]['num']; ?></strong>条评论（<strong><?php echo $comments_count_unactive[0]['num']; ?></strong>条待审核）</li>
            </ul>
            <canvas id="myChart" width="200" height="200" ></canvas>
          </div>
          
        </div>
        
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>
       <?php $current_page="index";?>
     <?php include "inc/sidebar.php"; ?>

  <script src="/baixiu/assets/vendors/jquery/jquery.js"></script>
  <script src="/baixiu/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script src="/baixiu/assets/chart/Chart.bundle.min.js"></script>
  
  
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo$posts_count[0]['num']; ?> , <?php echo $categories_count[0]['num']; ?>, <?php echo $comments_count[0]['num']; ?>, <?php echo $comments_count[0]['num']; ?>, <?php echo $posts_count_unactive[0]['num']; ?>, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

  
  </script>
</body>
</html>
