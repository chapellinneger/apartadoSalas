<?php

class BaseDeDato {

      private $Servidor;
      private $Puerto;
      private $Nombre;
      private $Usuario;
      private $Clave;

      function BaseDeDato($Servidor,$Puerto,$Nombre,$Usuario,$Clave)
      {
         $this->Servidor=$Servidor;
         $this->Puerto=$Puerto;
         $this->Nombre=$Nombre;
         $this->Usuario=$Usuario;
         $this->Clave=$Clave;
         //echo $this->Servidor;
      }
     function Conectar()
      {
      	 //echo "$this->Servidor</br>";
      	 //echo "$this->Puerto</br>";
      	 //echo "$this->Nombre</br>";
      	 //echo "$this->Usuario</br>";
      	 //echo "$this->Clave</br>";
         //$BaseDato = mysql_connect($this->Servidor, $this->Usuario, $this->Clave);
	 //mysql_database($this->Nombre,$BaseDato);
         //$BaseDato = mysqli_connect($this->Servidor,$this->Usuario,$this->Clave,$this->Nombre);
	 $BaseDato = new mysqli($this->Servidor,$this->Usuario,$this->Clave,$this->Nombre);
	 return $BaseDato;

      }
      function Consultas($Consulta)
      {

         $Valor= $this->Conectar();
         if(($Valor->connect_erro) || ($Valor == null)){
	    echo "error de conneccion</br>";
            echo "errno de depuración: " . $Valor->connect_error ."</br>";
            return 0; //Si no se pudo conectar
         }
         else
         {
            //Valor es resultado de base de dato y Consulta es la Consulta a realizar
         	$acentos = $Valor->query("SET NAMES 'utf8'");
         	$Resultado = $Valor->query($Consulta);
	    //echo  $Consulta;
	    //echo $Resultado->num_rows;
	    //$rows = $Resultado->fetch_array(MYSQLI_ASSOC);
	    $substr = substr($Consulta,0, 6);
	    if ($substr == 'INSERT' || $substr == 'UPDATE' || $substr == 'DELETE'){
		$res = $Valor->insert_id;
		//echo $res;
		if(!$res){
			if ($Valor->affected_rows){
				return true;
			}
		}
	   	$Valor->close();
		return $res;
	   }else{
		if ($Resultado->num_rows > 0){
			$i=0;
			while($dbResult = $Resultado->fetch_assoc()){
				$rows[$i] = $dbResult;
				$i++;
			}
	   	}
	   }


	   $Resultado->free();
	   $Valor->close();
           return $rows;// retorna si fue afectada una fila

         }
      }
   }
?>
