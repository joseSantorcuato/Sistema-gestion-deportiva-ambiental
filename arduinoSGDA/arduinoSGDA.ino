#include <VSync.h>
ValueSender<1> sender;

int pin = 8;
unsigned long duracion;
unsigned long inicio;
unsigned long tDeSampleoMS = 20000;//samplea y promedia cada 20 segundos;
unsigned long usoPw = 0;
float fq = 0;
float icap = 0;
int indice = 10;

void setup() {
  Serial.begin(19200);
  pinMode(8,INPUT);
  inicio = millis();//tiempo desde que arranco soft
  
  sender.observe(indice);

}

void loop() {
  duracion = pulseIn(pin, LOW);
  usoPw = usoPw+duracion;

  if ((millis()-inicio) >= tDeSampleoMS)//sie el tiempo de muestreo o sampleo es mayor o iguual 20s
  {
    fq = usoPw/(tDeSampleoMS*99.0);  // promedia variaciones de pulso
    icap = 1.1*pow(fq,3)-3.8*pow(fq,2)+520*fq+0.62; // para icap

    usoPw = 0;
    inicio = millis();
    indice = int(icap);
     sender.sync();
    
  }
   

}

