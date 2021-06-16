<?php
include 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Money</title>

    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

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
          background-color: #301b3f;
          background-size: cover;
    
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

    .alert{
      margin-bottom: 0px;
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

        @media screen and (max-width: 767px){
          h1{
          font-size: 3rem;
        }
        .slanted{
          padding-top: 25px;
          padding-left: 30px;
        }
        }

        .input-group{
          width: 70%;
          margin: auto;
          padding: 20px;
        }

        .mb-3{
          width: 70%;
          margin: auto;
          padding: 20px;
        }

        .container{
          margin: auto;
          text-align: center;
        }
        
        .btn{
         width: 15%;
        }

        @media screen and (max-width: 767px){
          .btn{
            padding: 2px;
            width: 20%;
          }
        }
        #footer {
            margin-top: 130px;
            padding: 10px 0px 10px 0px;
            bottom: 0;
            width: 100%;
            /* Height of the footer*/ 
            height: 40px;
            background: grey;
            text-align: center;
            font-weight: bold;
        }

        @media screen and (max-width: 767px;){
          #footer{
            margin-top: 0px;
          }
        }
    </style>

</head>
<body>
  <div class="allButFooter">
    <!-- NAVBAR -->
  
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">
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

      <?php
      
      if (isset($_POST['submit'])){
        $From = $_POST['From'];
        $To = $_POST['To'];
        $Amount = $_POST['Amount'];
        
        $sql = "SELECT * from customers where Customer_id=$From";
        $query = mysqli_query($con,$sql) or die( mysqli_error($con));;
        $sql1 = mysqli_fetch_array($query); 
    
        $sql = "SELECT * from customers where Customer_id=$To";
        $query = mysqli_query($con,$sql) or die( mysqli_error($con));;
        $sql2 = mysqli_fetch_array($query);
    
       if(($Amount)<0){
        echo "<div class='alert alert-warning' role='alert'>".
        "Warning!! Negative value is non-transferable.".
        "</div>";
      }
  
      else if(($Amount)==0){
        echo "<div class='alert alert-warning' role='alert'>".
        "Ooopss!! 0 is non-transferable.".
        "</div>";
      }

      else if($Amount > $sql1['Amount']){
        echo "<div class='alert alert-danger' role='alert'>".
        "Sorry!! Insufficient Balance.".
        "</div>";
      }

      else if(($sql1['Amount']) == ($sql2['Amount'])){
        echo "<div class='alert alert-warning' role='alert'>".
        "Alert!! Same Account.".
        "</div>";
      }

      else if(($Amount)>0){

        // deducting amount from sender's account
        $newbalance = $sql1['Amount'] - $Amount;
        $sql = "UPDATE customers set Amount=$newbalance where Customer_id=$From";
        mysqli_query($con,$sql);
     

        // adding amount to reciever's account
        $newbalance = $sql2['Amount'] + $Amount;
        $sql = "UPDATE customers set Amount=$newbalance where Customer_id=$To";
        mysqli_query($con,$sql);

        $sender = $sql1['Name'];
        $receiver = $sql2['Name'];
        $query = "INSERT INTO `bank`.`transfermoney` (`From`, `To`, `Amount`, `Time`) VALUES ('$sender', '$receiver', '$Amount', current_timestamp());";
        $result = mysqli_query($con,$query);
        
        if($result){
          //echo "Inserted successfully";
          echo "<div class='alert alert-success' role='alert'>".
        "Wooohooo!! Transaction is Successful.".
        "</div>";
        }
        $newbalance= 0;
        $Amount =0;
      }
      else{
        die("Error");
      }
    

  }
    ?>
     <!-- Heading -->
     <div class="slanted">
      <h1>Transfer Money</h1>
      </div>
    
    <form action="transfer.php" method="POST">
      <div class="input-group mb-3">
        <label class="input-group-text" for="">FROM</label>
        <select class="form-select" name="From">
          <option selected>Select Sender Name</option>
          <option value="1">Shambhavi</option>
          <option value="2">Akanksha</option>
          <option value="3">Bibhash Jha</option>
          <option value="4">Vedashri Jha</option>
          <option value="5">Akshan</option>
          <option value="6">Keshav Jha</option>
          <option value="7">Ayumi</option>
          <option value="8">Sunindra Kashyap</option>
          <option value="9">Munindra Kumar Jha</option>
          <option value="10">Sanjeev Chaudhary</option>
        </select>
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="">TO</label>
        <select class="form-select" name="To">
          <option selected>Select Receiver Name</option>
          <option value="1">Shambhavi</option>
          <option value="2">Akanksha</option>
          <option value="3">Bibhash Jha</option>
          <option value="4">Vedashri Jha</option>
          <option value="5">Akshan</option>
          <option value="6">Keshav Jha</option>
          <option value="7">Ayumi</option>
          <option value="8">Sunindra Kashyap</option>
          <option value="9">Munindra Kumar Jha</option>
          <option value="10">Sanjeev Chaudhary</option>
         
        </select>
      </div>
      
      <div class="mb-3">
         <input type="number" class="form-control" name="Amount" id="Amount" placeholder="Enter Amount"
         required="required">
       </div>
      
      <div class="container">
        <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
        </div>
        </form>
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