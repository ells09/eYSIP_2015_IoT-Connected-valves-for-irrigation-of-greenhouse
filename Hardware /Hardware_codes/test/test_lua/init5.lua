pin14 = 5
pin12 = 6
pin13 = 7
gpio.mode(pin14,gpio.OUTPUT)
gpio.mode(pin12,gpio.OUTPUT)
gpio.mode(pin13,gpio.OUTPUT)

tmr.alarm(1,3000,1,function()

gpio.write(pin12,gpio.HIGH)
gpio.write(pin14,gpio.LOW)

gpio.write(pin13,gpio.HIGH) 
tmr.delay(60000)
gpio.write(pin13,gpio.LOW)

tmr.delay(2000000)

gpio.write(pin12,gpio.LOW)
gpio.write(pin14,gpio.HIGH)

gpio.write(pin13,gpio.HIGH) 
tmr.delay(60000)
gpio.write(pin13,gpio.LOW)

tmr.delay(2000000)

end)