<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Esta clase se contruye con el fin de realizar operaciones repetitivas en todos
 * los modelos
 */

include_once './../conf/conexion.php';
class clase_generica {
    //inicio_clase
    private $row;
    private $resultado = array();
    private $host = 'localhost';
    //http://localhost/phpmyadmin
    private $port = '3306';
    private $nombre_bd = 'reserva_salas_nueva';
    private $usua = 'root';
    private $clave = 'root';
    private $connec;

    //estos son los datos de la segunda connecion
    private $host2 = 'localhost';
    private $port2 = '3306';
    private $nombre_bd2 = 'sadministracion';
    private $usua2 = 'root';
    private $clave2 = 'root';
    private $connec2;
    
    
    //metodo constructor Vacio
    function __construct() {
		$this->connec = New BaseDeDato($this->host,$this->port, $this->nombre_bd,$this->usua,$this->clave);
		$this->connec2 = New BaseDeDato($this->host2,$this->port2, $this->nombre_bd2,$this->usua2,$this->clave2);
    }
   
    
    //El ConsultaG se encarga de realizar las operaciones de consulta con las base de datos y genera un array
    function ConsultaG($sql_g) {
                 $resu = $this->connec->Consultas($sql_g);
                 //$rsEstados = mysql_fetch_all($resu);
                 $this->resultado=$resu;
                 return $this->resultado;
        }
    
    function ConsultaG2($sql_g) {
                 $resu = $this->connec2->Consultas($sql_g);
                 //$rsEstados = mysql_fetch_all($resu);
                 $this->resultado=$resu;
                 return $this->resultado;
        }
    //Método geter de la variable privada resultado;
    public function getResultado() {
            return $this->resultado;
        }
        
    //Este metodo es util para imprimir los arreglos que se necesiten ver
    public function imprimeArray(){
        $imprimir .= '<pre>'.print_r($this->row).'<pre>';
        return $imprimir;
    }
    
    //Método que genera un query para insert;
    function insert($nomTabla) {
        
      $sql = "INSERT INTO $nomTabla";
      
      $sql.= " (".implode(",", array_keys($this->row)).")";
      
      $sql.= " VALUES (";
      $numero = count($this->row);
      foreach ($this->row as $key => $value) {
             if(is_numeric($value)){
                 $sql.=" ".$value;
             } else {
                 $sql.= "'$value'";
             }
             $aux +=1;
             if($numero == $aux){
                 $sql.=") ";
             }else {
                 $sql.=",";
             }
      }
          
      return $sql;

    }
    
    
    function update($nombreTabla, $where) {
        $numero = count($this->row);
        $sql="UPDATE ".$nombreTabla ." SET ";
        foreach ($this->row as $key => $value){
            if(is_numeric($value)){
                $sql.= $key." = ".$value;
            } 
            else
            {
                $sql.= $key." = '".$value."'";
            }
             $aux +=1;
             if($numero == $aux){
                 $sql.=" WHERE ";
             }else {
                 $sql.=",";
             }
        }
        $sql.= $where;
        
        return $sql;
    }
    
    //setea la variable privada row
    public function setRow($row) {
        $this->row = $row;
    }
    
    //setea la variable resultado
    public function setResultado($resultado) {
        $this->resultado = $resultado;
    }



}
/*
$valor = new clase_generica();
$arra_insert = array(
		'codigo_tipo_catalogo' => 123,
		'denominacion' => 'prueba',
		'anho' => 2016,
		'codigo_presupuestario' => 12,
		'estatus' => 'activo'
);

$valor->setRow($arra_insert);
$sql = $valor->insert('catalogo_bienes');
$sql .= ' RETURNING id_catalogo_bienes';
$result = $valor->ConsultaG($sql);

*/
?>
