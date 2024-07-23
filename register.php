<?php include ('components/header.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Register Page</h2>

            <form action="" method="post">
            <table>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="name" placeholder="full name"></td><br>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" placeholder="email"></td><br>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="password"></td><br>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Submit" class="edit-btn"></td><br>
                </tr>
            </table>
            </form>
        </div>
    </div>

<?php include('components/footer.php') ?>

<?php
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $sql = "INSERT INTO users SET
        name = '$name',
        email = '$email',
        password = '$password'
        ";

        $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        if($res == true){
            $_SESSION['add-user'] = '<div>=user added';
            header('location:'.SITEURL.'home.php');
        }else{
            $_SESSION['add'] = '<div class="error">Admin added failed</div>';
            header('location:'.SITEURL.'admin/add-admin.php');
        }
    }
?>