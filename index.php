<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <title>Form</title>
</head>
<style>
    td,
    tr {
        border: 1px solid #0006;
    }

    td {
        padding: 5px;
    }
</style>

<body>

    <?php
    $first_name = $last_name = $email = $gender  = $contact = $password = $confirmPassword = "";
    $firstNameErr = $lastNameErr = $emailErr = $genderErr  =  $contactErr = $passErr = "";
    $address = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //first name verification
        if (empty($_POST["first_name"])) {
            $firstNameErr = "* required ";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["first_name"])) {
            $firstNameErr = "* should contain letters";
            $_POST["first_name"] = "";
        } elseif ($_POST["last_name"] == "") {
            $firstNameErr = "* last name can not remain empty";
            $_POST["first_name"] = "";
        } else {
            $first_name = test_data($_POST["first_name"]);
        }


        //last name verification
        if (empty($_POST["last_name"])) {
            $lastNameErr = "* required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["last_name"])) {
            $lastNameErr = "* should contain letters";
            $_POST["last_name"] = "";
        } else {
            $last_name = test_data($_POST["last_name"]);
        }


        //email verification
        if (empty($_POST["email"])) {
            $emailErr = "* required";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "* input a valid email address";
        } else {
            $email = test_data($_POST["email"]);
        }


        //gender verification
        if ($_POST["gender"] == "notSelected") {
            $genderErr = "* required";
        } else {
            $gender = test_data($_POST["gender"]);
        }


        //contact verification
        if (empty($_POST["contact"])) {
            $contactErr = "* required";
        } elseif (!is_numeric($_POST["contact"])) {
            $contactErr = "* should contain only number";
        } elseif (strlen($_POST["contact"]) != 11) {
            $contactErr = "* contact should contain 11 digits";
        } else {
            $contact = test_data($_POST["contact"]);
        }


        //password verification
        if (empty($_POST["password"])) {
            $passErr = "* required";
        } elseif (!preg_match("/[@#!$%^&*:;<>]/", $_POST["password"])) {
            $passErr = "* should contain a special charectar";
        } elseif (strlen($_POST["password"]) < 8) {
            $passErr = "* password must contain 8 characters";
        } elseif ($_POST["password"] != $_POST["confirmPassword"]) {
            $passErr = "* password did not match";
        } else {
            $password = test_data($_POST["password"]);
        }

        $address = test_data($_POST["address"]);
    }

    function test_data($userData)
    {
        $userData = trim($userData);
        $userData = stripslashes($userData);
        $userData = htmlspecialchars($userData);
        return $userData;
    }
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form container ">

        <h1 class="text-center text-primary">Registration Form</h1>


        <input class="form-control form-control-lg border border-primary" type="text" name="first_name" placeholder="First Name">
        <span class="text-danger p-1"><?php echo $firstNameErr; ?></span>



        <input class=" form-control form-control-lg border border-primary" type="text" name="last_name" placeholder="Last Name">
        <span class="text-danger p-1"><?php echo $lastNameErr; ?></span>



        <input class="form-control form-control-lg border border-primary" type="email" name="email" placeholder="Email">
        <span class="text-danger p-1"><?php echo $emailErr; ?></span>



        <select class="form-select form-select-lg border border-primary" name="gender" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="others">Others</option>
            <option value="notSelected" selected>Select Gender..</option>
        </select>
        <span class="text-danger p-1"> <?php echo $genderErr; ?>

            <input class="form-control form-control-lg border border-primary" type="text" name="address" placeholder="Address">
            <span class="text-danger p-1"></span>

            <input class="form-control form-control-lg border border-primary" type="tel" name="contact" placeholder="Contact no">
            <span class="text-danger p-1">
                <?php echo $contactErr; ?>
            </span>

            <input class="form-control form-control-lg border border-primary" type="password" name="password" placeholder="Password">
            <span class="text-danger p-1"><?php echo $passErr; ?></span>

            <input class="form-control form-control-lg border border-primary" type="password" name="confirmPassword" placeholder="Confirm Password">
            <span class="text-danger p-1"><?php echo $passErr; ?></span>
            <br>
            <input class="btn btn-primary mx-1 align-middle" type="submit">

    </form>



    <table class="text-black mt-3">
        <tr>
            <td>Name</td>
            <td class="w-100"><?php echo $first_name . " " . $last_name; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td class="w-100"><?php echo $email; ?></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td class="w-100"><?php echo $gender; ?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td class="w-100"><?php echo $address; ?></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td class="w-100"><?php echo $contact; ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td class="w-100"><?php echo $password; ?></td>
        </tr>
    </table>


    <script src="./js/bootstrap.bundle.js"></script>
</body>

</html>