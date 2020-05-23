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

1. Instalar algo de certificacion de SMTP
	```
	sudo apt-get install msmtp ca-certificates
	```

2. Crear y abrir el archivo `/etc/msmtprc`


3. Completar el archivo anterior con: (reemplazar el correo y contraseña por el que corresponda)
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

4. Crear el archivo y cambiarle los permisos:
	```
	sudo touch /var/log/msmtp.log
	sudo chmod 0644 /etc/msmtprc
	```

5. Cambiarle los permisos a este otro archivo:
	```
	sudo chmod 0777 /var/log/msmtp.log
	```

7. Con eso ya queda configurado, para probar ejecutar el comando (reemplazar **MY_GMAIL_ID** por tu correo)
	```
	echo -e "Subject: Test Mail\r\n\r\nThis is my first test email." |msmtp --debug --from=default -t MY_GMAIL_ID@gmail.com
	```

