<?php
include "includes/db_connect.inc";
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

		<form id="addBookForm" class="book-form">

			<!-- Book Title -->
			<div class="mb-3">
				<label for="bookTitle" class="form-label">
					<span class="material-icons">title</span>
					Book Title
				</label>

				<input type="text" class="form-control" id="bookTitle" name="title" placeholder="Enter book title" required>
			</div>

			<!-- Author -->
			<div class="mb-3">
				<label for="bookAuthor" class="form-label">
					<span class="material-icons">person</span>
					Author Name
				</label>

				<input type="text" class="form-control" id="bookAuthor" name="author" placeholder="Enter author name" required>
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
					<option value="dystopian">Dystopian</option>
					<option value="romance">Romance</option>
					<option value="memoir">Memoir</option>
					<option value="self-help">Self-Help</option>
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

					<input type="number" class="form-control" id="publicationYear" name="publication_year" placeholder="2024" required>
				</div>

				<div class="col-md-6 mb-3">
					<label for="price" class="form-label">
						<span class="material-icons">attach_money</span>
						Price
					</label>

					<input type="number" class="form-control" id="price" name="price" placeholder="19.99" step="0.01" required>
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
						<option value="new">New</option>
						<option value="gently-used">Gently Used</option>
						<option value="fair">Fair</option>
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

				<!-- Image Preview -->
				 <div id="imagePreviewContainer" class="image-preview-container d-none">
					<p class="preview-file-name" id="previewFileName"></p>
				 </div>
			</div>

			 <!-- Availability -->
			<div class="mb-3">
				<label for="availability" class="form-label">
					<span class="material-icons">verified</span>
					Availability Status
				</label>

				<select class="form-select" id="availability" name="status" required>
					<option value="" selected disabled>Select status</option>
					<option value="available">Available</option>
					<option value="reserved">Reserved</option>
					<option value="sold">Sold</option>
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