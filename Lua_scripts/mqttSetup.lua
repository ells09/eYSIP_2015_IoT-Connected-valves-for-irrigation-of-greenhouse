--#################################################

--program name : mqttSetup.lua
--author name : Kevin Dsouza
--This program creates a mqtt client and waits for the message

--#################################################

m = mqtt.Client(wifi.sta.getmac(), 120)    --creating client
--lwt function sends the last will and testament message to tbe sent to the broker in case it goes offline
m:lwt('lwt','offline',0,0)                                         
c=false                                   --initialising the flag 
--mqtt offline function keeps checking whether the device has gone offline or not
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

--this function opens the latching valve 
function startValve()

gpio.write(pin4,gpio.HIGH)
gpio.write(pin5,gpio.LOW)

doValve()
end

--this function closes the latching valve
function stopValve()

gpio.write(pin4,gpio.LOW)
gpio.write(pin5,gpio.HIGH)

doValve()
end

--this function gives the 20 ms pulse to the PWM enable pin 
function doValve()

  gpio.write(pin2,gpio.HIGH) 
  tmr.delay(20000)
  gpio.write(pin2,gpio.LOW)
  
end


--################################################# 

  
