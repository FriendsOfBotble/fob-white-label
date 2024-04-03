<?php

namespace FriendsOfBotble\WhiteLabel\Http\Controllers\Settings;

use FriendsOfBotble\WhiteLabel\Forms\Settings\WhiteLabelSettingForm;
use FriendsOfBotble\WhiteLabel\Http\Requests\Settings\WhiteLabelSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;
use Illuminate\Support\Str;

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
        $isAdminDirDirty = setting('white_label_admin_path') !== $request->input('white_label_admin_path');
        $currentAdminDir = config('core.base.general.admin_dir');
        $systemAdminDir = app('admin_dir');
        $newAdminDir = $request->input('white_label_admin_path');

        $response = $this->performUpdate($request->validated());

        if ($isAdminDirDirty) {
            $redirectUrl = url()->previous();

            $redirectUrl = Str::of($redirectUrl)->replace(
                url($currentAdminDir),
                url($newAdminDir ?: $systemAdminDir)
            );

            $response->setNextUrl($redirectUrl);
        }

        return $response;
    }
}
