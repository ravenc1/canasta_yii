<?php

use yii\db\Migration;

/**
 * Datos iniciales del torneo "La Canasta".
 *
 * Dataset autoritativo (sincronizado con la base de datos real):
 *   - 6 equipos
 *   - 30 jugadores (5 por equipo)
 *   - 3 tipos de tiro
 *   - 77 puntuaciones
 *
 * Las imagenes referenciadas existen en web/uploads/ y se versionan en el
 * repositorio (logos, fotos, fondos e icono), por lo que un clon limpio que
 * ejecute `php yii migrate` reproduce exactamente estos datos.
 *
 * NOTA: el orden del array de jugadores define su id (1..30); no reordenar
 * sin actualizar tambien la columna jugador_id de las puntuaciones.
 */
class m241013_000005_seed_data extends Migration
{
    public function safeUp()
    {
        // Tipos de tiro
        $this->batchInsert('tipo_tiro', ['nombre', 'valor'], [
            ['Libre', 1],
            ['Dos puntos', 2],
            ['Tres puntos', 3],
        ]);

        // Equipos (el orden define el id 1..6 usado por jugador.equipo_id)
        $this->batchInsert('equipo', ['nombre', 'logo'], [
            ['Tigres del Sur', 'uploads/logos/equipo1.webp'],
            ['Halcones Azules', 'uploads/logos/equipo2.webp'],
            ['Aguilas Doradas', 'uploads/logos/equipo3.webp'],
            ['Leones de la Cancha', 'uploads/logos/equipo4.webp'],
            ['Los Angeles Lakers', 'uploads/logos/logo_6ad0414c5b202.jpg'],
            ['Chicago Bulls', 'uploads/logos/logo_6ad05dde78806.webp'],
        ]);

        // Jugadores (5 por equipo). El orden define el id 1..30.
        $this->batchInsert('jugador', ['equipo_id', 'nombres', 'apellidos', 'fecha_nacimiento', 'fotografia'], [
            // id 1..2 -> equipo 1
            [1, 'Carlos', 'Gomez', '1995-03-12', 'uploads/fotos/jugador1.jpg'],
            [1, 'Juan', 'Perez', '1994-11-05', 'uploads/fotos/jugador3.jpg'],
            // id 3..5 -> equipo 2
            [2, 'Miguel', 'Ramirez', '1997-01-18', 'uploads/fotos/jugador4.jpg'],
            [2, 'Jose', 'Hernandez', '1995-09-30', 'uploads/fotos/jugador5.jpg'],
            [2, 'Pedro', 'Lopez', '1996-04-14', 'uploads/fotos/jugador6.jpg'],
            // id 6..8 -> equipo 3
            [3, 'Andres', 'Sanchez', '1998-02-25', 'uploads/fotos/jugador7.jpg'],
            [3, 'Fernando', 'Castillo', '1994-08-09', 'uploads/fotos/jugador8.jpg'],
            [3, 'Ricardo', 'Vargas', '1996-12-01', 'uploads/fotos/jugador9.jpg'],
            // id 9..11 -> equipo 4
            [4, 'Diego', 'Molina', '1997-06-17', 'uploads/fotos/jugador10.jpg'],
            [4, 'Sergio', 'Ortega', '1995-10-23', 'uploads/fotos/jugador11.jpg'],
            [4, 'Alberto', 'Flores', '1996-05-08', 'uploads/fotos/jugador12.jpg'],
            // id 12 -> equipo 5
            [5, 'Pedro', 'Pascal', '1994-09-10', 'uploads/fotos/foto_6ad045edd7b24.png'],
            // id 13..17 -> equipo 6
            [6, 'Nicolas', 'Claxton', '1996-09-05', 'uploads/fotos/foto_6ad05e1d6fc77.png'],
            [6, 'Rob', 'Dillingham', '1995-04-02', 'uploads/fotos/foto_6ad05eb48269b.png'],
            [6, 'Patrick', 'Williams', '1996-03-16', 'uploads/fotos/foto_6ad05f0ddcc4a.png'],
            [6, 'Tre', 'Jones', '1993-08-12', 'uploads/fotos/foto_6ad05fa455423.png'],
            [6, 'Norman', 'Powell', '1996-06-17', 'uploads/fotos/foto_6ad060216e312.png'],
            // id 18..21 -> equipo 5
            [5, 'Luka', 'Doncic', '1992-07-18', 'uploads/fotos/foto_6ad0623d16531.png'],
            [5, 'Sandro', 'Mamukelashvili', '1990-10-04', 'uploads/fotos/foto_6ad0630c4a64e.png'],
            [5, 'Bronny', 'James', '1987-11-11', 'uploads/fotos/foto_6ad06374765e8.png'],
            [5, 'Cameron', 'Carr', '1993-08-25', 'uploads/fotos/foto_6ad063b336b80.png'],
            // id 22..23 -> equipo 3
            [3, 'Jason', 'Momoa', '1985-11-21', 'uploads/fotos/foto_6ad06432e8702.jpg'],
            [3, 'Juan', 'Wgner', '1994-05-30', 'uploads/fotos/foto_6ad064bf9c6cc.jpg'],
            // id 24..25 -> equipo 2
            [2, 'Mario', 'Dodorts', '1993-11-10', 'uploads/fotos/foto_6ad0650d275ef.jpg'],
            [2, 'David', 'Jolls', '1989-04-05', 'uploads/fotos/foto_6ad0655f42456.jpg'],
            // id 26..27 -> equipo 4
            [4, 'Dreick', 'Jhonson', '1988-01-12', 'uploads/fotos/foto_6ad065ba4ca6e.jpg'],
            [4, 'Leo', 'Davidson', '1996-09-18', 'uploads/fotos/foto_6ad066076dbf8.jpg'],
            // id 28..30 -> equipo 1
            [1, 'Walter', 'White', '1974-03-08', 'uploads/fotos/foto_6ad066cbe28ed.jpg'],
            [1, 'Jessie', 'Pinkman', '1992-02-05', 'uploads/fotos/foto_6ad067530f5af.jpg'],
            [1, 'Luis', 'Martinez', '1996-07-22', 'uploads/fotos/jugador2.jpg'],
        ]);

        // Puntuaciones (77 registros). jugador_id referencia los ids 1..30.
        $this->batchInsert('puntuacion', ['jugador_id', 'jornada', 'tipo_tiro_id', 'puntos'], [
            [2, 1, 1, 1],
            [2, 2, 2, 2],
            [2, 3, 3, 3],
            [2, 4, 2, 2],
            [3, 1, 3, 3],
            [3, 1, 3, 3],
            [3, 2, 2, 2],
            [3, 3, 1, 1],
            [4, 1, 2, 2],
            [4, 2, 3, 3],
            [4, 3, 3, 3],
            [4, 4, 2, 2],
            [5, 2, 1, 1],
            [5, 3, 2, 2],
            [5, 4, 3, 3],
            [6, 1, 3, 3],
            [6, 2, 2, 2],
            [6, 3, 1, 1],
            [6, 4, 3, 3],
            [7, 1, 2, 2],
            [7, 2, 3, 3],
            [7, 3, 2, 2],
            [8, 2, 1, 1],
            [8, 3, 3, 3],
            [8, 4, 2, 2],
            [9, 1, 3, 3],
            [9, 2, 2, 2],
            [9, 3, 3, 3],
            [10, 1, 2, 2],
            [10, 2, 1, 1],
            [10, 3, 3, 3],
            [11, 2, 2, 2],
            [11, 3, 3, 3],
            [11, 4, 1, 1],
            [12, 3, 1, 1],
            [13, 2, 3, 3],
            [14, 2, 2, 2],
            [15, 2, 2, 2],
            [16, 2, 3, 3],
            [17, 2, 3, 3],
            [28, 4, 1, 1],
            [29, 4, 3, 3],
            [27, 3, 3, 3],
            [10, 1, 3, 3],
            [2, 4, 1, 2],
            [24, 3, 3, 3],
            [19, 3, 3, 3],
            [18, 3, 1, 1],
            [28, 4, 3, 3],
            [28, 3, 3, 3],
            [28, 3, 3, 3],
            [25, 2, 2, 2],
            [23, 2, 3, 3],
            [22, 3, 3, 3],
            [22, 3, 3, 3],
            [22, 3, 3, 3],
            [28, 4, 2, 2],
            [28, 4, 2, 2],
            [28, 4, 3, 3],
            [22, 3, 3, 3],
            [22, 3, 3, 3],
            [22, 3, 3, 3],
            [28, 4, 3, 3],
            [21, 1, 1, 1],
            [26, 3, 2, 2],
            [20, 2, 2, 2],
            [1, 1, 3, 6],
            [1, 2, 2, 2],
            [1, 3, 1, 3],
            [1, 4, 2, 4],
            [1, 5, 3, 3],
            [30, 1, 2, 4],
            [30, 2, 1, 1],
            [30, 3, 3, 6],
            [30, 4, 1, 2],
            [30, 5, 2, 6],
            [30, 5, 3, 3],
        ]);
    }

    public function safeDown()
    {
        $this->delete('puntuacion');
        $this->delete('jugador');
        $this->delete('equipo');
        $this->delete('tipo_tiro');
    }
}
