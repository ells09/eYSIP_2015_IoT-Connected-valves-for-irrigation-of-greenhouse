--data unpacking into variables

if id== "" then 

tmr.alarm(1,repeat_duration,repeat_flag,function()
   
   tmr.alarm(1,60000000,1,function()
     if start_time=tmr.time()
     startValve()
     tmr.stop()
     end
   end)

   tmr.alarm(1,60000000,1,function()
     if stop_time=tmr.time()
     startValve()
     tmr.stop()
     end
   end)

end)

elseif id =="" then

tmr.alarm(1,repeat_duration,repeat_flag,function()

   tmr.alarm(1,60000000,1,function()
     if start_time=tmr.time()
     startValve()
     tmr.stop()
     end
   end)

   tmr.delay(on_duration)
   stopValve()
   
elseif id == "" then 

   if == "ON" then 
     startValve()
   elseif data == "OFF" then 
     stopValve()

end