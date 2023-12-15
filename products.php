<?php
session_start();
include 'db_cnx.php';

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Fetch user information
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Fetch categories for the category filter
$categoryQuery = "SELECT * FROM Categories";
$categoryResult = mysqli_query($conn, $categoryQuery);
$categories = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);

// Initialize category, minPrice, maxPrice, and search filters
$categoryFilter = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : '';
$minPriceFilter = isset($_GET['minPrice']) ? $_GET['minPrice'] : '';
$maxPriceFilter = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : '';
$searchFilter = isset($_GET['search']) ? $_GET['search'] : '';

// get the current page from the URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// Define the number of products to display per page
$productsPerPage = 6;

// Calculate the starting product index
$startIndex = ($page - 1) * $productsPerPage;

// Fetch total number of products with the category filter
$totalProductsQuery = "SELECT COUNT(*) as total FROM Products WHERE disabled = FALSE";
// Include category filter in the total count query
if ($categoryFilter != '') {
    $totalProductsQuery .= " AND category_id = '" . mysqli_real_escape_string($conn, $categoryFilter) . "'";
}

// Fetch total number of products
$totalProductsResult = mysqli_query($conn, $totalProductsQuery);
$totalProductsRow = mysqli_fetch_assoc($totalProductsResult);
$numProducts = $totalProductsRow['total'];

// Calculate the total number of pages
$totalPages = ceil($numProducts / $productsPerPage);

// Fetch products with filters
$productQuery = "SELECT * FROM Products WHERE disabled = FALSE";
// Apply category filter
if ($categoryFilter != '') {
    $productQuery .= " AND category_id = '" . mysqli_real_escape_string($conn, $categoryFilter) . "'";
}

// Apply price filters
if ($minPriceFilter != '') {
    $productQuery .= " AND final_price >= '" . mysqli_real_escape_string($conn, $minPriceFilter) . "'";
}

if ($maxPriceFilter != '') {
    $productQuery .= " AND final_price <= '" . mysqli_real_escape_string($conn, $maxPriceFilter) . "'";
}

// Apply search filter
if ($searchFilter != '') {
    $productQuery .= " AND (label LIKE '%" . mysqli_real_escape_string($conn, $searchFilter) . "%' OR description LIKE '%" . mysqli_real_escape_string($conn, $searchFilter) . "%')";
}

// Fetch low on stock products if the filter is applied
if (isset($_GET['lowOnStock'])) {
    $productQuery .= " AND stock_quantity <= 10";
}


$productQuery .= " LIMIT $startIndex, $productsPerPage";

$productResult = mysqli_query($conn, $productQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="img/electric.png">
    <title>Product Listing</title>
    <style>
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include("nav.php"); ?>

    <div class="container mt-5">
        <!-- Filter form -->
        <form method="get" id="filterForm">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="categoryFilter" class="form-label">Filter by Category:</label>
                    <select name="categoryFilter" id="categoryFilter" class="form-select">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['category_id']; ?>" <?php echo ($categoryFilter == $category['category_id']) ? 'selected' : ''; ?>>
                                <?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="minPrice" class="form-label">Min Price:</label>
                    <input type="text" name="minPrice" id="minPrice" class="form-control" value="<?php echo $minPriceFilter; ?>">
                </div>
                <div class="col-md-4">
                    <label for="maxPrice" class="form-label">Max Price:</label>
                    <input type="text" name="maxPrice" id="maxPrice" class="form-control" value="<?php echo $maxPriceFilter; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search:</label>
                    <input type="text" name="search" id="search" class="form-control" value="<?php echo $searchFilter; ?>">
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Apply Filter</button>
                <button type="submit" class="btn btn-warning ms-2" name="lowOnStock" value="1">Low on Stock</button>
            </div>
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo generatePageLink($page - 1); ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="<?php echo generatePageLink($i); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo ($page == $totalPages || $totalPages == 0) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo generatePageLink($page + 1); ?>">Next</a>
                </li>
            </ul>
        </nav>
        <div class="row" id="products-container">
            <?php while ($row = mysqli_fetch_assoc($productResult)) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <!-- Make the image clickable and link to the product detail page -->
                        <a href="product-details.php?id=<?php echo $row['product_id']; ?>">
                            <img src="./img/<?php echo $row['image']; ?>" class=" card-img-top" alt="<?php echo $row['label']; ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['label']; ?></h5>
                            <p class="card-text">Price: $<?php echo $row['final_price']; ?></p>
                            <!-- Add to Cart button -->
                            <form method="post" action="cart.php?action=add&id=<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="hidden_name" value="<?php echo $row['label']; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row['final_price']; ?>">
                                <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    // Function to generate pagination link with current filters
    function generatePageLink($pageNumber)
    {
        global $categoryFilter, $minPriceFilter, $maxPriceFilter, $lowOnStockFilter, $searchFilter;

        $link = "?page=$pageNumber";
        $link .= ($categoryFilter != '') ? "&categoryFilter=$categoryFilter" : '';
        $link .= ($minPriceFilter != '') ? "&minPrice=$minPriceFilter" : '';
        $link .= ($maxPriceFilter != '') ? "&maxPrice=$maxPriceFilter" : '';
        $link .= ($lowOnStockFilter) ? '&lowOnStock=1' : '';
        $link .= ($searchFilter != '') ? "&search=$searchFilter" : '';

        return $link;
    }
    ?>
    <script>
        $(document).ready(function() {
            // Function to load content using AJAX
            function loadContent(url) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        $('#products-container').html(data);
                    }
                });
            }

            // Submit the filter form using AJAX
            $('#filterForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize(); // Fix the typo here
                loadContent('<?php echo $_SERVER['PHP_SELF']; ?>' + '?' + formData);
            });

            // Handle pagination clicks
            $('.pagination a').on('click', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('=')[1];
                var url = '<?php echo $_SERVER['PHP_SELF']; ?>' + '?page=' + page +
                    '&categoryFilter=' + $('#categoryFilter').val() +
                    '&minPrice=' + $('#minPrice').val() +
                    '&maxPrice=' + $('#maxPrice').val() +
                    '&lowOnStock=' + ($('#lowOnStock').val() == '1' ? '1' : '') +
                    // Check if the button is clicked
                    '&search=' + $('#search').val();

                loadContent(url);
            });
        });
    </script>
    <?php include("footer.php"); ?>
