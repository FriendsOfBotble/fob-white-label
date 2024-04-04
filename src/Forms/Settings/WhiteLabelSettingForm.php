<?php

namespace FriendsOfBotble\WhiteLabel\Forms\Settings;

use Botble\Base\Forms\FieldOptions\AlertFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\Fields\AlertField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Setting\Forms\SettingForm;
use FriendsOfBotble\WhiteLabel\Http\Requests\Settings\WhiteLabelSettingRequest;

class WhiteLabelSettingForm extends SettingForm
{
    public function buildForm(): void
    {
        parent::buildForm();

        $this
            ->setSectionTitle(trans('plugins/fob-white-label::white-label.settings.title'))
            ->setSectionDescription(trans('plugins/fob-white-label::white-label.settings.description'))
            ->setValidatorClass(WhiteLabelSettingRequest::class)
        ;

        $this
            ->add(
                'white_label_hide_license_activation_info',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-white-label::white-label.settings.hide_license_activation_info'))
                    ->helperText(trans('plugins/fob-white-label::white-label.settings.hide_license_activation_info_help'))
                    ->defaultValue(setting('white_label_hide_license_activation_info', config('core.base.general.hide_activated_license_info', false)))
                    ->toArray()
            )
            ->add(
                'white_label_hide_theme_management',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-white-label::white-label.settings.hide_theme_management'))
                    ->defaultValue(setting('white_label_hide_theme_management', false))
                    ->toArray()
            )
            ->add(
                'white_label_hide_plugin_management',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-white-label::white-label.settings.hide_plugin_management'))
                    ->helperText(trans('plugins/fob-white-label::white-label.settings.hide_plugin_management_help'))
                    ->defaultValue(setting('white_label_hide_plugin_management', false))
                    ->toArray()
            )
            ->add(
                'white_label_hide_plugin_author',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-white-label::white-label.settings.hide_plugin_author'))
                    ->defaultValue(setting('white_label_hide_plugin_author', false))
                    ->toArray()
            )
            ->add(
                'white_label_hide_plugin_marketplace',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-white-label::white-label.settings.hide_plugin_marketplace'))
                    ->defaultValue(setting('white_label_hide_plugin_marketplace', false))
                    ->toArray()
            )
            ->add(
                'white_label_hide_system_updater',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-white-label::white-label.settings.hide_system_updater'))
                    ->defaultValue(setting('white_label_hide_system_updater', false))
                    ->toArray()
            )
            ->add(
                'white_label_hide_system_info',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-white-label::white-label.settings.hide_system_info'))
                    ->defaultValue(setting('white_label_hide_system_info', false))
                    ->toArray()
            )
            ->add(
                'white_label_hide_from_settings',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/fob-white-label::white-label.settings.hide_from_settings'))
                    ->defaultValue(setting('white_label_hide_from_settings', false))
                    ->toArray()
            )
            ->add(
                'white_label_hide_from_settings_alert',
                AlertField::class,
                AlertFieldOption::make()
                    ->type('warning')
                    ->content(trans('plugins/fob-white-label::white-label.settings.hide_from_settings_alert'))
                    ->toArray()
            )

            ->add(
                'white_label_admin_path_alert',
                AlertField::class,
                AlertFieldOption::make()
                    ->type('info')
                    ->content(trans('plugins/fob-white-label::white-label.settings.admin_path_alert', [
                        'path' => $path = 'awesome-secret',
                        'url' => url($path),
                    ]))
                    ->toArray()
            )
        ;
    }
}
