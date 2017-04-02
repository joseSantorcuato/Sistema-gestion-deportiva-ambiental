#include <VSync.h>
ValueSender<1> sender;

int pin = 8;
unsigned long duracion;
unsigned long inicio;
unsigned long tDeSampleoMS = 20000;//sampe 30s&nbsp;;
unsigned long usoPw = 0;
float fq = 0;
float icap = 0;
int indice = 10;

void setup() {
  Serial.begin(19200);
  pinMode(8,INPUT);
  inicio = millis();//get the current time;
  
  sender.observe(indice);

}

void loop() {
  duracion = pulseIn(pin, LOW);
  usoPw = usoPw+duracion;

  if ((millis()-inicio) >= tDeSampleoMS)//if the sampel time = = 30s
  {
    fq = usoPw/(tDeSampleoMS*99.0);  // Integer percentage 0=&gt;100
    icap = 1.1*pow(fq,3)-3.8*pow(fq,2)+520*fq+0.62; // using spec sheet curve

    usoPw = 0;
    inicio = millis();
  
    
  }
     indice = int(icap);
    sender.sync();

}

