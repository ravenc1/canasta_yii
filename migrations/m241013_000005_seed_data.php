<?php

use yii\db\Migration;

class m241013_000005_seed_data extends Migration
{
    public function safeUp()
    {
        // Tipo de tiro
        $this->batchInsert('tipo_tiro', ['nombre', 'valor'], [
            ['Libre', 1],
            ['Dos puntos', 2],
            ['Tres puntos', 3],
        ]);

        // Equipos
        $equipos = [
            ['Leones del Norte', 'uploads/logos/equipo1.webp'],
            ['Águilas Doradas', 'uploads/logos/equipo2.webp'],
            ['Tigres del Sur', 'uploads/logos/equipo3.webp'],
            ['Halcones Azules', 'uploads/logos/equipo4.webp'],
        ];
        foreach ($equipos as $e) {
            $this->insert('equipo', ['nombre' => $e[0], 'logo' => $e[1]]);
        }

        // Jugadores (3 por equipo)
        $jugadores = [
            // equipo 1
            [1, 'Juan', 'Pérez', '1998-04-12', 'uploads/fotos/jugador1.jpg'],
            [1, 'Carlos', 'López', '1999-09-03', 'uploads/fotos/jugador2.jpg'],
            [1, 'Miguel', 'González', '1997-11-20', 'uploads/fotos/jugador3.jpg'],
            // equipo 2
            [2, 'Pedro', 'Martínez', '2000-02-15', 'uploads/fotos/jugador4.jpg'],
            [2, 'Luis', 'Ramírez', '1998-07-28', 'uploads/fotos/jugador5.jpg'],
            [2, 'José', 'Hernández', '1996-12-05', 'uploads/fotos/jugador6.jpg'],
            // equipo 3
            [3, 'Andrés', 'Castro', '1999-03-18', 'uploads/fotos/jugador7.jpg'],
            [3, 'Diego', 'Morales', '1997-08-22', 'uploads/fotos/jugador8.jpg'],
            [3, 'Fernando', 'Vargas', '2001-01-10', 'uploads/fotos/jugador9.jpg'],
            // equipo 4
            [4, 'Ricardo', 'Arias', '1998-05-30', 'uploads/fotos/jugador10.jpg'],
            [4, 'Eduardo', 'Soto', '1999-10-14', 'uploads/fotos/jugador11.jpg'],
            [4, 'Sergio', 'Díaz', '2000-06-09', 'uploads/fotos/jugador12.jpg'],
        ];
        foreach ($jugadores as $j) {
            $this->insert('jugador', [
                'equipo_id' => $j[0],
                'nombres' => $j[1],
                'apellidos' => $j[2],
                'fecha_nacimiento' => $j[3],
                'fotografia' => $j[4],
            ]);
        }

        // Puntuaciones: al menos 30 registros distribuidos
        // Obtener ids
        $jugadorIds = $this->db->createCommand('SELECT id FROM jugador')->queryColumn();
        $tipos = [1, 2, 3]; // tipo_tiro ids
        $rows = [];
        $jornadas = [1, 2, 3, 4, 5];
        $count = 0;
        foreach ($jugadorIds as $jid) {
            foreach ($jornadas as $jor) {
                if ($count >= 35) {
                    break 2;
                }
                // cada jugador anota en alguna jornada 1-2 veces
                if (mt_rand(0, 1) === 1) {
                    continue;
                }
                $tipoId = $tipos[array_rand($tipos)];
                $valor = $tipoId; // coincide con valor para Libre=1, Dos=2, Tres=3
                // puntos calculado según tipo (1,2,3). A veces múltiples tiros
                $cantidad = mt_rand(1, 3);
                $rows[] = [$jid, $jor, $tipoId, $valor * $cantidad];
                $count++;
            }
        }
        // asegurar al menos 30
        while ($count < 30) {
            $jid = $jugadorIds[array_rand($jugadorIds)];
            $jor = $jornadas[array_rand($jornadas)];
            $tipoId = $tipos[array_rand($tipos)];
            $valor = $tipoId;
            $cantidad = mt_rand(1, 2);
            $rows[] = [$jid, $jor, $tipoId, $valor * $cantidad];
            $count++;
        }
        $this->batchInsert('puntuacion', ['jugador_id', 'jornada', 'tipo_tiro_id', 'puntos'], $rows);
    }

    public function safeDown()
    {
        $this->delete('puntuacion');
        $this->delete('jugador');
        $this->delete('equipo');
        $this->delete('tipo_tiro');
    }
}
