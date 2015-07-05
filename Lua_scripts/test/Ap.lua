cfg={}
cfg.ssid="kevin"
cfg.pwd="qwerty"
wifi.ap.config(cfg)
tmr.delay(2000)
print(wifi.ap.getip())