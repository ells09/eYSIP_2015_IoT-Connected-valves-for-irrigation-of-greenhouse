--creating client with the macid as the client id 
m = mqtt.Client(wifi.sta.getmac(), 120)   --120sec keep alive
--lwt function sends the last will and testament message to tbe sent to the broker in case it goes offline
m:lwt('lwt','offline',0,0)    

--mqtt offline function keeps checking whether the device has gone offline or not
m:on('offline',function(con) c = false end) 
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
    m:publish('esp/'..macid..'/battery',tostring(adc.read(0)),0,0, function(conn) print('battery status sent (demand)') end)
  end
end)

function startValve()

    gpio.write(pin12,gpio.HIGH)
    gpio.write(pin14,gpio.LOW)
    
    doValve()
end
function stopValve()

    gpio.write(pin12,gpio.LOW)
    gpio.write(pin14,gpio.HIGH)
    
    doValve()
end
function doValve()
  gpio.write(pin13,gpio.HIGH) 
  tmr.delay(500000)
  gpio.write(pin13,gpio.LOW)
end
