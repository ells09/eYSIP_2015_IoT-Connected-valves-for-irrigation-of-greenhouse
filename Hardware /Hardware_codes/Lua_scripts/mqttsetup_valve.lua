--#################################################

--e-Yantra Summer Internship program 
--Project name : IoT based irrigation of greenhouse project
-- Team members : Jayant solanki, Kevin Dsouza 

--#################################################
 
--program name : mqttsetup_valve.lua
--author name : Kevin Dsouza
--This program creates a mqtt client and waits for the message

--#################################################


 --creating client with the macid as the client id 
m = mqtt.Client(wifi.sta.getmac(), 120)   
               
--lwt function sends the last will and testament message to tbe sent to the broker in case it goes offline
m:lwt('lwt','offline',0,0)    
                                     
c=false                                   --initialising the flag 

--mqtt offline function keeps checking whether the device has gone offline or not
m:on('offline', 
  function(con) print ('mqtt offline');c = false end) 
  
-- on publish message receive event print the topic and data and do the task
m:on('message', function(conn, topic, data)
  print(topic .. ':')
  if data ~= nil then
    print(data)
  end 


-- Use the data to turn the valve ON or OFF 
  if data == "1" then 
    startValve() 
  elseif data == "0" then 
    stopValve()

--to give the user the battery status 
  elseif data == "2" then 
     if (adc.read(0) < 200) then 
        m:publish('esp/battery',macid .. '0',0,0, function(conn) print('battery status sent') end)
     else
        m:publish('esp/battery',macid .. '1',0,0, function(conn) print('battery status sent') end)
     end 
 
--to disconnect from WiFi and save power         
  elseif data == "3" then 
   flag = 0                           -- initializing the flag 
   if flag == 0 then 
       wifi.sta.disconnect()          -- disconnect from WiFi 
       flag = 1 
   end 
  end 
 
end)

--Function name : startValve()
-- Input Parameters : none 
-- Output parameters : none 
-- Function   :   this function opens the latching valve 
-- Logic     :   Keepinng the GPIO 4,5 HIGH and LOW 
-- Example  :  startValve() 
function startValve()

gpio.write(pin12,gpio.HIGH)
gpio.write(pin14,gpio.LOW)

doValve()
end

--Function name : stopValve()
-- Input Parameters : none 
-- Output parameters : none 
-- Function   :   this function closes the latching valve 
-- Logic     :   Keepinng the GPIO 4,5 LOW and HIGH 
-- Example  :  stopValve() 
function stopValve()

gpio.write(pin12,gpio.LOW)
gpio.write(pin14,gpio.HIGH)

doValve()
end

--Function name : doValve()
-- Input Parameters : none 
-- Output parameters : none 
-- Function   :   this function gives the pulse required to latch the valve(PWM)
-- Logic     :   Pulse the GPIO 2 PIN 
-- Example  :  doValve() 
function doValve()

  gpio.write(pin13,gpio.HIGH) 
  tmr.delay(20000)
  gpio.write(pin13,gpio.LOW)
  
end


--################################################# 

  
