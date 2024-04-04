<?php

namespace FriendsOfBotble\WhiteLabel\Providers;

use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\Facades\PanelSectionManager as PanelSectionManagerFacade;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Setting\PanelSections\SettingOthersPanelSection;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;

class WhiteLabelServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->setNamespace('plugins/fob-white-label');

        rescue(function () {
            $data = [];

            if (setting('white_label_hide_license_activation_info')) {
                $data['core.base.general.hide_activated_license_info'] = true;
            }

            if (setting('white_label_hide_theme_management')) {
                $data['packages.theme.general.display_theme_manager_in_admin_panel'] = false;
            }

            if (setting('white_label_hide_plugin_management')) {
                $data['packages.plugin-management.general.enable_plugin_manager'] = false;
            }

            if (setting('white_label_hide_plugin_marketplace')) {
                $data['packages.plugin-management.general.enable_marketplace_feature'] = false;
            }

            if (setting('white_label_hide_plugin_author')) {
                $data['packages.plugin-management.general.hide_plugin_author'] = true;
            }

            if (setting('white_label_hide_system_updater')) {
                $data['core.base.general.enable_system_updater'] = false;
            }

            if (setting('white_label_hide_system_info')) {
                PanelSectionManagerFacade::group('system')->beforeRendering(function () {
                    PanelSectionManagerFacade::ignoreItemId('information');
                });

                Event::listen(RouteMatched::class, function (RouteMatched $event) {
                    abort_if($event->route->getName() === 'system.info', 404);
                });
            }

            config($data);
        }, report: false);
    }

    public function boot(): void
    {
        $this
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes()
        ;

        PanelSectionManager::default()->beforeRendering(function () {
            if (setting('white_label_hide_from_settings', false)) {
                return;
            }

            PanelSectionManager::registerItem(
                SettingOthersPanelSection::class,
                fn () => PanelSectionItem::make('fob-white-label')
                    ->setTitle(trans('plugins/fob-white-label::white-label.settings.title'))
                    ->withIcon('ti ti-tags')
                    ->withPriority(2001)
                    ->withDescription(trans('plugins/fob-white-label::white-label.settings.description'))
                    ->withRoute('white-label.settings')
            );
        });

        rescue(function () {
            if (setting('white_label_hide_system_info')) {
                PanelSectionManagerFacade::group('system')->beforeRendering(function () {
                    PanelSectionManagerFacade::ignoreItemId('information');
                });

                Event::listen(RouteMatched::class, function (RouteMatched $event) {
                    abort_if($event->route->getName() === 'system.info', 404);
                });
            }
        }, report: false);
    }
}
