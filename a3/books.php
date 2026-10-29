<?php include "includes/db_connect.inc";

$sql ="SELECT books.*, users.username FROM books LEFT JOIN users ON books.user_id = users.user_id
    ORDER BY books.book_id ASC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<?php
$pageTitle = "BookVerse | Browse Books";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="books-page">
    <div class="container books-container py-5">
        
        <!-- Page Heading-->
            <h1 class="books-title mb-4">
            <span class="material-icons">library_books</span>
            All Books
            </h1>

            <!-- Status Filter -->
            <div class="book-filter mb-4">
            <label for="statusFilter">Filter by Status:</label>

            <select id="statusFilter" class="form-select form-select-sm">
                <option value="all">Show All</option>
                <option value="available">Available</option>
                <option value="reserved">Reserved</option>
                <option value="sold">Sold</option>
            </select>
            </div>

            <!--Books Table -->
            <div class="books-table-wrapper">
            <div class="table-responsive">

                <table class="table books-table align-middle mb-0">
                    <tbody>
                        <?php while ($book = mysqli_fetch_assoc($result)): ?>
                            <tr data-status="<?php echo htmlspecialchars(strtolower($book["status"])); ?>">
                                <td>
                                    <a href="details.php?id=<?php echo (int) $book["book_id"]; ?>">
                                        <?php echo htmlspecialchars($book["title"]); ?>
                                    </a>
                                </td>

                                <td><?php echo htmlspecialchars($book["author"]); ?></td>
                                <td><?php echo htmlspecialchars($book["genre"]); ?></td>
                                <td><?php echo htmlspecialchars($book["publication_year"]); ?></td>
                                <td><?php echo number_format((float) $book["price"], 2); ?></td>

                                <td><?php $status = strtolower($book["status"]); ?>
                                    <span class="badge status-<?php echo htmlspecialchars($status); ?>">
                                        <?php echo htmlspecialchars($book["status"]); ?>
                                    </span>
                                </td>

                                <td><?php if ($book["user_id"] !== null && $book["username"] !== null): ?>
                                    <a href="seller.php?id=<?php echo (int) $book["user_id"]; ?>">
                                        <?php echo htmlspecialchars($book["username"]); ?>
                                    </a>
                                    <?php else: ?>
                                        <span>Unknown Seller</span>
                                        <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php mysqli_stmt_close($stmt); ?>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.inc"; ?>