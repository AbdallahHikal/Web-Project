<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/view details page 2.css">
</head>
<body>
    <div class="employee-details-container">
        <div class="details-header">
            <h1 class="details-title">View Employee Details</h1>
        </div>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <label for="employee-id" >Employee ID</label>
                <input type="text" id="employee-id" class="form-control" placeholder="Enter employee ID" name="id">
            </div>
            
            <button type="submit" name="btnview" class="view-details-btn">
                <i class="fas fa-search"></i>
                View Details
            </button>
        </form>


        <div class="employee-info-card">
            


            <?php

                $host = "localhost";
                $user = "root";
                $pass = "123";
                $db = "emp_management";

                $conn = mysqli_connect($host, $user, $pass, $db);

                $name = "";
                $email = "";
                $dept = "";
                $dates = "";
                $salary = "";
                

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnview'])) {

                    $id = mysqli_real_escape_string($conn, $_POST['id']);

                    $sql = "SELECT * FROM employee WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($res) > 0) {
                        $row = mysqli_fetch_array($res);
                        $name = $row['name'];
                        $email = $row['email'];
                        $dept = $row['department'];
                        $dates = $row['dates'];
                        $salary = $row['salary'];
                    }
                    else{
                        echo "<script> alert('ID not found')</script>"; 
                    }
                }
            ?>




            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-user"></i>
                    Name:
                </div>
                <div class="info-value"><?php echo $name; ?></div>
            </div>

            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-user"></i>
                    Email:
                </div>
                <div class="info-value"><?php echo $email ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-building"></i>
                    Department:
                </div>
                <div class="info-value"><?php echo $dept ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-calendar-alt"></i>
                    Date of Joining:
                </div>
                <div class="info-value"><?php echo $dates ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-money-bill-wave"></i>
                    Salary:
                </div>
                <div class="info-value"><?php echo $salary."$" ?></div>
            </div>
        </div>
        
        <button  class="back-btn"onclick="window.location.href='main menu admin.php'">
            Back to Main Menu
        </button>
    </div>
</body>
</html>