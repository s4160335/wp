<?php
include "includes/db_connect.inc";

$book = null;

if (isset($_GET["id"])) {
    $bookId = (int) $_GET["id"];
    $sql = "SELECT * FROM books WHERE book_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $bookId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $book = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);
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
                    <?php echo htmlspecialchars($book["author"]); ?>
                </p>
                
                <?php $status = strtolower($book["status"]); ?>
                <span class="badge status-<?php echo $status; ?>">
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

                </div>

                <!-- Description -->
                <div class="details-description mt-3">
                    <h2>Description</h2>

                    <p>
                        <?php echo htmlspecialchars($book["description"]); ?>
                    </p>
                </div>

                <!-- Buttons -->
                <div class="details-actions">

                    <a href="books.php" class="btn details-back-btn">
                        <span class="material-icons">arrow_back</span>
                        Back to Books
                    </a>

                    <a href="add.php" class="btn details-add-btn">
                        <span class="material-icons">add</span>
                        Add Similar Book
                    </a>

                </div>

            </div>
        </div>

    </div>
</main>

<?php include "includes/footer.inc"; ?>