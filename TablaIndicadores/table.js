

function generaTabla1() {
   //1. Obtener los datos
  getTableData1().done(function(records) {

    //2. Obtener los nombres de las columnas
    var headername = Object.keys(records[0]);

    //3.Construir el Html para los encabezados
    var headerHTML = MakeColumnHeaderHtml(headername);
    var columns = [];

    //3.1 Destruir los tag bajo #myTable 
    //var element = document.getElementById(myTable);
    //element.parentNode.removeChild(element);

    const container = document.querySelector('#myTable');
    removeAllChildNodes(container);

    //4. append table header
    $('#myTable').append(headerHTML);

    //5. create a column definition
    for (var i = 0; i < headername.length; i++) {
      columns.push( { "data": headername[i] });
    }

    //6. inicializa la tabla con sus definiciones
    var dtable = $('#myTable').DataTable(getDatatableDef(columns));

    //7. agregar datos a la tabla
    dtable.rows.add(records).draw();
  
  });
}

function generaTabla2() {
   //1. Obtener los datos
  getTableData2().done(function(records) {

    //2. Obtener los nombres de las columnas
    var headername = Object.keys(records[0]);

    //3.Construir el Html para los encabezados
    var headerHTML = MakeColumnHeaderHtml(headername);
    var columns = [];

    //3.1 Destruir los tag bajo #myTable 
    //var element = document.getElementById(myTable);
    //element.parentNode.removeChild(element);

    const container = document.querySelector('#myTable');
    removeAllChildNodes(container);

    //4. append table header
    $('#myTable').append(headerHTML);

    //5. create a column definition
    for (var i = 0; i < headername.length; i++) {
      columns.push( { "data": headername[i] });
    }

    //6. inicializa la tabla con sus definiciones
    var dtable = $('#myTable').DataTable(getDatatableDef(columns));

    //7. agregar datos a la tabla
    dtable.rows.add(records).draw();
  
  });
}

function getTableData1() {
     return $.ajax( {
       url : "data2.json",
       method: "Get"
     });
}

function getTableData2() {
     return $.ajax( {
       url : "data1.json",
       method: "Get"
     });
}


function MakeColumnHeaderHtml (columnHeaderNames) {
  var table_head = '<thead class= "table-header"><tr>';

  $.each(columnHeaderNames, function (data, value) {

    table_head += '<th>';
    table_head += value;
    table_head += '</th>';
  });
  table_head += '</tr></thead>';
  return table_head;
}

function getDatatableDef(columnDef) {
   var datatableformat = {
      columns : columnDef,
      paging:false,
      info: false,
      searching: false,
      ordering : false,
      bFilter  : false,
      bDestroy : true,
   
   };
   return datatableformat

}

function GenTable1() {
  generaTabla1();
}

function GenTable2() {
  generaTabla2();
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}