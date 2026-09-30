<?php include "includes/db_connect.inc";

$message ="";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["bookTitle"] ?? "");
    $author = trim($_POST["bookAuthor"] ?? "");
    $genre = trim($_POST["genre"] ?? "");
    $publicationYear = (int) ($_POST["publication_year"] ?? 0);
    $isbn = trim($_POST["isbn"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $bookCondition = $_POST["book_condition"] ?? "";
    $price = (float) ($_POST["price"] ?? 0);
    $status = $_POST["status"] ?? "";

    if ($title === "" || $author === "" || $genre === "" || $publicationYear <= 0 || $isbn === "" || 
        $description === "" ||$bookCondition === "" || $price < 0 || $status === "") {
            $errors[] = "Please complete all required fields correctly.";
        }
    
    $allowedConditions = ["New", "Gently Used", "Fair"];
    $allowedStatuses = ["Available", "Reserved", "Sold"];

    if (!in_array($bookCondition, $allowedConditions, true)) {
        $errors[] = "Invalid book condition.";
    }

    if (!in_array($status, $allowedStatuses, true)) {
        $errors[] = "Invalid availability status.";
    }

    $imagePath ="";

    if (isset($_FILES["image_path"]) && $_FILES["image_path"]["error"] === UPLOAD_ERR_OK) {
        $originalName = $_FILES["image_path"]["name"];
        $temporaryName = $_FILES["image_path"]["tmp_name"];

        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExtensions = ["jpg", "jpeg", "png", "gif", "webp"];

        if (in_array($extension, $allowedExtensions, true)) {

            $newFileName = uniqid("book_", true) . "." .$extension;
            $uploadPath = "assets/images/covers/" . $newFileName;

            if (move_uploaded_file($temporaryName, $uploadPath)) {
                $imagePath = $newFileName;
            }else{
                $errors[] = "The cover image could not be uploaded.";
            }
        }
    }

    if (empty($errors) && $imagePath !== "") {
        $sql = "INSERT INTO books (title, author, genre, publication_year, isbn, description, book_condition, price, image_path, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "sssisssdss", $title, $author, $genre, $publicationYear, $isbn, $description, $bookCondition,
            $price, $imagePath, $status);
        
        if (mysqli_stmt_execute($stmt)) {
            $message = "Book added successfully.";
        
        }else {
            $message = "Book could not be added.";
        }
        mysqli_stmt_close($stmt);
    }elseif ($imagePath === "" && empty($errors)) {
        $message = "Please upload a valid image.";

    }elseif (!empty($errors)) {
        $message = $errors[0];
    }
}
?>

<?php
$pageTitle = "BookVerse | Add Book";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="add-page">
    <div class="container add-container py-3">
        <h1 class="add-title mb-3">
            <span class="material-icons">add_box</span>
            Add new Book
        </h1>

        <?php if ($message !== ""): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form id="addBookForm" class="book-form" method="post" enctype="multipart/form-data">

            <!-- Book Title -->
             <div class="mb-3">
                <label for="bookTitle" class="form-label">
                    <span class="material-icons">title</span>
                    Book Title
                </label>

                <input type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Enter book title" required>
            </div>

            <!-- Author -->
            <div class="mb-3">
                <label for="bookAuthor" class="form-label">
                    <span class="material-icons">person</span>
                    Author
                </label>

                <input type="text" class="form-control" id="bookAuthor" name="bookAuthor" placeholder="Enter author name" required>
            </div>

            <!-- Genre -->
            <div class="mb-3">
                <label for="genre" class="form-label">
                    <span class="material-icons">category</span>
                    Genre
                </label>

                <select class="form-select" id="genre" name="genre" required>
                    <option value="" selected disabled>Select genre</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Science Fiction">Science Fiction</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Dystopian">Dystopian</option>
                    <option value="Romance">Romance</option>
                    <option value="Memoir">Memoir</option>
                    <option value="Self-Help">Self-Help</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                </select>
            </div>

            <!-- Year and Price -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="publicationYear" class="form-label">
                        <span class="material-icons">calendar_today</span>
                        Publication Year
                    </label>

                    <input type="number" class="form-control" id="publicationYear" name="publication_year" placeholder="2024" min="1000" max="2026" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">
                        <span class="material-icons">attach_money</span>
                        Price
                    </label>

                    <input type="number" class="form-control" id="price" name="price" placeholder="19.99" min="0" step="0.01" required>
                </div>
            </div>

            <!-- ISBN and Condition -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="isbn" class="form-label">
                        ISBN
                    </label>

                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="978-3-16-148410-0" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="condition" class="form-label">
                        <span class="material-icons">inventory_2</span>
                        Book Condition
                    </label>

                    <select class="form-select" id="condition" name="book_condition" required>
                        <option value="" selected disabled>Select condition</option>
                        <option value="New">New</option>
                        <option value="Gently Used">Gently Used</option>
                        <option value="Fair">Fair</option>
                    </select>  
                </div>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">
                    <span class="material-icons">description</span>
                    Description
                </label>

                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe the book" required></textarea>
            </div>
            <div class="mb-3">
                <label for="coverImage" class="form-label">
                    <span class="material-icons">image</span>
                    Upload Cover Image
                </label>

                <input type="file" class="form-control" id="coverImage" name="image_path" accept=".jpg, .jpeg, .png, .gif, .webp" required>
                <div id="imageError" class="invalid-feedback"></div>
            </div>

            <!-- Image Preview -->
            <div id="imagePreviewContainer" class="image-preview-container d-none">
                <p class="preview-file-name" id="previewFileName"></p>
            </div>

            <!-- Availability -->
            <div class="mb-3">
                <label for="availability" class="form-label">
                    <span class="material-icons">verified</span>
                    Availability Status
                </label>

                <select class="form-select" id="availability" name="status" required>
                    <option value="" selected disabled>Select status</option>
                    <option value="Available">Available</option>
                    <option value="Reserved">Reserved</option>
                    <option value="Sold">Sold</option>
                </select>
            </div>

            <!-- Agreement -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreement" name="agree" required>
                <label class="form-check-label" for="agreement">
                    I agree that this book information is accurate and complete.
                </label>
            </div>

            <!-- Submit -->
             <button type="submit" class="btn add-book-btn w-100">
                <span class="material-icons">library_add</span>
                Add Book to Collection
            </button>
        </form>
    </div>
</main>
<?php include "includes/footer.inc"; ?>