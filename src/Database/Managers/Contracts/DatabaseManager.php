<?php 

namespace Ikonc\PhpMvc\Database\Managers\Contracts;

interface DatabaseManager 
{

    public function connect(): \PDO;

    public function query(string $query, $values = []);
	//"select * from users where $value[1], $value[2] , $value[3]"

    public function create($data);

    public function read($columns = '*', $filter = null);
    //"select % from users where username ....";
	//User::all();
	//User::where('username','eric');
	
    public function update($id, $data);
    //UPDATE users SET USERNAME = 'X', email ='email' where id= 'id');

    public function delete($id);
    //DELETE from users where id='id'
}