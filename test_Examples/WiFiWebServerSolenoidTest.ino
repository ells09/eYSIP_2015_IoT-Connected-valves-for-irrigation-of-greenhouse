//#############################################
// Program name : WifiWebServerSolenoidTest

//#############################################

/*
 *  This sketch demonstrates how to set up a simple HTTP-like server.
 *  The server will set a GPIO pin depending on the request
 *    http://server_ip/gpio/0 will latch the coil,
 *    http://server_ip/gpio/1 will unlatch the coil
 *  server_ip is the IP address of the ESP8266 module, will be 
 *  printed to Serial when the module is connected.
 */

//#############################################

#include <ESP8266WiFi.h>


const char* ssid = "your-ssid";
const char* password = "your-passwd";

// Create an instance of the server
// specify the port to listen on as an argument

WiFiServer server(80);

void setup() {
  Serial.begin(115200);     // setup serial communication
  delay(10);
  
  //prepare GPIO's 
  
  pinMode(2, OUTPUT);       // PWM enable pin 
  pinMode(4, OUTPUT);       // Input pin to IN1
  pinMode(5, OUTPUT);       // INput pin to IN2
  
  // Connect to WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  
  // Start the server
  server.begin();
  Serial.println("Server started");

  // Print the IP address
  Serial.println(WiFi.localIP());
}

void loop() {
  // Check if a client has connected
  WiFiClient client = server.available();
  if (!client) {
    return;
  }
  
  // Wait until the client sends some data
  Serial.println("new client");
  while(!client.available()){
    delay(1);
  }
  
  // Read the first line of the request
  String req = client.readStringUntil('\r');
  Serial.println(req);
  client.flush();
  
  // Match the request
  int val;
  if (req.indexOf("/gpio/0") != -1)
    val = 0;
  else if (req.indexOf("/gpio/1") != -1)
    val = 1;
  else {
    Serial.println("invalid request");
    client.stop();
    return;
  }

  // latch coil according to the request
  
  if (val==1) {
  digitalWrite(4, HIGH);             // To set the direction of the coil to latched
  digitalWrite(5 ,LOW);
  
  digitalWrite(2, HIGH);             // Give PWM signal for 20 seconds
  delay(20);             
  digitalWrite(2, LOW); 
  
  delay(2000);

  }

  else if (val==0) {
  digitalWrite(4, LOW);              // To set the direction of the coil to unlatched 
  digitalWrite(5 ,HIGH);
  
  digitalWrite(2, HIGH);
  delay(20);                       // PWM signal for 20 seconds
  digitalWrite(2, LOW); 
  
  delay(2000);

  }
  
  client.flush();

  // Prepare the response
  String s = "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\n\r\n<!DOCTYPE HTML>\r\n<html>\r\nCoil is now ";
  s += (val)?"UnLatched":"latched";
  s += "</html>\n";

  // Send the response to the client
  client.print(s);
  delay(1);
  Serial.println("Client disonnected");

  // The client will actually be disconnected 
  // when the function returns and 'client' object is detroyed
}

//#############################################

