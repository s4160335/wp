<?php
include "includes/db_connect.inc";
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
			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/1.png" data-title="The Midnight Library">
					<img src="assets/images/covers/1.png" class="img-fluid" alt="The Midnight Library">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/2.png" data-title="Project Hail Mary">
					<img src="assets/images/covers/2.png" class="img-fluid" alt="Project Hail Mary">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/3.png" data-title="Dune">
					<img src="assets/images/covers/3.png" class="img-fluid" alt="Dune">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/4.png" data-title="The Hobbit">
					<img src="assets/images/covers/4.png" class="img-fluid" alt="The Hobbit">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/5.png" data-title="1984">
					<img src="assets/images/covers/5.png" class="img-fluid" alt="1984">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/6.png" data-title="Pride and Prejudice">
					<img src="assets/images/covers/6.png" class="img-fluid" alt="Pride and Prejudice">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/7.png" data-title="To Kill a Mockingbird">
					<img src="assets/images/covers/7.png" class="img-fluid" alt="To Kill a Mockingbird">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/8.png" data-title="The Great Gatsby">
					<img src="assets/images/covers/8.png" class="img-fluid" alt="The Great Gatsby">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/9.png" data-title="Educated">
					<img src="assets/images/covers/9.png" class="img-fluid" alt="Educated">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/10.png" data-title="The Seven Husbands">
					<img src="assets/images/covers/10.png" class="img-fluid" alt="The Seven Husbands">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/11.png" data-title="Atomic Habits">
					<img src="assets/images/covers/11.png" class="img-fluid" alt="Atomic Habits">
				</button>
			</div>

			<div class="col-6 col-md-4 col-lg-2">
				<button class="gallery-item" type="button" data-bs-toggle="modal" data-bs-target="#galleryModal"
					data-image="assets/images/covers/12.png" data-title="Sapiens">
					<img src="assets/images/covers/12.png" class="img-fluid" alt="Sapiens">
				</button>
			</div>
		</div>
	</div>

	<!-- Bootstrap Modal -->
	 <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel" aria-hidden="true">
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