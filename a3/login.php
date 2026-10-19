<?php require_once "includes/db_connect.inc";
$pageTitle = "Login - BookVerse";
$error = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = "Please enter your username and password.";
    }else {
        $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($user && password_verify($password, $user["password"])) {
            session_regenerate_id(true);

            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["flash_message"] = "Welcome back, " . $user["username"] . "!";
            $_SESSION["flash_type"] = "success";

            header("Location: index.php");
            exit;
        }else {
            $error = "Invalid username or password.";
        }
    }
}

include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="login-page">
    <div class="container">
        <div class="login-card register-card">
            <h1 class="register-title login-title">
                <span class="material-icons register-icon">login</span>
                Login to BookVerse
            </h1>

            <?php if ($error !== ""): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">
                        Username
                    </label>

                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" 
                        value="<?php echo htmlspecialchars($username); ?>" autocomplete="username" required >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
                        autocomplete="current-password" required >
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <span class="material-icons">check_circle</span>
                    Login
                </button>
            </form>

            <div class="login-footer">
                Don't have an account?
                <a href="register.php">Register here</a>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.inc"; ?>