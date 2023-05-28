<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\BlogCategory;
use App\Models\Form;
use App\Models\Gateway;
use App\Models\GatewayCurrency;
use App\Models\HomeSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Sabberworm\CSS\Settings;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('11223344'),
                'status' => 1
            ]
        );

        $admin->email_verified_at = Carbon::now();
        $admin->save();

        $this->addSettings();

        $language = $this->addDefaultLanguage();

        $this->addDefaultMenus($language);

        $this->additionalQueries();
    }

    /**
     * Insert required data in relevant tables
     *
     * @return void
     */
    private function additionalQueries()
    {
    }

    /**
     * Insert default language information
     *
     * @return Language
     */
    private function addDefaultLanguage(): Language
    {
        $language = new Language();
        $language->name = $language->native = 'English';
        $language->code = 'en';
        $language->is_default = 1;
        $language->save();

        Cache::put('language_default', $language);

        return $language;
    }

    /**
     * Add default menus
     *
     * @param Language $language
     * @return void
     */
    private function addDefaultMenus(Language $language)
    {
        Menu::insert([
            [
                'name' => 'Main Menu',
                'slug' => slugify('Main Menu' . $language->name),
                'language' => $language->code,
                'links' => json_encode($this->mainMenuItems()),
                'menu_type' => 'main'
            ],
            [
                'name' => 'Quick Links',
                'slug' => 'quick-link',
                'language' => $language->code,
                'links' => json_encode([]),
                'menu_type' => 'widget'
            ],
        ]);
    }

    /**
     * Get primary menu item list
     *
     * @return array
     */
    private function mainMenuItems(): array
    {
        return [
            [
                'url' => url('/'),
                'text' => 'Home',
                'target' => 'self',
                'submenu' => false
            ],
            [
                'url' => url('contact'),
                'text' => 'Contact',
                'target' => 'self',
                'submenu' => false
            ],
        ];
    }

    /**
     * Add default settings parameters
     *
     * @return void
     */
    private function addSettings()
    {
        Setting::query()->truncate();

        Setting::insert([
            [
                'key_name' => 'site_name',
                'key_value' => 'Hotel Booking Manager',
            ],
            [
                'key_name' => 'site_address',
                'key_value' => 'Dhaka, Bangladesh',
            ],
            [
                'key_name' => 'site_contact_no',
                'key_value' => '0123456789',
            ],
            [
                'key_name' => 'support_email',
                'key_value' => 'support@example.com',
            ],
            [
                'key_name' => 'maintenance_mode',
                'key_value' => '0',
            ],
            [
                'key_name' => 'force_ssl',
                'key_value' => '0',
            ],
            [
                'key_name' => 'secure_password',
                'key_value' => '0',
            ],
            [
                'key_name' => 'agree',
                'key_value' => '1',
            ],
            [
                'key_name' => 'registration',
                'key_value' => '1',
            ],
            [
                'key_name' => 'color_primary',
                'key_value' => '3EB74F',
            ],
            [
                'key_name' => 'preloader_status',
                'key_value' => 0,
            ],
        ]);
    }
}
