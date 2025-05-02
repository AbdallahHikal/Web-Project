<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Delete Record</title>
    <link rel="stylesheet" href="delete-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/delete 2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="header">
                <h1><i class="fas fa-exclamation-triangle" style="color: plum;"></i> Confirm Deletion</h1>
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <input type="text" id="employeeId" name="id" required />
                    <label>Employee ID</label>
                </div>
                <p class="confirmation-message">
                    Are you sure you want to delete this record?
                </p>
                <div class="form-actions">
                    <button class="delete-btn" id="deleteBtn" name="btndel">Delete</button>
                    <button class="cancel-btn" onclick="window.location.href='main menu admin.php'" type="button">Cancel</button>
                    <br>
                </div>
            </form>
        </div>
    </div>


    
    <?php

        $host="localhost";
        $user="root";
        $pass="123";
        $db="emp_management";

        $conn= mysqli_connect($host,$user,$pass,$db);


        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btndel'])) {
            $id = mysqli_real_escape_string($conn, $_POST['id']);
        
            $sql =  "DELETE FROM employee WHERE id=$id ";
            if(mysqli_query($conn, $sql)){
            echo "<script> 
             Swal.fire({
              icon: 'success',
              title: 'Deleted!',
              text: `Employee #${id} was deleted.`,
              confirmButtonColor: '#8b008b',
              background: 'linear-gradient(to right, rgb(112,5,112), plum, purple)',
              color: '#fff',
              
        });
               </script>";
               
        }
      }
    ?>


<script>
  const form      = document.getElementById("deleteForm");
  const deleteBtn = document.getElementById("deleteBtn");

  deleteBtn.addEventListener("click", () => {
    const id = document.getElementById("employeeId").value.trim();

    if (!id) {
      Swal.fire({
        icon: 'error',
        title: 'Missing ID!',
        text: 'Please enter an employee ID to delete.',
        confirmButtonColor: '#8b008b',
        background: "linear-gradient(to right, rgb(112,5,112), plum, purple)",
        color: "#fff"
      });
      return;
    }
  });

</script>

      
</body>
</html>
