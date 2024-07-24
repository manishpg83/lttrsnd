<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Plan;

class PlanTable extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $isEditing = false;
    public $planId;
    public $planName;
    public $planType;
    public $amount;
    public $description;

    protected $listeners = [
        'planDeleted' => '$refresh',
    ];

    public function render()
    {
        $plans = Plan::query()
            ->where('plan_name', 'like', "%{$this->search}%")
            ->orWhere('plan_type', 'like', "%{$this->search}%")
            ->withTrashed() // Include trashed plans
            ->paginate(10);

        return view('livewire.plan-table', compact('plans'));
    }

    public function create()
    {
        $this->resetFields();
        $this->isEditing = false;
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $plan = Plan::withTrashed()->find($id);
        $this->planId = $plan->plan_id;
        $this->planName = $plan->plan_name;
        $this->planType = $plan->plan_type;
        $this->amount = $plan->amount;
        $this->description = $plan->plan_description;
        $this->isEditing = true;
        $this->isModalOpen = true;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'planName' => 'required|string|max:255',
            'planType' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Plan::updateOrCreate(
            ['plan_id' => $this->planId],
            [
                'plan_name' => $this->planName,
                'plan_type' => $this->planType,
                'amount' => $this->amount,
                'plan_description' => $this->description
            ]
        );

        notyf()->success('Plan saved successfully.');
        $this->resetFields();
        $this->isModalOpen = false;
    }

    public function delete($id)
    {
        Plan::find($id)->delete();
        notyf()->success('Plan deleted successfully.');
        $this->dispatch('refreshComponent');
    }

    public function restore($id)
    {
        $plan = Plan::withTrashed()->findOrFail($id);
        $plan->restore();
        notyf()->success('Plan restored successfully.');
        $this->dispatch('refreshComponent');
    }

    public function forceDelete($id)
    {
        $plan = Plan::withTrashed()->findOrFail($id);
        $plan->forceDelete();
        notyf()->success('Plan permanently deleted.');
        $this->dispatch('refreshComponent');
    }

    private function resetFields()
    {
        $this->planId = null;
        $this->planName = '';
        $this->planType = '';
        $this->amount = '';
        $this->description = '';
    }
}