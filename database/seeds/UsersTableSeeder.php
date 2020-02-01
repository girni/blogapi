<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker\Factory::create();

        $admin = \Boostcsgo\Core\Model\User::create([
            'name' => 'admin',
            'password' => bcrypt('zxc123qwe'),
            'email' => "admin@admin.com",
            'role' => \Boostcsgo\Core\Enum\UserRole::ADMIN
        ]);

        $this->createUserData($admin);

        $booster = \Boostcsgo\Core\Model\User::create([
            'name' => 'booster',
            'password' => bcrypt('zxc123qwe'),
            'email' => "booster@booster.com",
            'role' => \Boostcsgo\Core\Enum\UserRole::BOOSTER
        ]);

        $this->createUserData($booster);

        $client = \Boostcsgo\Core\Model\User::create([
            'name' => 'client',
            'password' => bcrypt('zxc123qwe'),
            'email' => "client@client.com"
        ]);

        $this->createUserData($client);

        for($i = 0; $i < 50; $i++) {
            $user = \Boostcsgo\Core\Model\User::create([
                'name' => $this->faker->name,
                'password' => bcrypt('zxc123qwe'),
                'email' => "test{$i}@example.com",
                'role' => \Boostcsgo\Core\Enum\UserRole::getValues()[array_rand(\Boostcsgo\Core\Enum\UserRole::getValues())],
            ]);

            $this->createUserData($user);
        }
    }

    /**
     * @param \Boostcsgo\Core\Model\User $user
     * @return \Boostcsgo\User\Model\UserData
     */
    private function createUserData(\Boostcsgo\Core\Model\User $user): \Boostcsgo\User\Model\UserData
    {
        return \Boostcsgo\User\Model\UserData::create([
            'user_id' => $user->id,
            'skype' => $this->faker->name,
            'discord' => $this->faker->name,
            'steam' => $this->faker->name,
            'country' => $this->faker->countryCode,
            'balance' => $this->faker->numberBetween(0, 1000)
        ]);
    }
}
