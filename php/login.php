<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="../css/login 2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="../index.php">Home</a>
            <a href="about.php">About</a>
        </nav>

    </header>
    <div class="background"></div>
    <div class="container">
        <div class="content">
            <h2 class="logo">EMPLOYEE MANAGEMENT </h2>
            <div class="text-sci">
                <h2>Welcome!<br> 
                    <span>
                        To our Website.
                    </span>
                </h2>
                <p> This platform is designed to streamline employee management, communication, and collaboration. our portal empowers employees to work efficiently and stay connected</p>

            </div>
        </div>
        <div class="logreg-box">
            <div class="form-box login">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h2>Login </h2>

                    <div class="input-box">
                        <span class="icon"><i class='bx bx-id-card'></i></span>
                        <input type="text"  id="userID" name="id" required>
                        <label>ID</label>
                    </div>
                    
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password"  id="password" name="pass" required >
                        <label> Password</label>
                    </div>

                    <div class="remeber-forgot">
                        <label>
                            <input type="checkbox">
                            Remember me 
                        </label>
                        
                    </div>
                   <button class="btn" name="btnlog" onclick="validateLogin()">Login</button>
                </form>
            </div>
        </div>
    </div>

    <?php
        $host="localhost";
        $user="root";
        $pass="123";
        $db="emp_management";

        $conn= mysqli_connect($host,$user,$pass,$db);

        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnlog'])) {

            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

            $_SESSION['id']=$id;
        
            $sql = "SELECT types FROM employee WHERE id='$id' and password='$pass'";
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                if($row['types']==0){
                    header("location: main menu admin.php");
                }
                else if($row['types']==1){
                    header("location: main menu employee.php");
                }
            }
            else{
                echo "<script>
                        Swal.fire({
                            title: 'Invalid Login',
                            text: 'Data not found',
                            icon: 'error',
                            background: 'linear-gradient(to right, rgb(112, 5, 112), plum, purple)',
                            confirmButtonColor: 'rgb(86, 1, 86)',
                            color: '#e4e4e4',
                            confirmButtonText: 'OK'
                        });
                    </script>";
            }   
        }
    ?>

</body>
<script>
    function validateLogin() {
    const userID = document.getElementById("userID").value;
    const password = document.getElementById("password").value;
    localStorage.setItem("userID", userID);
    
    if (!userID || !password) {
        Swal.fire({
            title: "Error!",
            text:("Please fill in both ID and password!"),
            icon: "warning",
            background: "linear-gradient(to right, rgb(112, 5, 112) ,  rgb(127, 15, 127),rgb(132, 42, 132) ,plum,purple)",
            confirmButtonColor: "rgb(86, 1, 86)", 
            color:" #e4e4e4",
            confirmButtonText:"OK"
        });
        return;
    }
}
</script>
</html>
