--#################################################

--e-Yantra Summer Internship program 
--Project name : IoT based irrigation of greenhouse project
-- Team members : Jayant solanki, Kevin Dsouza 

--#################################################

--#################################################

--program name : init.lua 
--author name : Kevin Dsouza
--This is the first program to run during reset of the ESP8266
--This program establishes connection with a wireless network and calls on Mqtt script. Also establishes mqtt connection.

--#################################################

--configure wifi 
wifi.setmode(wifi.STATION)
wifi.sta.config('seraph','')
wifi.sta.connect()
macid = wifi.sta.getmac()

--configure gpio pins according to revised pin map
pin14 = 5
pin12 = 6
pin13 = 7
gpio.mode(pin14,gpio.OUTPUT)
gpio.mode(pin12,gpio.OUTPUT)
gpio.mode(pin13,gpio.OUTPUT)

--wait for WiFi connection 
tmr.alarm(1, 5000, 1, function() 
    if wifi.sta.getip()== nil then
       print ('Connecting...')
       
    else
        tmr.stop(1)
        print('IP is '..wifi.sta.getip())
        dofile('mqttSetup.lua')                      --calling mqtt script 
        tries = 0                                                              
        tmr.alarm(1, 1000, 1, function()
        
       
--checking for mqtt connection
           if not c and tries < 15 then 
             tries = tries + 1                      -- incrementing the number of tries 
             m:connect('192.168.43.184',1883, 0, 
              function(conn) 
                print('mqtt connected')
                m:publish('esp/valve',macid,0,0,  function(conn)         -- publish the device macid to the broker to identify itself 
                
                c = true

                if c then

                topic = 'esp/valve/'..wifi.sta.getmac()                  -- topic to subscribe to 
                
                m:subscribe(topic,0, 
                    function(conn) print('subscribing success') end)     -- subscribing to topic 
                end
                
                end)

         
              end)
            
          elseif tries >= 15 then                -- If the number of tries are greater than a certain threshold go to sleep 
             node.dsleep(0)   
          end 

       
       --   tmr.alarm(1,900000,1,function()
       --       if (adc.read(0) < 725) then 
         --         m:publish(topic,'0',0,0, function(conn) print('battery status sent') end)
     
           --   else
            --      m:publish(topic  ,'1',0,0, function(conn) print('battery status sent') end)
     
           --   end
        --  end)
          
        end)
        
   end

  
end)


   
                   
 --#################################################                  
                
                
                   
                   
