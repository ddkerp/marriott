<?PHP
    // Stick your DBOjbect subclasses in here (to help keep things tidy).

    class User extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('users', array('nid', 'username', 'password', 'level'), $id);
        }
    }
	
	class Newsletter extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('newsletter', array('email'), $id);
        }
    }
	
	class Review extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('review', array('id','venue_id','user_name','email','phone','review_text','ratings','status'), $id);
        }
    }
