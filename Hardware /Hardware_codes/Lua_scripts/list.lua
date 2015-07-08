--#################################################

--e-Yantra Summer Internship program 
--Project name : IoT based irrigation of greenhouse project
-- Team members : Jayant solanki, Kevin Dsouza 

--#################################################

--#################################################

--program name : list.lua 
--author name : --
--This program gives the list of files saved on the ESP
--#################################################



l = file.list();
    for k,v in pairs(l) do
      print("name:"..k..", size:"..v)
    end

--#################################################
