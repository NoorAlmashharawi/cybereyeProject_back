use App\Models\Admin;
use App\Models\Instructor;
use App\Models\Student;

public function boot()
{
    Auth::provider('admins', function ($app, array $config) {
        return new EloquentUserProvider($app['hash'], Admin::class);
    });
    
    Auth::provider('instructors', function ($app, array $config) {
        return new EloquentUserProvider($app['hash'], Instructor::class);
    });
    
    Auth::provider('students', function ($app, array $config) {
        return new EloquentUserProvider($app['hash'], Student::class);
    });
}