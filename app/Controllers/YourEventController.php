<?php namespace App\Controllers;
use App\Models\YourEventModel;
use App\Models\CategoryModel;
use App\Models\CitiesModel;
class YourEventController extends BaseController
{
	protected $event;
    protected $categorys;
    protected $jsons;

    public function __construct() 
    {
        $this->event = new YourEventModel();
        $this->categorys = new CategoryModel();
        $this->jsons = new CitiesModel();
    }
	public function showYourEvent()
	{
		$data = [
            'eventData' => $this->event->getEvent(),
            "categoryData" => $this->categorys->getCategory(),
            "dataJson" => $this->jsons->getCities(),
        ];
        return view('events/yourEvent',$data);
        
	}

		
    public function createEvent() 
    {
        $categorys = $this->request->getVar('categorys');
        $title = $this->request->getVar('title');
        $start_date = $this->request->getVar('start_date');
        $end_date = $this->request->getVar('end_date');
        $start_time = $this->request->getVar('start_time');
        $end_time = $this->request->getVar('end_time');
        $description = $this->request->getVar('description');
        $city = $this->request->getVar('city');
        $file = $this->request->getFile('profile');

        if($file->getSize()> 0)
        {
            $photo = $file->getRandomName();
            $file->move('images', $photo);
        }

        $data = array(
            "cat_id" => $categorys,
            "title" => $title,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "start_time" => $start_time,
            "end_time" => $end_time,
            "description" => $description,
            "city" => $city,
            'profile'=>$photo
        );

        $this->event->insert($data);
        return redirect()->to("/yourEvents");
    }
}