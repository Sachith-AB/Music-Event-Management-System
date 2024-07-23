<?php include ('components/header.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Register Page</h2>

            <?php
                if(isset($_SESSION['add-user'])){
                    echo $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                }

                if(isset($_SESSION['add-user-faild'])){
                    echo $_SESSION['add-user-faild'];
                    unset($_SESSION['add-user-faild']);
                }

            ?><br><br>

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
                    <td colspan="2"><input type="submit" name="submit" value="Submit" class=""></td><br>
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

        if(!$name || !$email || !$password){
            $_SESSION['add-user-faild'] = '<div class="">=user added fail</div>';
            header('location:'.SITEURL.'/register.php');
        }else{
            $sql = "INSERT INTO users SET
            name = '$name',
            email = '$email',
            password = '$password'";

            $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));

            if($res == true){
                $_SESSION['add-user'] = '<div class="">=user added</div>';
                header('location:'.SITEURL.'/home.php');
            }else{
                $_SESSION['add-user'] = '<div class="">user added failed</div>';
                header('location:'.SITEURL.'/register.php');
        }
        }
    }
?>