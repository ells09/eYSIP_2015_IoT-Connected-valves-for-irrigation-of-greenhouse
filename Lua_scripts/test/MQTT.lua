-- init mqtt client with keepalive timer 120sec
m = mqtt.Client("123", 120, "mosca", "")

-- for secure: m:connect("192.168.11.118", 1880, 1)
m:connect("", 1880, 0, function(conn) print("connected") end)

-- subscribe topic with qos = 0
m:subscribe("/",0, function(conn) print("subscribe success") end)

-- setup Last Will and Testament (optional)
-- Broker will publish a message with qos = 0, retain = 0, data = "offline"
-- to topic "/lwt" if client don't send keepalive packet
m:lwt("/lwt", "offline", 0, 0)

m:on("connect", function(con) print ("connected") end)
m:on("offline", function(con) print ("offline") end)

-- on publish message receive event
m:on("message", function(con, topic, data)
  print(topic .. ":" )
  if data ~= nil then
    print(data)
  end
end)


-- or subscribe multiple topic (topic/0, qos = 0; topic/1, qos = 1; topic2 , qos = 2)
-- m:subscribe({["topic/0"]=0,["topic/1"]=1,topic2=2}, function(conn) print("subscribe success") end)
-- publish a message with data = hello, QoS = 0, retain = 0
m:publish("/topic","hello",0,0, function(conn) print("sent") end)

m:close();
-- you can call m:connect again
