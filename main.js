function generarColumnas() {
    const numColumnas = document.getElementById('columnas').value;
    const tableBody = document.getElementById('table-body');
    
    tableBody.innerHTML = '';

    for (let i = 0; i < numColumnas; i++) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" class="form-control form-control-sm" name="item[]" required></td>
            <td><input type="text" class="form-control form-control-sm" name="description[]" required></td>
            <td><input type="number" class="form-control form-control-sm" name="price[]" required></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">Eliminar</button></td>
        `;
        tableBody.appendChild(row);
    }
}

function eliminarFila(button) {
    const row = button.parentNode.parentNode; 
    row.parentNode.removeChild(row); 
}