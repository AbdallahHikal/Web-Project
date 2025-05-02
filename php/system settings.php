<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>System Settings | HR Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/system settings 2.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <header>
        <div class="container header-content">
            <h1><i class="fas fa-cog"></i> System Settings</h1>
        </div>
    </header>

    <div class="container">
        <div class="settings-card">
            <h2 class="section-title">
                <i class="fas fa-lock"></i> Change Password
            </h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="passwordForm">
                <div class="form-group">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input type="password" id="currentPassword" class="form-control" placeholder="Enter current password" name="cpass" required>
                </div>
                <div class="form-group">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" id="newPassword" class="form-control" placeholder="Enter new password" name="npass" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm new password" name="cnpass" required>
                </div>
                <button type="submit" class="btn btn-primary" name="btnsave">
                        <i class="fas fa-save"></i> Save Changes
                </button>
            </form>


            <?php

                $host = "localhost";
                $user = "root";
                $pass = "123";
                $db = "emp_management";

                $conn = mysqli_connect($host, $user, $pass, $db);


                $spass="";
                $cpass="";
                $npass = "";
                $cnpass="";

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnsave'])) {

                    session_start();
                    $id = $_SESSION['id'];
                
                    $sql = "SELECT * FROM employee WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);
                
                    if ($res && mysqli_num_rows($res) > 0) {
                        $row = mysqli_fetch_array($res);
                
                        $spass = $row['password'];
                        $cpass = $_POST['cpass'];
                        $npass = $_POST['npass'];
                        $cnpass= $_POST['cnpass'];

                        if ($npass != $cnpass){
                            echo "<h4 style= 'color: red' >"."The password not match between new and confirm password"."</h1>";
                            exit();
                        }
                        if($spass != $cpass){
                            echo "<h4 style= 'color: red' >"."The Current password is not correct!"."</h1>";
                            exit();
                        }
                        if ($spass == $cpass) {
                            $sql = "UPDATE employee SET password='$npass' WHERE id='$id'";
                            mysqli_query($conn, $sql);
                            echo "<h4 style= 'color: green' >"."Changed Successfully!"."</h1>";
                            echo "<script> setTimeout(() => { window.location.href='main menu employee.php'; }, 2000); </script>";
                        }
                    }
                }
                
            ?>   

            <div id="alert-success" class="alert-box success" style="display: none;">
                <i class='bx bx-check-circle'></i>
                <span id="success-msg">Password changed successfully.</span>
            </div>
            <div id="alert-fail" class="alert-box fail" style="display: none;">
                <i class='bx bx-error-circle'></i>
                <span id="fail-msg">Failed to change password. Please try again.</span>
            </div>
        </div>
    </div>

    <footer class="container">
        <a href="main menu employee.php" class="cancel" id="cancel">
            <i class="fas fa-sign-out-alt"></i> Cancel
        </a>
    </footer>

</body>

</html>