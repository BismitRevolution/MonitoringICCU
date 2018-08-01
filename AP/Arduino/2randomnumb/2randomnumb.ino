#include <SPI.h>
#include <Ethernet.h>
byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};
IPAddress ip(192, 168, 5, 2);
IPAddress gateway(192, 168, 5, 1);
IPAddress subnet(255, 255, 255, 0);

EthernetServer server(23);
boolean alreadyConnected = false; 

void setup() {
  Ethernet.begin(mac, ip, gateway, subnet);
  server.begin();
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial 
  }
}

void loop() {
  EthernetClient client = server.available();
      client.flush();
      long H1 = bacadetak1();
      long H2 = bacadetak2();
    String gabs="D#"+String(H1)+"#"+String(H2)+"#X";

Serial.println(gabs);
client.println(gabs);
delay (1000);
}

long bacadetak1 () {
  long r=random(70,100);
  return r;
}

long bacadetak2 () {
  long q=random(60,90);
  return q;
}
