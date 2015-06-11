m = mqtt.Client('nodemcu', 120)
c = false
m:on('offline', 
  function(con) print ('mqtt offline');c = false end)
 
-- on publish message receive event
m:on('message', function(conn, topic, data)
  print(topic .. ':')
  if data ~= nil then
    print(data)
  end 

  if data == "on" then 
    gpio.write(pin4,gpio.HIGH)
    gpio.write(pin5,gpio.LOW)
  elseif data == "off" then 
    gpio.write(pin4,gpio.LOW)
    gpio.write(pin5,gpio.HIGH)
  end 
  
     gpio.write(pin2,gpio.HIGH) 
     tmr.delay(20000)
     gpio.write(pin2,gpio.LOW)
end)

 

  