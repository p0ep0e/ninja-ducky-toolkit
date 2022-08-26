# Ninja Ducky Toolkit

A collection of scripts designed to exfiltrate data using a HID USB implant sending securely to a remote web server for the purposes of demonstration and security hardening.

The aim of the scripts is to address a couple of challenges I had:

 - I wanted to use cheap and disposable USB implants because using them is generally opportunistic - I want to be able to plug one in to an unlocked computer and walk away.
 - Most payloads (scripts) out there for exfiltrating data to a remote location rely on either SMTP or FTP meaning that you expose login credentials not only on-screen but these can also be retrieved by decompiling the device.
 - Attiny85 USB devices have don't handle long sophisticated payloads due to memory constraints.
 - Sending by email isn't always secure and can often expose the data enroute to the destination mailbox

## How does it work?

### Data exfiltration and processing

![A diagram showing how the Ninja Ducky scripts interoperate](http://bobmckay.com/wp-content/uploads/2022/08/Ninja-Ducky-Diagram-Part1.jpg)

### Data decryption
If you encrypt your data, there is a simple method for decrypting it

![A diagram showing how the decryption page is used](http://bobmckay.com/wp-content/uploads/2022/08/Ninja-Ducky-Diagram-Part2.jpg)

## The Toolkit Files

### NinjaDuckyV1.0.ino
This file is the Arduino script for compiling and deploying on to ATtiny85 USB boards.  These are very cost effective boards but limited when compared with something like the Hak5 Rubber Ducky, however they low-cost means you do not have to worry about retrieving them - hence the need for a robust way of exfiltrating the data to a remote server.  IMPORTANT NOTE: This is currently written for UK keyboards [because of issues with the DigiKeyboard library](https://bobmckay.com/i-t-support-networking/using-the-digispark-digikeyboard-h-library-with-uk-keyboards/)

### NinjaDuckyReceiver.php
This is the workhorse of the script, recieving the data posted to it by the ducky.  It can then encrypt the data, save it on the webserver and/or email it to a recipient.

### NinjaDuckyDecrypter.php
This file is used if you decide to encrypt the captured data in the NinjaDuckyReceiver.php before storing or emailing it.  It provides a simple method of decrypting it.  This can be hosted completely seperately or even locally for improved security and convenience.

### NinjaDuckyTester.php
Diagnosing the server side aspect of the Ninja Ducky scripts can be difficult if you have to keep unplugging and replugging USB devices, waiting for the scripts to finish, etc.   The NinjaDuckyTester.php provides a simply way of posting sample data to the NinjaDuckyReceiver.php to test the encryption, saving and emailing features.

# To Do
I need to:
 - Create versions of the compiled script for different keyboard country layouts (but would love some help).
 - I like the idea of exploring options for public key cryptography for the encryption, more as a point of interest.
 - Use the 10 second waiting time for the gatherNetworkInfo.vbs script to run to gather other interesting information - suggestions welcome!
