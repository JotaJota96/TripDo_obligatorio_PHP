# Prosedimineto para configurar XAMPP para enviar emails

En las siguientes instrucciones se utilizará a modo de ejemplo el correo `ejemplo@gmail.com` con la contrasea `12345678`, reemplazar por la que corresponda.

## Configuracion de la cuenta de Google

1. Iniciar sesion en la cuenta desde la que se desean enviar los correos

2. Acceder al siguiente enlace: https://myaccount.google.com/lesssecureapps?pli=1

3. Activar la opcion **Permitir el acceso de aplicaciones poco seguras: si**

----------------------------------------------------------------------

## Configuracion para Windows

1. Ir al archivo `C:\xampp\php\php.ini`

2. Quitar el `;' (punto y coma)  para descomentar la siguiente linea:
    ```
    extension=php_openssl.dll 
    ```

3. En la seccion: `[mail function]` modificar los datos para que coincidan con lo siguiente: (reemplazar el correo por el que corresponda)
    ```
    SMTP=smtp.gmail.com
    smtp_port=587
    sendmail_from = ejemplo@gmail.com
    sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
    ```

4. Ir al archivo `C:\xampp\sendmail\sendmail.ini` y reemplazar todo el codigo por lo siguiente:
    ```
    [sendmail]

    smtp_server=smtp.gmail.com
    smtp_port=587
    error_logfile=error.log
    debug_logfile=debug.log
    auth_username=tripDo.uy@gmail.com
    auth_password=12345678
    force_sender=TripDo.uy@gmail.com
    ```

----------------------------------------------------------------------

## Configuracion para Linux

1. Instalar un paquete para enviar mails y otro de certificados para SMTP
	```
	sudo apt-get install msmtp ca-certificates
	```

2. Crear y abrir el archivo `/etc/msmtprc`


3. Completar el archivo anterior con lo siguiente:   
	**Nota:** reemplazar el correo y contraseña por el que corresponda
	```
	defaults
	tls on
	tls_starttls on
	tls_trust_file /etc/ssl/certs/ca-certificates.crt

	account default
	host smtp.gmail.com
	port 587
	auth on
	user ejemplo@gmail.com
	password 12345678
	from ejemplo@gmail.com
	logfile /var/log/msmtp.log
	```

4. Crear el archivo de logs y cambiarle los permisos a el y al archivo de configuracion anterior:
	```
	sudo touch /var/log/msmtp.log
	sudo chmod 0644 /etc/msmtprc
	sudo chmod 0777 /var/log/msmtp.log
	```

6. Para probar si la configuracion viene bien, ejecutar el siguiente comando  
	**Nota:** reemplazar **MY_GMAIL_ID** por el correo a donde se enviará la prueba
	```
	echo -e "Subject: Test Mail\r\n\r\nThis is my first test email." |msmtp --debug --from=default -t MY_GMAIL_ID@gmail.com
	```

7. Para el siguiente paso hay que saber donde está el ejecutable de `msmtp`, para saberlo ejecutar:
	```
	which msmtp
	```

8. Abrir el archivo `php.ini` que está ubicado en `/opt/lampp/etc/php.ini`

9. Buscar la linea que dice `;sendmail_path = `  
	9.1. descomentarla (quitando `;`)  
	9.2. agregarle la ruta obtenida  en el paso **7**  
	9.3. agregarle la opcion `-t`  
	Debe quedar algo asi:
	```
	# Antes
	;sendmail_path = 
	# Despues
	sendmail_path = /usr/bin/msmtp -t
	```

10. Reiniciar el servidor **Xampp**






