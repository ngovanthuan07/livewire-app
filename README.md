# Livewire
- php artisan make:model Client -m => Tạo model and migration

- php artisan migrate => ...

- php artisan livewire:make admin/appointments/create-appointment-form

- php artisan  make:factory ClientFactory
- Client::factory()->create();

- co the dung ham nay de check
- php artisan config:cache
- Configuration cache cleared!
- Configuration cached successfully!


- php artisan make:migration add_avatar_field_to_users_table

- php artisan make:migration add_admin_role_field_to_users_table
- php artisan make:migration add_order_position_to_appointments_table
- $table->integer('order_posstion')->default(null);
- $table->dropColumn('order_position');

- php artisan make:export AppointmentsExport
nếu bị lỗi excel
- composer update --ignore-platform-reqs

- dowload adminlte with node js
- https://adminlte.io/docs/3.2/

LINK:

cdn ckeditor:
https://cdn.ckeditor.com/

- progress
https://alpinejs.dev/essentials/installation

- load
https://labs.danielcardoso.net/load-awesome/
- charts
https://apexcharts.com/
- excel
https://docs.laravel-excel.com/3.1/getting-started/installation.html

- link download: https://adminlte.io/docs/3.2/

- sortable
https://github.com/livewire/sortable


