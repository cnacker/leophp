D:
cd D:\www\work\cdn
set filename=log/%date:~0,4%%date:~5,2%%date:~8,2%.log
echo #  >>%filename%
echo %date%%time% >>%filename%
git pull origin master >>%filename% 2>&1
exit