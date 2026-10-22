<?php include "includes/db_connect.inc";

if (!isset($_SESSION["user_id"])) {
    $_SESSION["flash_message"] = "Please log in to edit a book.";
    $_SESSION["flash_type"] = "error";
    header("Location: login.php");
    exit();
}

$bookId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$bookId || $bookId <= 0) {
    http_response_code(400);
    exit("Book not found.");
}

$sql = "SELECT * FROM books WHERE book_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $bookId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$book) {
    http_response_code(404);
    exit("Book not found.");
}

if ($book["user_id"] === null || (int) $book["user_id"] !== (int) $_SESSION["user_id"]) {
    http_response_code(403);
    exit("You are not authorised to edit this book.");
}

$pageTitle = "BookVerse | Edit Book";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="add-page">
    <div class="container add-container py-3">

        <div class="edit-heading mx-auto">
            <h1 class="add-title mb-3">
                <span class="material-icons">edit</span>
                Edit Book
            </h1>
        </div>

        <form id="editBookForm" class="book-form edit-form mx-auto" method="post" enctype="multipart/form-data">

            <!-- Book Title -->
            <div class="mb-3">
                <label for="bookTitle" class="form-label">
                    <span class="material-icons">title</span>
                    Book Title
                </label>

                <input type="text" class="form-control" id="bookTitle" name="bookTitle"
                    value="<?php echo htmlspecialchars($book["title"]); ?>" required>
            </div>

            <!-- Author -->
            <div class="mb-3">
                <label for="bookAuthor" class="form-label">
                    <span class="material-icons">person</span>
                    Author
                </label>

                <input type="text" class="form-control" id="bookAuthor" name="bookAuthor"
                    value="<?php echo htmlspecialchars($book["author"]); ?>" required>
            </div>

            <!-- Genre -->
            <div class="mb-3">
                <label for="genre" class="form-label">
                    <span class="material-icons">category</span>
                    Genre
                </label>

                <select class="form-select" id="genre" name="genre" required>
                    <?php $genres = ["Fiction", "Science Fiction", "Fantasy", "Dystopian", "Romance", "Memoir", "Self-Help", "Non-Fiction"];
                    foreach ($genres as $genre): ?>
                        <option value="<?php echo htmlspecialchars($genre); ?>"
                            <?php echo $book["genre"] === $genre ? "selected": "" ?>>
                            <?php echo htmlspecialchars($genre); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Price and Condition -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">
                        Price
                    </label>

                    <input type="number" class="form-control" id="price" name="price" min="0"step="0.01"
                        value="<?php echo htmlspecialchars($book["price"]); ?>" required>
                </div>

                <!-- Condition -->
                 <div class="col-md-6 mb-3">
                    <label for="condition" class="form-label">
                        Condition
                    </label>

                    <select class="form-select" id="condition" name="book_condition" required>
                        <?php $conditions = ["New", "Gently Used", "Fair"];
                        foreach ($conditions as $condition): ?>
                            <option value="<?php echo htmlspecialchars($condition); ?>"
                                <?php echo $book["book_condition"] === $condition ? "selected" : "" ?>>
                                <?php echo htmlspecialchars($condition); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">
                    Description
                </label>

                <textarea class="form-control" id="description" name="description" rows="4"
                    required><?php echo htmlspecialchars($book["description"] ?? ""); ?></textarea>
            </div>
            
            <!-- Available Status -->
            <div class="mb-3">
                <label for="status" class="form-label">
                    Status *
                </label>

                <select class="form-select" id="status" name="status" required>
                    <?php $statuses = ["Available", "Reserved", "Sold"];

                    foreach ($statuses as $status): ?>
                        <option value="<?php echo htmlspecialchars($status); ?>"
                            <?php echo $book["status"] === $status ? "selected" : "" ?>>
                            <?php echo htmlspecialchars($status); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Cover image -->
            <div class="mb-3">
                <label for="coverImage" class="form-label">
                    Cover Image
                </label>

                <!-- Current Cover -->
                <div class="mb-3">
                    <img src="assets/images/covers/<?php echo htmlspecialchars($book["image_path"]); ?>"
                        alt="<?php echo htmlspecialchars($book["title"]); ?> cover" class="edit-cover-preview">
                </div>

                <!-- Optional Replacement -->
                <input type="file" class="form-control" id="coverImage" name="image_path" accept=".jpg, .jpeg, .png">
                <small class="form-text text-muted">
                    Leave empty to keep the current cover image.
                </small>
            </div>

            <!-- Save Changes Button -->
            <button type="submit" class="btn add-book-btn w-100">
                <span class="material-icons">save</span>
                Save Changes
            </button>
        </form>
    </div>
</main>
<?php include "includes/footer.inc"; ?>
