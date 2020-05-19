<?php 
class Destinatario {

    private $id;
    private $Nombre;
	private $PrimerApellido;
	private $SegundoApellido;
    private $Cedula;
    private $Correo;

	function Destinatario($id,$Nombre,$PrimerApellido,$SegundoApellido,$Cedula,$Correo) {

        $this->id = $id;
        $this->Nombre = $Nombre;
        $this->PrimerApellido = $PrimerApellido;
        $this->SegundoApellido = $SegundoApellido;
        $this->Cedula = $Cedula;
        $this->Correo = $Correo;
    }

 function getid() { 
		return $this->id; 
	}
	function setid($id) { 
		$this->id = $id; 
	}
	 function getNombre() { 
		return $this->Nombre; 
	}
	function setNombre($Nombre) { 
		$this->Nombre = $Nombre; 
	}
	 function getPrimerApellido() { 
		return $this->PrimerApellido; 
	}
	function setPrimerApellido($PrimerApellido) { 
		$this->PrimerApellido = $PrimerApellido; 
	}
	function getSegundoApellido() { 
		return $this->SegundoApellido; 
	}
	function setSegundoApellido($SegundoApellido) { 
		$this->SegundoApellido = $SegundoApellido; 
	}
	 function getCedula() { 
		return $this->Cedula; 
	}
	function setCedula($Cedula) { 
		$this->Cedula = $Cedula; 
	}
	 function getCorreo() { 
		return $this->Correo; 
	}
	function setCorreo($Correo) { 
		$this->Correo = $Correo; 
	}

}
?>