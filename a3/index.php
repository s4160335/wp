<?php
include "includes/db_connect.inc";

// Retrieve the four most recently added books and their sellers
$sql = "SELECT books.*, users.username
        FROM books
        LEFT JOIN users ON books.user_id = users.user_id
        ORDER BY books.created_at DESC, books.book_id DESC
        LIMIT 4";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

// Store the books so both the carousel and cards can use them
$recentBooks = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_stmt_close($stmt);

$pageTitle = "BookVerse | Home";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main>
    <!-- Home Carousel -->
<section id="bookCarousel" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">

        <?php foreach ($recentBooks as $index => $book): ?>

            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">

                <img
                    src="assets/images/covers/<?php echo htmlspecialchars($book['image_path']); ?>"
                    class="d-block w-100 carousel-image"
                    alt="<?php echo htmlspecialchars($book['title']); ?>"
                >

                <div class="carousel-caption">

                    <h2>
                        <?php echo htmlspecialchars($book['title']); ?>
                    </h2>

                    <a
                        href="details.php?id=<?php echo (int) $book['book_id']; ?>"
                        class="btn carousel-details-btn"
                    >
                        <span class="material-icons" aria-hidden="true">visibility</span>
                        View Details
                    </a>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <?php if (count($recentBooks) > 1): ?>

        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#bookCarousel"
            data-bs-slide="prev"
        >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#bookCarousel"
            data-bs-slide="next"
        >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    <?php endif; ?>
</section>

    <!-- Featured Books -->
    <section class="feature-books">
        <div class="container">
            <h1 class="section-title mb-2">
                <span class="material-icons"> favorite</span>
                Recently Added Books
            </h1>

            <div class="row g-3">
               <?php foreach ($recentBooks as $book): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        
                        <article class="card book-card h-100">
                            <img src="assets/images/covers/<?php echo htmlspecialchars($book["image_path"]); ?>"
                                class="card-img-top" alt="<?php echo htmlspecialchars($book["title"]); ?>" >

                            <div class="card-body">
                                <h2 class="card-title">
                                    <?php echo htmlspecialchars($book["title"]); ?>
                                </h2>

                                <p class="book-details">
                                    <?php echo htmlspecialchars($book["genre"]); ?>
                                    &middot;
                                    <?php echo htmlspecialchars($book["author"]); ?>
                                </p>

                                <p class="book-price">
                                    $<?php echo number_format((float) $book["price"], 2); ?>
                                </p>

                                <?php if ($book["user_id"] !== null && $book["username"] !== null): ?>
                                    <p class="book-seller">
                                        <a href="seller.php?id=<?php echo (int) $book["user_id"]; ?>">
                                            <?php echo htmlspecialchars($book["username"]); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>

                                <a href="details.php?id=<?php echo (int) $book["book_id"]; ?>" class="btn view-details-btn">
                                    <span class="material-icons">visibility</span>
                                    View Details
                                </a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php include "includes/footer.inc"; ?>