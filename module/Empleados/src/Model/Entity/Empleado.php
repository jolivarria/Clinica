<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Empleados\Model\Entity;
/**
 * Description of Empleado
 *
 * @author jorge
 */
class Empleado {

    //put your code here
    private  $idEmpleados; //int(11) AI PK 
    private  $idDepartamento; // int(11) PK 
    private  $foto; // varchar(45) 
    private  $numeroEmpleado; // varchar(45) 
    private  $nombreCompleto; // varchar(45) 
    private  $fechaNac; // date 
    private  $correo; // varchar(45) 
    private  $telefono; // varchar(45) 
    private  $celular; // varchar(45) 
    private  $domicilio; // varchar(45) 
    private  $sexo; // enum('Masculino','Femenino') 
    private  $tipoPlaza; // enum('Base','Confianza') 
    private  $nombramiento; // enum('Auxiliar Administrativo','Jefe de Dep.','Director') 
    private  $estado; // tinyint(4)
    
    function getIdEmpleados() {
        return $this->idEmpleados;
    }

    function getIdDepartamento() {
        return $this->idDepartamento;
    }

    function getFoto() {
        return $this->foto;
    }

    function getNumeroEmpleado() {
        return $this->numeroEmpleado;
    }

    function getNombreCompleto() {
        return $this->nombreCompleto;
    }

    function getFechaNac() {
        return $this->fechaNac;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCelular() {
        return $this->celular;
    }

    function getDomicilio() {
        return $this->domicilio;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getTipoPlaza() {
        return $this->tipoPlaza;
    }

    function getNombramiento() {
        return $this->nombramiento;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdEmpleados($idEmpleados) {
        $this->idEmpleados = $idEmpleados;
    }

    function setIdDepartamento($idDepartamento) {
        $this->idDepartamento = $idDepartamento;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setNumeroEmpleado($numeroEmpleado) {
        $this->numeroEmpleado = $numeroEmpleado;
    }

    function setNombreCompleto($nombreCompleto) {
        $this->nombreCompleto = $nombreCompleto;
    }

    function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setTipoPlaza($tipoPlaza) {
        $this->tipoPlaza = $tipoPlaza;
    }

    function setNombramiento($nombramiento) {
        $this->nombramiento = $nombramiento;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        
    public function exchangeArray($data){
        $this->idEmpleados = (isset($data['idEmpleados'])) ? $data['idEmpleados'] : null;
        $this->idDepartamento = (isset($data['idDepartamento'])) ? $data['idDepartamento'] : null;
        $this->foto = (isset($data['foto'])) ? $data['foto'] : null;
        $this->numeroEmpleado = (isset($data['numeroEmpleado'])) ? $data['numeroEmpleado'] : null;
        $this->nombreCompleto = (isset($data['nombreCompleto'])) ? $data['nombreCompleto'] : null;
        $this->fechaNac = (isset($data['fechaNac'])) ? $data['fechaNac'] : null;
        $this->correo = (isset($data['correo'])) ? $data['correo'] : null;
        $this->telefono = (isset($data['telefono'])) ? $data['telefono'] : null;
        $this->celular = (isset($data['celular'])) ? $data['celular'] : null;
        $this->domicilio = (isset($data['domicilio'])) ? $data['domicilio'] : null;
        $this->sexo = (isset($data['sexo'])) ? $data['sexo'] : null;
        $this->tipoPlaza = (isset($data['tipoPlaza'])) ? $data['tipoPlaza'] : null;
        $this->nombramiento = (isset($data['nombramiento'])) ? $data['nombramiento'] : null;
        $this->estado = (isset($data['estado'])) ? $data['estado'] : null;
    }
    
    public function getArrayCopy(){
        return get_object_vars($this);
    }
  
}
