/* jshint esversion: 6 */
//Books Page Status Filter
const statusFilter = document.getElementById("statusFilter");

if (statusFilter) {
    const bookRows = document.querySelectorAll(".books-table tbody tr");
    statusFilter.addEventListener("change", function () {
        const selectedStatus = statusFilter.value;
		
		statusFilter.classList.remove("filter-available", "filter-reserved", "filter-sold");
		
		if (selectedStatus !== "all") {
			statusFilter.classList.add("filter-" + selectedStatus);
		}
		
        bookRows.forEach(function (row) {
            const bookStatus = row.dataset.status;

            if (selectedStatus === "all" || bookStatus === selectedStatus) {
                row.classList.remove("d-none");
            } else {
                row.classList.add("d-none");
            }
        });
    });
}

// Gallery Modal
const galleryModal = document.getElementById("galleryModal");

if (galleryModal) {
    const galleryItems = document.querySelectorAll(".gallery-item");
    const modalImage = document.getElementById("modalImage");
    const modalTitle = document.getElementById("galleryModalLabel");
    const previousButton = document.getElementById("previousImage");
    const nextButton = document.getElementById("nextImage");
    let currentImage = 0;

    // Display selected image
    const showImage = function (index) {
        const selectedItem = galleryItems[index];

        modalImage.src = selectedItem.dataset.image;
        modalImage.alt = selectedItem.dataset.title;
        modalTitle.textContent = selectedItem.dataset.title;

        currentImage = index;
    };

    // Open clicked image
    galleryModal.addEventListener("show.bs.modal", function (event) {
        const selectedItem = event.relatedTarget;

        currentImage = Array.from(galleryItems).indexOf(selectedItem);
        showImage(currentImage);
    });

    // Previous image
    previousButton.addEventListener("click", function () {
        currentImage--;

        if (currentImage < 0) {
            currentImage = galleryItems.length - 1;
        }

        showImage(currentImage);
    });

    // Next image
    nextButton.addEventListener("click", function () {
        currentImage++;

        if (currentImage >= galleryItems.length) {
            currentImage = 0;
        }

        showImage(currentImage);
    });
}

// Add Book - Image Validation and Preview
const coverImage = document.getElementById("coverImage");

if (coverImage) {
	const imagePreviewContainer = document.getElementById("imagePreviewContainer");
	
	const imagePreview = document.createElement("img");
	imagePreview.id = "imagePreview";
	imagePreview.alt = "Book cover preview";
	imagePreviewContainer.appendChild(imagePreview);
	
	const previewFileName = document.getElementById("previewFileName");
	const imageError = document.getElementById("imageError");
	
	const allowedExtensions = ["jpg", "jpeg", "png", "gif", "webp"];
	coverImage.addEventListener("change", function () {
		const file = coverImage.files[0];
		
		if (!file) {
			return;
		}
		
		const extension = file.name.split(".").pop().toLowerCase();
		
		if (!allowedExtensions.includes(extension)) {
			imageError.textContent = "Please select a JPG, JPEG, PNG, GIF, or WEBP image.";
			
			coverImage.classList.add("is-invalid");
			imagePreviewContainer.classList.add("d-none");
			coverImage.value = "";
			return;
		}
		
		coverImage.classList.remove("is-invalid");
		imageError.textContent = "";
		
		previewFileName.textContent = "Selected: " + file.name;
		imagePreview.src = URL.createObjectURL(file);
		
		imagePreviewContainer.classList.remove("d-none");
	});
}