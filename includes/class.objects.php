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
