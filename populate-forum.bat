@echo off
echo Starting EduConnect Forum Data Population...
echo.

echo Compiling ForumDataPopulator...
javac -cp "target\classes;lib\*" src\main\java\services\ForumDataPopulator.java

if %ERRORLEVEL% NEQ 0 (
    echo Compilation failed!
    pause
    exit /b 1
)

echo.
echo Running forum population...
echo.
java -cp "target\classes;lib\*;src\main\java" services.ForumDataPopulator

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo Forum population failed!
    echo Make sure the database is running and MySQL driver is available.
    pause
    exit /b 1
)

echo.
echo Forum population completed successfully!
echo.
pause
