<?php

namespace FriendsOfBotble\WhiteLabel\Http\Controllers\Settings;

use Botble\Setting\Http\Controllers\SettingController;
use FriendsOfBotble\WhiteLabel\Forms\Settings\WhiteLabelSettingForm;
use FriendsOfBotble\WhiteLabel\Http\Requests\Settings\WhiteLabelSettingRequest;

class WhiteLabelSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(
            trans('plugins/fob-white-label::white-label.settings.title')
        );

        return WhiteLabelSettingForm::create()->renderForm();
    }

    public function update(WhiteLabelSettingRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
