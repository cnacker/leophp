D:
cd D:\www\work\astrology
set filename=logs\%date:~0,4%%date:~5,2%%date:~8,2%.log
echo #  >>%filename%
echo %date%%time% >>%filename%
"C:\Program Files\Git\cmd\git.exe" pull gitee secret >>%filename% 2>&1
echo ##  >>%filename%
git push origin secret >>%filename% 2>&1
echo ###  >>%filename%
exit
