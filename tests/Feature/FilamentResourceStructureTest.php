<?php

namespace Tests\Feature;

use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\ContactMessageResource\Pages\ListContactMessages;
use App\Filament\Resources\MenuResource\Pages\CreateMenu;
use App\Filament\Resources\MenuResource\Pages\EditMenu;
use App\Filament\Resources\MenuResource\Pages\ListMenus;
use App\Filament\Resources\ReservationResource\Pages\ListReservations;
use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentResourceStructureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['role' => 'super_admin']));
    }

    public function test_all_admin_pages_load(): void
    {
        $pages = [
            '/admin',
            '/admin/categories',
            '/admin/categories/create',
            '/admin/menus',
            '/admin/menus/create',
            '/admin/galleries',
            '/admin/galleries/create',
            '/admin/reservations',
            '/admin/reservations/create',
            '/admin/teams',
            '/admin/teams/create',
            '/admin/testimonials',
            '/admin/testimonials/create',
            '/admin/contact-messages',
            '/admin/settings-page',
        ];

        foreach ($pages as $page) {
            $this->get($page)->assertOk();
        }
    }

    public function test_resource_schemas_and_tables_classes_exist(): void
    {
        $pairs = [
            'Category' => ['Categories', 'CategoryForm', 'CategoriesTable'],
            'Menu' => ['Menus', 'MenuForm', 'MenusTable'],
            'Gallery' => ['Galleries', 'GalleryForm', 'GalleriesTable'],
            'Reservation' => ['Reservations', 'ReservationForm', 'ReservationsTable'],
            'Team' => ['Teams', 'TeamForm', 'TeamsTable'],
            'Testimonial' => ['Testimonials', 'TestimonialForm', 'TestimonialsTable'],
            'ContactMessage' => ['ContactMessages', 'ContactMessageForm', 'ContactMessagesTable'],
        ];

        foreach ($pairs as $resource => [$plural, $form, $table]) {
            $this->assertTrue(
                class_exists("App\\Filament\\Resources\\{$resource}Resource\\Schemas\\{$form}"),
                "{$resource} Schemas class missing"
            );
            $this->assertTrue(
                class_exists("App\\Filament\\Resources\\{$resource}Resource\\Tables\\{$table}"),
                "{$resource} Tables class missing"
            );
        }
    }

    public function test_menu_create_with_image_upload(): void
    {
        Storage::fake('public');
        $category = Category::create(['name' => 'Seafood']);

        Livewire::test(CreateMenu::class)
            ->fillForm([
                'category_id' => $category->id,
                'name' => 'Udang Sambal Matah',
                'slug' => 'udang-sambal-matah',
                'price' => 65000,
                'rating' => 4.8,
                'description' => 'Udang segar dengan sambal matah.',
                'image' => UploadedFile::fake()->image('udang.jpg'),
                'featured' => true,
                'status' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('menus', [
            'name' => 'Udang Sambal Matah',
            'slug' => 'udang-sambal-matah',
        ]);

        $menu = Menu::firstWhere('slug', 'udang-sambal-matah');
        $this->assertNotNull($menu->image);
        $this->assertTrue($menu->category->is($category), 'Category relation broken');
        Storage::disk('public')->assertExists($menu->image);
    }

    public function test_menu_edit_and_relationship(): void
    {
        $category = Category::create(['name' => 'Gorengan']);
        $menu = Menu::create([
            'category_id' => $category->id,
            'name' => 'Tempe Mendoan',
            'slug' => 'tempe-mendoan',
            'price' => 15000,
        ]);

        $this->assertCount(1, $category->menus);
        $this->assertSame($category->id, $menu->category->id);

        Livewire::test(EditMenu::class, ['record' => $menu->getRouteKey()])
            ->fillForm(['price' => 18000, 'name' => 'Tempe Mendoan Premium'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('menus', ['id' => $menu->id, 'price' => 18000]);
    }

    public function test_menu_table_search_and_filters(): void
    {
        $catA = Category::create(['name' => 'Seafood']);
        $catB = Category::create(['name' => 'Minuman']);
        Menu::create(['category_id' => $catA->id, 'name' => 'Cumi Saus Padang', 'slug' => 'cumi-saus-padang', 'price' => 55000, 'status' => true]);
        Menu::create(['category_id' => $catB->id, 'name' => 'Es Teh Manis', 'slug' => 'es-teh-manis', 'price' => 10000, 'status' => false]);

        Livewire::test(ListMenus::class)
            ->searchTable('Cumi')
            ->assertCountTableRecords(1);

        Livewire::test(ListMenus::class)
            ->filterTable('category_id', $catB->id)
            ->assertCountTableRecords(1);

        Livewire::test(ListMenus::class)
            ->filterTable('status', true)
            ->assertCountTableRecords(1);
    }

    public function test_category_crud_with_slug_generation(): void
    {
        Livewire::test(CreateCategory::class)
            ->fillForm([
                'name' => 'Makanan Tradisional',
                'slug' => 'makanan-tradisional',
                'description' => 'Hidangan warisan.',
                'sort_order' => 1,
                'status' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $category = Category::firstWhere('name', 'Makanan Tradisional');
        $this->assertNotNull($category);
        $this->assertSame('makanan-tradisional', $category->slug);

        Livewire::test(EditCategory::class, ['record' => $category->getRouteKey()])
            ->fillForm(['description' => 'Diperbarui'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'description' => 'Diperbarui']);
    }

    public function test_reservations_and_contact_messages_table_load(): void
    {
        $this->post('/reservation', [
            'name' => 'Budi',
            'phone' => '08123456789',
            'email' => 'budi@example.com',
            'guest' => 4,
            'reservation_date' => now()->addDay()->toDateString(),
            'reservation_time' => '19:00',
            'message' => 'Dekat jendela',
        ])->assertSessionHas('success');

        $this->post('/contact', [
            'name' => 'Siti',
            'email' => 'siti@example.com',
            'subject' => 'Info',
            'message' => 'Apakah buka hari minggu?',
        ])->assertSessionHas('success');

        $this->assertDatabaseHas('reservations', ['name' => 'Budi', 'status' => 'pending']);
        $this->assertDatabaseHas('contact_messages', ['name' => 'Siti', 'status' => 'unread']);

        Livewire::test(ListReservations::class)->assertCountTableRecords(1);
        Livewire::test(ListContactMessages::class)->assertCountTableRecords(1);
    }

    public function test_resource_main_class_lives_inside_its_own_folder(): void
    {
        $resources = [
            'CategoryResource' => 'categories',
            'MenuResource' => 'menus',
            'GalleryResource' => 'galleries',
            'ReservationResource' => 'reservations',
            'TeamResource' => 'teams',
            'TestimonialResource' => 'testimonials',
            'ContactMessageResource' => 'contact-messages',
        ];

        foreach ($resources as $class => $slug) {
            $nested = "App\\Filament\\Resources\\{$class}\\{$class}";

            // 1. Class must be autoloadable from inside its folder
            $this->assertTrue(class_exists($nested), "{$class} not found at {$nested}");

            // 2. No leftover file at the Resources root
            $this->assertFileDoesNotExist(app_path("Filament/Resources/{$class}.php"));

            // 3. File must physically live in the resource folder
            $this->assertFileExists(app_path("Filament/Resources/{$class}/{$class}.php"));

            // 4. URL slug must stay stable after nesting
            $this->assertSame($slug, $nested::getSlug(), "{$class} slug changed");

            // 5. Support folders must sit next to the resource class
            $this->assertDirectoryExists(app_path("Filament/Resources/{$class}/Pages"));
            $this->assertDirectoryExists(app_path("Filament/Resources/{$class}/Schemas"));
            $this->assertDirectoryExists(app_path("Filament/Resources/{$class}/Tables"));
        }
    }

    public function test_navigation_lists_all_resources(): void
    {
        $response = $this->get('/admin');
        $response->assertOk();

        foreach (['Categories', 'Menus', 'Galleries', 'Reservations', 'Teams', 'Testimonials', 'Contact Messages'] as $label) {
            $response->assertSee($label);
        }
    }
}
