
INSERT INTO `usuario` (`nickname`, `email`, `contrasenia`, `nombre`, `apellido`, `telefono`, `biografia`, `imagen`, `verificado`) VALUES 
('antonio57', 'antonio@email.com', '1234', 'Antonio', 'Garcia', '098432872', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem reprehenderit magnam, tempora aspernatur eum quos consectetur nesciunt, iusto commodi repellat unde. Amet pariatur officia assumenda!', null, true),
('marianela42', 'marianela@email.com', '1234', 'Maria', 'Martinez', '098147584', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo fugiat, nesciunt accusantium incidunt excepturi rem. Illum est provident nobis totam!', null, true),
('jose57', 'jose@email.com', '1234', 'Jose', 'Lopez', '095128757', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo, numquam ipsum nulla illo reprehenderit veniam vel voluptatibus facere nisi quibusdam accusantium dolores', null, true),
('maria98', 'maria@email.com', '1234', 'Maria Carmen', 'Sanchez', '095784589', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Et eaque illo sapiente culpa voluptatem maiores delectus inventore velit', null, true),
('francisco91', 'francisco@email.com', '1234', 'Francisco', 'Gonzalez', '099887543', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam quibusdam aliquam maxime. ', null, true),
('josefa84', 'josefa@email.com', '1234', 'Josefa', 'Gomez', '092784256', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta non eaque iure perferendis, autem earum, reprehenderit laboriosam perspiciatis facere dolorem ipsam suscipit laudantium! ', null, true);

INSERT INTO `viaje` (`id`, `nombre`, `descripcion`, `publico`, `imagen` , `realizado`, `idUsuario`) VALUES 
(1, 'Vinos de América', 'Oportundad para recrear la cultura vitivinícola', true, 'viaje_prueba_1', true, 'antonio57'),
(2, 'Corredor termal Río Uruguay', 'Aguas termales, un encanto para disfrutar', true, 'viaje_prueba_2', false, 'jose57'),
(3, 'Uruguay Natural', 'De la costa a las sierras', false, 'viaje_prueba_3', false, 'antonio57'),
(4, 'El gran Buenos Aires', 'Paseos y entretenimiento', false, 'viaje_prueba_4', false, 'francisco91');

INSERT INTO `destino` (`id`, `pais`, `ciudad`, `idViaje`, `agregadoPor`, `fechaAgregado`) VALUES 
(1, 'Argentina', 'Mendoza', 1, 'antonio57', '2020-04-12'),
(2, 'Chile', 'Santiago', 1, 'francisco91', '2020-04-13'),
(3, 'Uruguay', 'Salto', 2, 'jose57', '2020-04-14'),
(4, 'Argentina', 'Colón', 2, 'maria98', '2020-04-15'),
(5, 'Uruguay', 'Piriápolis', 3, 'josefa84', '2020-04-16'),
(6, 'Uruguay', 'Minas', 3, 'maria98', '2020-04-17'),
(7, 'Argentina', 'Buenos Aires', 4, 'francisco91', '2020-04-18'),
(8, 'Argentina', 'Tigre', 4, 'maria98', '2020-04-19');

INSERT INTO `tag` (`id`, `texto`, `idDestino`) VALUES 
(1, 'Brindis Rass', 1),
(2, 'Restoran Rass', 1),
(3, 'Bodega Hum', 2),
(4, 'Vendimia', 2),
(5, 'Termas', 3),
(6, 'Juegos acuáticos', 3),
(7, 'Termas', 4),
(8, 'Compras', 4),
(9, 'Aventura', 5),
(10, 'Playa', 5),
(11, 'Sierra', 6),
(12, 'Festival', 6),
(13, 'Teatro', 7),
(14, 'Cena', 7),
(15, 'Hospedaje', 8),
(16, 'Paseos', 8);

INSERT INTO `plan` (`id`, `nombre`, `descripcion`, `latitud`, `longitud`, `link`, `idDestino`, `agregadoPor`, `fechaAgregado`) VALUES 
(1, 'Degustación de vinos', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ',  -32.8897294, -68.8442956, 'http://www.ejemplo.com/plan-1', 1, 'antonio57', '2020-04-18'),
(2, 'Almuerzo con copa de vino', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ', -32.87514591, -68.80044937 , 'http://www.ejemplo.com/plan-2', 1, 'maria98', '2020-04-19'),
(3, 'Visita a bodega Hum. ', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ', -33.4377968, -70.6504451 , 'null', 2, 'francisco91', '2020-04-20'),
(4, 'Recreación de la vendimia', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ', -33.40064762, -70.55082321 , 'http://www.ejemplo.com/plan-4', 2, 'maria98', '2020-04-21'),
(5, 'Termas de Daymán', 'Dos días de piscinas termales. ', -31.38889, -57.9608876 , 'null', 3, 'jose57', '2020-04-22'),
(6, 'Aquagame Daymán', 'Dos días con entrada incluída al parque de juegos', -31.39439117, -57.94135094 , 'http://www.ejemplo.com/plan-6', 3, 'josefa84', '2020-04-23'),
(7, 'Termas Colón. ', 'Dos días de piscinas termales', -31.39120778, -58.02452088 , 'http://www.ejemplo.com/plan-7', 4, 'maria98', '2020-04-24'),
(8, 'Rambla de artesanos', 'Tour de compras', -31.36186053, -58.03576469 , 'http://www.ejemplo.com/plan-8', 4, 'maria98', '2020-04-25'),
(9, 'Cerro Pan de Azúcar', 'Escalada al cerro a cargo de especialistas',  -34.8689037, -55.2724472, 'null', 5, 'josefa84', '2020-04-26'),
(10, 'Playa', 'Arena, sol y agua', -34.8268486, -55.30403137 , 'null', 5, 'antonio57', '2020-04-27'),
(11, 'Cerro Arequita', 'Reconocimiento de flora y fauna',  -34.3773987, -55.2382144, 'http://www.ejemplo.com/plan-11', 6, 'maria98', '2020-04-28'),
(12, 'Cerro Artigas', 'Noche de los fogones', -34.36407248, -55.22180557 , 'http://www.ejemplo.com/plan-12', 6, 'josefa84', '2020-04-29'),
(13, 'Teatro Plaza', 'Les Luthiers', -34.6075682, -58.4370894 , 'http://www.ejemplo.com/plan-13', 7, 'francisco91', '2020-04-30'),
(14, 'Cena con amigos', 'Restoran Los luteros', -34.55804539, -58.43539238 , 'http://www.ejemplo.com/plan-14', 7, 'maria98', '2020-05-01'),
(15, 'Ubicación en hospedaje', 'Hostel del delta',  -34.4226513, -58.5808967, 'http://www.ejemplo.com/plan-15', 8, 'maria98', '2020-05-02'),
(16, 'Navegación por canales', 'Navegación por los canales y paseo de compras', -34.4651764, -58.52937698 , 'null', 8, 'francisco91', '2020-05-03');

INSERT INTO `viajero` (`idUsuario`, `idViaje`, `valoracion`, `texto`) VALUES 
('marianela42', 1, 5, 'La verdad que un viaje muy recomendable'),
('jose57', 1, 5, 'Se pasó muy bien, ojalá se repita'),
('josefa84', 1, 4, 'Muy bueno el viaje, pero tendría que haber durado más!'),
('maria98', 2, null, null),
('francisco91', 2, null, null),
('josefa84', 2, null, null),
('antonio57', 2, null, null),
('maria98', 3, null, null);

INSERT INTO `colaborador` (`idUsuario`, `idViaje`) VALUES 
('francisco91', 1),
('maria98', 1),
('josefa84', 3),
('maria98', 4);


/* ****************************************************************************** */

INSERT INTO `destinovotado` (`idUsuario`, `idViaje`, `idDestino`) 
    SELECT sc.nickname, sc.idViaje, d.id as idDestino
    FROM (
        SELECT vj.idUsuario as nickname, vj.idViaje as idviaje
        FROM viajero vj
        UNION
        SELECT u.nickname as nickname, v.id as idviaje
        FROM usuario u JOIN viaje v ON v.idUsuario = u.nickname
    ) sc JOIN destino d ON d.idViaje = sc.idViaje
    WHERE (sc.idViaje = 1)
    OR (sc.idViaje <> 1 AND sc.nickname LIKE '%e%')
;

INSERT INTO `planvotado` (`idUsuario`, `idViaje`, `idPlan`) 
	SELECT sc.nickname, sc.idViaje, p.id as idPlan
	FROM (
		SELECT vj.idUsuario as nickname, vj.idViaje as idviaje
		FROM viajero vj
		UNION
		SELECT u.nickname as nickname, v.id as idviaje
		FROM usuario u JOIN viaje v ON v.idUsuario = u.nickname
	) sc JOIN destino d ON d.idViaje = sc.idViaje
	JOIN plan p ON p.idDestino = d.id
	WHERE (sc.idViaje = 1)
	OR (sc.idViaje <> 1 AND sc.nickname LIKE '%e%')
;

UPDATE plan SET latitud = latitud*0.6;

UPDATE tag SET texto = lower(texto);

-- tremendo parche este... xD
UPDATE `plan` SET `latitud` = -32.957005, `longitud` = -68.873726 WHERE id = 1;
UPDATE `plan` SET `latitud` = -32.944622, `longitud` = -68.814781 WHERE id = 2;
UPDATE `plan` SET `latitud` = -33.442039, `longitud` = -70.530159 WHERE id = 3;
UPDATE `plan` SET `latitud` = -33.503830, `longitud` = -70.627525 WHERE id = 4;
UPDATE `plan` SET `latitud` = -31.452635, `longitud` = -57.907772 WHERE id = 5;
UPDATE `plan` SET `latitud` = -31.377329, `longitud` = -57.896774 WHERE id = 6;
UPDATE `plan` SET `latitud` = -32.209526, `longitud` = -58.145695 WHERE id = 7;
UPDATE `plan` SET `latitud` = -32.220020, `longitud` = -58.132359 WHERE id = 8;
UPDATE `plan` SET `latitud` = -34.811230, `longitud` = -55.255993 WHERE id = 9;
UPDATE `plan` SET `latitud` = -34.863083, `longitud` = -55.280735 WHERE id = 10;
UPDATE `plan` SET `latitud` = -34.281502, `longitud` = -55.255878 WHERE id = 11;
UPDATE `plan` SET `latitud` = -34.375015, `longitud` = -55.217361 WHERE id = 12;
UPDATE `plan` SET `latitud` = -34.622265, `longitud` = -58.381557 WHERE id = 13;
UPDATE `plan` SET `latitud` = -34.654129, `longitud` = -58.455276 WHERE id = 14;
UPDATE `plan` SET `latitud` = -34.422905, `longitud` = -58.579872 WHERE id = 15;
UPDATE `plan` SET `latitud` = -34.446190, `longitud` = -58.550121 WHERE id = 16;


