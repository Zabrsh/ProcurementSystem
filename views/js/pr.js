
  var items = 0;

  function addItem() {
    items++; 

    var html = "<tr>";
    html += "<td><input type='text' name='itemName[]'></td>";
    html += "<td><input type='text' name='itemDescription[]'></td>";
    html += "<td><input type='text' name='UOM[]'></td>";
    html += "<td><input type='number' name='itemQuantity[]'></td>";
    html += "<td><button type='button' onclick='deleteRow(this);'>Delete</button></td>";
       
    
    html += "</tr>";
    
    var row = document.getElementById("tbody").insertRow();
    row.innerHTML = html;
  }

  function deleteRow(button) {Not
    items--
    button.parentElement.parentElement.remove();
    // first parentElement will be td and second will be tr.
  }