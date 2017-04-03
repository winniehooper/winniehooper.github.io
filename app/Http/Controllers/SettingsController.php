<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function callAction($method, $parameters)
    {
        $this->user = Auth::user();
        return parent::callAction($method, $parameters);
    }


    public function settings()
    {
        return view('settings.index', ['tab' => request('tab', 'profile')]);
    }

    public function saveSettings() {
        $this->user->fill(request(['name', 'information', 'residency']))->save();

        return redirect('/settings');
    }

    public function tabProfile() {
        return [
          'status'  => 'ok',
          'content' => view('settings.tabs.profile')->render(),
        ];
    }

    public function tabAccess() {

        return [
          'status'  => 'ok',
          'content' => view('settings.tabs.access')->render(),
        ];
    }

    public function tabNotify() {
        return [
          'status'  => 'ok',
          'content' => view('settings.tabs.notify')->render(),
        ];
    }

    /**
     * @return string
     */
    public function changeEmail(Request $request)
    {
        $newEmail = request('new_email');
        $password = request('password');

        $oldUser = User::whereEmail($newEmail)->first();

        if ($oldUser) {
            return ['status' => 'error-save', 'message' => 'Новый email уже используется другим пользователем.'];
        }

        $valid = $this->guard()->getProvider()->validateCredentials($this->user, ['email' => $this->user->email, 'password' => $password]);
        if (!$valid) {
            return ['status' => 'error-save', 'message' => 'Неверный пароль.'];
        }

        $this->user->email = $newEmail;
        $this->user->save();

        // TODO: send confirmation email

        return ['status' => 'success'];
    }

    public function changePassword(Request $request)
    {
        $password = request('old_password');
        $newPassword = request('new_password');
        $newPasswordConfirm = request('new_password_confirm');

        if ($newPassword != $newPasswordConfirm) {
            return ['status' => 'error-save', 'message' => 'Пароли не совпадают.'];
        }

        $valid = $this->guard()->getProvider()->validateCredentials($this->user, ['email' => $this->user->email, 'password' => $password]);
        if (!$valid) {
            return ['status' => 'error-save', 'message' => 'Неверный пароль.'];
        }

        $this->user->forceFill([
          'password' => bcrypt($newPassword)
        ])->save();

        // TODO: send confirmation email

        return ['status' => 'success'];
    }

    /**
     * @return string
     */
    public function removeSocial()
    {

        return ['status' => 'success'];
    }

    public function setNotifications()
    {
        $settings = $this->user->settings;
        if (!$settings) {
            $settings = array();
        }
        $settings['notifications'][request('notify_name')] = request('value');
        $this->user->settings = $settings;
        $this->user->save();
        return ['status' => 'success'];
    }
}
