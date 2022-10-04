<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <div class="d-flex justify-content-between">
            <h3 wire:loading.delay.remove>{{ $appointmentsCount }}</h3>
            <div wire:loading.delay>
                <x.animations.ballbeat />
            </div>
            <select wire:change="getAppointmentsCount($event.target.value)" style="height: 2rem; outline: 2px solid transparent; border: 2px; border-radius: 2px;">
                <option value="">All</option>
                <option value="scheduled">Scheduled</option>
                <option value="closed">Closed</option>
            </select>
            </div>
            <p>Appointments</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('admin.appointments') }}" class="small-box-footer">View Appointments <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
