/**
 * Programa control para el envio de mensajes 
 * basado en el sensor E18-D80NK 
 * Sensor IR 
 * Luis Cobián 
 * 3 de junio 
 */


/**
 * Constantes 
 */

#include <SoftwareSerial.h>
SoftwareSerial ESP(3, 2); // RX | TX


#define SENSOR1 4 // pin para conectar primer sensor
#define SENSOR2 7 // pin para conectar segundo sensor
#define INDICADOR1 12 // led indica primero cajon
#define INDICADOR2 13 // led indica segundo cajon 


int estado1;
int estado2; 
int lock1;
int lock2;

void setup() {
  Serial.begin(9600);
  ESP.begin(115200);
  delay(1000);
  
  pinMode(SENSOR1, INPUT_PULLUP); // amarillo 
  pinMode(SENSOR2, INPUT_PULLUP);  // blanco
  pinMode(INDICADOR1, OUTPUT); 
  pinMode(INDICADOR2, OUTPUT);
  estado1=-1;
  estado2=-1;
  lock1=0;
  lock2=0;
}

void loop() {
  int left = digitalRead(SENSOR1);
  int right = digitalRead(SENSOR2); 
  verificaSensor(left,INDICADOR1,&estado1,&lock1);
  verificaSensor(right,INDICADOR2,&estado2,&lock2);
   
  delay(500);
}

void verificaSensor(int valor, int indicador, 
                    int *estado, int *lock) {
    if(valor==0){
        if(*estado!=1) {
             digitalWrite(indicador,HIGH);
             *estado=1;
             *lock=1;
              imprimirEstado(estado);
        }
        else 
          *lock=1;
    }else {
      if(*estado!=0 && *lock==0){
         digitalWrite(indicador,LOW);
        *estado=0;
        imprimirEstado(estado);
      }
      else 
         *lock=0;
    }
    
    
}

void imprimirEstado(int *estado){  
  if(estado==&estado1)
  {
    Serial.print("Cajon1:");
    Serial.println(estado1);
    if(estado1==0)
      enviarActualizacion("GET /iot/phps/cambioLugares.php?lugar=1&estado=0 HTTP/1.1");
    else
      enviarActualizacion("GET /iot/phps/cambioLugares.php?lugar=1&estado=1 HTTP/1.1");
  }
  else {
    Serial.print("Cajon2:");
    Serial.println(estado2);
    if(estado2==0)
      enviarActualizacion("GET /iot/phps/cambioLugares.php?lugar=2&estado=0 HTTP/1.1");
    else
      enviarActualizacion("GET /iot/phps/cambioLugares.php?lugar=2&estado=1 HTTP/1.1");
  }
}


void enviarActualizacion(char *strHTTP){
     Serial.println("Enviar actualización");
     Serial.println(strHTTP);
     ESP.println("AT+CIPSTART=\"TCP\",\"luiscobian.com.mx\",80");
     delay(200);
     ESP.println("AT+CIPSEND=102");
     delay(200);
     ESP.println(strHTTP);
     //ESP.println("GET /iot/phps/cambioLugares.php?lugar=1&estado=0 HTTP/1.1");
     delay(200);
     ESP.println("Host:luiscobian.com.mx");
     delay(200);
     ESP.println("Conexion: close");
     delay(200);
     ESP.println("");
     ESP.println("AT+CIPCLOSE"); 
     delay(2500);   

}
