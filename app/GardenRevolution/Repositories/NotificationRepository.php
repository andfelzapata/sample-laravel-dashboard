<?php namespace App\GardenRevolution\Repositories;

use App\Models\Notification;

use App\GardenRevolution\Repositories\Contracts\NotificationRepositoryInterface;

/*
 * Repository for notifications
 */
class NotificationRepository implements NotificationRepositoryInterface {
    private $notification;

    public function __construct(Notification $notification) {
        $this->notification = $notification;
    }
    public function create(array $data) {
        $this->notification = $this->notification->newInstance()->create($data);
        return $this->notification;
    }
    
    public function update(array $data, $id) {
        $this->notification = $this->notification->newInstance()->find($id);;

        if( is_null($this->notification) ) {
            return false;
        }

        else {
            $this->notification->fill($data);
            return $this->notification->save();
        }
    }

    public function delete($id) {
        $this->notification = $this->notification->newInstance()->find($id);;

        if( is_null($this->notification) ) {
            return false;
        }

        else {
            return $this->notification->delete();
        }
    }

    public function find($id, $columns = array('*')) {
        $this->notification = $this->notification->newInstance()->find($id,$columns);
        return $this->notification;
    }
    
    public function getAll()
    {
        return $this->notification->newInstance()->get();
    }

    public function getAllPaginated($pages = 10, Array $eagerLoads = [])
    {
        $notifications = $this->notification->newInstance()->with($eagerLoads)->orderBy('id','desc')->paginate($pages);
        return $notifications;
    }
}
