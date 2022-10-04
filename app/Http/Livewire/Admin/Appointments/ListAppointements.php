<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class ListAppointements extends AdminComponent
{

    protected $listeners = ['deleteConfirmed' => 'deleteAppointment'];

    public $appointmentIdBegingRemoved = null;

    public $status = null;

    protected $queryString = ['status'];

    public $selectedRows = [];

    public $selectPageRows = false;

    public function confirmAppointmentRemoval($appointment) {
        $this->appointmentIdBegingRemoved = $appointment;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteAppointment() {
        $appointment = Appointment::findOrFail($this->appointmentIdBegingRemoved);

        $appointment->delete();

        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted success']);
    }

    public function filterAppointmentsByStatus($status = null) {
        $this->resetPage();
        $this->status = $status;
    }

    public function updatedSelectPageRows($value) {
        if($value) {
            $this->selectedRows = $this->appointments->pluck('id')->map(function($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getAppointmentsProperty() {
        return Appointment::with('client')
            ->when($this->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(5);
    }

    public function deleteSelectedRows() {
        Appointment::whereIn('id', $this->selectedRows)->deleted();

        $this->dispatchBrowserEvent('deleted', ['message' => 'All selected appointment got deleted. ']);

        $this->reset(['selectPageRows', 'selectedRows']);
    }

    public function markAllAsScheduled() {
        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'SCHEDULED']);
        $this->dispatchBrowserEvent('updated', ['message' => 'Appointments marked as scheduled.']);

        $this->reset(['selectPageRows', 'selectedRows']);
    }
    public function markAllAsClosed() {
        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'CLOSED']);
        $this->dispatchBrowserEvent('updated', ['message' => 'Appointments marked as closed.']);

        $this->reset(['selectPageRows', 'selectedRows']);
    }


    public function render()
    {
        $appointments = $this->appointments;

        $appointmentsCount = Appointment::count();
        $scheduleAppointmentCount = Appointment::where('status', 'scheduled')->count();
        $closedAppointmentCount = Appointment::where('status', 'closed')->count();

        return view('livewire.admin.appointments.list-appointements', [
            'appointments' => $appointments,
            'appointmentsCount' => $appointmentsCount,
            'scheduleAppointmentCount' => $scheduleAppointmentCount,
            'closedAppointmentCount' => $closedAppointmentCount,
        ]);
    }
}
