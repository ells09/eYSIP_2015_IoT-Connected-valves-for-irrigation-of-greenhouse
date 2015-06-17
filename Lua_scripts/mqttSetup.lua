--#################################################

--program name : mqttSetup.lua
--author name : Kevin Dsouza
--This program creates a mqtt client and waits for the message

--#################################################

m = mqtt.Client(wifi.sta.getmac(), 120)    --creating client
m:lwt('lwt','offline',0,0)                                         
c=false                                   --initialising the flag 
m:on('offline', 
  function(con) print ('mqtt offline');c = false end) 
  
-- on publish message receive event
m:on('message', function(conn, topic, data)
  print(topic .. ':')
  if data ~= nil then
    print(data)
  end 

  if data == "ON" then 
    startValve() 
    print('Publishing')
    m:publish('valve','Valve is on',0,0,  function(conn) print('publishing success') end)
  elseif data == "OFF" then 
    stopValve()
    print('Publishing')
    m:publish('valve','Valve is off',0,0,  function(conn) print('publishing success') end)
  end 
 
end)

function startValve()

gpio.write(pin4,gpio.HIGH)
gpio.write(pin5,gpio.LOW)

doValve()
end

function stopValve()

gpio.write(pin4,gpio.LOW)
gpio.write(pin5,gpio.HIGH)

doValve()
end

function doValve()

  gpio.write(pin2,gpio.HIGH) 
  tmr.delay(20000)
  gpio.write(pin2,gpio.LOW)
  
end


--################################################# 

  
