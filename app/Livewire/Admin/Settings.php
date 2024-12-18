<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Config;

class Settings extends Component
{
    public $adminEditPosts, $modsEditSettings, $modsEditPosts, $modsEditLocations, $modsEditForaging, $modsEditItems, $modsMassEditForaging;
    public $uploadForages, $uploadComets, $createPosts, $editPosts, $foragePassword;

    public function mount()
    {
        $this->adminEditPosts = Role::where('is_admin', 1)->get('edit_posts')->first()->edit_posts;
        $this->modsEditSettings = Role::where('is_admin', 2)->get('edit_settings')->first()->edit_settings;
        $this->modsEditPosts = Role::where('is_admin', 2)->get('edit_posts')->first()->edit_posts;
        $this->modsEditLocations = Role::where('is_admin', 2)->get('edit_locations')->first()->edit_locations;
        $this->modsEditForaging = Role::where('is_admin', 2)->get('edit_foraging_locations')->first()->edit_foraging_locations;
        $this->modsEditItems = Role::where('is_admin', 2)->get('edit_items')->first()->edit_items;
        $this->modsMassEditForaging = Role::where('is_admin', 2)->get('mass_edit_foraging')->first()->mass_edit_foraging;

        $this->uploadForages = Config::where('data', 'upload forages')->get('value')->first()->value;
        $this->uploadComets = Config::where('data', 'upload comets')->get('value')->first()->value;
        $this->createPosts = Config::where('data', 'create posts')->get('value')->first()->value;
        $this->editPosts = Config::where('data', 'edit posts')->get('value')->first()->value;
        $this->foragePassword = Config::where('data', 'forage password')->get('value')->first()->value;
    }

    public function updateSettings()
    {

        Config::where('data', 'upload forages')->update([
            'value' => $this->uploadForages,
        ]);
        Config::where('data', 'upload comets')->update([
            'value' => $this->uploadComets,
        ]);
        Config::where('data', 'create posts')->update([
            'value' => $this->createPosts,
        ]);
        Config::where('data', 'edit posts')->update([
            'value' => $this->editPosts,
        ]);
        Config::where('data', 'forage password')->update([
            'value' => $this->foragePassword,
        ]);

        session()->flash('settingMessage', 'Permissions updated succesfully');

    }

    public function updatePermissions()
    {
        if(Auth::user()->is_admin == 1) {
            Role::where('is_admin', 1)->update([
                'edit_posts' => $this->adminEditPosts,
            ]);
            Role::where('is_admin', 2)->update([
                'edit_settings' => $this->modsEditSettings,
                'edit_posts' => $this->modsEditPosts,
                'edit_locations' => $this->modsEditLocations,
                'edit_foraging_locations' => $this->modsEditForaging,
                'edit_items' => $this->modsEditItems,
                'mass_edit_foraging' => $this->modsMassEditForaging,
            ]);

            session()->flash('postMessage', 'Permissions updated succesfully');
        } else {
            session()->flash('errorMessage', 'Can\'t update permissions.');
        }
    }

    public function render()
    {
        return view('admin.settings');
    }
}
