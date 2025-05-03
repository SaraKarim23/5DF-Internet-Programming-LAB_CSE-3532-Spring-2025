document.addEventListener("DOMContentLoaded", function ()
 {
 
    document.getElementById("type").addEventListener("change", filterTransactions);
    document.getElementById("date").addEventListener("change", filterTransactions);
});


function filterTransactions() {
    let selectedType = document.getElementById("type").value.toLowerCase();
    let selectedDate = document.getElementById("date").value;
    let rows = document.querySelectorAll("#transactionTable tr");

    rows.forEach(row => {
        let type = row.cells[1].innerText.toLowerCase();
        let date = row.cells[0].innerText;

        let typeMatch = selectedType === "all" || type === selectedType;
        let dateMatch = !selectedDate || date === selectedDate;

        row.style.display = typeMatch && dateMatch ? "" : "none";
    });
}


function exportTransactions() {
    let table = document.querySelector("table");
    let rows = table.querySelectorAll("tr");
    let csvContent = [];

    rows.forEach(row => {
        let cols = row.querySelectorAll("th, td");
        let rowData = [];
        cols.forEach(col => rowData.push(col.innerText));
        csvContent.push(rowData.join(","));
    });

    let csvString = csvContent.join("\n");
    let blob = new Blob([csvString], { type: "text/csv" });
    let link = document.createElement("a");

    link.href = URL.createObjectURL(blob);
    link.download = "transactions.csv";
    link.click();
}
