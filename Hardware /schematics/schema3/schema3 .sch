EESchema Schematic File Version 2
LIBS:power
LIBS:device
LIBS:transistors
LIBS:conn
LIBS:linear
LIBS:regul
LIBS:74xx
LIBS:cmos4000
LIBS:adc-dac
LIBS:memory
LIBS:xilinx
LIBS:special
LIBS:microcontrollers
LIBS:dsp
LIBS:microchip
LIBS:analog_switches
LIBS:motorola
LIBS:texas
LIBS:intel
LIBS:audio
LIBS:interface
LIBS:digital-audio
LIBS:philips
LIBS:display
LIBS:cypress
LIBS:siliconi
LIBS:opto
LIBS:atmel
LIBS:contrib
LIBS:valves
LIBS:ESP8266
LIBS:ftdi
LIBS:usb-b
LIBS:ft232bm
LIBS:USB
LIBS:schema1 -cache
EELAYER 27 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 1 1
Title ""
Date "20 jun 2015"
Rev ""
Comp ""
Comment1 ""
Comment2 ""
Comment3 ""
Comment4 ""
$EndDescr
$Comp
L 7805 U3
U 1 1 5581C405
P 7050 1650
F 0 "U3" H 7200 1454 60  0000 C CNN
F 1 "7805" H 7050 1850 60  0000 C CNN
F 2 "" H 7050 1650 60  0000 C CNN
F 3 "" H 7050 1650 60  0000 C CNN
	1    7050 1650
	1    0    0    -1  
$EndComp
$Comp
L ESP-07V2 U2
U 1 1 5582A81F
P 5650 2900
F 0 "U2" H 5650 2800 50  0000 C CNN
F 1 "ESP-07" H 5650 3000 50  0000 C CNN
F 2 "" H 5650 2900 50  0001 C CNN
F 3 "" H 5650 2900 50  0001 C CNN
	1    5650 2900
	1    0    0    -1  
$EndComp
$Comp
L R R1
U 1 1 5582A8E6
P 4200 2300
F 0 "R1" V 4280 2300 40  0000 C CNN
F 1 "1K" V 4207 2301 40  0000 C CNN
F 2 "~" V 4130 2300 30  0000 C CNN
F 3 "~" H 4200 2300 30  0000 C CNN
	1    4200 2300
	1    0    0    -1  
$EndComp
$Comp
L R R2
U 1 1 5582A93F
P 4600 2250
F 0 "R2" V 4680 2250 40  0000 C CNN
F 1 "1K" V 4607 2251 40  0000 C CNN
F 2 "~" V 4530 2250 30  0000 C CNN
F 3 "~" H 4600 2250 30  0000 C CNN
	1    4600 2250
	1    0    0    -1  
$EndComp
$Comp
L BATTERY BT1
U 1 1 5582A9C5
P 3550 1600
F 0 "BT1" H 3550 1800 50  0000 C CNN
F 1 "8V" H 3550 1410 50  0000 C CNN
F 2 "~" H 3550 1600 60  0000 C CNN
F 3 "~" H 3550 1600 60  0000 C CNN
	1    3550 1600
	-1   0    0    1   
$EndComp
$Comp
L GND #PWR01
U 1 1 5582AA7E
P 5650 4300
F 0 "#PWR01" H 5650 4300 30  0001 C CNN
F 1 "GND" H 5650 4230 30  0001 C CNN
F 2 "" H 5650 4300 60  0000 C CNN
F 3 "" H 5650 4300 60  0000 C CNN
	1    5650 4300
	1    0    0    -1  
$EndComp
$Comp
L GND #PWR02
U 1 1 5582AAF5
P 5650 4300
F 0 "#PWR02" H 5650 4300 30  0001 C CNN
F 1 "GND" H 5650 4230 30  0001 C CNN
F 2 "" H 5650 4300 60  0000 C CNN
F 3 "" H 5650 4300 60  0000 C CNN
	1    5650 4300
	1    0    0    -1  
$EndComp
$Comp
L LT1129CQ-3.3 U1
U 1 1 5582AB5E
P 5100 1050
F 0 "U1" H 4850 1250 40  0000 C CNN
F 1 "LT1129CQ-3.3" H 5250 1250 40  0000 C CNN
F 2 "TO263-5" H 5100 1150 35  0000 C CIN
F 3 "" H 5100 1050 60  0000 C CNN
	1    5100 1050
	1    0    0    -1  
$EndComp
$Comp
L JUMPER JP1
U 1 1 5582C7B4
P 6800 3450
F 0 "JP1" H 6800 3600 60  0000 C CNN
F 1 "JUMPER" H 6800 3370 40  0000 C CNN
F 2 "~" H 6800 3450 60  0000 C CNN
F 3 "~" H 6800 3450 60  0000 C CNN
	1    6800 3450
	0    -1   -1   0   
$EndComp
$Comp
L CONN_8X2 P1
U 1 1 5582F083
P 8950 3000
F 0 "P1" H 8950 3450 60  0000 C CNN
F 1 "LT293D" V 8950 3000 50  0000 C CNN
F 2 "" H 8950 3000 60  0000 C CNN
F 3 "" H 8950 3000 60  0000 C CNN
	1    8950 3000
	1    0    0    -1  
$EndComp
NoConn ~ 9350 2750
NoConn ~ 9350 2850
NoConn ~ 9350 2950
NoConn ~ 9350 3050
NoConn ~ 9350 3150
NoConn ~ 9350 3250
NoConn ~ 9350 3350
NoConn ~ 4750 2900
NoConn ~ 4750 3000
NoConn ~ 4750 3100
NoConn ~ 4750 3200
NoConn ~ 4650 1150
$Comp
L PWR_FLAG #FLG03
U 1 1 5583E367
P 4650 1000
F 0 "#FLG03" H 4650 1095 30  0001 C CNN
F 1 "PWR_FLAG" H 4650 1180 30  0000 C CNN
F 2 "" H 4650 1000 60  0000 C CNN
F 3 "" H 4650 1000 60  0000 C CNN
	1    4650 1000
	1    0    0    -1  
$EndComp
$Comp
L PWR_FLAG #FLG04
U 1 1 5583EFE8
P 5650 3800
F 0 "#FLG04" H 5650 3895 30  0001 C CNN
F 1 "PWR_FLAG" H 5650 3980 30  0000 C CNN
F 2 "" H 5650 3800 60  0000 C CNN
F 3 "" H 5650 3800 60  0000 C CNN
	1    5650 3800
	-1   0    0    1   
$EndComp
$Comp
L CONN_2 P2
U 1 1 5584D826
P 7950 700
F 0 "P2" V 7900 700 40  0000 C CNN
F 1 "CONN_2" V 8000 700 40  0000 C CNN
F 2 "" H 7950 700 60  0000 C CNN
F 3 "" H 7950 700 60  0000 C CNN
	1    7950 700 
	0    -1   -1   0   
$EndComp
$Comp
L USB-A-PCB P3
U 1 1 5584DD93
P 2350 1200
F 0 "P3" H 2350 1650 60  0000 C CNN
F 1 "USB-A-PCB" H 2450 700 60  0000 C CNN
F 2 "" H 2350 1200 60  0000 C CNN
F 3 "" H 2350 1200 60  0000 C CNN
	1    2350 1200
	0    -1   -1   0   
$EndComp
Text Label 2400 950  1    60   ~ 0
D+
Text Label 7900 5600 0    60   ~ 0
D-
Wire Wire Line
	4750 2800 4200 2800
Wire Wire Line
	4200 2800 4200 2550
Wire Wire Line
	4750 2600 4600 2600
Wire Wire Line
	4600 2600 4600 2500
Wire Wire Line
	4600 2000 4600 1800
Wire Wire Line
	4600 1800 4200 1800
Connection ~ 4200 1800
Wire Wire Line
	3250 1600 3250 3800
Wire Wire Line
	3250 3800 7500 3800
Wire Wire Line
	5650 3800 5650 4300
Connection ~ 4200 1600
Wire Wire Line
	3850 1600 6650 1600
Wire Wire Line
	5550 1000 5650 1000
Wire Wire Line
	5550 1150 5550 1000
Wire Wire Line
	6550 3000 6800 3000
Wire Wire Line
	7450 1600 7450 2200
Wire Wire Line
	7450 2200 9750 2200
Wire Wire Line
	9750 2200 9750 2650
Wire Wire Line
	6550 3100 8300 3100
Wire Wire Line
	6500 1600 6500 2500
Wire Wire Line
	6500 2500 8400 2500
Connection ~ 6500 1600
Wire Wire Line
	7650 1250 7900 1250
Wire Wire Line
	7650 1250 7650 1050
Wire Wire Line
	8000 1250 8250 1250
Wire Wire Line
	8250 1250 8250 1050
Wire Wire Line
	8400 2500 8400 3350
Wire Wire Line
	8400 3350 8550 3350
Wire Wire Line
	9750 2650 9350 2650
Wire Wire Line
	8550 2850 7900 2850
Wire Wire Line
	7900 2850 7900 1250
Wire Wire Line
	8550 3150 8000 3150
Wire Wire Line
	8000 3150 8000 1250
Wire Wire Line
	8300 3100 8300 2650
Wire Wire Line
	8300 2650 8550 2650
Wire Wire Line
	6550 2800 7100 2800
Wire Wire Line
	7100 2800 7100 2750
Wire Wire Line
	7100 2750 8550 2750
Wire Wire Line
	8550 2950 8550 3050
Wire Wire Line
	8550 2950 7500 2950
Wire Wire Line
	6550 2900 7300 2900
Wire Wire Line
	7300 2900 7300 3250
Wire Wire Line
	7300 3250 8550 3250
Wire Wire Line
	4200 1000 4200 2050
Wire Wire Line
	4200 1000 4650 1000
Connection ~ 3250 1950
Wire Wire Line
	6550 3800 6550 3200
Connection ~ 5650 3800
Wire Wire Line
	6800 3800 6800 3750
Connection ~ 6550 3800
Wire Wire Line
	6800 3000 6800 3150
Wire Wire Line
	7500 2950 7500 3800
Connection ~ 6800 3800
Wire Wire Line
	7050 1900 7050 3800
Connection ~ 7050 3800
Wire Wire Line
	3250 1950 5100 1950
Wire Wire Line
	5100 1950 5100 1350
Wire Wire Line
	7650 1050 7850 1050
Wire Wire Line
	8250 1050 8050 1050
Wire Wire Line
	2650 1600 3250 1600
Connection ~ 5650 1000
Wire Wire Line
	2450 1600 2450 1850
Wire Wire Line
	2450 1850 6550 1850
Wire Wire Line
	6550 1850 6550 2600
Wire Wire Line
	2250 1600 2250 2100
Wire Wire Line
	2250 2100 6750 2100
Wire Wire Line
	6750 2100 6750 2700
Wire Wire Line
	6750 2700 6550 2700
Wire Wire Line
	5650 1000 5650 2000
NoConn ~ 2050 1600
$Comp
L PWR_FLAG #FLG05
U 1 1 5584E277
P 6550 2700
F 0 "#FLG05" H 6550 2795 30  0001 C CNN
F 1 "PWR_FLAG" H 6550 2880 30  0000 C CNN
F 2 "" H 6550 2700 60  0000 C CNN
F 3 "" H 6550 2700 60  0000 C CNN
	1    6550 2700
	0    1    1    0   
$EndComp
Wire Wire Line
	3900 1600 3900 2200
Connection ~ 3900 1600
$Comp
L R R4
U 1 1 55853C9B
P 3900 2450
F 0 "R4" V 3980 2450 40  0000 C CNN
F 1 "7K" V 3907 2451 40  0000 C CNN
F 2 "~" V 3830 2450 30  0000 C CNN
F 3 "~" H 3900 2450 30  0000 C CNN
	1    3900 2450
	1    0    0    -1  
$EndComp
Wire Wire Line
	3900 2700 3900 3050
$Comp
L R R5
U 1 1 55853CF7
P 3900 3300
F 0 "R5" V 3980 3300 40  0000 C CNN
F 1 "1K" V 3907 3301 40  0000 C CNN
F 2 "~" V 3830 3300 30  0000 C CNN
F 3 "~" H 3900 3300 30  0000 C CNN
	1    3900 3300
	1    0    0    -1  
$EndComp
Wire Wire Line
	3900 3550 3900 3800
Connection ~ 3900 3800
Wire Wire Line
	3900 2700 4750 2700
$EndSCHEMATC
