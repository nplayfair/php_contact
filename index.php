<?php
    // Message vars
    $msg        = '';
    $msgClass   = '';

    // Check for submit
    if (filter_has_var(INPUT_POST, 'submit')) {
        // Get form data
        $name       = $_POST['name'];
        $email      = $_POST['email'];
        $message    = $_POST['message'];

        // Check required fields
        if (!empty($email) && !empty($name) && !empty($message)) {
            // Passed
            //echo 'Passed';
        } else {
            // Failed
            $msg = 'Please complete all fields';
            $msgClass = 'alert-danger';
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Contact Us</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">

    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a href="index.php" class="navbar-brand">My Site</a>
        </nav>

        <div class="container">
        <div class="row">
        <div class="col-8">
            <?php if($msg != ''): ?>
                <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
            <?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control" id="message"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        </div>
        </div>

    </body>
</html>