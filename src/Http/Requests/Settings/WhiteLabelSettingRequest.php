<?php

namespace FriendsOfBotble\WhiteLabel\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;

class WhiteLabelSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'white_label_hide_license_activation_info' => new OnOffRule(),
            'white_label_hide_theme_management' => new OnOffRule(),
            'white_label_hide_plugin_management' => new OnOffRule(),
            'white_label_hide_plugin_marketplace' => new OnOffRule(),
            'white_label_hide_plugin_author' => new OnOffRule(),
            'white_label_hide_system_updater' => new OnOffRule(),
            'white_label_hide_system_info' => new OnOffRule(),
            'white_label_hide_from_settings' => new OnOffRule(),
        ];
    }
}
