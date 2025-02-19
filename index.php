<?php

session_start();

if(!isset($_SESSION['LOGGED']) || $_SESSION['LOGGED'] !== true){
    header('Location: login.php');
}

include 'head.php';
?>
<style>
	#filas div{
		padding: 0;
		padding-left: 5px;
	}
</style>
<form action="pdf.php" method="post" class="p-3">
        <div class="row justify-content-evenly mt-4 p-2">
            <div class="col-12 col-md-5">
                <h2>Datos del cliente</h2>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nombreCliente" class="form-label">Nombre del cliente<i class="fa-solid fa-asterisk fa-2xs ms-1" style="color:red;"></i></label>
                            <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Ej. JOSE IGNACIO AYO ACHALANDABASO" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="dniCliente" class="form-label">Identificación fiscal<i class="fa-solid fa-asterisk fa-2xs ms-1" style="color:red;"></i></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="dniCliente" name="dniCliente" placeholder="Ej. 14411270E" required>
                            <select class="form-select" id="tipoID" name="tipoID" aria-label="tipo de identificacion">
                              <option selected value="1">DNI</option>
                              <option value="2">CIF</option>
                            </select>
                          </div>                          
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección (Calle, número, bungalow...)<i class="fa-solid fa-asterisk fa-2xs ms-1" style="color:red;"></i></label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ej. C/ABADIA Nº42 BW8" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="urbanizacionCliente" class="form-label">Detalle de la Vivienda (Urbanización...)</label>
                            <input type="text" class="form-control" id="urbanizacionCliente" name="urbanizacionCliente" placeholder="Ej. URBANIZACIÓN ALBIR BAHÍA">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="codigo_postal" class="form-label">Código Postal<i class="fa-solid fa-asterisk fa-2xs ms-1" style="color:red;"></i></label>
                            <input type="number" class="form-control" id="codigo_postal" name="codigo_postal" placeholder="Ej. 03581" max="99999" required />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="localidad" class="form-label">Localidad<i class="fa-solid fa-asterisk fa-2xs ms-1" style="color:red;"></i></label>
                            <input type="text" class="form-control" id="localidad" name="localidad" placeholder="Ej. ALFAZ DEL PI" required>
                        </div>
                    </div>
                </div>               
            </div>
            <div class="col-12 col-md-5">
                <h2>Datos de la factura</h2>
                <div class="row mt-4">
                    <div class="col-12 mb-3">
                        <div class="form-check form-check-inline ps-0">
                            <input type="radio" class="btn-check" name="tipoCliente" id="general" value="general" checked>
                            <label class="btn btn-outline-primary" for="general"><i class="fa-solid fa-users me-2"></i>General</label>
                        </div>
                        <div class="form-check form-check-inline ps-0">
                            <input type="radio" class="btn-check" name="tipoCliente" id="comunidad" value="comunidad">
                            <label class="btn btn-outline-primary" for="comunidad"><i class="fa-solid fa-building-user me-2"></i>Comunidad</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="numeroFactura" class="form-label">Nº de factura</label>
                            <input type="number" class="form-control" id="numeroFactura" name="numeroFactura" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="fechaFactura" class="form-label">Fecha factura</label>
                            <input type="date" class="form-control" id="fechaFactura" name="fechaFactura" value="<?php echo date('Y-m-d');?>" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="dniCliente" class="form-label">IVA</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" value="21" id="ivaFactura" name="ivaFactura" required>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <h3>Filas</h3>
                <div id="filas">
                    <div class="row mt-4">
                        <div class="col-6 col-sm-7">
                            <div class="mb-3">
                                <label for="conceptoFactura" class="form-label">Concepto</label>
                                <input type="text" class="form-control" id="conceptoFactura" name="conceptoFactura[]">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="importeFactura" class="form-label">Importe (€)<i class="fa-solid fa-asterisk fa-2xs ms-1" style="color:red;"></i></label>
                                <input type="number" class="form-control" id="importeFactura" name="importeFactura[]" step=".01" required>
                            </div>
                        </div>
                        <div class="col-1 d-flex align-items-center">
                                <button type="button" id="add-fila" class="btn btn-primary ms-1"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="almacenar" name="almacenar" checked>
                    <label class="form-check-label" for="almacenar">
                        Almacenar Factura
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Crear Factura</button>
            </div>
        </div>
    </form>
</body>
<script src="main.js"></script>
</html>