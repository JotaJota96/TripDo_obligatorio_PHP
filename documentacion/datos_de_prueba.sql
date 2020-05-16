
INSERT INTO `usuario` (`nickname`, `email`, `contrasenia`, `nombre`, `apellido`, `telefono`, `biografia`, `imagen`, `verificado`) VALUES 
('antonio57', 'antonio@email.com', '1234', 'Antonio', 'Garcia', '098432872', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem reprehenderit magnam, tempora aspernatur eum quos consectetur nesciunt, iusto commodi repellat unde. Amet pariatur officia assumenda!', null, true),
('marianela42', 'marianela@email.com', '1234', 'Maria', 'Martinez', '098147584', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo fugiat, nesciunt accusantium incidunt excepturi rem. Illum est provident nobis totam!', null, true),
('jose57', 'jose@email.com', '1234', 'Jose', 'Lopez', '095128757', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo, numquam ipsum nulla illo reprehenderit veniam vel voluptatibus facere nisi quibusdam accusantium dolores.', null, true),
('maria98', 'maria@email.com', '1234', 'Maria Carmen', 'Sanchez', '095784589', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Et eaque illo sapiente culpa voluptatem maiores delectus inventore velit.', null, true),
('francisco91', 'francisco@email.com', '1234', 'Francisco', 'Gonzalez', '099887543', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam quibusdam aliquam maxime. ', null, true),
('josefa84', 'josefa@email.com', '1234', 'Josefa', 'Gomez', '092784256', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta non eaque iure perferendis, autem earum, reprehenderit laboriosam perspiciatis facere dolorem ipsam suscipit laudantium! ', null, true);

INSERT INTO `viaje` (`id`, `nombre`, `descripcion`, `publico`, `realizado`, `idUsuario`) VALUES 
(1, 'Vinos de América', 'Oportundad para recrear la cultura vitivinícola.', true, true, 'antonio57'),
(2, 'Corredor termal Río Uruguay.', 'Aguas termales, un encanto para disfrutar.', true, false, 'jose57'),
(3, 'Uruguay Natural.', 'De la costa a las sierras.', false, false, 'antonio57'),
(4, 'El gran Buenos Aires.', 'Paseos y entretenimiento.', false, false, 'francisco91');

INSERT INTO `destino` (`id`, `pais`, `ciudad`, `idViaje`, `agregadoPor`, `fechaAgregado`) VALUES 
(1, 'Argentina', 'Mendoza', 1, 'antonio57', '2020-04-12'),
(2, 'Chile', 'Santiago', 1, 'francisco91', '2020-04-13'),
(3, 'Uruguay', 'Salto', 2, 'jose57', '2020-04-14'),
(4, 'Argentina', 'Colón', 2, 'maria98', '2020-04-15'),
(5, 'Uruguay', 'Piriápolis', 3, 'josefa84', '2020-04-16'),
(6, 'Uruguay', 'Minas', 3, 'maria98', '2020-04-17'),
(7, 'Argentina', 'Buenos Aires', 4, 'francisco91', '2020-04-18'),
(8, 'Argentina', 'Tigre.', 4, 'maria98', '2020-04-19');

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
(10, 'Playa.', 5),
(11, 'Sierra.', 6),
(12, 'Festival.', 6),
(13, 'Teatro.', 7),
(14, 'Cena.', 7),
(15, 'Hospedaje.', 8),
(16, 'Paseos.', 8);

INSERT INTO `plan` (`id`, `nombre`, `descripcion`, `latitud`, `longitud`, `link`, `idDestino`, `agregadoPor`, `fechaAgregado`) VALUES 
(1, 'Degustación de vinos.', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ', -64.45312858, 50.66033345, 'http://www.ejemplo.com/plan-1', 1, 'antonio57', '2020-04-18'),
(2, 'Almuerzo con copa de vino.', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ', 5.85937142, 17.21588078, 'http://www.ejemplo.com/plan-2', 1, 'maria98', '2020-04-19'),
(3, 'Visita a bodega Hum. ', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ', 100.07812142, 17.21588078, 'null', 2, 'francisco91', '2020-04-20'),
(4, 'Recreación de la vendimia.', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. ', 138.04687142, 17.21588078, 'http://www.ejemplo.com/plan-4', 2, 'maria98', '2020-04-21'),
(5, 'Termas de Daymán.', 'Dos días de piscinas termales. ', 138.04687142, 44.00512491, 'null', 3, 'jose57', '2020-04-22'),
(6, 'Aquagame Daymán.', 'Dos días con entrada incluída al parque de juegos.', 5.85937142, 50.66033345, 'http://www.ejemplo.com/plan-6', 3, 'josefa84', '2020-04-23'),
(7, 'Termas Colón. ', 'Dos días de piscinas termales.', 100.07812142, 50.66033345, 'http://www.ejemplo.com/plan-7', 4, 'maria98', '2020-04-24'),
(8, 'Rambla de artesanos.', 'Tour de compras.', 138.04687142, 50.66033345, 'http://www.ejemplo.com/plan-8', 4, 'maria98', '2020-04-25'),
(9, 'Cerro Pan de Azúcar.', 'Escalada al cerro a cargo de especialistas.', -64.45312858, 17.21588078, 'null', 5, 'josefa84', '2020-04-26'),
(10, 'Playa.', 'Arena, sol y agua.', 100.07812142, 44.00512491, 'null', 5, 'antonio57', '2020-04-27'),
(11, 'Cerro Arequita.', 'Reconocimiento de flora y fauna.', -64.45312858, -25.2312458, 'http://www.ejemplo.com/plan-11', 6, 'maria98', '2020-04-28'),
(12, 'Cerro Artigas.', 'Noche de los fogones.', 100.07812142, -25.2312458, 'http://www.ejemplo.com/plan-12', 6, 'josefa84', '2020-04-29'),
(13, 'Teatro Plaza.', 'Les Luthiers.', 5.85937142, 44.00512491, 'http://www.ejemplo.com/plan-13', 7, 'francisco91', '2020-04-30'),
(14, 'Cena con amigos.', 'Restoran Los luteros.', 5.85937142, -25.2312458, 'http://www.ejemplo.com/plan-14', 7, 'maria98', '2020-05-01'),
(15, 'Ubicación en hospedaje.', 'Hostel del delta.', -64.45312858, 44.00512491, 'http://www.ejemplo.com/plan-15', 8, 'maria98', '2020-05-02'),
(16, 'Navegación por canales.', 'Navegación por los canales y paseo de compras.', 138.04687142, -25.2312458, 'null', 8, 'francisco91', '2020-05-03');

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

