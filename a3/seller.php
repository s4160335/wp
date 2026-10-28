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

            <!-- Seller's Books -->
            <section class="col-12 col-lg-8">
                <h2 class="seller-books-title">
                    Books by <?php echo htmlspecialchars($seller["username"]); ?>
                </h2>

                <?php if (empty($books)) : ?>
                    <p class="text-light">
                        This seller has not listed any books yet.
                    </p>
                <?php else: ?>

                    <div class="row g-3">
                        <?php foreach($books as $book): ?>
                            <div class="col-12 col-sm-6 col-md-4">

                                <article class="card seller-book-card h-100">
                                    <img src="assets/images/covers/<?php echo htmlspecialchars($book["image_path"] ?? "placeholder.jpg"); ?>"
                                        class="card-img-top seller-book-image" alt="<?php echo htmlspecialchars($book["title"]); ?> cover">

                                    <div class="card-body">
                                        <h3 class="seller-book-title">
                                            <?php echo htmlentities($book["title"]); ?>
                                        </h3>

                                        <p class="seller-book-price">
                                            $<?php echo number_format((float) $book["price"], 2); ?>
                                        </p>

                                        <a href="details.php?id=<?php echo (int) $book["book_id"]; ?>" 
                                            class="btn btn-sm seller-view-btn">
                                            View
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </div>
</main>
<?php include "includes/footer.inc"; ?>