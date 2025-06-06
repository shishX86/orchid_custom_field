<?php

declare(strict_types=1);

namespace App\Orchid;

use App\Models\Posttype;
use App\Models\Template;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        $posttypes = Posttype::all();

        $postList = $posttypes->map(function($posttype) {
            return Menu::make($posttype->name)
                ->icon('bs.book')
                ->route('platform.post.list', ['posttype' => $posttype->id])
                ->active('*/posts?posttype='.$posttype->id);
            })
            ->toArray();

        $menu = [
            Menu::make('Контент')
                ->icon('folder')
                ->list($postList),

            Menu::make('Компоненты')
                ->icon('grid')
                ->route('platform.template.list'),

            Menu::make('Типы страниц')
                ->icon('stack')
                ->route('platform.posttype.list')
        ];

        return $menu;
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
