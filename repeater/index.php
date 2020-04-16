<?php
if (isset($_POST["submit"])) {
  $conn = mysqli_connect("localhost", "root", "", "repeater");
  $customerName = $_POST["customerName"];

  $qry = "INSERT INTO invoices (customerName) VALUES ('$customerName')";
  mysqli_query($conn, $qry);

  $invoiceId = mysqli_insert_id($conn);

  for ($a = 0; $a < count($_POST["itemName"]); $a++) {
    $qry = "INSERT INTO items (invoiceId, itemName, itemQuantity) VALUES ('$invoiceId', '" . $_POST["itemName"][$a] . "','" . $_POST["itemQuantity"][$a] . "' )";
    mysqli_query($conn, $qry);
  }
  echo "<p> Invoice has been Added</p>";
}
?>
<form action="index.php" method="POST">
  <p>
    <input type="text" name="customerName" placeholder="Enter Customer Name">
  </p>
  <table>
    <tr>
      <th>#</th>
      <th>Item name</th>
      <th>Item quantity</th>
    </tr>

    <tbody id="tbody"></tbody>
  </table>

  <p>
    <button type="button" onclick="addItem();">
      Add Item
    </button>
  </p>
  <p>
    <input type="submit" name="submit">
  </p>
</form>


<script>
  var items = 0;

  function addItem() {
    items++;
    var html = "<tr>";

    html += "<td>" + items + "</td>";
    html += "<td><input name='itemName[]'></td>";
    html += "<td><input name='itemQuantity[]'></td>";
    html += "</tr>";

    document.getElementById("tbody").insertRow().innerHTML = html;
  }
</script>