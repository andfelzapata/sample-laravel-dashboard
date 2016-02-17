<?php 


namespace App\GardenRevolution\Notifications;

/*
 * Class to output formatted action messages
 */


class NotifyAction {
    
    /*
    * Outputs a formatted string for entity added message notification
    * @param $entity The entity type name
    * @return The formatted entity added message
    */
    public function added($entity) 
    {
        return sprintf('new %s is added',$entity);
    }

    /*
     * Outputs a formatted string for attribute reminder message notification
     * @param $attribute The attribute name
     * @return The formatted attribute reminder message
     */
    public function reminder($attribute)
    {
        return sprintf('%s reminder',$attribute);
    }
    
    /*
     * Outputs a general message notification
     * @return The general message notification
     */
    public function general()
    {
        return 'news and updates';
    }
}
