<?php include "includes/db_connect.inc";

$keyword = trim($_GET["keyword"] ?? "");
$books = [];
$searched = isset($_GET["keyword"]);

if ($searched && $keyword !== "") {
    $searchTerm = "%" . $keyword . "%";
    $sql = "SELECT book_id, title, author, image_path FROM books WHERE title LIKE ? 
        OR author LIKE ? OR description LIKE?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $searchTerm, $searchTerm, $searchTerm);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
}

$pageTitle = "BookVerse | Search Books";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="search-page">
    <div class="container search-container">

        <h1 class="search-title">
            <span class="material-icons">search</span>
            Search Books
        </h1>

        <div class="search-form-container">
            <form action="search.php" method="get" role="search">
                <div class="input-group">
                    <input type="search" class="form-control" id="keyword" name="keyword" placeholder="Search books by title, author or description" 
                        aria-label="Search books" value="<?php echo htmlspecialchars($keyword); ?>">
                    
                    <button type="submit" class="btn search-btn">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <?php if ($searched): ?>
            <?php if ($keyword === ""): ?>
                <p class="search-message">
                    Please enter a keyword to search.
                </p>

            <?php elseif (empty($books)) : ?>
                <p class="search-message">
                    No books found matching your search.
                </p>

            <?php else: ?>
                <div class="row g-3 search-results">

                    <?php foreach ($books as $book): ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <article class="card search-book-card h-100">
                                
                                <img src="assets/images/covers/<?php echo htmlspecialchars($book["image_path"] ?? "Placeholder.jpg") ?>"
                                    class="card-img-top search-book-image" alt="<?php echo htmlspecialchars($book["title"]); ?> cover">
                                
                                <div class="card-body">
                                    <h2 class="search-book-title">
                                        <?php echo htmlspecialchars($book["title"]); ?>
                                    </h2>

                                    <p class="search-book-author">
                                        <?php echo htmlspecialchars($book["author"]) ?>
                                    </p>
                                    <a href="details.php?id=<?php echo (int) $book["book_id"]; ?>" class="btn btn-sm search-view-btn">
                                        view
                                    </a>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>
<?php include "includes/footer.inc"; ?>