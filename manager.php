<?php
class NewsManager{
    public $manager,$id,$name,$description,$News,$con;

    public function __construct($connection){
        $this->con=$connection;
    }
    
    
    public function CheckInput($type){
        if($type!="add"){
            if(empty($this->id))
                return false;
        }
        if(empty($this->name))
            return false;
        if(empty($this->description))
           return false; 

        return true;
    }

    public function AddParameters($type,$query){
        if($type!="add")
        $query->bindParam(":id",$this->id);
        $query->bindParam(":name",$this->name);
        $query->bindParam(":description",$this->description);
        if($query->execute())
        return true;

        return false;
    }
    public function addNews(){
        return $this->AddParameters("add",$this->con->prepare("INSERT INTO `news` (`id`,`name`,`description`) VALUES (NULL,:name,:description)"));
    }
    public function updateNews(){
        return $this->AddParameters("update",$this->con->prepare("UPDATE `news` SET `name` =:name, `description`=:description WHERE `id`=:id"));
    }
    public function deleteNews(){
        $query=$this->con->prepare("DELETE FROM `news` WHERE `id`=:id");
        $query->bindParam(":id",$this->id);
        if($query->execute())
        return true;

        return false;
    }
    public function getNews(){
        $query=$this->con->prepare("SELECT * FROM `news`");
        $this->News=array();
        if($query->execute()){
        while($row=$query->fetchObject()){
            $this->News[]=$row;
        }
        return true;
    }

    return false;
    }
}
?>