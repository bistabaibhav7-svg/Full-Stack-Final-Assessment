document.addEventListener("DOMContentLoaded", () => {
  const results = document.getElementById("results");
  if (!results) return;

  // Your existing page already uses these IDs (from your old JS): #search and #results
  const input = document.getElementById("search");

  // OPTIONAL: if you have a button, give it id="searchBtn" (you already mentioned it)
  const searchBtn = document.getElementById("searchBtn");

  // OPTIONAL: if you have advanced search form, give it id="advancedSearchForm"
  const advForm = document.getElementById("advancedSearchForm");

  function escapeHtml(s) {
    return String(s ?? "")
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  function render(data) {
    if (!Array.isArray(data) || data.length === 0) {
      results.innerHTML = "<p>No recipes found.</p>";
      return;
    }

    let html = "";
    data.forEach((r) => {
      html += `
        <div class="recipe-card">
          <img
            src="${escapeHtml(r.image_url)}"
            alt="${escapeHtml(r.title)}"
            loading="lazy"
            referrerpolicy="no-referrer"
            onerror="this.onerror=null;this.src='../assets/img/placeholder.jpg';"
          />
          <h3>${escapeHtml(r.title)}</h3>
          <a class="btn" href="recipe.php?id=${encodeURIComponent(r.id)}">View Recipe</a>
        </div>
      `;
    });

    results.innerHTML = html;
  }

  function doSearch(params) {
    const qs =
      params instanceof URLSearchParams ? params.toString() : String(params || "");

    fetch("ajax_search.php?" + qs, {
      headers: { "X-Requested-With": "XMLHttpRequest" }
    })
      .then((res) => res.json())
      .then(render)
      .catch(() => {
        results.innerHTML = "<p>Search failed. Please try again.</p>";
      });
  }

  // ✅ Live typing (no reload)
  if (input) {
    let timer = null;
    input.addEventListener("input", () => {
      clearTimeout(timer);
      timer = setTimeout(() => {
        const p = new URLSearchParams();
        p.set("q", input.value.trim());
        doSearch(p);
      }, 250);
    });
  }

  // ✅ Search button (no reload)
  if (searchBtn) {
    searchBtn.addEventListener("click", (e) => {
      e.preventDefault();
      const p = new URLSearchParams();
      p.set("q", input ? input.value.trim() : "");
      doSearch(p);
    });
  }

  // ✅ Advanced search form submit (no reload)
  if (advForm) {
    advForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const p = new URLSearchParams(new FormData(advForm));

      // If your advanced form doesn't include q, still include the typing box text
      if (input && !p.get("q")) p.set("q", input.value.trim());

      doSearch(p);
    });
  }
});