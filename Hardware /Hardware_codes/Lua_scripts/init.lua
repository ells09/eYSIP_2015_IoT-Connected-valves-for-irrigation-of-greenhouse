--tmr.delay(2000000)  --remove this later
wifi.setmode(wifi.STATION)
wifi.sta.config('ERTS lab 102_2.4 Ghz','balstre201')

--configure gpio pins according to revised pin map
pin14 = 5
pin12 = 6
pin13 = 7
gpio.mode(pin14,gpio.OUTPUT)
gpio.mode(pin12,gpio.OUTPUT)
gpio.mode(pin13,gpio.OUTPUT)
gpio.write(pin13,gpio.LOW)
c=false                                   --initialising the flag 
wifiAvailable=0
sleepTime=1000000*10    --10 min sleep
dofile('connect.lua')