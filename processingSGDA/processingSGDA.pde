/*SISTEMAAMBIENTAL DE GESTION DEPORTIVA
*CHILE 2016*
*Se incluye codigo comentado, conexion a base de datos, registro de 3 sensores, hora y fecha*
*Creacion de log error, txt, con registro de los tres sensores, hora y fecha en caso de no poder acceder a bd*
*Santorcuato 2016 santorcuato76@gmail.com*
*/
import processing.serial.*;// importo todos los metodos de la libreria serial
import vsync.*;

import de.bezier.data.sql.*;//importo libreria para mysql
MySQL msql;// creacion objeto msql para base de datos
ValueReceiver receiver;

public int indice;

int minu;// variables que luego se utilizaran para contener tiempo
int secu;


int[] minutero;
int[] minuterob;
boolean estado;


void setup() {
  size(100,100);// ventana por defecto processing
 minutero= new int[61];
 minuterob= new int[60];

  println(Arduino.list());//lista de arduinos

  Serial serial = new Serial(this, "/dev/ttyACM0", 19200);
  receiver = new ValueReceiver(this, serial);

  receiver.observe("indice");



       String usuario     = "root"; //parametros conexion MySql
      String password     = "pass";
      String basedatos = "deportes";

        msql = new MySQL( this, "localhost", basedatos, usuario, password );//definicion parametros objeto msql
        msql.connect();//se establece conexion




}

void draw() {



int d = day();    //variables que contienen dia, mes y ano
int m = month();
int a = year();


int ho = hour();


int mi = minute();
int se = second();

String dia = String.valueOf(d);

String mes = String.valueOf(m);

String ano = String.valueOf(a);

String fec = ano+"-"+mes+"-"+dia;
println( "Fecha: " ,fec );//concatencacion para fecha

String hora = String.valueOf(ho);

String minutos = String.valueOf(mi);

String segundos = String.valueOf(se);

String hrComp = hora+":"+minutos+":"+segundos;
println( "Hora: " , hrComp );//concatencacion para hora


println("ICAP: "+indice);






  String sen1 = str(indice);//se pasan a string para la base de datos





  minu = minute();// variables para evalauar e insertar en base de datos
  secu = second();



  //REGISTRO SENSORES EN BASE DE DATOS
     for (int i = 0; i < 61; i++) {

    minutero[i] = i;


    // si los minutos son igual a 10, 20,30,40,50 y los segundos 0 guarda el valor de los sensores, hora y fecha
        if (minu  == minutero[i] && secu < 2 ){

msql.query("INSERT INTO DatoSensor (Fecha, Hora, MedicionDatoSensor) VALUES ('%s','%s','%s')", fec, hrComp, sen1);
        delay(1000);
        println( "Valores ingresados a la base de datos" );//salida terminal processing




     }


     if (minu  == minutero[i] && secu < 2 ){





   delay(1000);
   println( "Valores respaldados en txt" );//salida terminal processing

   delay(1000);


     }

        //Si no se estable conexion y  los minutos son igual a 10, 20,30,40,50 y los segundos 0 guarda el valor de los sensores, hora y fecha en el txt





     }}
