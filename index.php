<?php
    // Message vars
    $msg        = '';
    $msgClass   = '';

    // Check for submit
    if (filter_has_var(INPUT_POST, 'submit')) {
        // Get form data
        $name       = htmlspecialchars($_POST['name']);
        $email      = htmlspecialchars($_POST['email']);
        $message    = htmlspecialchars($_POST['message']);

        // Check required fields
        if (!empty($email) && !empty($name) && !empty($message)) {
            // Passed
            // Check email
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                // Failed validation
                $msg ='Please enter a valid email address.';
                $msgClass = 'alert-danger';
            } else {
                // Passed validation
                // Set recipient email
                $toEmail = 'conatact@nickplayfair.co.uk';
                $subject = 'Contact request from '.$name;
                $body = '<h2>Contact Request</h2>
                        <h4>Name</h4><p>'.$name.'</p>
                        <h4>Email</h4><p>'.$email.'</p>
                        <h4>Message</h4><p>'.$message.'</p>';
                // Set email headers
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

                // Additional headers
                $headers .= "From: ".$name."<".$email.">" . "\r\n";

                // Attempt to send email

                if (mail($toEmail, $subject, $body, $headers)) {
                    // Mail successfully sent
                    $msg = 'Your email has been sent';
                    $msgClass = 'alert-success';
                } else {
                    // Mail failed to send
                    $msg = 'Your email was not sent';
                    $msgClass = 'alert-danger';
                }

            }

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
                <input type="text" class="form-control" id="name" name="name" 
                value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control" id="message"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        </div>
        </div>

    </body>
</html>