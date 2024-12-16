<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->createMany([
            [
                'name' => 'Lucas DA SILVEIRA',
                'email' => 'lucas.da_silveira@edu.univ-fcomte.fr',
            ],
            [
                'name' => 'Nathan BOSCHI',
                'email' => 'nathan.boschi@edu.univ-fcomte.fr',
            ],
            [
                'name' => 'Clément MENAUCOURT',
                'email' => 'clement.menaucourt@edu.univ-fcomte.fr',
            ]
        ]);

        $users = $users->concat(User::factory(5)->create());

        $lucas = $users->firstWhere('email', 'lucas.da_silveira@edu.univ-fcomte.fr');

        $group = Group::factory()->create([
            'name' => '24H DU MANS',
            'owner_id' => $lucas->id,
        ]);

        // add lucas to the group
        GroupUser::factory()->create([
            'group_id' => $group->id,
            'user_id' => $lucas->id,
        ]);

        $otherUsers = $users->where('id', '!=', $lucas->id);

        for ($i = 0; $i < 3; $i++) {
            $createdUser = GroupUser::factory()->create([
                'group_id' => $group->id,
                'user_id' => $otherUsers->random()->id,
            ]);
            $otherUsers = $otherUsers->where('id', '!=', $createdUser->id);
        }
    }
}
