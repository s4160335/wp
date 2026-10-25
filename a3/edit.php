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

if (empty($_SESSION["edit_csrf_token"])) {
    $_SESSION["edit_csrf_token"] = bin2hex(random_bytes(32));
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $submittedToken = $_POST["csrf_token"] ?? "";

    if (!is_string($submittedToken) || !hash_equals($_SESSION["edit_csrf_token"], $submittedToken)) {
        http_response_code(403);
        exit("Invalid security token.");
    }

    $title = trim($_POST["bookTitle"] ?? "");
    $author = trim($_POST["bookAuthor"] ?? "");
    $genre = trim($_POST["genre"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $condition = $_POST["book_condition"] ?? "";
    $priceInput = trim($_POST["price"] ?? "");
    $status = trim($_POST["status"] ?? "");

    if ($title === "" || $author === "" || $genre === "" || $description === "" || $condition === "" || $priceInput === "" || $status === "") {
        $errors [] = "Please complete all required field.";
    }

    $allowedGenres = ["Fiction", "Science Fiction", "Fantasy", "Dystopian", "Romance", "Memoir", "Self-Help", "Non-Fiction"];
    if (!in_array($genre, $allowedGenres, true)) {
        $errors [] = "Please select a valid genre.";
    }

    $allowedConditions = ["New", "Gently Used", "Fair"];
    if (!in_array($condition, $allowedConditions, true)) {
        $errors [] = "Please select a valid condition.";
    }

    $allowedStatuses = ["Available", "Reserved", "Sold"];
    if (!in_array($status, $allowedStatuses, true)) {
        $errors [] = "Please select a valid satus";
    }

    if (!is_numeric($priceInput) || !is_finite((float) $priceInput) || (float) $priceInput < 0) {
        $errors [] = "Please enter a valid price.";
    }

    $newImage = $_FILES["image_path"] ?? null;
    $hasNewImage = $newImage !== null && $newImage["error"] !== UPLOAD_ERR_NO_FILE;

    if ($hasNewImage) {
        if ($newImage["error"] !== UPLOAD_ERR_OK) {
            $errors[] = "There was a problem uploading the cover image.";
        } else {

            $allowedExtensions = ["jpg", "jpeg", "png", "gif", "webp"];
            $extension = strtolower(pathinfo($newImage["name"], PATHINFO_EXTENSION));

            if (!in_array($extension, $allowedExtensions, true)) {
                $errors[] = "Only JPG, JPEG, PNG, GIF and WEBP images are allowed.";
            }

            if ($newImage["size"] > 5 * 1024 * 1024) {
                $errors[] = "The cover image must not exceed 5 MB.";
            }

            if (!getimagesize($newImage["tmp_name"])) {
                $errors[] = "The selected file is not a valid image.";
            }
        }
    }

    if (empty($errors)) {
        $price = (float) $priceInput;
        $userId = (int) $_SESSION["user_id"];

        $imagePath = $book["image_path"];
        $newImagePath = null;

        if ($hasNewImage) {
            $newImagePath = uniqid("book_", true) . "." . $extension;
            $destination = __DIR__ . "/assets/images/covers/" . $newImagePath;

            if (move_uploaded_file($newImage["tmp_name"], $destination)) {
                $imagePath = $newImagePath;
            } else {
                $errors[] = "Unable to save the replacement cover image.";
            }
        }
    }

    if (empty($errors)) {
        $updateSql = "UPDATE books SET title = ?, author = ?, genre = ?, price = ?, book_condition = ?, 
            description = ?, status = ?, image_path = ? WHERE book_id = ? AND user_id = ?";
        
        $updateStmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "sssdssssii", $title, $author, $genre, $price, $condition, 
            $description, $status, $imagePath, $bookId, $userId);
    
        if (mysqli_stmt_execute($updateStmt)) {
            mysqli_stmt_close($updateStmt);

            if ($newImagePath !== null) {
                $oldImageName = $book["image_path"];

                $validFilename = is_string($oldImageName) &&
                        preg_match('/^book_[a-f0-9]{13,14}\.[0-9]{8}\.(jpg|jpeg|png|gif|webp)$/i', $oldImageName);

                if ($validFilename && $oldImageName !== $newImagePath) {
                    $checkSql = "SELECT COUNT(*) FROM books WHERE image_path = ?";
                    $checkStmt = mysqli_prepare($conn, $checkSql);
                    
                    mysqli_stmt_bind_param($checkStmt, "s", $oldImageName);
                    mysqli_stmt_execute($checkStmt);
                    mysqli_stmt_bind_result($checkStmt, $imageCount);
                    mysqli_stmt_fetch($checkStmt);
                    mysqli_stmt_close($checkStmt);

                    if ((int) $imageCount === 0) {
                        $oldImageName = __DIR__ . "/assets/images/covers/" . $oldImageName;

                        if (is_file($oldImageName)) {
                            if (!unlink($oldImageName)) {
                                error_log("Unable to delete previos cover: " . $oldImageName);
                            }
                        }
                    }
                }
            }

            $_SESSION["flash_message"] = "Book updated successfully.";
            $_SESSION["flash_type"] = "success";

            header("Location: details.php?id=" . $bookId);
            exit();
        }else {
            $errors [] = "Unable to update the book. Please try again.";
            mysqli_stmt_close($updateStmt);

            if ($newImagePath !== null) {
                $newFile = __DIR__ . "/assets/images/covers/" . $newImagePath;

                if (is_file($newFile)) {
                    unlink($newFile);
                }
            }
        }
    }
}



$pageTitle = "BookVerse | Edit Book";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="add-page">
    <?php if (!empty($errors)): ?>
        <div class="container mt-3">
            <div class="alert alert-danger" role="alert">
                <?php foreach ($errors as $error): ?>
                    <p class="mb-1"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="container add-container py-3">

        <div class="edit-heading mx-auto">
            <h1 class="add-title edit-title mb-3">
                <span class="material-icons">edit</span>
                Edit Book
            </h1>
        </div>

        <form id="editBookForm" class="book-form edit-form mx-auto" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["edit_csrf_token"]); ?>">

            <!-- Book Title -->
            <div class="mb-3">
                <label for="bookTitle" class="form-label">
                    Title *
                </label>

                <input type="text" class="form-control" id="bookTitle" name="bookTitle"
                    value="<?php echo htmlspecialchars($book["title"]); ?>" required>
            </div>

            <!-- Author -->
            <div class="mb-3">
                <label for="bookAuthor" class="form-label">
                    Author *
                </label>

                <input type="text" class="form-control" id="bookAuthor" name="bookAuthor"
                    value="<?php echo htmlspecialchars($book["author"]); ?>" required>
            </div>

            <!-- Genre -->
            <div class="mb-3">
                <label for="genre" class="form-label">
                    Genre *
                </label>

                <select class="form-select" id="genre" name="genre">
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
                        Price *
                    </label>

                    <input type="number" class="form-control" id="price" name="price" min="0" step="0.01"
                        value="<?php echo htmlspecialchars($book["price"]); ?>" required>
                </div>

                <!-- Condition -->
                 <div class="col-md-6 mb-3">
                    <label for="condition" class="form-label">
                        Condition *
                    </label>

                    <select class="form-select" id="condition" name="book_condition">
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
                    Description *
                </label>

                <textarea class="form-control" id="description" name="description" rows="3"
                    required><?php echo htmlspecialchars($book["description"] ?? ""); ?></textarea>
            </div>
            
            <!-- Available Status -->
            <div class="mb-3">
                <label for="status" class="form-label">
                    Status *
                </label>

                <select class="form-select" id="status" name="status">
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