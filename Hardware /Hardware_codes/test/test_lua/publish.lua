 --#################################################    

--program name : publish.lua 
--author name : Kevin Dsouza
--This program publishes to a particular topic

 --#################################################    

print('Publishing')
if c then
 m:publish('esp/moisture/lib','done',0,0,  function(conn) print('publishing success') end)
end 


 --#################################################   

