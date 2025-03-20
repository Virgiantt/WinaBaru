@echo off
set fileName=%1
echo Printing file: %fileName% > D:\laragon\www\direct_print\scripts\print.log
echo Running as: %username% >> D:\laragon\www\direct_print\scripts\print.log
whoami >> D:\laragon\www\direct_print\scripts\print.log
echo Current directory: %cd% >> D:\laragon\www\direct_print\scripts\print.log
notepad /p %fileName% >> D:\laragon\www\direct_print\scripts\print.log 2>&1
if %errorlevel% neq 0 (
	echo Notepad print command failed with error code: %errorlevel% >> D:\laragon\www\direct_print\scripts\print.log
) else (
	echo Print command executed successfully >> D:\laragon\www\direct_print\scripts\print.log
)