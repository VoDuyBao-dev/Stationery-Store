
function searchUser() {
     let input = document.getElementById("searchInput").value.toLowerCase();
     let rows = document.querySelectorAll("tbody tr");
     rows.forEach(row => {
         let text = row.innerText.toLowerCase();
         row.style.display = text.includes(input) ? "" : "none";
     });
 }
