

pin2 = 4
pin4 = 2
pin5 = 1
gpio.mode(pin2,gpio.OUTPUT)
gpio.mode(pin4,gpio.OUTPUT)
gpio.mode(pin5,gpio.OUTPUT)

TIME_ALARM = 3000  -- 0.5 second

function ledHandler() 

--tmr.wdclr()

gpio.write(pin4,gpio.HIGH)
gpio.write(pin5,gpio.LOW)

gpio.write(pin2,gpio.HIGH) 
tmr.delay(20000)
gpio.write(pin2,gpio.LOW)

tmr.delay(2000000)

gpio.write(pin4,gpio.LOW)
gpio.write(pin5,gpio.HIGH)

gpio.write(pin2,gpio.HIGH) 
tmr.delay(20000)
gpio.write(pin2,gpio.LOW)

tmr.delay(2000000)


end


tmr.alarm(1, TIME_ALARM, 1, ledHandler)
