//#############################################
// Program name : H-BridgeTest

//#############################################

// A program to conrol the H-bridge serially through ESP8266

//#############################################

int time = 20;

void setup() {

  Serial.begin(115200);     // setup serial communication
  delay(10);
  
  //prepare GPIO's 
  
  pinMode(2, OUTPUT);       // PWM enable pin 
  pinMode(4, OUTPUT);       // Input pin to IN1
  pinMode(5, OUTPUT);       // INput pin to IN2

  
}

void loop() {

 

  digitalWrite(4, HIGH);             // To set the direction of the coil to latched
  digitalWrite(5 ,LOW);
  
  digitalWrite(2, HIGH);             // Give PWM signal for 20 seconds
  delay(time);             
  digitalWrite(2, LOW); 
  
  delay(2000);

  digitalWrite(4, LOW);              // To set the direction of the coil to unlatched 
  digitalWrite(5 ,HIGH);
  
  digitalWrite(2, HIGH);
  delay(time);                       // PWM signal for 20 seconds
  digitalWrite(2, LOW); 
  
  delay(2000);

}

//#############################################
