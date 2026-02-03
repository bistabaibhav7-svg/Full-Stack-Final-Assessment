<?php
if (session_status() === PHP_SESSION_NONE) session_start();

/**
 * If user is NOT logged in, show landing page.
 * If logged in, show the recipes (dashboard) page.
 */
if (!isset($_SESSION['user_id'])) {
    header("Location: landing.php");
    exit;
}

require_once '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recipes</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body>
<?php include '../includes/header.php'; ?>

<main class="container">

  <section class="page-hero">
    <h1>Discover Recipes</h1>
    <p>Search by recipe name or by ingredient — results update instantly (no reload).</p>
  </section>

  <!-- ✅ Search UI (ONLY name + ingredients) -->
  <section class="search-panel">

    <!-- Basic input + button -->
    <div class="search-row">
      <input
        type="text"
        id="search"
        name="q"
        placeholder="Type recipe name..."
        autocomplete="off"
      />
      <button type="button" id="searchBtn" class="btn btn-secondary">Search</button>
    </div>

    <!-- Advanced (only ingredient filter) -->
    <form id="advancedSearchForm" class="advanced-filters" method="get" action="search.php">
      <div class="filters-grid" style="grid-template-columns: 1fr;">
        <div class="filter">
          <label for="ingredients">Filter by Ingredient</label>
          <input
            type="text"
            id="ingredients"
            name="ingredients"
            placeholder="e.g. garlic, chicken, cheese..."
            autocomplete="off"
          />
        </div>
      </div>

      <div class="filters-actions">
        <button type="submit" class="btn">Apply</button>
        <button type="reset" class="btn btn-ghost"
          onclick="setTimeout(()=>document.getElementById('searchBtn')?.click(), 0)">
          Reset
        </button>
      </div>

      <p class="hint">
        Tip: Typing in the top box filters by name live. Ingredient filter works with “Apply” — without reload.
      </p>
    </form>

  </section>

  <!-- ✅ Results (AJAX updates this without reload) -->
  <section class="results-section">
    <h2 class="section-title">Recipes</h2>

    <div id="results" class="recipes-grid">
      <?php
        $stmt = $pdo->query("SELECT id, title, image_url FROM recipes ORDER BY id DESC LIMIT 24");
        $recipes = $stmt->fetchAll();

        if (!$recipes) {
          echo "<p>No recipes found.</p>";
        } else {
          foreach ($recipes as $r) {
            $id = (int)$r['id'];
            $title = htmlspecialchars($r['title'] ?? '');
            $img = htmlspecialchars($r['image_url'] ?? '');
            ?>
              <div class="recipe-card">
                <img
                  src="<?= $img ?>"
                  alt="<?= $title ?>"
                  loading="lazy"
                  referrerpolicy="no-referrer"
                  onerror="this.onerror=null;this.src='../assets/img/placeholder.jpg';"
                />
                <h3><?= $title ?></h3>
                <a href="recipe.php?id=<?= $id ?>" class="btn">View Recipe</a>
              </div>
            <?php
          }
        }
      ?>
    </div>
  </section>

</main>

<!-- ✅ AJAX search script -->
<script src="../assets/js/search.js"></script>

<?php include '../includes/footer.php'; ?>
</body>
</html>