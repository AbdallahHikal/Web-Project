<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Employee Details</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/modify 2.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php

        $host = "localhost";
        $user = "root";
        $pass = "123";
        $db = "emp_management";
        $conn = mysqli_connect($host, $user, $pass, $db);

                        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btn-mo'])) {

            $id = isset($_POST['id']) && !empty($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : null;
            if ($id) {
                $sql = "SELECT * FROM employee WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['name'];
                    $types = $row['types'];
                    $email = $row['email'];
                    $dept = $row['department'];
                    $dates = $row['dates'];
                    $salary = $row['salary'];
                }
                else{
                    echo "<script>
                        Swal.fire({
                            title: 'Failed!',
                            text: 'ID not found in DataBase.',
                            icon: 'warning',
                            background: 'linear-gradient(to right, rgb(112, 5, 112), plum, purple)',
                            confirmButtonColor: 'rgb(86, 1, 86)',
                            color: '#e4e4e4',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
            }
            else{
                echo "<script>
                        Swal.fire({
                            title: 'Missing ID!',
                            text: 'Please enter an employee ID.',
                            icon: 'warning',
                            background: 'linear-gradient(to right, rgb(112, 5, 112), plum, purple)',
                            confirmButtonColor: 'rgb(86, 1, 86)',
                            color: '#e4e4e4',
                            confirmButtonText: 'OK'
                        });
                    </script>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {
            $id = isset($_POST['id']) && !empty($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : null;
            if ($id) {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $types = mysqli_real_escape_string($conn, $_POST['types']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $dept = mysqli_real_escape_string($conn, $_POST['department']);
                $date = mysqli_real_escape_string($conn, $_POST['dates']);
                $salary = mysqli_real_escape_string($conn, $_POST['salary']);

                $update = "UPDATE employee SET 
                            name = '$name',
                            salary = '$salary',
                            dates = '$date',
                            email = '$email',
                            department = '$dept',
                            types = '$types'
                            WHERE id = '$id'";
                if (mysqli_query($conn, $update)) {
                    echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Employee details updated successfully!',
                            icon: 'success',
                            background: 'linear-gradient(to right, rgb(112, 5, 112), plum, purple)',
                            confirmButtonColor: 'rgb(86, 1, 86)',
                            color: '#e4e4e4',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to update employee details.',
                                icon: 'error',
                                background: 'linear-gradient(to right, rgb(112, 5, 112), plum, purple)',
                                confirmButtonColor: 'rgb(86, 1, 86)',
                                color: '#e4e4e4',
                                confirmButtonText: 'OK'
                            });
                        </script>";
                    }
            }
        }
    ?>


<form class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
    <div class="container" >
    <div class="glass-card">
            <div class="card-header">
                <h2>MODIFY EMPLOYEE DETAILS</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="employeeId"><i class="fas fa-id-card"></i> Enter ID</label>
                    <input type="text" id="employeeId" name="id" placeholder="Employee ID" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>">
                </div>
                
                <div class="form-group">
                    <button type="submit" name="btn-mo" id="load-btn" class="btn btn-submit" style="width: 100%; margin-bottom: 20px;">
                        <i class="fas fa-search"></i> Fetch Details
                    </button>
                </div>
                
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Name</label>
                    <input type="text" id="name" name="name" placeholder="Employee name" value="<?php echo isset($name) ? $name : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="types"><i class="fas fa-user"></i> Type</label>
                    <input type="text" id="types" name="types" placeholder="Employee type" value="<?php echo isset($types) ? $types : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-user"></i>Email</label>
                    <input type="email" id="email" name="email" placeholder="Employee email" value="<?php echo isset($email) ? $email : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="department"><i class="fas fa-building"></i> Department</label>
                    <input type="text" id="department" name="department" placeholder="Department" value="<?php echo isset($dept) ? $dept : ''; ?>">

                    <i class="fas fa-chevron-down icon"></i>
                </div>
                
                <div class="form-group">
                    <label for="joiningDate"><i class="fas fa-calendar-alt"></i> Date of Joining</label>
                    <input type="date" id="joiningDate" name="dates" value="<?php echo isset($dates) ? $dates : ''; ?>">
                    <i class="fas fa-calendar-day icon"></i>
                </div>
                
                <div class="form-group">
                    <label for="salary"><i class="fas fa-money-bill-wave"></i> Salary</label>
                    <input type="number" id="salary" name="salary" placeholder="Enter salary" value="<?php echo isset($salary) ? $salary :''; ?>">
                </div>
                
                <div class="btn-container">
                    <button type="submit" name="update" id="submit-btn" class="btn btn-submit">
                        <i class="fas fa-check-circle"></i> Modify
                    </button>
                    <a href="main menu admin.php"><button class="btn btn-cancel" type="button">
                        <i class="fas fa-times-circle"></i> Cancel
                    </button></a>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
