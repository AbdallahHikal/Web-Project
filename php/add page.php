<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add an Employee</title>
    <link rel="stylesheet" href="../css/add page 2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="container">
        <div class="form-container">
            <div class="header">
                <h1>Add an Employee </h1><br>
            </div>
            <div class="form-group">
                <input type="text" id="name" name="name" required>
                <label for="name">Name</label>
            </div>

            <div class="form-group">
                <input type="text" id="types" name="types" required>
                <label for="types">Type</label>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="pass" required>
                <label for="password">Password</label>
            </div>

            <div class="form-group">
                <input type="password" id="confirm-password" name="cpass" required>
                <label for="password"> Confirm Password</label>
            </div>

            <div class="form-group">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
            </div>
            <div class="form-group">
                <input type="text" id="department" name="dept" required >
                <label for="department">Department</label>
            </div>
            <div class="form-group">
                <input type="tel" id="salary" name="salary" required>
                <label for="salary">Salary</label>
            </div>
            <div class="form-group">
                <input type="date" id="join-date" name="date" required>
                <label for="join-date"></label>
            </div>
            <div class="form-actions">
                <button type="submit" id="submit-btn" name="add">Add</button>
                <button onclick="window.location.href='main menu admin.php'">Cancel</button>
            </div>
        </div>
    </div>
</form>
    <?php

        $host = "localhost";
        $user = "root";
        $pass = "123";
        $db = "emp_management";
        $conn = mysqli_connect($host, $user, $pass, $db);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add'])) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $types = mysqli_real_escape_string($conn, $_POST['types']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);
            $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $dept = mysqli_real_escape_string($conn, $_POST['dept']);
            $salary = mysqli_real_escape_string($conn, $_POST['salary']);
            $date = mysqli_real_escape_string($conn, $_POST['date']);

            if ($pass === $cpass) {
                
                $sql = "INSERT INTO employee (name,salary,dates, password, email, department,types)values('$name','$salary','$date','$pass','$email','$dept','$types')";
                if( mysqli_query($conn, $sql)){
                    $employee_id = mysqli_insert_id($conn);
                }
                $sal= "INSERT INTO attendance (id,attendance_rate,days_present,days_absent,total_days)values($employee_id,'100%',1,0,1)";
            
                if (mysqli_query($conn, $sal)) {
                    echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Employee added successfully',
                            icon: 'success',
                        background:'linear-gradient(to right, rgb(112, 5, 112), rgb(127, 15, 127), rgb(132, 42, 132), plum, purple)',
                            confirmButtonColor: 'rgb(86, 1, 86)',
                            color: '#e4e4e4',
                            confirmButtonText: 'OK'
                            
                        });
                    </script>";
                }
                else{
                    echo "<script>
                        Swal.fire({
                            title: 'Failed!',
                            text: 'Employee not added',
                            icon: 'warning',
                        background:'linear-gradient(to right, rgb(112, 5, 112), rgb(127, 15, 127), rgb(132, 42, 132), plum, purple)',
                            confirmButtonColor: 'rgb(86, 1, 86)',
                            color: '#e4e4e4',
                            confirmButtonText: 'OK'
                            
                        });
                    </script>";
                }

            } 
            else {
                echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Passwords do not match!',
                        icon: 'error',
                        background: 'linear-gradient(to right, rgb(112, 5, 112), rgb(127, 15, 127), rgb(132, 42, 132), plum, purple)',
                        confirmButtonColor: 'rgb(86, 1, 86)',
                        color: '#e4e4e4',
                        confirmButtonText: 'OK'
                    });
                </script>";
                }
        }
    ?>



    <script>
        document.getElementById("submit-btn").addEventListener("click", function(event) {

            const name = document.getElementById("name").value.trim();
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm-password").value;
            const email = document.getElementById("email").value.trim();
            const department = document.getElementById("department").value;
            const salary = document.getElementById("salary").value.trim();
            const joinDate = document.getElementById("join-date").value;
            const types = document.getElementById("types").value;

            if (!name  ||!password || !confirmPassword || !email || department === "Department" || !salary || !joinDate||!types) {
                Swal.fire({
                    title: "Error!",
                    text:("Please fill all fields!"),
                    icon: "warning",
                    background: "linear-gradient(to right, rgb(112, 5, 112) ,  rgb(127, 15, 127),rgb(132, 42, 132) ,plum,purple)",
                    confirmButtonColor: "rgb(86, 1, 86)", 
                    color:" #e4e4e4",
                    confirmButtonText:"OK"
                });
                return;
            }
            
        });
    </script>
</body>
</html>