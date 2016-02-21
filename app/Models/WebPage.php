<?php 

namespace App\Models;

use Exception;

use Illuminate\Database\Eloquent\Model;

use App\Models\Contracts\WebPageInterface;

class WebPage extends Model implements WebPageInterface {

    /* Denotes table associated with this model
     * @var string $table
     */
    protected $table = 'web_pages';
    
    /*
     * Unmerged elements 
     * @var array
     */
    private $unmerged = array();
    
    /*
     * Add an element to the unmerged set of elements
     * @var string $id 
     * @var string $value
     * @return 
     */
    public function addElement($id, $value)
    {
        $this->unmerged[$id] = $value;
    }
    
    /*
     * Add elements to the unmerged set of elements
     * @var array $elements
     */
    public function addElements(array $elements)
    {
        $this->unmerged = array_merge($this->unmerged,$elements);
    }

    public function save(array $options = array())
    {
        if( count($this->unmerged) > 0 )
        {
            $elements = new \stdClass();

            if( isset($this->attributes['elements']) )
            {
                $elements = json_decode($this->attributes['elements']);
            }

            foreach($this->unmerged as $key => $value)
            {
                $elements->$key = $value;
            }

            $elements = json_encode($elements);

            $this->attributes['elements'] = $elements;
        }

        parent::save($options);
    }
}
