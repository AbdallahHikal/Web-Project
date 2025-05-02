<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile | HR System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/employee profile 2.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <h1>Employee Profile</h1>
        </div><br><br>
        

    </header>
        <div class="profile-grid">
            <div class="profile-card">
                <div class="card-header">
                    <h2 class="card-title">Employment Details</h2>
                    <i class="fas fa-briefcase" ></i>
                </div>


                <?php

                    $host = "localhost";
                    $user = "root";
                    $pass = "123";
                    $db = "emp_management";

                    $conn = mysqli_connect($host, $user, $pass, $db);
           
                    $id="";
                    $name = "";
                    $email = "";
                    $dept = "";
                    $dates="";
                    $salary = "";
                    $att_rate="";
                    $day_pre="";
                    $day_ab="";
                    $total="";

                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btndisplay'])) {

                        session_start();
                        $id = $_SESSION['id'];

                        $sql = "SELECT * FROM employee WHERE id=$id";
                        $res = mysqli_query($conn, $sql);

                        $sql1 = "SELECT * FROM attendance WHERE id=$id";
                        $res1 = mysqli_query($conn, $sql1);
                        
                        if ($res &&  $res1 && mysqli_num_rows($res) > 0 && mysqli_num_rows($res1) > 0 ) {
                            $row = mysqli_fetch_array($res);
                            $row1 = mysqli_fetch_array($res1);

                            $name = $row['name'];
                            $email = $row['email'];
                            $dept = $row['department'];
                            $dates = $row['dates'];
                            $salary = $row['salary'];
                            $att_rate=$row1['attendance_rate'];
                            $day_pre=$row1['days_present'];
                            $day_ab=$row1['days_absent'];
                            $total=$row1['total_days'];

                        }
                    }
                ?>



                <div class="info-item">
                    <div class="info-label">Employee ID</div>
                    <div class="info-value"><?php echo $id; ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Full Name</div>
                    <div class="info-value"><?php echo $name; ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?php echo $email; ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Department</div>
                    <div class="info-value"><?php echo $dept; ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Date of Joining</div>
                    <div class="info-value"><?php echo $dates; ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Salary</div>
                    <div class="info-value"><?php echo $salary; ?></div>
                </div>
                
            </div>


            <div class="profile-card expandable" style="flex: 1;" onclick="toggleAttendance()">
                <div class="card-header">
                  <h2 class="card-title">Attendance Summary</h2>
                  <i class="fas fa-calendar-check"></i>
                </div>
                <div class="attendance-stats">
                  <div class="stat-item">
                    <div class="stat-value present"><?php echo $att_rate; ?></div>
                    <div class="stat-label">Attendance Rate</div>
                  </div>
                </div>
                <div id="expand-content" style="display: none;">
                  <div class="attendance-stats">
                    <div class="stat-item"><div class="stat-value present"><?php echo $day_pre; ?></div><div class="stat-label">Days Present</div></div>
                    <div class="stat-item"><div class="stat-value absent"><?php echo $day_ab; ?></div><div class="stat-label">Days Absent</div></div>
                    <div class="stat-item"><div class="stat-value"><?php echo $total; ?></div><div class="stat-label">Total Days</div></div>
                  </div>
                </div>
              </div>

        </div>

    <footer class="container">
        <div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <button class="btn btn-cancel" name="btndisplay" type="submit" style="width: 105px">Display</button>
            </form>
        </div>

        <div style="padding-left: 70px"> 
            <button class="btn btn-cancel" type="button">
                <a href="main menu employee.php">Cancel</a>
                <i class="fas fa-times"></i> 
            </button>
        </div>
        
    </footer>

    <script>
        function toggleAttendance() {
          const content = document.getElementById('expand-content');
          content.style.display = content.style.display === 'none' ? 'block' : 'none';
        }
      </script>
</body>
</html>