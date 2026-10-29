<?php
include "includes/db_connect.inc";

if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

$book = null;

if (isset($_GET["id"])) {
    $bookId = (int) $_GET["id"];
    $sql = "SELECT books.*, users.username FROM books LEFT JOIN users ON books.user_id = users.user_id
        WHERE book_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $bookId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $book = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);
}

$isOwner = $book && isset($_SESSION["user_id"]) && $book["user_id"] !== null
    && (int) $book["user_id"] === (int) $_SESSION["user_id"];

// Handle book deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_book"])) {

    // Check that the user is logged in
    if (!isset($_SESSION["user_id"])) {
        http_response_code(403);
        exit("You must be logged in to delete a book.");
    }

    if (!isset($_POST["csrf_token"]) || !is_string($_POST["csrf_token"]) || !hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])) {
        http_response_code(403);
        exit("Invalid security token.");
    }

    // Check that the logged-in user owns this book
    if (!$isOwner) {
        http_response_code(403);
        exit("You are not authorised to delete this book.");
    }

    // Delete the book using a prepared statement
    $deleteSql = "DELETE FROM books WHERE book_id = ? AND user_id = ?";
    $deleteStmt = mysqli_prepare($conn, $deleteSql);

    $userId = (int) $_SESSION["user_id"];

    mysqli_stmt_bind_param($deleteStmt, "ii", $bookId, $userId);
    mysqli_stmt_execute($deleteStmt);

    $deleted = mysqli_stmt_affected_rows($deleteStmt) === 1;

    mysqli_stmt_close($deleteStmt);

    if ($deleted) {
        $imageName = $book["image_path"];

        $validFilename = is_string($imageName) &&
            preg_match('/^book_[a-f0-9]{13,14}\.[0-9]{8}\.(jpg|jpeg|png|gif|webp)$/i', $imageName);
            
        if ($validFilename) {
            $checkSql = "SELECT COUNT(*) FROM books WHERE image_path = ?";
            $checkStmt = mysqli_prepare($conn, $checkSql);

            mysqli_stmt_bind_param($checkStmt, "s", $imageName);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_bind_result($checkStmt, $imageCount);
            mysqli_stmt_fetch($checkStmt);
            mysqli_stmt_close($checkStmt);

            if ((int) $imageCount === 0) {
                $imagePath = __DIR__ . "/assets/images/covers/" . $imageName;

                if (is_file($imagePath)) {
                    if (!unlink($imagePath)){
                        error_log("Unable to delete uploaded cover: " . $imagePath);
                    }
                }
            }
        }

        $_SESSION["flash_message"] = "Book deleted successfully.";
        $_SESSION["flash_type"] = "success";

        header("Location: books.php");
        exit;
    }

    // Handle unsuccessful deletion
    $_SESSION["flash_message"] = "Unable to delete the book.";
    $_SESSION["flash_type"] = "error";

    header("Location: details.php?id=" . $bookId);
    exit;
}

if (!$book) {
    http_response_code(404);
}

$pageTitle = $book
    ?"BookVerse | " . $book["title"]
    :"BookVerse | Book Details";

include "includes/header.inc";
include "includes/nav.inc";
?>

<?php if (!$book): ?>
    <main class="details-page">
        <div class="container py-5">
            <p>Book not found.</p>
        </div>
    </main>

    <?php include "includes/footer.inc"; ?>
    <?php exit; ?>
    <?php endif; ?>

<main class="details-page">
    <div class="container py-3">

        <div class="row align-items-start">

            <!-- Book Cover -->
            <div class="col-md-4">
                <img src="assets/images/covers/<?php echo htmlspecialchars($book["image_path"]); ?>"
                    class="details-image" alt="<?php echo htmlspecialchars($book["title"]); ?> cover">
            </div>

            <!-- Book Details -->
            <div class="col-md-7 details-content">

                <h1 class="details-book-title">
                    <?php echo htmlspecialchars($book["title"]); ?>
                </h1>

                <p class="details-author">
                    by <?php echo htmlspecialchars($book["author"]); ?>
                </p>
                
                <?php $status = strtolower($book["status"]); ?>
                <span class="badge status-<?php echo htmlspecialchars($status); ?>">
                    <?php echo htmlspecialchars($book["status"]); ?>
                </span>

                <!-- Information Box -->
                <div class="details-info-box">

                    <div class="details-row">
                        <strong>Genre:</strong>
                        <span><?php echo htmlspecialchars($book["genre"]); ?></span>
                    </div>

                    <div class="details-row">
                        <strong>Publication Year:</strong>
                        <span><?php echo htmlspecialchars($book["publication_year"]); ?></span>
                    </div>

                    <div class="details-row">
                        <strong>ISBN:</strong>
                        <span><?php echo htmlspecialchars($book["isbn"]); ?></span>
                    </div>

                    <div class="details-row">
                        <strong>Condition:</strong>
                        <span><?php echo htmlspecialchars($book["book_condition"]); ?></span>
                    </div>

                    <div class="details-row">
                        <strong>Price:</strong>
                        <span class="details-price">
                            $<?php echo number_format((float) $book["price"], 2); ?>
                        </span>
                    </div>

                    <!-- Seller Information -->
                    <div class="details-row">
                        <strong>Seller:</strong>

                        <span>
                            <?php if ($book["user_id"] !== null && $book["username"] !== null): ?>
                                <a href="seller.php?id=<?php echo (int) $book["user_id"]; ?>">
                                    <?php echo htmlspecialchars($book["username"]); ?>
                                </a>
                            <?php else: ?>
                                <span>Unknown Seller</span>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="details-description mt-3">
                    <h2>Description</h2>

                    <p>
                        <?php echo htmlspecialchars($book["description"] ?? ""); ?>
                    </p>
                </div>

                <!-- Buttons -->
                <div class="details-actions">

                    <a href="books.php" class="btn details-back-btn">
                        Back
                    </a>

                    <?php if ($isOwner): ?>
                        <a href="edit.php?id=<?php echo (int) $book["book_id"]; ?>" class="btn btn-warning">
                            Edit
                        </a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBookModal">
                            Delete
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ($isOwner): ?>
        <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="deleteBookModalLabel">
                            Confirm Delete
                        </h2>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete
                        <strong><?php echo htmlspecialchars($book["title"]); ?></strong>?
                        This action cannot be undone.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form method="POST" action="details.php?id=<?php echo (int) $book["book_id"]; ?>">
                            <input type="hidden" name="delete_book" value="1">

                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]); ?>">
                            <button type="submit" class="btn btn-danger">
                                Delete Book
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>
<?php include "includes/footer.inc"; ?>