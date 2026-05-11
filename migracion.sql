-- =====================================================
-- Migración para la tienda de videojuegos
-- Ejecutar en phpMyAdmin sobre la base `tienda_videojuegos`
-- =====================================================

-- 1. Borrar al usuario "Alan" (contraseña hasheada que ya no servirá) y sus carritos
DELETE FROM carrito_detalle WHERE id_carrito IN (SELECT id FROM carrito WHERE id_usuario = 1);
DELETE FROM carrito WHERE id_usuario = 1;
DELETE FROM usuarios WHERE id = 1;

-- 2. Cambiar el campo imagen de LONGBLOB a VARCHAR(100) para guardar el nombre del archivo
ALTER TABLE productos MODIFY imagen VARCHAR(100) DEFAULT NULL;

-- 3. Asignar nombre de imagen a los 11 productos existentes
UPDATE productos SET imagen = 'ps5-slim.jpg'         WHERE id = 1;
UPDATE productos SET imagen = 'ps5-pro.jpg'          WHERE id = 2;
UPDATE productos SET imagen = 'xbox-series-x.jpg'    WHERE id = 3;
UPDATE productos SET imagen = 'xbox-series-s.jpg'    WHERE id = 4;
UPDATE productos SET imagen = 'switch-2.jpg'         WHERE id = 5;
UPDATE productos SET imagen = 'dualsense.jpg'        WHERE id = 6;
UPDATE productos SET imagen = 'xbox-wireless.jpg'    WHERE id = 7;
UPDATE productos SET imagen = 'joy-con.jpg'          WHERE id = 8;
UPDATE productos SET imagen = 'spider-man-2.jpg'     WHERE id = 9;
UPDATE productos SET imagen = 'halo-infinite.jpg'    WHERE id = 10;
UPDATE productos SET imagen = 'mario-kart-world.jpg' WHERE id = 11;

-- 4. Insertar 20 productos nuevos (3 controles + 17 videojuegos) para llegar a 31
-- Categorías: 1=Consola, 2=Control, 3=Videojuego
-- Plataformas: 1=PS5, 2=Xbox Series, 3=Switch 2

INSERT INTO productos (id_categoria, id_plataforma, nombre, descripcion, imagen, precio, stock, fabricante, origen) VALUES
(2, 1, 'Control DualSense Edge',        'Control profesional inalámbrico para PlayStation 5 con botones personalizables.', 'dualsense-edge.jpg',     3999.00, 8,  'Sony',          'Japón'),
(2, 2, 'Control Xbox Elite Series 2',   'Control de élite inalámbrico con paletas traseras y gatillos ajustables.',        'xbox-elite-2.jpg',       3799.00, 10, 'Microsoft',     'Estados Unidos'),
(2, 3, 'Pro Controller Switch 2',       'Control Pro inalámbrico para Nintendo Switch 2.',                                 'pro-controller-switch.jpg', 1999.00, 12, 'Nintendo',   'Japón'),

(3, 1, 'God of War Ragnarok',           'Aventura épica de acción con Kratos y Atreus para PlayStation 5.',                'god-of-war-ragnarok.jpg', 1299.00, 15, 'Santa Monica Studio', 'Estados Unidos'),
(3, 1, 'The Last of Us Part II Remastered', 'Versión remasterizada del aclamado juego de Naughty Dog.',                    'last-of-us-part-2.jpg',  1199.00, 12, 'Naughty Dog',    'Estados Unidos'),
(3, 1, 'Final Fantasy VII Rebirth',     'Segunda parte de la trilogía de remakes de Final Fantasy VII.',                   'ff7-rebirth.jpg',        1499.00, 10, 'Square Enix',    'Japón'),
(3, 1, 'Gran Turismo 7',                'Simulador de carreras realista exclusivo de PlayStation.',                        'gran-turismo-7.jpg',     1099.00, 14, 'Polyphony Digital', 'Japón'),
(3, 1, 'Astro Bot',                     'Plataformero 3D ganador del GOTY 2024.',                                          'astro-bot.jpg',          1299.00, 18, 'Team Asobi',     'Japón'),
(3, 1, 'Ghost of Tsushima Directors Cut','Aventura samurái en el Japón feudal.',                                            'ghost-of-tsushima.jpg',  999.00,  16, 'Sucker Punch',   'Estados Unidos'),

(3, 2, 'Forza Horizon 5',               'Carreras de mundo abierto en México.',                                            'forza-horizon-5.jpg',    1099.00, 13, 'Playground Games', 'Reino Unido'),
(3, 2, 'Starfield',                     'RPG espacial de Bethesda con exploración de planetas.',                           'starfield.jpg',          1199.00, 11, 'Bethesda',       'Estados Unidos'),
(3, 2, 'Gears 5',                       'Shooter en tercera persona de la saga Gears of War.',                             'gears-5.jpg',            799.00,  10, 'The Coalition',  'Canadá'),
(3, 2, 'Sea of Thieves',                'Aventura cooperativa de piratas en mundo abierto.',                               'sea-of-thieves.jpg',     799.00,  20, 'Rare',           'Reino Unido'),
(3, 2, 'Senuas Saga Hellblade II',      'Aventura cinematográfica con la guerrera Senua.',                                 'hellblade-2.jpg',        999.00,  9,  'Ninja Theory',   'Reino Unido'),
(3, 2, 'Microsoft Flight Simulator',    'Simulador de vuelo con escenarios fotorrealistas del mundo entero.',              'flight-simulator.jpg',   1099.00, 7,  'Asobo Studio',   'Francia'),

(3, 3, 'The Legend of Zelda: Tears of the Kingdom', 'Aventura abierta en el reino de Hyrule con Link.',                    'zelda-totk.jpg',         1499.00, 14, 'Nintendo',       'Japón'),
(3, 3, 'Super Mario Bros. Wonder',      'Plataformero 2D clásico de Mario con efectos sorprendentes.',                     'mario-wonder.jpg',       1299.00, 16, 'Nintendo',       'Japón'),
(3, 3, 'Splatoon 3',                    'Shooter multijugador a base de tinta.',                                            'splatoon-3.jpg',         1199.00, 12, 'Nintendo',       'Japón'),
(3, 3, 'Pokemon Scarlet',               'Aventura RPG en la región de Paldea.',                                            'pokemon-scarlet.jpg',    1299.00, 13, 'Game Freak',     'Japón'),
(3, 3, 'Donkey Kong Bananza',           'Plataformero 3D protagonizado por Donkey Kong.',                                  'donkey-kong-bananza.jpg', 1399.00, 10, 'Nintendo',       'Japón');

-- =====================================================
-- Verificación: SELECT COUNT(*) FROM productos;
-- Resultado esperado: 31
-- =====================================================
