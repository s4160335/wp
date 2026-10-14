<?php require_once "includes/db_connect.inc";
$pageTitle = "Register - BookVerse";

$errors = [];
$username = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";
    $phone = trim($_POST["phone"] ?? "");
    $location = trim($_POST["location"] ?? "");
    $bio = trim($_POST["bio"] ?? "");

    if ($username === "") {
        $errors[] = "Username is required.";
    }elseif (strlen($username) > 50) {
        $errors[] = "Username must not exceed 50 characters.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }elseif (strlen($email) > 100) {
        $errors[] = "Email must not exceed 100 characters.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must contain at least 8 characters.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Password do not match.";
    }

    if (strlen($phone) > 20) {
        $errors[] = "Phone number must not exceed 20 characters.";
    }

    if (strlen($location) > 100) {
        $errors[] = "Location must not exceed 100 characters.";
    }

    if (empty($errors)) {
        $sql = "SELECT user_id FROM users WHERE username = ? OR email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors[] = "Username or email is already registered.";
        }
        mysqli_stmt_close($stmt);
    }

    if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);

        if (mysqli_stmt_execute($stmt)) {
            $userId = mysqli_insert_id($conn);

            session_regenerate_id(true);

            $_SESSION["user_id"] = $userId;
            $_SESSION["username"] = $username;

            $_SESSION["flash_message"] = "Registration successful! Welcome to BookVerse.";
            $_SESSION["flash_type"] = "success";
            mysqli_stmt_close($stmt);

            header("Location: index.php");
            exit;
        }else {
            $errors[] = "Registration failed. Please try again.";
        }
        mysqli_stmt_close($stmt);
    }
}

include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-sm register-card">

                <div class="card-body p-4">
                    <h1 class="register-title mb-4">
                        <span class="material-icons register-icon" aria-hidden="true">person_add</span>
                        Create Account
                    </h1>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($errors); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="register.php" method="POST" class="register-form">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>

                            <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" maxlength="50"
                                    value="<?php echo htmlspecialchars($username); ?>" required >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" maxlength="100"
                                    value="<?php echo htmlspecialchars($email); ?>" required >
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" minlength="8" required >
                        </div>

                        <div class="mb-2">
                            <label for="confirm_password" class="form-label">
                                Confirm Password
                            </label>

                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" minlength="8" required >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <span class="material-icons align-middle" aria-hidden="true">check_circle</span>
                            Register
                        </button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        Already have an account?
                        <a href="login.php">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.inc"; ?>