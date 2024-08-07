<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserTable extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $userId;
    public $firstName;
    public $lastName;
    public $email;

    public function render()
    {
        $users = User::query()
            ->where('first_name', 'like', "%{$this->search}%")
            ->orWhere('last_name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('livewire.user-table', compact('users'));
    }

    public function create()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }


    public function mount()
    {
        $this->resetFields();
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->user_id;
        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
        $this->email = $user->email;
        $this->isModalOpen = true;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId . ',user_id',
        ]);

        $user = User::updateOrCreate(
            ['user_id' => $this->userId],
            [
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'email' => $this->email,
            ]
        );

        $this->closeModal();
        $this->resetFields();
        notyf()->success('User updated successfully!');
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }
    public function view($id)
    {
        return redirect()->route('admin.users.show', ['userId' => $id]);
    }
    private function resetFields()
    {
        $this->userId = null;
        $this->firstName = '';
        $this->lastName = '';
        $this->email = '';
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        $user->status = $user->status == 'Active' ? 'Inactive' : 'Active';
        $user->save();

        notyf()->success('User status updated successfully!');
    }
}
