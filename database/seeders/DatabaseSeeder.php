<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['CJ_email' => 'admin@event.local'],
            [
                'CJ_name' => 'Admin',
                'CJ_password' => Hash::make('admin123'),
                'CJ_role' => 'admin',
            ]
        );

        if (User::count() < 6) {
            User::factory(5)->create();
        }

        if (Category::count() === 0) {
            $categories = [
                'Conférence',
                'Formation',
                'Networking',
                'Séminaire',
                'Webinaire',
            ];

            foreach ($categories as $name) {
                Category::create(['CJ_name' => $name]);
            }
        }

        if (Event::count() === 0) {
            $events = [
            [
                'CJ_title' => 'Conférence Technologie & Innovation',
                'CJ_description' => 'Une conférence portant sur les dernières tendances technologiques et l\'innovation numérique en Tunisie.',
                'CJ_place' => 'Tunis - Palais de Congrès',
                'CJ_price' => 125.00,
                'CJ_capacity' => 200,
                'CJ_status' => 'active',
            ],
            [
                'CJ_title' => 'Atelier Entrepreneuriat Digital',
                'CJ_description' => 'Formation pratique sur la création d\'entreprise et la digitalisation des PME tunisiennes.',
                'CJ_place' => 'Sfax - Centre des Affaires',
                'CJ_price' => 85.00,
                'CJ_capacity' => 80,
                'CJ_status' => 'active',
            ],
            [
                'CJ_title' => 'Networking Professionnel',
                'CJ_description' => 'Rencontre d\'affaires entre professionnels et entrepreneurs de la région.',
                'CJ_place' => 'Sousse - Port Marina',
                'CJ_price' => 65.00,
                'CJ_capacity' => 150,
                'CJ_status' => 'active',
            ],
            [
                'CJ_title' => 'Séminaire Marketing Digital',
                'CJ_description' => 'Stratégies marketing modernes et outils numériques pour développer votre entreprise.',
                'CJ_place' => 'Monastir - Hôtel Marina',
                'CJ_price' => 95.00,
                'CJ_capacity' => 100,
                'CJ_status' => 'active',
            ],
            [
                'CJ_title' => 'Webinaire Formation Continue',
                'CJ_description' => 'Amélioration continue des compétences professionnelles en ligne.',
                'CJ_place' => 'Gafsa - Salle de Formation',
                'CJ_price' => 55.00,
                'CJ_capacity' => 120,
                'CJ_status' => 'active',
            ],
        ];

            foreach ($events as $index => $eventData) {
                Event::create([
                    'CJ_title' => $eventData['CJ_title'],
                    'CJ_description' => $eventData['CJ_description'],
                    'CJ_start_date' => now()->addDays($index + 1),
                    'CJ_end_date' => now()->addDays($index + 1)->addHours(3),
                    'CJ_place' => $eventData['CJ_place'],
                    'CJ_price' => $eventData['CJ_price'],
                    'CJ_is_free' => false,
                    'CJ_capacity' => $eventData['CJ_capacity'],
                    'CJ_status' => $eventData['CJ_status'],
                    'CJ_category_id' => Category::inRandomOrder()->first()->CJ_id,
                    'CJ_created_by' => $admin->CJ_id,
                ]);
            }
        }
    }
}
