<?php
include "includes/db_connect.inc";

$sql = "SELECT * FROM books ORDER BY book_id ASC";
$result = mysqli_query($conn, $sql);

$pageTitle = "BookVerse | Gallery";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="gallery-page">
    <div class="container gallery-container py-5">
        <h1 class="gallery-title mb-4">
            <span class="material-icons">collections</span>
            Book Cover Gallery
        </h1>

        <div class="row g-3">
            <?php while ($book = mysqli_fetch_assoc($result)): ?>
                <div class="col-6 col-md-4 col-lg-2">
                    
                    <button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
                        data-image="assets/images/covers/<?php echo htmlspecialchars($book["image_path"]); ?>"
                        data-title="<?php echo htmlspecialchars($book["title"]); ?>">

                        <img src="assets/images/covers/<?php echo htmlspecialchars($book["image_path"]); ?>"
                            class="img-fluid" alt="<?php echo htmlspecialchars($book["title"]); ?>">
                    </button>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Bootstrap Modal -->
        <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog"
            aria-labelledby="galleryModalLabel" aria-hidden="true">
            
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content gallery-modal">
                <div class="modal-header">
                    <h2 class="modal-title" id="galleryModalLabel">
                        Book Cover
                    </h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body text-center">
                    <img id="modalImage" src="assets/images/covers/1.png" class="img-fluid" alt="Selected book cover">
                </div>
                
                <!-- Modal Navigation -->
                <div class="modal-footer">
                    <button type="button" id="previousImage" class="btn btn-secondary btn-sm">
                        &lsaquo; Previous
                    </button>

                    <button type="button" id="nextImage" class="btn btn-primary btn-sm">
                            Next &rsaquo;
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.inc"; ?>