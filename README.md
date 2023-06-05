composer create-project laravel/laravel example-app

cd example-app

composer require laravel/jetstream

php artisan jetstream:install livewire



npm install

npm run dev

<!-- npm run buil -->

php artisan migrate


php artisan serve

cria usuário e senha

loga 

php artisan vendor:publish --tag=jeststream-view

### DatabaseSeeder.php

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;                                ============> NÃO ESQUECER DE IMPORTAR A CLASSE User
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Alberto Gomes da Silva',
            'email' => 'albertogomesdasilva@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        \App\Models\User::factory(10)->create();
    }
}


 
 # UserFactory.php
<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     */
    public function withPersonalTeam(callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $user->name.'\'s Team',
                    'user_id' => $user->id,
                    'personal_team' => true,
                ])
                ->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }
}

### FILAMENT.COM
composer require filament/filament:"^2.0"


# composer.json linha 43

"post-update-cmd": [
    // ...
    "@php artisan filament:upgrade"
],

# Publicando o config/filament.php
php artisan vendor:publish --tag=filament-config

# filament.php
linha 172: 'dark_mode': true,

209: is_collapsible_on_desktop: => true,

213: 'width' => 'full',

# substituimos a página inicial welcome.blade.php e a pasta de assets dentro da pasta public

# EXIBINDO AS PÁGINAS DO FILAMENT ADMIN
php artisan vendor:publish

Tag: filament-translations .............................. 28  
  Tag: filament-views ..................................... 29  
  Tag: flare-config ....................................... 30  
  Tag: forms-config ....................................... 31  
  Tag: forms-stubs ........................................ 32  
  Tag: forms-translations ................................. 33  
  Tag: forms-views ........................................ 34  
  Tag: fortify-config ..................................... 35  
  Tag: fortify-migrations ................................. 36  
  Tag: fortify-support .................................... 37  
  Tag: ignition-config .................................... 38  
  Tag: jetstream-config ................................... 39  
  Tag: jetstream-inertia-auth-pages ....................... 40  
  Tag: jetstream-migrations ............................... 41  
  Tag: jetstream-routes ................................... 42  
  Tag: jetstream-team-migrations .......................... 43  
  Tag: laravel-errors ..................................... 44  
  Tag: laravel-mail ....................................... 45  
  Tag: laravel-notifications .............................. 46  
  Tag: laravel-pagination ................................. 47  
  Tag: livewire ........................................... 48  
  Tag: sail ............................................... 56  
  Tag: sail-bin ........................................... 57  
  Tag: sail-docker ........................................ 58  
  Tag: sanctum-config ..................................... 59  
  Tag: sanctum-migrations ................................. 60  
  Tag: tables-config ...................................... 61  
  Tag: tables-stubs ....................................... 62  
  Tag: tables-translations ................................ 63  
  Tag: tables-views ....................................... 64  
❯ 29 ===========> filament.views 

# insere a logo do Dashboard
resources\views\vendor\filament\components\header\index.blade.php 
@props([
    'actions' => null,
    'heading',
    'subheading' => null
])

<header {{ $attributes->class(['filament-header space-y-2 items-start justify-between sm:flex sm:space-y-0 sm:space-x-4  sm:rtl:space-x-reverse sm:py-4']) }}>
    <div>
        <x-filament::header.heading>
            <div class="flex items-center">
                <div>  <img class="w-20 mr-2" src="assets/img/real-invest-logo.png" alt="logo"> </div>
                 <div>
                     {{ $heading }}
                 </div>   
                </div>
                
            </div>
        </x-filament::header.heading>

        @if ($subheading)
            <x-filament::header.subheading class="mt-1">
                {{ $subheading }}
            </x-filament::header.subheading>
        @endif
    </div>


    <x-filament::pages.actions :actions="$actions" class="shrink-0" />
</header>

# https://tailwindcss.com/docs/width


### aparência e themes filament para mudar a aparência do filament
https://filament.com/docs    -> Building themes

npm install tailwindcss @tailwindcss/forms @tailwindcss/typography autoprefixer tippy.js --save-dev

# tailwind.config.js  -> fica assim
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const colors = require('tailwindcss/colors')     // INSERIDA ESTA LINHA 

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        './vendor/filament/**/*.blade.php',   //INSERIDA ESTA LINHA 


    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
//  INSERIDAS ESTAS LINHAS
            colors: { 
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            }, 
// FIM
        },
    },

    plugins: [forms, typography],
};

# vite.config.js -> fica assim

import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',

                'resources/css/filament.css',     // INSERIDA ESTA LINHA AQUI
                
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});

# CRIA UM ARQUIVO NA PASTA resource/css/filament.css
# filament.css

@import '../../vendor/filament/filament/resources/css/app.css';   // Somente essa linha no filament.css

 
# App/Providers/AppServiceProvider.php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Filament\Facades\Filament;      // inserida aqui
use Illuminate\Foundation\Vite;    //e inserido aqui 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         
Filament::serving(function () {
    // Using Vite
    Filament::registerViteTheme('resources/css/filament.css');
});
    }
}

#### O DARK MODE DEIXA DE FUNCIONAR

* *ailwind.config.js

import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const colors = require('tailwindcss/colors')     // INSERIDA ESTA LINHA 

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',              ========> INSERE SOMENTE ESSA LINHA AQUI QUE O DARK MODE VOLTA A FUNCIONAR
    content: [


### AJUSTAR AS CORES AZUIS COMO O AZUL DA LOGO
 
 tailwind.config.css
 import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const colors = require('tailwindcss/colors')     // INSERIDA ESTA LINHA 

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        './vendor/filament/**/*.blade.php',   //INSERIDA ESTA LINHA 


    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
//  INSERIDAS ESTAS LINHAS
            colors: { 
                danger: colors.rose,
                // primary: colors.blue,
                //INICIO DA CUSTOMIZAÇÃO
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#1e40af', // same as blue-800
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    
                        },

                //FIM
                success: colors.green,
                warning: colors.yellow,
            }, 
// FIM
        },
    },

    plugins: [forms, typography],
};


### MODEL / MIGRATION

php artisan make:model Property -mfc


php artisan make:model Property -mfc (CRIA A MODEL, A FACTORY E CONTROLLER)

# CONFIGURANDO PRIMEIRO A MODEL com SoftDeletes que será usada também da migration:
Property.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
}


# CONFIGURANDO A MIGRATION
2023_06_05_212921_create_properties_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->unsignedInteger('price');
            $table->unsignedInteger('sqm');
            $table->unsignedSmallInteger('bedrooms')->nullable();
            $table->unsignedSmallInteger('bathrooms')->nullable();
            $table->unsignedSmallInteger('garages')->nullable();
            $table->boolean('slider')->default(false);
            $table->boolean('visible')->default(true);
            $table->date('start_date')->default('2022-01-01');
            $table->date('end_date')->default('2023-01-01');

            $table->softDeletes();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

# php artisan migrate

# CRIANDO O FILAMENT RESOURCE
* preencher a factory
database\factories\PropertyFactory.php

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realTextBetween(25,45),
            'description' => $this->faker->realTextBetween(100,150),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'price' => rand(500, 5000)*1000,
            'sqm' => rand(150, 1500),
            'bedrooms' => rand(3, 10),
            'bathrooms' => rand(3, 6),
            'garages' => rand(1, 5),
        ];
    }
}

* preenchendo a database\seeders\DatabaseSeeder.php
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Alberto Gomes da Silva',
            'email' => 'albertogomesdasilva@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        \App\Models\User::factory(10)->create();
        
        Property::factory(50)->create();
    }
}

### REFAZENDO O BANCO DE DADOS, GERA O USUÁRIO albertogomesdasilva@gmail.com e Preenche 50 registros na tabela property

* importante alterar 'locale' e 'faker_locale' => 'pt_BR', para gerar registros faker em português. config\app.php

php artisan migrate:fresh --seed

### INSTALANDO O PACOTE DBAL PARA CRIAR  RESOURCES DO FILAMENT AUTOMATICAMENTE
composer require doctrine/dbal

### criando os resources com softdeletes que usamos na migration e na model:
php artisan make:filament-resource Property --generate --soft-deletes --view

* MODEL Despesa.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Despesa extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
}

* MIGRATION 2023_06_05_223326_create_despesas_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();

            $table->string('despesas');
            $table->float('valor')->nullable();
            $table->date('vencimento')->nullable();
            $table->boolean('status')->nullable();
            $table->date('pagamento')->nullable();
            $table->string('obs')->nullable();

            $table->softDeletes();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};

* DespesaFactory.php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Despesa>
 */
class DespesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'despesas' => $this->faker->realTextBetween(25,45),
            'valor' => fake()->randomfloat(2, 10, 1000),
            'vencimento' => fake()->date(),
            'status' => fake()->boolean(),
            'pagamento' => fake()->date(),
            'obs' => fake()->sentence(5),
        ];
    }
}


* DatabaseSeeder.php

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Despesa;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Alberto Gomes da Silva',
            'email' => 'albertogomesdasilva@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        \App\Models\User::factory(10)->create();
        
        Despesa::factory(10)->create();
        
        Property::factory(50)->create();
    }
}


### php artisan migrate:fresh --seed 

### $ php artisan make:filament-resource Despesa --generate --soft-deletes --view

localhost:8000/admin
