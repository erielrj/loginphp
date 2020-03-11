<?php
 // Include db config
 require_once 'db.php';

 // Init vars
 $email = $password = '';
 $email_err = $password_err = '';

 // Process form when post submit
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
   // Sanitize POST
   $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

   // Put post vars in regular vars
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);

   // Validate email
   if(empty($email)){
     $email_err = 'Por favor, insira seu email.';
   }

   // Validate password
   if(empty($password)){
     $password_err = 'Por favor, insira sua senha. ';
   }

   // Make sure errors are empty
   if(empty($email_err) && empty($password_err)){
     // Prepare query
     $sql = 'SELECT name, email, password FROM users WHERE email = :email';

     // Prepare statement
     if($stmt = $pdo->prepare($sql)){
       // Bind params
       $stmt->bindParam(':email', $email, PDO::PARAM_STR);

       // Attempt execute
       if($stmt->execute()){
         // Check if email exists
         if($stmt->rowCount() === 1){
           if($row = $stmt->fetch()){
             $hashed_password = $row['password'];
             if(password_verify($password, $hashed_password)){
               // SUCCESSFUL LOGIN
               session_start();
               $_SESSION['email'] = $email;
               $_SESSION['name'] = $row['name'];
               header('location: index.php');
             } else {
               // Display wrong password message
               $password_err = 'The password you entered is not valid';
             }
           }
         } else {
           $email_err = 'No account found for that email';
         }
       } else {
         die('Something went wrong');
       }
     }
     // Close statement
     unset($stmt);
   }

   // Close connection
   unset($pdo);
 }