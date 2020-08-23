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
    private $escolaridad; // varchar(45) 
    private $ocupacion; // varchar(45) 
    private $estadoCivil; // varchar(45) 
    private $servicioMedico; // enum('Si','No') 
    private $tipoServicio; // varchar(45) 
    private $numero; // varchar(45) 
    private $tipoPaciente; // enum('Servidor','Anexado')
    private $telefonoPp; //varchar(45) 
    private $telefonoPt; // varchar(45) 
    private $celular; // varchar(45)
    private $email; // varchar(45)
    
    private $idingreso; //int(11) AI PK 
    private $tipo; // enum('Voluntario','Involuntario','Obligatorio') 
    private $referencia; // enum('Domicilio Particular','Institución Pública','Institución Privada','Hospital Psiquiatrico','Centro de Redaptación Social') 
    private $otro; // varchar(45) 
    private $acude; // enum('Solo','Amigo','Vecino','Familiar','Parentesco') 
    private $parentesco; // varchar(45) 
    private $adulo; // enum('Si','No') 
    private $drogasAlcohol; // enum('Si','No') 
    private $consecunciaConsumo; // enum('Si','No') 
    private $mental; // enum('Si','No') 
    private $criteriosAdmision; // enum('Si','No') 
    private $fechaIngreso; //timestamp
    private $fecha; //date
    

    private $paciente_idpaciente; //int(11) AI PK 
    private $nombreFam; //varchar(45) 
    private $domicilioFam; //varchar(45) 
    private $numeroFam; //varchar(45) 
    private $coloniaFam; // varchar(45) 
    private $telefonoParticularFam; // varchar(45) 
    private $celularFam; // varchar(45) 

    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    
    function getPaciente_idpaciente() {
        return $this->paciente_idpaciente;
    }

    function getNombreFam() {
        return $this->nombreFam;
    }

    function getDomicilioFam() {
        return $this->domicilioFam;
    }

    function getNumeroFam() {
        return $this->numeroFam;
    }

    function getColoniaFam() {
        return $this->coloniaFam;
    }

    function getTelefonoParticularFam() {
        return $this->telefonoParticularFam;
    }

    function getCelularFam() {
        return $this->celularFam;
    }

    function setPaciente_idpaciente($paciente_idpaciente) {
        $this->paciente_idpaciente = $paciente_idpaciente;
    }

    function setNombreFam($nombreFam) {
        $this->nombreFam = $nombreFam;
    }

    function setDomicilioFam($domicilioFam) {
        $this->domicilioFam = $domicilioFam;
    }

    function setNumeroFam($numeroFam) {
        $this->numeroFam = $numeroFam;
    }

    function setColoniaFam($coloniaFam) {
        $this->coloniaFam = $coloniaFam;
    }

    function setTelefonoParticularFam($telefonoParticularFam) {
        $this->telefonoParticularFam = $telefonoParticularFam;
    }

    function setCelularFam($celularFam) {
        $this->celularFam = $celularFam;
    }

        function getTelefonoPp() {
        return $this->telefonoPp;
    }

    function getTelefonoPt() {
        return $this->telefonoPt;
    }

    function getCelular() {
        return $this->celular;
    }

    function setTelefonoPp($telefonoPp) {
        $this->telefonoPp = $telefonoPp;
    }

    function setTelefonoPt($telefonoPt) {
        $this->telefonoPt = $telefonoPt;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

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

    function getEscolaridad() {
        return $this->escolaridad;
    }

    function getOcupacion() {
        return $this->ocupacion;
    }

    function getEstadoCivil() {
        return $this->estadoCivil;
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

    function getIdingreso() {
        return $this->idingreso;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getOtro() {
        return $this->otro;
    }

    function getAcude() {
        return $this->acude;
    }

    function getParentesco() {
        return $this->parentesco;
    }

    function getAdulo() {
        return $this->adulo;
    }

    function getDrogasAlcohol() {
        return $this->drogasAlcohol;
    }

    function getConsecunciaConsumo() {
        return $this->consecunciaConsumo;
    }

    function getMental() {
        return $this->mental;
    }

    function getCriteriosAdmision() {
        return $this->criteriosAdmision;
    }

    function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    function setIdingreso($idingreso) {
        $this->idingreso = $idingreso;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setOtro($otro) {
        $this->otro = $otro;
    }

    function setAcude($acude) {
        $this->acude = $acude;
    }

    function setParentesco($parentesco) {
        $this->parentesco = $parentesco;
    }

    function setAdulo($adulo) {
        $this->adulo = $adulo;
    }

    function setDrogasAlcohol($drogasAlcohol) {
        $this->drogasAlcohol = $drogasAlcohol;
    }

    function setConsecunciaConsumo($consecunciaConsumo) {
        $this->consecunciaConsumo = $consecunciaConsumo;
    }

    function setMental($mental) {
        $this->mental = $mental;
    }

    function setCriteriosAdmision($criteriosAdmision) {
        $this->criteriosAdmision = $criteriosAdmision;
    }

    function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $fechaIngreso;
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

    function setEscolaridad($escolaridad) {
        $this->escolaridad = $escolaridad;
    }

    function setOcupacion($ocupacion) {
        $this->ocupacion = $ocupacion;
    }

    function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
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
        $this->escolaridad = (isset($data['escolaridad'])) ? $data['escolaridad'] : null;
        $this->ocupacion = (isset($data['ocupacion'])) ? $data['ocupacion'] : null;
        $this->estadoCivil = (isset($data['estadoCivil'])) ? $data['estadoCivil'] : null;
        $this->servicioMedico = (isset($data['servicioMedico'])) ? $data['servicioMedico'] : null;
        $this->tipoServicio = (isset($data['tipoServicio'])) ? $data['tipoServicio'] : null;
        $this->numero = (isset($data['numero'])) ? $data['numero'] : null;
        $this->tipoPaciente = (isset($data['tipoPaciente'])) ? $data['tipoPaciente'] : null;
        $this->telefonoPp = (isset($data['telefonoPp'])) ? $data['telefonoPp'] : null;
        $this->telefonoPt = (isset($data['telefonoPt'])) ? $data['telefonoPt'] : null;
        $this->celular = (isset($data['celular'])) ? $data['celular'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;

        $this->idingreso = (isset($data['idingreso'])) ? $data['idingreso'] : null;
        $this->tipo = (isset($data['tipo'])) ? $data['tipo'] : null;
        $this->referencia = (isset($data['referencia'])) ? $data['referencia'] : null;
        $this->otro = (isset($data['otro'])) ? $data['otro'] : null;
        $this->acude = (isset($data['acude'])) ? $data['acude'] : null;
        $this->parentesco = (isset($data['parentesco'])) ? $data['parentesco'] : null;
        $this->adulo = (isset($data['adulo'])) ? $data['adulo'] : null;
        $this->drogasAlcohol = (isset($data['drogasAlcohol'])) ? $data['drogasAlcohol'] : null;
        $this->consecunciaConsumo = (isset($data['consecunciaConsumo'])) ? $data['consecunciaConsumo'] : null;
        $this->mental = (isset($data['mental'])) ? $data['mental'] : null;
        $this->criteriosAdmision = (isset($data['criteriosAdmision'])) ? $data['criteriosAdmision'] : null;
        $this->fecha = (isset($data['fecha'])) ? $data['fecha'] : null;
        $this->fechaIngreso = (isset($data['fechaIngreso'])) ? $data['fechaIngreso'] : null;
        
        $this->nombreFam = (isset($data['nombreFam'])) ? $data['nombreFam'] : null;
        $this->domicilioFam = (isset($data['domicilioFam'])) ? $data['domicilioFam'] : null;
        $this->numeroFam = (isset($data['numeroFam'])) ? $data['numeroFam'] : null;
        $this->coloniaFam = (isset($data['coloniaFam'])) ? $data['coloniaFam'] : null;
        $this->telefonoParticularFam = (isset($data['telefonoParticularFam'])) ? $data['telefonoParticularFam'] : null;
        $this->celularFam = (isset($data['celularFam'])) ? $data['celularFam'] : null;
       
        
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
