<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

/*
NINJA DUCKY V1.0
A collection of scripts designed to exfiltrate data using a HID USB implant sending securely to a remote web server for the purposes of demonstration and security hardening.

Author: Bob McKay
August 2022
GitHub: https://github.com/p0ep0e/ninja-ducky-toolkit
*/

?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ninja Ducky Tester</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ninja Ducky Tester</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item"><a class="nav-link" href="https://github.com/p0ep0e/ninja-ducky-toolkit">Ninja Ducky GitHub Repo</a></li>
                <li class="nav-item"><a class="nav-link" href="https://bobmckay.com/i-t-support-networking/ethical-hacking/ninja-ducky-tool…via-usb-implants/">About Ninja Ducky</a></li>
                <li class="nav-item"><a class="nav-link" href="https://seguro.ltd" title="Seguro Information & Cyber Security Consulting">Sponsored by Seguro</a></li>
            </ul>
        </div>
    </div>
</nav>
<main class="container" style="margin-top: 80px">
    <h1>Ninja Ducky Tester</h1>
    <div class="bg-light p-5 rounded">
        <p>Submit test data to your Ninja Ducky Receiver Script for testing and troubleshooting.</p>
        <form action="NinjaDuckyReceiver.php?noCache=<?=date_timestamp_get(date_create())?>" method="post">
            <div class="mb-3">
                <label for="duckyToken" class="form-label">Ducky Token</label>
                <input type="text" class="form-control" id="duckyToken" name="duckyToken" aria-describedby="duckyToken">
                <div id="duckyToken" class="form-text">The token your ducky will use to authenticate against the script.</div>
            </div>
            <div class="mb-3">
                <label for="wifiPwds" class="form-label">Wifi Password Data (wifiPwds)</label>
                <textarea class="form-control" id="wifiPwds" name="wifiPwds" rows="10">&lt;?xml version=&quot;1.0&quot;?&gt;&lt;WLANProfile xmlns=&quot;http://www.microsoft.com/networking/WLAN/profile/v1&quot;&gt;&lt;name&gt;BT-96CMGX&lt;/name&gt;&lt;SSIDConfig&gt;&lt;SSID&gt;&lt;hex&gt;4765744475636B6564&lt;/hex&gt;&lt;name&gt;GetDucked&lt;/name&gt;&lt;/SSID&gt;&lt;/SSIDConfig&gt;&lt;connectionType&gt;ESS&lt;/connectionType&gt;&lt;connectionMode&gt;auto&lt;/connectionMode&gt;&lt;MSM&gt;&lt;security&gt;&lt;authEncryption&gt;&lt;authentication&gt;WPA2PSK&lt;/authentication&gt;&lt;encryption&gt;AES&lt;/encryption&gt;&lt;useOneX&gt;false&lt;/useOneX&gt;&lt;/authEncryption&gt;&lt;sharedKey&gt;&lt;keyType&gt;passPhrase&lt;/keyType&gt;&lt;protected&gt;false&lt;/protected&gt;&lt;keyMaterial&gt;stinkyPassword&lt;/keyMaterial&gt;&lt;/sharedKey&gt;&lt;/security&gt;&lt;/MSM&gt;&lt;MacRandomization xmlns=&quot;http://www.microsoft.com/networking/WLAN/profile/v3&quot;&gt;&lt;enableRandomization&gt;false&lt;/enableRandomization&gt;&lt;randomizationSeed&gt;2021388807&lt;/randomizationSeed&gt;&lt;/MacRandomization&gt;&lt;/WLANProfile&gt;</textarea>
            </div>
            <div class="mb-3">
                <label for="osInfo" class="form-label">OS Info (osInfo)</label>
                <textarea class="form-control" id="osInfo" name="osInfo" rows="10">[Architecture/Processor Information] PROCESSOR_ARCHITECTURE=AMD64 PROCESSOR_IDENTIFIER=Intel64 Family 6 Model 142 Stepping 12, GenuineIntel PROCESSOR_LEVEL=6 PROCESSOR_REVISION=8e0c [Operating System Information] Product Name = Windows 10 Pro Version = 6.3 Build Lab = 19041.1.amd64fre.vb_release.190206-1206 Type = Multiprocessor Free This is a spankingly clean installed system [File versions] onex.dll 10.0.19041.928 l2nacp.dll 10.0.19041.1 wlanapi.dll 10.0.19041.1741 wlancfg.dll 10.0.19041.1237 wlanconn.dll 10.0.19041.746 wlandlg.dll 10.0.19041.746 wlanext.exe 10.0.19041.1 wlangpui.dll 10.0.19041.746 wlanhc.dll 10.0.19041.746 wlanmm.dll 10.0.19041.746 wlanmsm.dll 10.0.19041.1741 wlanpref.dll 10.0.19041.746 wlansec.dll 10.0.19041.1741 wlansvc.dll 10.0.19041.1865 wlanui.dll 10.0.19041.1202 onex.dll 10.0.19041.928 dot3api.dll 10.0.19041.1682 dot3cfg.dll 10.0.19041.1266 dot3dlg.dll 10.0.19041.746 dot3gpclnt.dll 10.0.19041.1 dot3gpui.dll 10.0.19041.746 dot3msm.dll 10.0.19041.1682 dot3svc.dll 10.0.19041.1682 dot3ui.dll 10.0.19041.1 [Power Information] Machine is running on a flux capacitor [System Information] Host Name: NINJADUCK OS Name: Microsoft Windows 10 Pro OS Version: 10.0.19044 N/A Build 19044 OS Manufacturer: Microsoft Corporation OS Configuration: Member Workstation OS Build Type: Multiprocessor Free Registered Owner: Ninja Ducky Registered Organization: Product ID: 00331-20096-64478-AA583 Original Install Date: 27/01/2020, 09:28:19 System Boot Time: 24/08/2020, 21:30:35 System Manufacturer: Duck Inc. System Model: Zubion 3000 System Type: x64-based PC Processor(s): 1 Processor(s) Installed. [01]: Intel64 Family 6 Model 142 Stepping 12 GenuineIntel ~1803 Mhz BIOS Version: Dell Inc. 1.14.0, 10/06/2022 Windows Directory: C:\Windows System Directory: C:\Windows\system32 Boot Device: \Device\HarddiskVolume1 System Locale: en-gb;English (United Kingdom) Input Locale: en-gb;English (United Kingdom) Time Zone: (UTC+00:00) Dublin, Edinburgh, Lisbon, London Total Physical Memory: 16,166 MB Available Physical Memory: 8,748 MB Virtual Memory: Max Size: 18,598 MB Virtual Memory: Available: 10,236 MB Virtual Memory: In Use: 8,362 MB Page File Location(s): C:\pagefile.sys Domain: ninjaducky.com Logon Server: \\DC Hotfix(s): 13 Hotfix(s) Installed. [01]: KB5015730 [02]: KB5003791 [03]: KB5012170 Network Card(s): 6 NIC(s) Installed. [01]: Intel(R) Wi-Fi 7 AX201 160MHz Connection Name: WiFi DHCP Enabled: Yes DHCP Server: 192.168.1.1 IP address(es) [01]: 192.168.1.49 [02]: Bluetooth Device (Personal Area Network) Connection Name: Bluetooth Network Connection Status: Media disconnected [03]: DisplayLink Network Adapter NCM Connection Name: Ethernet Status: Media disconnected [04]: TAP-Windows Adapter V9 Connection Name: Local Area Connection Status: Media disconnected [05]: Hyper-V Virtual Ethernet Adapter Connection Name: vEthernet (Default Switch) DHCP Enabled: No IP address(es) [01]: 172.14.92.1 [02]: fe60::a116:f23d:5143:a40f [06]: Hyper-V Virtual Ethernet Adapter Connection Name: vEthernet (External Network Switch (NO NAT)) Status: Hardware not present Hyper-V Requirements: A hypervisor has been detected. Features required for Hyper-V will not be displayed. [User Information] USERDNSDOMAIN=NINJADUCKY.COM USERDOMAIN=NINJADUCKY USERDOMAIN_ROAMINGPROFILE=NINJADUCKY USERNAME=ninja.duck USERPROFILE=C:\Users\ninjaduck</textarea>
            </div>
            <div class="mb-3">
                <label for="smbInfo" class="form-label">SMB Info (smbInfo)</label>
                <textarea class="form-control" id="smbInfo" name="smbInfo" rows="10">NBTSTAT -N: Bluetooth Network Connection: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache Local Area Connection* 1: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache Ethernet: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache Local Area Connection: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache WiFi: Node IpAddress: [192.168.1.49] Scope Id: [] NetBIOS Local Name Table Name Type Status --------------------------------------------- NINJADUCKY &lt;00&gt; UNIQUE Registered NINJADUCKY &lt;20&gt; UNIQUE Registered DUCKVILLE &lt;00&gt; GROUP Registered vEthernet (Default Switch): Node IpAddress: [172.19.96.1] Scope Id: [] NetBIOS Local Name Table Name Type Status --------------------------------------------- NINJADUCKY &lt;00&gt; UNIQUE Registered NINJADUCKY &lt;20&gt; UNIQUE Registered DUCKVILLE &lt;00&gt; GROUP Registered Local Area Connection* 10: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache NBTSTAT -C: Bluetooth Network Connection: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache Local Area Connection* 1: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache Ethernet: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache Local Area Connection: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache WiFi: Node IpAddress: [192.168.1.49] Scope Id: [] No names in cache vEthernet (Default Switch): Node IpAddress: [172.19.96.1] Scope Id: [] No names in cache Local Area Connection* 10: Node IpAddress: [0.0.0.0] Scope Id: [] No names in cache NET CONFIG RDR: Computer name \\NINJADUCKY Full Computer name duck.ninjaducky.com User name ninja.duck Workstation active on NetBT_Tcpip_{DC00B3CE-344E-432D-8C3C-D6FFC0493B21} (0C7A15DB786F) Software version Windows 10 Pro Workstation domain NINJADUCKY Workstation Domain DNS Name ninjaducky.com Logon domain NINJADUCKY COM Open Timeout (sec) 0 COM Send Count (byte) 16 COM Send Timeout (msec) 250 The command completed successfully. NET CONFIG SRV: NET SHARE: Share name Resource Remark ------------------------------------------------------------------------------- C$ C:\ Default share D$ D:\ Default share IPC$ Remote IPC ADMIN$ C:\Windows Remote Admin The command completed successfully.</textarea>
            </div>
            <div class="mb-3">
                <label for="envInfo" class="form-label">Environment Info (envInfo)</label>
                <textarea class="form-control" id="envInfo" name="envInfo" rows="10">We're no strangers to love&#13;&#10;You know the rules and so do I (do I)&#13;&#10;A full commitment's what I'm thinking of&#13;&#10;You wouldn't get this from any other guy&#13;&#10;I just wanna tell you how I'm feeling&#13;&#10;Gotta make you understandNever gonna give you up&#13;&#10;Never gonna let you down&#13;&#10;Never gonna run around and desert you&#13;&#10;Never gonna make you cry&#13;&#10;Never gonna say goodbye&#13;&#10;Never gonna tell a lie and hurt you&#13;&#10;We've known each other for so long&#13;&#10;Your heart's been aching, but you're too shy to say it (say it)&#13;&#10;Inside, we both know what's been going on (going on)&#13;&#10;We know the game and we're gonna play it&#13;&#10;And if you ask me how I'm feeling&#13;&#10;Don't tell me you're too blind to see&#13;&#10;Never gonna give you up&#13;&#10;Never gonna let you down&#13;&#10;Never gonna run around and desert you&#13;&#10;Never gonna make you cry&#13;&#10;Never gonna say goodbye&#13;&#10;Never gonna tell a lie and hurt you&#13;&#10;Never gonna give you up&#13;&#10;Never gonna let you down&#13;&#10;Never gonna run around and desert you&#13;&#10;Never gonna make you cry&#13;&#10;Never gonna say goodbye&#13;&#10;Never gonna tell a lie and hurt you&#13;&#10;We've known each other for so long&#13;&#10;Your heart's been aching, but you're too shy to say it (to say it)&#13;&#10;Inside, we both know what's been going on (going on)&#13;&#10;We know the game and we're gonna play it&#13;&#10;I just wanna tell you how I'm feeling&#13;&#10;Gotta make you understand&#13;&#10;Never gonna give you up&#13;&#10;Never gonna let you down&#13;&#10;Never gonna run around and desert you&#13;&#10;Never gonna make you cry&#13;&#10;Never gonna say goodbye&#13;&#10;Never gonna tell a lie and hurt you&#13;&#10;Never gonna give you up&#13;&#10;Never gonna let you down&#13;&#10;Never gonna run around and desert you&#13;&#10;Never gonna make you cry&#13;&#10;Never gonna say goodbye&#13;&#10;Never gonna tell a lie and hurt you&#13;&#10;Never gonna give you up&#13;&#10;Never gonna let you down&#13;&#10;Never gonna run around and desert you&#13;&#10;Never gonna make you cry&#13;&#10;Never gonna say goodbye&#13;&#10;Never gonna tell a lie and hurt you</textarea>
            </div>
            <div class="mb-3">
                <label for="nearby" class="form-label">Nearby LAN Devices (nearby)</label>
                <textarea class="form-control" id="nearby" name="nearby" rows="10">ARP -A: Interface: 192.168.1.49 --- 0x18 Internet Address Physical Address Type 192.168.1.1 64-8f-2f-33-fb-f3 dynamic 192.168.1.6 02-12-66-27-4e-66 dynamic 192.168.1.96 45-e7-ef-c3-65-d7 dynamic 255.255.255.255 ff-ff-ff-ff-ff-ff static NETSH INT IPV6 SHOW NEIGHBORS: Interface 1: Loopback Pseudo-Interface 1 Internet Address Physical Address Type -------------------------------------------- ----------------- ----------- ff02::1:2 Permanent Interface 61: vEthernet (Default Switch) Internet Address Physical Address Type -------------------------------------------- ----------------- ----------- ff02::1 33-33-00-00-00-01 Permanent ff02::2 33-33-00-00-00-02 Permanent</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit to Ninja Ducky Receiver</button>
        </form>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
