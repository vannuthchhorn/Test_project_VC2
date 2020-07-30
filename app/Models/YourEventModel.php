<?php namespace App\Models;

use CodeIgniter\Model;


    class YourEventModel extends Model
    {
        protected $table      = 'event';
        protected $primaryKey = 'id';
        protected $returnType     = 'array';
        protected $allowedFields = [
            'title',
            'city',
            'description',
            'start_date',
            'end_date',
            'start_time',
            'end_time',
            'profile',
            'user_id',
            'cat_id'];
        
        public function getEvent() 
        {
            return $this->db->table('event')
            ->join('categorys', 'event.cat_id = categorys.id')
            ->get()->getResultArray();
            
        }
    }
