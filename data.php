<?php
$con=mysqli_connect('localhost','root','','stddata');
if(!$con){
    echo "Not connected";
}
if(isset($_POST['nameform']) && isset($_POST['lastnameform'])&& isset($_POST['birthform']) 
&& isset($_POST['contactform']) && isset($_POST['selectid']) && isset($_POST['emaiform']) && isset($_FILES['fileform'])){
$nameform = $_POST['nameform'];
$lastnameform = $_POST['lastnameform'];
$birthform = $_POST['birthform'];
$contactform = $_POST['contactform'];
$selectid = $_POST['selectid'];
$emaiform = $_POST['emaiform'];
$fileform = $_FILES['fileform'];

$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

$folder= "proofs/".$randomString.$fileform['name'];
move_uploaded_file($fileform['tmp_name'],$folder);
$query= "INSERT INTO `studentinfo`(`name`, `lastname`, `age`, `contact`, `section`, `email`, `proof`) VALUES
 ('$nameform','$lastnameform','$birthform','$contactform','$selectid','$emaiform','$folder')";
$run= mysqli_query($con,$query);
echo $fileform['tmp_name'];
}

if(isset($_POST['start'])){
    // if(isset($_POST['start'])){
        $start= $_POST['start'];

    // }
    // else{
    //     $start=1;
    // }
    $start= ($start-1)*5;
$query="select * from studentinfo where softdel=0 order by id desc limit $start,5";

$run= mysqli_query($con,$query);
// $index=1;
$view="";
$view.="
<table class='table table-bordered table-striped table-condensed text-center mx-auto'>
<thead>    
<tr>
    <th>id</th>
    <th>name</th>
    <th>last name</th>
    <th>age</th>
    <th>contact</th>
    <th>section</th>
    <th>email</th>
    <th>identification proof</th>
    <th>update</th>
    <th>delete</th>

</tr></thead>
<tbody>";
$index = $start + 1;

while($data= mysqli_fetch_array($run)){
    $view.="  <tr>
    <td>$index</td>
    <td>$data[1]</td>
    <td>$data[2]</td>
    <td>$data[3]</td>
    <td>$data[4]</td>
    <td>$data[5]</td>
    <td>$data[6]</td>
    <td><img src=$data[7] height='150px' width='150px'></td>
    <td><button class='btn btn-sm btn-primary' onclick='update($data[0])'>update</button></td>
    <td><button class='btn btn-sm btn-danger' onclick='del($data[0])'>delete</button></td>

    </tr>";
    $index++;


}
$view.="
</tbody>
</table>";
$run1= mysqli_query($con,"select * from studentinfo where softdel=0");

$pcount= mysqli_num_rows($run1);
$pindex= ceil($pcount/5);
// $view.="<div>";

// for($i=1;$i<=$pindex;$i++){
//     $view.=" 
//     <button class='cindex'>$i</button>"
//     ;

// }

// $view.="</div>";
$response= array(
    'html'=>$view,
    'pindex'=>$pindex
);


echo json_encode($response);





}
if(isset($_POST['id'])){
    $id= $_POST['id'];
    $query="select * from studentinfo where id='$id'";
    $output= array();
    $run= mysqli_query($con,$query);
    while ($data= mysqli_fetch_assoc($run)){
        $output=$data;
    }
    echo json_encode($output);
}
if(isset($_POST['id1'])){
    $id1= $_POST['id1'];
    $query="update studentinfo set softdel=1 where id='$id1'";
    mysqli_query($con,$query);
   
}

if (isset($_POST['idform1']) && isset($_POST['nameform1']) && isset($_POST['lastnameform1']) && isset($_POST['birthform1']) &&
isset($_POST['contactform1']) && isset($_POST['selectid1']) && isset($_POST['emaiform1'])) {
$idform1 = $_POST['idform1'];
$nameform1 = $_POST['nameform1'];
$lastnameform1 = $_POST['lastnameform1'];
$birthform1 = $_POST['birthform1'];
$contactform1 = $_POST['contactform1'];
$selectid1 = $_POST['selectid1'];
$emaiform1 = $_POST['emaiform1'];
$imgsrc=$_POST['imgsrc'];  
if (!empty($_FILES['fileform100']) && is_uploaded_file($_FILES['fileform100']['tmp_name'])) {
    if (file_exists($imgsrc)) {
        unlink($imgsrc);
    }
    $fileform100 = $_FILES['fileform100'];
    $imgname = $fileform100['name'];
    $tmp = $_FILES['fileform100']['tmp_name'];

    
    $randomString1= substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,5);
    $folder = "proofs/".$randomString1.$imgname;
    $query = "UPDATE `studentinfo` SET `name`='$nameform1',`lastname`='$lastnameform1',`age`='$birthform1',`contact`='$contactform1',
              `section`='$selectid1',`email`='$emaiform1',`proof`='$folder' WHERE `id`='$idform1' ";
    mysqli_query($con, $query);
    move_uploaded_file($tmp, $folder);
    // echo folder;
} else {
    // Handle the case where 'fileform100' is not set or no file was uploaded
    $query = "UPDATE `studentinfo` SET `name`='$nameform1',`lastname`='$lastnameform1',`age`='$birthform1',`contact`='$contactform1',
              `section`='$selectid1',`email`='$emaiform1' WHERE `id`='$idform1' ";
    mysqli_query($con, $query);
}
}

?> 