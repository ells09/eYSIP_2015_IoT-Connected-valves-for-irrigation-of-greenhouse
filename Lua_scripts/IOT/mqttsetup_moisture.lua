--#################################################

--e-Yantra Summer Internship program 
--Project name : IoT based irrigation of greenhouse project
-- Team members : Jayant solanki, Kevin Dsouza 

--#################################################

--#################################################

--program name : mqttsetup_moisture.lua
--author name : Kevin Dsouza
--This program creates a mqtt client and waits for the message

--#################################################

--creating client with macid as the client id 
m = mqtt.Client(wifi.sta.getmac(), 120)   

--lwt function sends the last will and testament message to tbe sent to the broker in case it goes offline 
--m:lwt('lwt','offline',0,0)                                         
c=false                                   --initialising the flag 

--mqtt offline function keeps checking whether the device has gone offline or not
m:on('offline', 
  function(con) print('offline');c = false end) 
  
-- on publish message receive event
m:on('message', function(conn, topic, data)
  print(topic .. ':')
  if data ~= nil then
    print(data)
  end 
  
  if data == "1" then 
  
    --  gpio.write(pin14, gpio.HIGH)                         -- set GPIO to turn on the power of the sensor module 
    
-- this code takes a number of sensor values and gives the average value 
    i = 0
    K = 0
    while i<20 do
    K = K + adc.read(0)
    i=i+1
    end 

    K = K/20 
    print("Moisture value :"..K)

    m:publish('esp/moisture',macid .. K,0,0, function(conn) print('moisture value sent') end)

  elseif data == "2" then 
    if (adc.read(0) < 725) then 
       m:publish('esp/battery',macid .. '1',0,0, function(conn) print('battery status sent') end)
     else
        m:publish('esp/battery',macid .. '1',0,0, function(conn) print('battery status sent') end)
     end 

  elseif data == "3" then 
   flag = 0                           -- initializing the flag 
   if flag == 0 then 
       wifi.sta.disconnect()          -- disconnect from WiFi 
       flag = 1 
      -- print("here") 
   end 
   
             
         
            
               
          
  end 
  
    
    --result=wifi.sleeptype(wifi.LIGHT_SLEEP) 
   -- result=wifi.sleeptype(wifi.NONE_SLEEP)

     
end)

--#################################################
