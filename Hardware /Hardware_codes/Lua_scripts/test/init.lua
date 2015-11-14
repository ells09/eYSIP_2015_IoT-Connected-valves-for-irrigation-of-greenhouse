tmr.alarm(0,5000,1,function()
    print('going to sleep')
   
    node.dsleep(10*1000000)

end)