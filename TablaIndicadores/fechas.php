<?php
$fecini = "";
$fecfin = "";
require_once("config/const.php");
require_once("config/odbc.php");
$cnn = new conexion(tserver);
$cnn->conectar();
$sql = "EXEC sp_TraeUltimasVtas ";
$result = $cnn->query($sql);
$fecini = $cnn->result('fecini');
$fecfin = $cnn->result('fecfin');
?>

<head>
</head>

<body>

<form class="form-inline my-0">
    <input type="text" class="form-control mb-2 mr-sm-2" id="PickerFecIni" value="<?php echo $fecini; ?>">
    <input type="text" class="form-control mb-2 mr-sm-2" id="PickerFecFin">
    <div class="card rounded-0">
    <select class="selectpicker" id="tipo"  class="btn btn-primary mb-2">
        <option>Sucursal</option>
        <option>Division</option>
    </select>
    </div>
    <button type="button" class="btn btn-primary mb-3 " Id="BtnUpdate">Actualizar</button>
</form>

<script type="text/javascript">

document.addEventListener("DOMContentLoaded",function(event){
   
   
});

</script>
</body>
