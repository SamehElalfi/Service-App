let rows = document.querySelectorAll('tr a.delete-btn');
for (const row of rows) {
  row.addEventListener('click', function(e) {
    e.preventDefault();
    id = e.target.getAttribute('data-id');
    if (confirm("Do you want to delete this user?")) {
      $.ajax({
        url: '/dashboard/users/'+id,
        type: 'DELETE',
        success: function(result) {
          alert("user deleted successfully");
          row.parentElement.parentElement.remove();
        }
      });
    }
  });
}