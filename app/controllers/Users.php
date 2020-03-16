<?php 

  class Users extends Controller {

    public function __construct() {
      $this->userModel = $this->model('User');
    }

    public function index() {
      redirect('pages/index');
    }

    public function register() {
      
      // Check for posts
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process the form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Init Form
        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])) {
          $data['email_err'] = 'Please Enter Email';
        } else {
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }
      
        // Validate Name
        if(empty($data['name'])) {
          $data['name_err'] = 'Please Enter Name';
        }
        // Validate Password
        if(empty($data['password'])) {
          $data['password_err'] = 'Please Enter Password';
        } elseif(strlen($data['password']) < 7) {
          $data['password_err'] = 'The Password should be more or equal to 7 characters...';
        }
        // Validate Confirm Password
        if(empty($data['confirm_password'])) {
          $data['confirm_password_err'] = 'Please Confirm Your Password';
        } elseif ($data['confirm_password'] !== $data['password']) {
          $data['confirm_password_err'] = 'Passwords Do Not Match';
        }

        // Make Sure Errors Are Empty
        if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
          // Validated
          
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data)) {
            flash('register_success', 'You are successfully register and may Log In');
            redirect('users/login');
          } else {
            die('SOMETHING WENT WRONG!');
          }


        } else {
          // Load View With Errors
          $this->view('users/register', $data);
        }

      } else {
        // Init Form
        $data = [
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load View
        $this->view('users/register', $data);
      }
    }

    public function login() {
      
      // Check for posts
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process the form
        // Init Form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Init Form
        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          
          'email_err' => '',
          'password_err' => '',
        ];

        // Validate Email
        if(empty($data['email'])) {
          $data['email_err'] = 'Please Enter Email';
        }
        // Validate Password
        if(empty($data['password'])) {
          $data['password_err'] = 'Please Enter Password';
        }

        // Check for user/email
        if ($this->userModel->findUserByEmail($data['email'])) {
          // User Found
        } else {
          // User Not Found
          $data['email_err'] = 'Email Not Found!';
        }

        // Make Sure Errors Are Empty
        if (empty($data['email_err']) && empty($data['password_err'])) {
          // Validated
          // Check And Set LoggedIn User
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);
          // Check If Logged In
          if($loggedInUser) {
            // Create Session
            $this->createUserSession($loggedInUser);
            
          } else {
            $data['password_err'] = 'Password Incorrect!';
            $this->view('users/login', $data);
          }

        } else {
          // Load View With Errors
          $this->view('users/login', $data);
        }

      } else {
        // Init Form
        $data = [
          'email' => '',
          'password' => '',
          
          'email_err' => '',
          'password_err' => '',
        ];

        // Load View
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user) {
      //session_start();

      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;

      flash('login_success', 'You have successfully Logged In');
      redirect('posts');
      //exit();
    }

    public function logout() {

      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      //session_unset();
      session_destroy();

      //flash('logout_success', 'You are successfully Logged Out');
      redirect('users/login');
      //exit();
    }

  }


  







