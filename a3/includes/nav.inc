<?php
$isLoggedIn = isset($_SESSION["user_id"]);
$username = $_SESSION["username"] ?? "";
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">

            <a class="navbar-brand" href="index.php">
                <span class="material-icons">menu_book</span>
                BookVerse
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <span class="material-icons">home</span>
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="books.php">
                            <span class="material-icons">view_list</span>
                            Browse Books
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">
                            <span class="material-icons">collections</span>
                            Gallery
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="search.php">
                            <span class="material-icons">search</span>
                            Search
                        </a>
                    </li>

                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="add.php">
                                <span class="material-icons">add_circle</span>
                                Add Book
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav">
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                <span class="material-icons">account_circle</span>
                                <?php echo htmlspecialchars($username); ?>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="accountDropdown">

                                <li>
                                    <a class="dropdown-item"
                                        href="seller.php?id=<?php echo (int) $_SESSION["user_id"]; ?>">
                                        My Profile &amp; Books
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="logout.php">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <span class="material-icons">login</span>
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="register.php">
                                <span class="material-icons">person_add</span>
                                Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<?php
if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION["flash_message"])):
    $flashMessage = $_SESSION["flash_message"];
    $flashType = $_SESSION["flash_type"] ?? "info";

    $alertClass = $flashType === "success" ? "success" : "danger";
    unset($_SESSION["flash_message"], $_SESSION["flash_type"]);
?>

<div class="container-fluid px-4 mt-2 mb-0">
    <div class="alert alert-<?php echo $alertClass; ?> alert-dismissible fade show py-2 mb-2" id="flashMessage" role="alert">
        <?php echo htmlspecialchars($flashMessage); ?>

        <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
</div>
<?php endif; ?>