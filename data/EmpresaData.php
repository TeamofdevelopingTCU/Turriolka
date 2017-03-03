<?php

include_once 'Data.php';
include_once '../../Domain/Empresa.php';

/*
 * Clase destinada a consultas en la Base de Datos 
 * relacionadas a la tabla la_empresa
 */

class EmpresaData extends Data {
    /*
     * ************* Métodos específicos *************
     */

    //Obtiene los datos de la empresa en español
    function getEmpresaEsData() {
        return $this->getEmpresaData(0);
    }

    //Obtiene los datos de la empresa en ingles
    function getEmpresaInData() {
        return $this->getEmpresaData(1);
    }

    //Actualiza Empresa en español
    function actualizaEmpresaEsData($empresa) {
        return $this->actualizaEmpresaData($empresa, 0);
    }

    //Actualiza Empresa en Ingles
    function actualizaEmpresaInData($empresa) {
        return $this->actualizaEmpresaData($empresa, 1);
    }

    /*
     * ************* Metodos generales *************
     */

    //funcion para obtener todos los datos de la empresa
    private function getEmpresaData($idioma) {
        $query = "select * from la_empresa where atIdioma = " . $idioma;
        $result = $this->exeQuery($query);
        $miEmpresa = NULL;
        if ($row = mysqli_fetch_array($result)) {
            $miEmpresa = new Empresa($row['atId'], $row['atHistoria'], $row['atQuinesSomos'], $row['atDescripcionGaleria'], $row['atElaboracion'], $row['atDescripcionProductoA'], $row['atElaboracionProductoB'], $row['atDenominacion'], $row['atDescripcionContactos'], $row['atDireccion'], $row['atCorreo'], $row['atTelefonoA'], $row['atTelefonoB'], $row['atEncargadoA'], $row['atEncargadoB'], $row['atMision'], $row['atVision'], $row['atIdioma']);
        }
        return $miEmpresa;
    }

    //Actualiza la información de la empresa
    private function actualizaEmpresaData($empresa, $idioma) {
        $query = "call ActualizarEmpresa(0, '" . $empresa->correo . "', '" . $empresa->denominacion . "', '" .
                $empresa->descripcionContactos . "', '" . $empresa->descripcionGaleria . "', '" .
                $empresa->descripcionProductoA . "', '" . $empresa->direccion . "', '" . $empresa->elaboracion .
                "', '" . $empresa->elaboracionProductoB . "', '" . $empresa->encargadoA .
                "', '" . $empresa->encargadoB . "', '" . $empresa->historia . "', '" . $empresa->vision .
                "', '" . $empresa->mision . "', '" . $empresa->quinesSomos . "', " . $empresa->telefonoA .
                ", " . $empresa->telefonoB . ", " . $idioma . ")";
        $result = $this->exeQuery($query);
        return $result;
    }
}
?>