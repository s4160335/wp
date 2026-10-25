<?php include "includes/db_connect.inc";

$sellerId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$sellerId || $sellerId <= 0) {
    http_response_code(400);
    exit("Invalid seller ID.");
}

$sql = "SELECT user_id, username, location, bio FROM users WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $sellerId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$seller = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$seller) {
    http_response_code(404);
    exit("Seller not found.");
}

$booksSql = "SELECT book_id, title, price, image_path, status FROM books WHERE user_id = ? ORDER BY created_at DESC";

$booksStmt = mysqli_prepare($conn, $booksSql);
mysqli_stmt_bind_param($booksStmt, "i", $sellerId);
mysqli_stmt_execute($booksStmt);
$booksResult = mysqli_stmt_get_result($booksStmt);
$books = mysqli_fetch_all($booksResult, MYSQLI_ASSOC);
mysqli_stmt_close($booksStmt);

$pageTitle = "BookVerse | Seller Profile";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="seller-page">
    <div class="container seller-container">
        <div class="row g-3 align-items-start">

            <aside class="col-12 col-lg-4">
                <div class="seller-profile">
                    <h2 class="seller-username">
                        <?php echo htmlspecialchars($seller["username"]); ?>
                    </h2>

                    <p class="seller-location">
                        <?php echo htmlspecialchars($seller["location"] ?: "Location not provided"); ?>
                    </p>

                    <p class="seller-bio">
                        <?php echo htmlspecialchars($seller["bio"] ?: "No biography provided."); ?>
                    </p>
                </div>
            </aside>
        </div>
    </div>
</main>
<?php include "includes/footer.inc"; ?>