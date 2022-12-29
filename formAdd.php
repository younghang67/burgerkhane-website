<?php

include('config/DB_connect.php');

$FullName = $email = $title = $ingredients = '';

$errors = array('FullName' => '', 'email' => '', 'title' => '', 'ingredients' => '');

if (isset($_POST['submit'])) {

    // checking FullName
    if (empty($_POST['FullName'])) {
        $errors['FullName'] = 'The name box is empty <br>';
    } else {
        $FullName = $_POST['FullName'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $FullName)) {
            $errors['FullName'] = 'Please enter a valid name <br>';
        }
    }
    //checking email
    if (empty($_POST['email'])) {
        $errors['email'] = 'The email box is empty <br>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email <br>';
        }
    }
    //checking title
    if (empty($_POST['title'])) {
        $errors['title'] = 'The Burger title is empty <br>';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Please enter a valid title <br>';
        }
    }
    //checking ingredients
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'The Burger ingredients is empty <br>';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'Please enter a valid ingredients <br>';
        }
    }
    // this is the end of POST check

    if (array_filter($errors)) :
        echo "There's some error in the form";
    else :
        // myqli_real_escape_string blocks macisoius code entering in database
        $FullName = mysqli_real_escape_string($conn, $_POST['FullName']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //create sql
        $sql = " INSERT INTO  burgers2(FullName,email,title,ingredients) VALUES('$FullName','$email','$title','$ingredients')";
        if (mysqli_query($conn, $sql)) :

            header('location: BurgerKhane.php');
        else :
            echo 'query error: ' . mysqli_error($conn);
        endif;

    endif;
}

?>
<!DOCTYPE html>
<html>

<?php include('phpForBurger/header.php'); ?>

<section class="container grey-text">
    <div class="AddABurger">
        <h4 class="center">Add a Burger</h4>
    </div>
    <form class="white" action="formAdd.php" method="POST">
        <!-- for validation there are two types one is on the action  
        page and another is on sever side
        for action page validation check use required or types in html code
        and for sever side validation use the method taught in The Net Ninja -->
        <div class="lvl">
            <label>Your Full Name</label>
            <input type="text" name="FullName" value="<?php echo htmlspecialchars($FullName) ?>">
            <div class="red-text"><?php echo $errors['FullName']; ?></div>
            <label>Your Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Burger title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label>Burger ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
        </div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class=" btn brand z-depth-0">

        </div>
    </form>
</section>


</html>