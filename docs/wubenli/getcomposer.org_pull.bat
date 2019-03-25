D:
cd D:\www\work\wubenli\getcomposer.org.git
set filename=logs\%date:~0,4%%date:~5,2%%date:~8,2%.log
echo #  >>%filename%
echo %date%%time% >>%filename%
"C:\Program Files\Git\cmd\git.exe" pull origin master >>%filename% 2>&1 
echo ### >>%filename%
exit