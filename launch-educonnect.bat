@echo off
setlocal

set "PROJECT_DIR=%~dp0"
cd /d "%PROJECT_DIR%"

set "INTELLIJ_MVN=C:\Program Files\JetBrains\IntelliJ IDEA 2025.2.1\plugins\maven\lib\maven3\bin\mvn.cmd"

if exist "%INTELLIJ_MVN%" (
    call "%INTELLIJ_MVN%" javafx:run
    goto :eof
)

where mvn >nul 2>nul
if %errorlevel%==0 (
    call mvn javafx:run
    goto :eof
)

echo Maven was not found.
echo Install Maven or open the project in IntelliJ and run app.Main.
pause
