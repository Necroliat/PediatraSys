@echo off
setlocal

REM Establecer las variables de conexión
set "servername=localhost"
set "username=root"
set "password="
set "database=pediatra_sis"

REM Obtener la fecha actual en formato YYYYMMDD
for /f "tokens=1-3 delims=/ " %%a in ('date /t') do (
    set "fecha=%%c%%b%%a"
)

REM Definir la ruta y el nombre del archivo de respaldo
set "ruta=C:\wamp64\www\sistema-medico-old\basededatos"
set "nombre=pediatra_sis_%fecha%.sql"
set "archivo=%ruta%\%nombre%"

REM Ejecutar el comando de respaldo
"C:\wamp64\bin\mysql\mysql8.0.31\bin\mysqldump" -u %username% -p%password% -h %servername% %database% > %archivo%

REM Verificar si el comando se ejecutó correctamente
if %errorlevel% equ 0 (
    echo Backup completado correctamente. El archivo se ha guardado como: %nombre%
) else (
    echo Ha ocurrido un error durante el proceso de backup.
)

pause
