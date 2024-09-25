function generarColumnas() {
    const numColumnas = document.getElementById('columnas').value;
    const tableBody = document.getElementById('table-body');
    
    tableBody.innerHTML = '';
  
    for (let i = 0; i < numColumnas; i++) {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td><input type="text" name="item[]" required></td>
        <td><input type="text" name="description[]" required></td>
        <td><input type="number" name="price[]" required></td>
        <td><button type="button" onclick="eliminarFila(this)">Eliminar</button></td>
      `;
      tableBody.appendChild(row);
    }
  }
  
  function eliminarFila(button) {
    const row = button.parentNode.parentNode; 
    row.parentNode.removeChild(row); 
  }
  