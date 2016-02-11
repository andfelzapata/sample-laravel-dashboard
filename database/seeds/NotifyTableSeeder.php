<?php

use Faker\Factory;

use Illuminate\Database\Seeder;

use App\GardenRevolution\Notifications\NotifyView;
use App\GardenRevolution\Notifications\NotifyAction;
use App\GardenRevolution\Notifications\NotifyCondition;

use App\GardenRevolution\Repositories\Contracts\NotificationRepositoryInterface;

class NotifyTableSeeder extends Seeder
{
    private $notificationRepository;
    private $notifyAction;
    
    private $actions = array('NEW_ENTITY','NEWS_UPDATES','REMINDER');
    private $entities = array('plant','user','pest','procedure','category','glossary term');
    private $attributes = array('username','password');
    
    private $actionMethods = array('NEW_ENTITY'=>'added','NEWS_UPDATES'=>'general','REMINDER'=>'reminder');

    private $actionConditions = array('NEW_ENTITY'=>NotifyCondition::PUBLISHED,'NEWS_UPDATES'=>NotifyCondition::PUBLISHED,'REMINDER'=>NotifyCondition::TRIGGERED);
    private $actionView;
    private $actionMethodParameters; 
    private $faker;

    public function __construct(
                                    NotificationRepositoryInterface $notificationRepository,
                                    NotifyAction $notifyAction
                                )
    {
        $this->notificationRepository = $notificationRepository;
        $this->notifyAction = $notifyAction;        
        $this->actionView = $this->getViews();
        $this->actionMethodParameters = $this->getActionMethodParameters();
        $this->faker = Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100; $i++)
        {
            $action = $this->faker->randomElement($this->actions);

            $method = $this->actionMethods[$action];

            $condition = $this->actionConditions[$action];

            $status = $this->faker->boolean();

            $content = null;

            if( isset( $this->actionMethodParameters[$action] ) )
            {
                $parameters = $this->actionMethodParameters[$action];

                $parameter = $this->faker->randomElement($parameters);
                
                $content = $this->actionView[$parameter][$action];

                $action = $this->notifyAction->$method($parameter);
            }

            else 
            {
                $parameter = $method;
                $content = $this->actionView[$parameter][$action];
                $action = $this->notifyAction->$method();
            }

                $data = array(
                              'action'=>$action,
                              'condition'=>$condition,
                              'content'=>$content,
                              'status'=>$status,
                              'from'=>$this->faker->email);
            
                $this->notificationRepository->create($data);
        }  
    }

    private function getViews() {
        return array(
            'plant'=>array('NEW_ENTITY'=>NotifyView::EMAIL_NEW_PLANT),
            'user'=>array('NEW_ENTITY'=>NotifyView::EMAIL_NEW_USER),
            'pest'=>array('NEW_ENTITY'=>NotifyView::EMAIL_NEW_PEST),
            'procedure'=>array('NEW_ENTITY'=>NotifyView::EMAIL_NEW_PROCED),
            'glossary term'=>array('NEW_ENTITY'=>NotifyView::EMAIL_NEW_TERM),
            'category'=>array('NEW_ENTITY'=>NotifyView::EMAIL_NEW_CATEGORY),
            'password'=>array('REMINDER'=>NotifyView::EMAIL_REMIND_PASSWORD),
            'username'=>array('REMINDER'=>NotifyView::EMAIL_REMIND_USERNAME),
            'general'=>array('NEWS_UPDATES'=>NotifyView::EMAIL_UPDATES)
        );
    }

    private function getActionMethodParameters() {
        return array(
                        'NEW_ENTITY'=>$this->entities,
                        'REMINDER'=>$this->attributes
                    ); 
    }
}
