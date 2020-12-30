// Delete User Button on /dashboard/users Page
let rows = document.querySelectorAll("tr a.delete-btn");
for (const row of rows) {
  row.addEventListener("click", function (e) {
    e.preventDefault();
    id = e.target.getAttribute("data-id");
    if (confirm("Do you want to delete this user?")) {
      $.ajax({
        url: "/dashboard/users/" + id,
        type: "DELETE",
        success: function (result) {
          alert("user deleted successfully");
          row.parentElement.parentElement.remove();
        },
      });
    }
  });
}

// Show users in search form
const showSearchResults = (results) => {};

// Search Form in Navbar
const searchInput = document.querySelector("#searchInput");
searchInput.addEventListener("keyup", (e) => {
  if (e.target.value) {
    $.ajax({
      url: "/dashboard/search/",
      type: "POST",
      data: {
        searchQuery: e.target.value,
      },
      success: function (response) {
        console.log("success");
        const results = JSON.parse(response);
        if (results.success) {
          const resultsBox = document.querySelector(".search-results-box");
          resultsBox.innerHTML = "";
          let elements = document.createElement("UL");
          for (const result of results.users) {
            const li = document.createElement("LI");
            const A = document.createElement("A");
            A.href = `/dashboard/users/${result.id}`;
            A.textContent = `${result.first_name} ${result.last_name}`;
            li.appendChild(A);
            elements.appendChild(li);
          }
          resultsBox.appendChild(elements);
        }
      },
    });
  } else {
    document.querySelector(".search-results-box").innerHTML = "";
  }
});
