wifi.setmode(wifi.STATION)
wifi.sta.config('iot','')
wifi.sta.connect()
pin2 = 4
pin4 = 2
pin5 = 1
gpio.mode(pin2,gpio.OUTPUT)
gpio.mode(pin4,gpio.OUTPUT)
gpio.mode(pin5,gpio.OUTPUT)

tmr.alarm(1, 5000, 1, function() 
    if wifi.sta.getip()== nil then
        print('IP unavaiable, waiting...') 
    else
        tmr.stop(1)
        print('IP is '..wifi.sta.getip())
        dofile('mqtt2.lua')

        tmr.alarm(1, 1000, 1, function()
        
          if not c then
              print("i entered")
             m:connect('192.168.43.184', 1883, 0, 
              function(conn) 
                print('mqtt connected')
                c = true
                dofile('sub2.lua')
         
              end)
          end
            
           m:on('offline', 
             function(con) print ('mqtt offline');c = false end)
      
        end)
        
   end
end)
   
                   
                   
                
                
                   
                   