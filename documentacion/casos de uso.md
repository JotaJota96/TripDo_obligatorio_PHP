# TripDo - Casos de uso

## Índice

+ [Registrarse](#Registrarse)
+ [Iniciar sesión](#Iniciar-sesión)
+ [Cerrar sesión](#Cerrar-sesión)
+ [Crear un viaje](#Crear-un-viaje)
+ [Agregar colaborador a un viaje](#Agregar-colaborador-a-un-viaje)
+ [Agregar viajero a un viaje](#Agregar-viajero-a-un-viaje)
+ [Sugerir destino a un viaje](#Sugerir-destino-a-un-viaje)
+ [Sugerir plan a un viaje](#Sugerir-plan-a-un-viaje)
+ [Copiar viaje](#Copiar-viaje)
+ [Marcar viaje como realizado](#Marcar-viaje-como-realizado)
+ [Calificar viaje realizado](#Calificar-viaje-realizado)
+ [Visualizar viaje](#Visualizar-viaje)
+ [Buscar viajes](#Buscar-viajes)
+ [Compartir viaje en redes sociales](#Compartir-viaje-en-redes-sociales)

## Registrarse

**Actores:** Invitado (usuario no logueado)

1. Ingresar los datos:
    + nickname (unico)
    + email (unico)
    + nombre
    + apellido
    + telefono
    + biografia
    + imagen
2. Si los datos son válidos, el sistema envía un email con un enlace para confirmar el registro
3. El usuario accede al enlace recibido por email
4. El sistema registra definitivamente al usuario

## Iniciar sesión

**Actores:** Invitado

1. El actor ingresa:
    + nickname o correo
    + contraseña
2. El sistema verifica los datos y si son correctos se inicia la sesion del usuario

## Cerrar sesión

**Actores:** Usuario logueado

1. Cerrar sesion

## Crear un viaje

**Actores:** Usuario logueado

1. Ingresar:
    + Nombre del viaje
    + Descripcion
    + Privacidad (público/privado)

## Agregar colaborador a un viaje

**Actores:** Propietario del viaje

1. El sistema genera un enlace para compartir el viaje como colaborador
2. Se muestra la lista de colaboradores ya agregados
3. El usuario puede ingresar el correo de la persona a la que le desea enviar el enlace mencionado en el paso 1
4. El usuario confirma el envio del correo (osea, le da clic al boton enviar)
5. Si el usuario confirma el envio del correo, el sistema envía a esa direccion el enlace mencionado en el paso 1

## Agregar viajero a un viaje

**Actores:** Propietario del viaje y viajeros agregados

1. El sistema genera un enlace para compartir el viaje como viajero
2. Se muestra la lista de colaboradores ya agregados
3. El usuario puede ingresar el correo de la persona a la que le desea enviar el enlace mencionado en el paso 1
4. El usuario confirma el envio del correo (osea, le da clic al boton enviar)
5. Si el usuario confirma el envio del correo, el sistema envía a esa direccion el enlace mencionado en el paso 1

## Sugerir destino a un viaje

**Actores:** Usuario logueado y con el rol de viajero o colaborador del viaje

1. Seleccionar un viaje
2. Ingresar informacion del destino:
    + Nombre del país
    + Ciudad
    + Tags (0 a muchos)
3. Enviar sugerencia

## Sugerir plan a un viaje

**Actores:** Usuario logueado y con el rol de viajero o colaborador del viaje

1. Seleccionar un viaje
2. Seleccionar uno de los posibles destinos del viaje
3. Ingresar informacion del plan:
    + Nombre
    + Descripcion
    + Ubicacion
    + Link (opcional)
4. Enviar sugerencia

## Votar destino o plan

**Actores:** Viajero de un viaje

1. ...
2. ...
3. ...

## Copiar viaje

**Actores:** Usuario logueado

1. Seleccionar un viaje
2. Clic en copiar viaje
3. El sistema hace una copia del viaje (sólo los destinos y planes) y lo asigna al usuario actual

## Marcar viaje como realizado

**Actores:** Propietario del viaje

1. Seleccionar un viaje
2. Clic en 'dar por realizado'

## Calificar viaje realizado

**Actores:** Usuario logueado y viajero del viaje

1. Seleccionar el viaje
2. Ingresar:
    + Calificacion (del 1 al 5)
    + Texto (opcional)
3. Clic en 'confirmar'

## Visualizar viaje

**Actores:** Invitado, usuario logueado
**Nota:** Si el viaje es privado sólo lo verá su propietario, sus colaboradores y viajeros

1. Seleccionar un viaje
2. Se mostrará:
    + Nombre del viaje
    + Destinos
    + Planes
    + Mapa
    + Registro de actividad reciente
    + Opcion para copiar el viaje (si este fue realizado)
3. Dependiendo del rol del usuario que visualiza el viaje:  
    3.1. Si el visitante es el propietario: Se mostrará una opcion para agregar colaboradores o viajeros  
    3.2. Si el visitante es viajero o colaborador: se mostrará una opcion para sugerir destino o plan. Si el viaje ya se ha realizado, se mostrara una opcion para votarlo  
    3.3. Si el visitante es viajero y el viaje no se ha realizado: Se mostrará una opcion para invitar a mas viajeros  
    3.4. Si el visitante es viajero: Se mostrarán opciones para compartir el viaje en Twitter y Facebook

## Buscar viajes

**Actores:** Invitado y usuario logueado

1. Ingresa palabras claves en el buscador
2. El sistema mostrará una lista de viajes que poseen destinos marcados con esas palabas claves

## Compartir viaje en redes sociales

**Actores:** Viajeros del viaje

1. Acceder al viaje que se desea compartir
2. Clic en el botón compartir

