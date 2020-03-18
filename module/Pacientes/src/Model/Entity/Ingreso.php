<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pacientes\Model\Entity;

/**
 * Description of Empleado
 *
 * @author jorge
 */
class Ingreso {

    //paciente
    private $idpaciente; //int(11) AI PK
    private $rfc; // varchar(45) 
    private $foto; // varchar(45) 
    private $nombre; // varchar(45) 
    private $sexo; // enum('Hombre','Mujer') 
    private $fechaNac; // date 
    private $edad; // varchar(45) 
    private $direccion; // varchar(45) 
    private $escolaridad; // varchar(45) 
    private $ocupacion; // varchar(45) 
    private $estadoCivil; // varchar(45) 
    private $codigoPostal; // varchar(45) 
    private $telefonoParticular; // varchar(45) 
    private $celular; // varchar(45) 
    private $telefonoTrabajo; // varchar(45) 
    private $servicioMedico; // enum('Si','No') 
    private $tipoServicio; // varchar(45) 
    private $numero; // varchar(45) 
    private $tipoPaciente; // enum('Servidor','Anexado') 
    private $email; // varchar(45)
    function getIdpaciente() {
        return $this->idpaciente;
    }

    function getRfc() {
        return $this->rfc;
    }

    function getFoto() {
        return $this->foto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFechaNac() {
        return $this->fechaNac;
    }

    function getEdad() {
        return $this->edad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getEscolaridad() {
        return $this->escolaridad;
    }

    function getOcupacion() {
        return $this->ocupacion;
    }

    function getEstadoCivil() {
        return $this->estadoCivil;
    }

    function getCodigoPostal() {
        return $this->codigoPostal;
    }

    function getTelefonoParticular() {
        return $this->telefonoParticular;
    }

    function getCelular() {
        return $this->celular;
    }

    function getTelefonoTrabajo() {
        return $this->telefonoTrabajo;
    }

    function getServicioMedico() {
        return $this->servicioMedico;
    }

    function getTipoServicio() {
        return $this->tipoServicio;
    }

    function getNumero() {
        return $this->numero;
    }

    function getTipoPaciente() {
        return $this->tipoPaciente;
    }

    function getEmail() {
        return $this->email;
    }

    function setIdpaciente($idpaciente) {
        $this->idpaciente = $idpaciente;
    }

    function setRfc($rfc) {
        $this->rfc = $rfc;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setEscolaridad($escolaridad) {
        $this->escolaridad = $escolaridad;
    }

    function setOcupacion($ocupacion) {
        $this->ocupacion = $ocupacion;
    }

    function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }

    function setCodigoPostal($codigoPostal) {
        $this->codigoPostal = $codigoPostal;
    }

    function setTelefonoParticular($telefonoParticular) {
        $this->telefonoParticular = $telefonoParticular;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setTelefonoTrabajo($telefonoTrabajo) {
        $this->telefonoTrabajo = $telefonoTrabajo;
    }

    function setServicioMedico($servicioMedico) {
        $this->servicioMedico = $servicioMedico;
    }

    function setTipoServicio($tipoServicio) {
        $this->tipoServicio = $tipoServicio;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setTipoPaciente($tipoPaciente) {
        $this->tipoPaciente = $tipoPaciente;
    }

    function setEmail($email) {
        $this->email = $email;
    }

        
    
    
    public function exchangeArray($data) {       
        $this->idpaciente = (isset($data['idpaciente'])) ? $data['idpaciente'] : null;
        $this->rfc = (isset($data['rfc'])) ? $data['rfc'] : null;
        $this->foto = (isset($data['foto'])) ? $data['foto'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->sexo = (isset($data['sexo'])) ? $data['sexo'] : null;
        $this->fechaNac = (isset($data['fechaNac'])) ? $data['fechaNac'] : null;
        $this->edad = (isset($data['edad'])) ? $data['edad'] : null;
        $this->direccion = (isset($data['direccion'])) ? $data['direccion'] : null;
        $this->escolaridad = (isset($data['escolaridad'])) ? $data['escolaridad'] : null;
        $this->ocupacion = (isset($data['ocupacion'])) ? $data['ocupacion'] : null;
        $this->estadoCivil = (isset($data['estadoCivil'])) ? $data['estadoCivil'] : null;        
        $this->codigoPostal = (isset($data['codigoPostal'])) ? $data['codigoPostal'] : null;
        $this->telefonoParticular = (isset($data['telefonoParticular'])) ? $data['telefonoParticular'] : null;
        $this->celular = (isset($data['celular'])) ? $data['celular'] : null;
        $this->telefonoTrabajo = (isset($data['telefonoTrabajo'])) ? $data['telefonoTrabajo'] : null;
        $this->servicioMedico = (isset($data['servicioMedico'])) ? $data['servicioMedico'] : null;
        $this->tipoServicio = (isset($data['tipoServicio'])) ? $data['tipoServicio'] : null;
        $this->numero = (isset($data['numero'])) ? $data['numero'] : null;
        $this->tipoPaciente = (isset($data['tipoPaciente'])) ? $data['tipoPaciente'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
