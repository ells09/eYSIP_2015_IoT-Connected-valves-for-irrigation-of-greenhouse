wifi.setmode(wifi.STATION)
wifi.sta.config('ERTS lab 102_2.4 Ghz','balstre201')
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
        dofile('mqttsetup_valve.lua')                      --calling mqtt script 
        tries = 0                                                              
        tmr.alarm(1, 1000, 1, function()                   --checking for mqtt connection 
                
               if not c and tries < 50 then 
                 tries = tries + 1                      -- incrementing the number of tries 
                 m:connect('10.129.28.118',1883, 0, 
                 function(conn) 
                    print('mqtt connected')
                    m:publish('esp',macid,0,0,  function(conn)         -- publish the device macid to the broker to identify itself 
                        c = true
                        if c then
                            topic = 'esp/'..macid                 -- topic to subscribe to 
                            m:subscribe(topic,0,function(conn) print('subscribing success') end)     -- subscribing to topic 
                        end
                    
                    end)
    
                    m:publish('esp/'..macid..'/battery',tostring(adc.read(0)),0,0, function(conn) print('battery status sent') end)
                  end)
              elseif tries >= 50 then                -- If the number of tries are greater than a certain threshold go to sleep 
                 node.dsleep(5000000)   
              end 
              if flag ==1 then 
              tmr.alarm(1,10000,1,function()
    
                node.restart()                -- restart the ESP module after a certain duration form when the flag is set to zero 
                tmr.stop(1)
    
              end)
              end 
    end)
   end
end)  
