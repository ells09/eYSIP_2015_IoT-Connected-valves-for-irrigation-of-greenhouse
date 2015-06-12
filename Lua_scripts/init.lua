--#################################################

--program name : init.lua 
--author name : Kevin Dsouza
--This is the first program to run during reset of the ESP8266
--This program establishes connection with a wireless network and calls on Mqtt script. Also establishes mqtt connection.

--#################################################

--configure wifi 

wifi.setmode(wifi.STATION)
wifi.sta.config('iot','')
wifi.sta.connect()

--configure gpio pins according to revised pin map

pin2 = 4
pin4 = 2
pin5 = 1
gpio.mode(pin2,gpio.OUTPUT)
gpio.mode(pin4,gpio.OUTPUT)
gpio.mode(pin5,gpio.OUTPUT)

--wait for connection and run mqtt script

tmr.alarm(1, 5000, 1, function() 
    if wifi.sta.getip()== nil then
    else
        tmr.stop(1)
        print('IP is '..wifi.sta.getip())
        dofile('mqtt2.lua')                --calling mqtt script 

        tmr.alarm(1, 1000, 1, function()
        
--checking for mqtt connection

          if not c then
              print("i entered")
             m:connect('192.168.43.184', 1883, 0, 
              function(conn) 
                print('mqtt connected')
                c = true
                dofile('sub2.lua')      --calling the subscribe script
         
              end)
          end
         

--To check whether the device has gone offline in between 

           m:on('offline', 
             function(con) print ('mqtt offline');c = false end)
      
        end)
        
   end
end)
   
                   
 --#################################################                  
                
                
                   
                   
