<?php 

include 'conect.php';

function getWardListByNurse($dbh, $id_nurse)
{
    $stmt = $dbh->prepare ("SELECT name FROM ward WHERE id_ward IN (Select fid_ward from nurse_ward where fid_nurse= :id_nurse) ");

    echo "<b>Палати в яких чергує обрана медсестра: </b><br>"; 

    if ($stmt->execute(array(':id_nurse' => $id_nurse))) 
    {
        
        while ($row = $stmt->fetch()) 
        {
          print_r($row[0]);
          echo "<br>";
        }
    }
}

function getNurseByDepartment($dbh, $department)
{
    $stmt = $dbh->prepare ( "SELECT * FROM nurse WHERE department = ?"); 

    $stmt->bindParam(1,$department);
    if ($stmt->execute()) 
    {
        echo '<table border=1>';
        echo "<tr><td>Ім`я</td><td>Відділення</td><td>Зміна</td></tr>";
    
        while ($row = $stmt->fetch()) 
        {
          echo '<tr><td>'.$row['name'].'</td><td>'.$row['department'].'</td><td>'.$row['shift'].'</td></tr>';
        }
        echo "</table>";
    }
}

function getDutyInWardByShift($dbh, $shift)
{
    $sql = "SELECT DISTINCT nurse.name as nurse_name,  nurse.date as nurse_date, nurse.department as nurse_department, nurse.shift as nusre_shift, ward.name as ward_name
            FROM nurse Join nurse_ward on nurse.id_nurse = nurse_ward.fid_nurse Join ward On nurse_ward.fid_ward = ward.id_ward
            WHERE nurse.shift = '$shift'";
   
   echo '<table border=1>';
   echo "<tr><td>Ім`я</td><td>Дата</td><td>Відділення</td><td>Зміна</td><td>Палата</td></tr>";

        foreach ($dbh->query($sql) as $row) 
        {
            echo '<tr><td>'.$row['nurse_name'].'</td><td>'.$row['nurse_date'].'</td><td>'.$row['nurse_department'].'</td><td>'.$row['nusre_shift'].'</td><td>'.$row['ward_name'].'</td></tr>';
        }
    echo "</table>";   
}   


if(array_key_exists('button1',$_POST))
{
    getWardListByNurse($dbh, $_POST['nurse']); 
}
else if (array_key_exists('button2',$_POST))
{
    getNurseByDepartment($dbh, $_POST['department']); 
}
else if (array_key_exists('button3',$_POST))
{    
    getDutyInWardByShift($dbh, $_POST['shift']); 
}

?>