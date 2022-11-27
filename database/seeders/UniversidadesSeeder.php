<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universidades')->truncate();
        DB::table('universidades')->insert([
            [
                'nombre' => 'Instituto Tecnológico de Cuautla',
                'direccion' => 'Libramiento Cuautla-Oaxaca s/n
                Col. Juan Morales
                CP 62745, Cuautla, Morelos',
                'telefono'=>'7351222242',
                'created_at'=> date('Y-m-d H:m:s'),
            ],

            [
                'nombre' => 'UPEMOR',
                'direccion' => 'Blvd. Cuauhnáhuac 566
                Col. Lomas del Texcal
                CP 62550, Jiutepec, Morelos',
                'telefono'=>'7772293500',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'UTEZ',
                'direccion' => 'Av. Universidad Tecnológica 1
                Col. Palo Escrito
                CP 62760, Emiliano Zapata, Morelos',
                'telefono'=>'77736811',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'ITESM',
                'direccion' => 'Autopista del Sol km 104
                Col. Real del Puente
                CP 62790, Temixco, Morelos',
                'telefono'=>'7773620800',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'UAEM',
                'direccion' => 'Av. Universidad 1001
                Col. Chamilpa
                CP 62210, Cuernavaca, Morelos',
                'telefono'=>'7773297002',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'CENIDET',
                'direccion' => 'Int. del Internado Palmira s/n
                Col. Palmira
                CP 62490, Cuernavaca, Morelos',
                'telefono'=>'7773627771',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Centro Universitario del Sur',
                'direccion' => 'Teopanzolco 605
                Col. Reforma
                CP 62260, Cuernavaca, Morelos',
                'telefono'=>'7773174706',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Centro Universitario Mexicano de Gestión de Cuernavaca',
                'direccion' => 'Nueva Bruselas 104. Esquina con Nueva China. Colonia Lomas de Reforma. Cuernavaca, Morelos',
                'telefono'=>'7773118355',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'INSP',
                'direccion' => 'Av. Universidad 655
                Col. Santa María Ahuacatitlán
                CP 62100, Cuernavaca, Morelos',
                'telefono'=>'7773293030',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'UNAM Campus Morelos',
                'direccion' => ' Av. Universidad 2001, Col. Chamilpa, 62100 Cuernavaca, Morelos ',
                'telefono'=>'7773290885',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'UPN',
                'direccion' => 'Carr. Cuautla Jojutla s/n
                Col. Ejidal Rafael Merino
                CP 62714, Ayala, Morelos',
                'telefono'=>' 7353549947',
                'created_at'=> date('Y-m-d H:m:s'),
            ],

            [
                'nombre' => 'Centro de Estudios Universitarios International',
                'direccion' => 'Calle Guillermina no. 50, Colonia Lomas del Mirador Cuernavaca, Morelos',
                'telefono'=>'7773225018',
                'created_at'=> date('Y-m-d H:m:s'),
            ],

            [
                'nombre' => 'Centro de Estudios Superiores México',
                'direccion' => 'Humboldt 46
                Centro
                CP 62000, Cuernavaca, Morelos',
                'telefono'=>'7771422537',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Cuauhnáhuac',
                'direccion' => 'Jacarandas 3333
                Col. Lomas de Cuernavaca
                CP 62584, Emiliano Zapata, Morelos',
                'telefono'=>' 7773127512',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad del Valle de Cuernavaca, Campus Cuernavaca',
                'direccion' => 'Chamilpa 11, 13 y 15
                Col. Miraval
                CP 62270, Cuernavaca, Morelos',
                'telefono'=>'7773124931',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Privada del Estado de Morelos (UPEM) Campus Cuernavaca',
                'direccion' => 'Av. Álvaro Obregón 624
                Col. Centro
                CP 62000, Cuernavaca, Morelos',
                'telefono'=>'7773185707',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Centro Universitario Aztlán, Plantel Cuernavaca',
                'direccion' => 'Av. Reforma 1565
                Col. Postal
                CP 62748, Cuautla, Morelos',
                'telefono'=>'7351521981',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Tecmilenio, Campus Cuernavaca',
                'direccion' => 'Meleleucas 179
                Col. Lomas de Cuernavaca
                CP 62589, Emiliano Zapata, Morelos',
                'telefono'=>'7772300351',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Latina, Campus Cuernavaca',
                'direccion' => 'Carr. Tlayecac - Cuautla 1060
                Hermenegildo Galeana
                CP 62741, Cuautla, Morelos',
                'telefono'=>'7353524697',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Instituto Tecnológico de la Construcción (ITC), Campus Cuernavaca',
                'direccion' => 'Dr. Gustavo Gómez Azcarate 200
                Col. Lomas de la Selva
                CP 62270, Cuernavaca, Morelos',
                'telefono'=>'7773113664',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Interamericana. Universidad de Negocios y Administración',
                'direccion' => 'Calle de la Luz 8
                Chapultepec
                CP 62450, Cuernavaca, Morelos',
                'telefono'=>'73535246',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Mexicana de Educación a Distancia (UMED), Virtual',
                'direccion' => 'Carr. Tlayecac - Cuautla 1060
                Hermenegildo Galeana
                CP 62741, Cuautla, Morelos',
                'telefono'=>'7773158001',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Fray Luca Paccioli, Campus Cuernavaca',
                'direccion' => 'Francisco Zarco 8
                Centro
                CP 62000, Cuernavaca, Morelos',
                'telefono'=>'7777121054',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Humanitas, Campus Cuernavaca',
                'direccion' => 'Antinea 7
                Col. Delicias
                CP 62330, Cuernavaca, Morelos',
                'telefono'=>'7771002627',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Universidad Americana de Morelos',
                'direccion' => 'Calle Del Ejido 30
                Ejido de Acapantzingo
                CP 62440, Cuernavaca, Morelos',
                'telefono'=>'7773106666',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Instituto Bonampak, Campus Cuernavaca',
                'direccion' => 'Av. Álvaro Obregón 158
                Col. Centro
                CP 62000, Cuernavaca, Morelos',
                'telefono'=>'7773182099',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Grupo Educativo Cristóbal Colón, Campus Cuernavaca',
                'direccion' => 'Av. Morelos 345
                Centro
                CP 62000, Cuernavaca, Morelos',
                'telefono'=>'7773145000',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Escuela Particular Normal Superior licenciado Benito Juárez, A. C.',
                'direccion' => 'Naranjos 10
                Lázaro Cárdenas
                CP 62080, Cuernavaca, Morelos',
                'telefono'=>'7773185248',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Colegio de Estudios de Posgrado de la Ciudad de México, Plantel Cuernavaca',
                'direccion' => 'Zapote 2
                Col. Las Palmas
                CP 62050, Cuernavaca, Morelos',
                'telefono'=>'5558683889',
                'created_at'=> date('Y-m-d H:m:s'),
            ],
            [
                'nombre' => 'Centro Universitario Latinoamericano de Morelos',
                'direccion' => '2a. Cda. de Chapultepec 3
                Col. Chapultepec
                CP 62450, Cuernavaca, Morelos',
                'telefono'=>'7773151530',
                'created_at'=> date('Y-m-d H:m:s'),
            ]
            
        ]);
    }
}
