<?php
require_once("db_connection.php");
if($connection){
require_once("manager.php");
if(!empty($_POST)){
if($_SERVER['REQUEST_METHOD']=="POST"){
    $news=new NewsManager();
    $response="";
if(!empty($_POST['Manager'])){
    $news->manager = $_POST['Manager'];
    if($news->manager=="add" || $news->manager=="update"){
        if($news->manager=="update")
            $news->id=$_POST['id'];
        $news->name=$_POST['name'];
        $news->description=$_POST['description'];
        if($news->manager=="add")
            $process=$news->CheckInput("add");
        else if($news->manager=="update")
            $process=$news->CheckInput("update");
        else 
            $process=false;
        if($process){
            if($news->manager=="add")
                $process=$news->addNews();
            else if($news->manager=="update")
                $process=$news->updateNews();
            else
            $process=false;

            if($process)
                $response="Success: Data saved successfully";
            else
                $response="Error: Data Saved failed";
        }else{
            $response="Error: Data Check failed";
        }
    }else if($news->manager=="delete"){
        if(!empty($_POST['id'])){
            $news->id = $_POST['id'];
            if($news->deleteNews())
                $response="Success: Data deleted successfully";
            else
                $response="Error: Data deleted failed";

        }

    }else if($news->manager=="all"){
        if($news->getNews())
            $response="Success: Data fetch successfully";
        else
            $response="Error: Data fetch failed";

    }
echo json_encode(array("response"=>$response,"News"=>$news->News));
}
}else{
    echo json_encode(array("response"=>"Error: Operation failed","News"=>null));

}
}else{?>
<form action="" method="post">
    <input type="hidden" name="Manager" value="add" id=""><br/>
    <input type="number" name="id" placeholder="ID" id=""><br/>
    <input type="text" name="name" placeholder="Name" id=""><br/>
    <input type="text" name="description" placeholder="Description" id=""><br/>

    <input type="submit" value="Ok">

</form>
<?php }
}
?>