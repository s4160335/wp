<?php
include "includes/db_connect.inc";
$pageTitle = "BookVerse | Home";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main>
    <!-- Home Carousel-->
    <section id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/covers/1.png" class="d-block w-100 carousel-image"
                    alt="The Midnight Library">

                <div class="carousel-caption">
                    <h2>The Midnight Library</h2>

                    <a href="details.php?id=1" class="btn carousel-details-btn">
                        <span class="material-icons">visibility</span>
                        View Details
                    </a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="assets/images/covers/2.png" class="d-block w-100 carousel-image" alt="Project Hail Mary">
                <div class="carousel-caption">
                    <h2>Project Hail Mary</h2>

                    <a href="details.php?id=2" class="btn carousel-details-btn">
                        <span class="material-icons">visibility</span>
                        View Details
                    </a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="assets/images/covers/3.png" class="d-block w-100 carousel-image" alt="Dune">
                <div class="carousel-caption">
                    <h2>Dune</h2>

                    <a href="details.php?id=3" class="btn carousel-details-btn">
                        <span class="material-icons">visibility</span>
                        View Details
                    </a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="assets/images/covers/4.png" class="d-block w-100 carousel-image" alt="The Hobbit">
                <div class="carousel-caption">
                    <h2>The Hobbit</h2>

                    <a href="details.php?id=4" class="btn carousel-details-btn">
                        <span class="material-icons">visibility</span>
                        View Details
                </a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>

    <!-- Featured Books -->
    <section class="feature-books">
        <div class="container">
            <h1 class="section-title mb-2">
                <span class="material-icons"> favorite</span>
                Featured Books
            </h1>

            <div class="row g-3">
               <?php while ($book = mysqli_fetch_assoc($result)): ?>
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

                                <a href="details.php?id=<?php echo $book["book_id"]; ?>" class="btn view-details-btn">
                                    <span class="material-icons">visibility</span>
                                    View Details
                                </a>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</main>

<?php include "includes/footer.inc"; ?>