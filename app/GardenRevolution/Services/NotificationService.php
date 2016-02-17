<?php

namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Repositories\Contracts\NotificationRepositoryInterface;

class NotificationService extends Service
{
    private $notificationRepository;
    protected $payloadFactory;

    public function __construct(NotificationRepositoryInterface $notificationRepository, PayloadFactory $payloadFactory)
    {
        $this->notificationRepository = $notificationRepository;
        $this->payloadFactory = $payloadFactory;
    }

    public function index()
    {
        $output = array();

        $notifications = $this->notificationRepository->getAllPaginated();
        $notifications->setPath('/admin/dashboard/#system-notifications');

        $output['notification_links'] = $notifications->links();
        $output['notifications'] = $notifications;

        return $this->success($output);
    }
}
