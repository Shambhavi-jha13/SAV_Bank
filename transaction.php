<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction history</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity=
    "sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@600&display=swap" rel="stylesheet">

    <!-- icon link -->
    <script src="https://kit.fontawesome.com/3d611db8c6.js" crossorigin="anonymous"></script>

    <style>
        .allButFooter {
         min-height: calc(100vh - 40px);
       }

       body{
         background-color: #ffe5e2;
       }

       .navbar{
         
         font-weight: bold;
       }
   
       .navbar-brand{
         padding-left: 15px;
       }
   
       .nav-item{
         padding-right: 30px;
         font-size: 1.3rem;
       }

       .fas{
        padding-right: 30px;
        padding-left: 10px;
        font-size: 1.2rem;
        width: 2rem;
        text-decoration: none;
       }

       @media screen and (max-width: 400px){
        .navbar-brand{
          padding-left: 0px;
        }
        .nav-item{
          padding-right: 0px;
        }
        .navbar{
          font-size: 3px;
        }

      }

       .slanted {
           background-image: url('PROJECT-FINANCE.jpg');
           background-size: cover;
           height:200px;
           padding-top: 50px;
           padding-left: 50px;
           -webkit-clip-path: polygon(0 0, 100% 0, 100% 40%, 0 100%);
           clip-path: polygon(0 0, 100% 0, 100% 60%, 0 100%);
    
       }

      h1{
            color: #fff;
            text-align: left;
            font-size: 4rem;
            text-shadow: 3px 3px #000;
          
        }

        .container{
          margin-top: 70px;
          margin-bottom: 70px;
        }

        @media screen and (max-width: 767px){
        .container{
          margin-top: 30px;
          margin-bottom: 30px;
        }
        h1{
          font-size: 3rem;
        }
        .slanted{
          padding-top: 30px;
          padding-left: 40px;
        }
      }

      table{
        background-color: #301b3f;
        margin: auto;
        text-align: center;
        font-family: 'Baloo Tammudu 2', cursive;
        
      }

      tr{
        cursor: pointer;
        color: #fff;
        }

      tr:hover{
        background-color: #867ae9;
        color: #000;
        border: 2px solid #fff;
        
      }

      th{
        padding: 10px 7px;
        text-decoration: underline;
      }

      td{
        padding: 10px 7px;
        
      }

      #footer {
      
      padding: 10px 0px 10px 0px;
      bottom: 0;
      width: 100%;
      /* Height of the footer*/ 
      height: 40px;
      background: grey;
      text-align: center;
      font-weight: bold;
    }

    </style>
</head>
<body>
    <div class="allButFooter">
    <!-- NAVBAR -->
  
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="https://www.phoneworld.com.pk/wp-content/uploads/2020/01/bank_750xx684-385-0-64.jpg" 
            alt="" width="35" height="27" class="d-inline-block align-text-top">
            SAV Bank
          </a>
          <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html"><i class="fas fa-home"></i>Home</a>
        </li>
        </ul>
        </div>
      </nav>
      
      <!-- Heading -->
      <div class="slanted">
      <h1>Transaction History</h1>
      </div>
    
    
    <div class="container">
      <div class="table-responsive-sm">
      <table class="table">
        <tr>
          <th>Transaction Id</th>
          <th>Sender</th>
          <th>Receiver</th>
          <th>Amount</th>
          <th>Date and Time</th>
        </tr>
      <?php

      $sql = "SELECT * FROM transfermoney";
      $result = mysqli_query($con,$sql);

      while($row = mysqli_fetch_assoc($result)){
      echo "<tr>".
             "<td>".$row['Transaction_id']."</td>". 
             "<td>".$row['From']."</td>". 
             "<td>".$row['To']."</td>". 
             "<td>".$row['Amount']."</td>". 
             "<td>".$row['Time']."</td>". 
            "</tr>";
      }
      ?>
      </table>
    </div>
    </div>
   </div>
    <!-- Footer -->
    <div id="footer">
        © 2021 @SAV Bank.
      </div>
    <!--Bootstrap Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity=
    "sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="
    sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="
    sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>