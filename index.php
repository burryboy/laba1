<header>
<style>
.block
{
    
    border: 1px solid black;
    width: 300px;
    height: 120px;
    padding: 15px;
    margin:5px;
    text-align:center ; border-radius: 25px;  float: left;
}
.insert
{
    padding: 15px;
    margin:5px;
   
    border: 1px solid black;
   
    text-align:center ; border-radius: 5px;  
    float: left;
}

</style>
</header>

<div class="block">
    <form action = "requests.php" method="POST">
    <b>перечень палат, в которых дежурит выбранная медсестра </b><p>
    <?php include 'conect.php';
        echo "<select name='nurse' >";

        
    $stmt = $dbh->prepare ("SELECT name, id_nurse FROM nurse ");
    $stmt->execute();

    if ($stmt->execute(array($_GET['name']))) 
    {
        while ($row = $stmt->fetch()) 
        {
            echo "<option value=".$row['id_nurse'].">".$row['name']."</option>";
        }
    }

    echo "</select>"."<br>";

    ?>

    <input type="Submit" name=button1 value=" Sumbit "><p>
    </form>
</div>


<div class="block">
    <form action = "requests.php" method="POST">
    <b>медсестры выбранного отделения</b><p> отделение №: 
    <?php include 'conect.php';
      echo "<select name='department' >";

        
    $stmt = $dbh->prepare ("SELECT DISTINCT department FROM nurse");
    $stmt->execute();

    if ($stmt->execute(array($_GET['department']))) 
    {
        while ($row = $stmt->fetch()) 
        {
            echo "<option value=".$row['department'].">".$row['department']."</option>";
        }
    }

    echo "</select>"."<br>";
    
    ?>
    <input type="Submit" name=button2 value=" Sumbit "><p>
    </form>
</div>


<div class="block">
    <form action = "requests.php" method="POST">
    <b>дежурства (в любых палатах) в указанную смену </b><p>
    <?php include 'conect.php';
        echo "<select name='shift' >";
    
    $stmt = $dbh->prepare ("SELECT DISTINCT  shift FROM nurse");
            $stmt->execute();
        
            if ($stmt->execute(array($_GET['shift']))) 
            {
                while ($row = $stmt->fetch()) 
                {
                    echo "<option value=".$row['shift'].">".$row['shift']."</option>";
                }
            }

    echo "</select>";
        
    ?>
    <br>
    <input type="Submit" name=button3 value=" Sumbit "><p>

    </form>
</div>

<div class="insert">

            Добавить палату <br>
    <form action = "insert.php" method="POST">
        название палаты: <input type="text" name=name value=" new ward " required >
        <input type="Submit" name=new_ward value=" Sumbit ">
    </form><br>

            Добавить медсестру<br>
            <table>
    <form action = "insert.php" method="POST">
        <tr><td>имя медсестры: <input type="text" name=name value=" name " required ></tr></td>
        <tr><td>дата: <input type="date" name=date required ></tr></td>
        <?php include 'conect.php';
         echo "<tr><td>отделение №: <select name='department' >";

        
         $stmt = $dbh->prepare ("SELECT DISTINCT department FROM nurse");
         $stmt->execute();
     
         if ($stmt->execute(array($_GET['department']))) 
         {
             while ($row = $stmt->fetch()) 
             {
                 echo "<option value=".$row['department'].">".$row['department']."</option>";
             }
         }
     
         echo "</select>"."</tr></td>";

        echo "<tr><td>смена: <select name='shift' >";
    
        $stmt = $dbh->prepare ("SELECT DISTINCT  shift FROM nurse");
                $stmt->execute();
            
                if ($stmt->execute(array($_GET['shift']))) 
                {
                    while ($row = $stmt->fetch()) 
                    {
                        echo "<option value=".$row['shift'].">".$row['shift']."</option>";
                    }
                }

        echo "</select></tr></td>";
    ?>
    </table>
        
        <input type="Submit" name=new_nurse value=" Sumbit ">
    </form>

</div>
<div class="insert">

<form action = "insert.php" method="POST">
        
        
    
<?php include 'conect.php';
        echo "медсестрa: <select name='nurse' >";

        
    $stmt = $dbh->prepare ("SELECT name, id_nurse FROM nurse ");
    $stmt->execute();

    if ($stmt->execute(array($_GET['name']))) 
    {
        while ($row = $stmt->fetch()) 
        {
            echo "<option value=".$row['id_nurse'].">".$row['name']."</option>";
        }
    }

    echo "</select>"."<br>";

    echo "палата: <select name='ward' >";

        
    $stmt = $dbh->prepare ("SELECT name, id_ward FROM ward ");
    $stmt->execute();

    if ($stmt->execute(array($_GET['name']))) 
    {
        while ($row = $stmt->fetch()) 
        {
            echo "<option value=".$row['id_ward'].">".$row['name']."</option>";
        }
    }

    echo "</select>"."<br>";

    ?>
<input type="Submit" name=setNurseToWard value=" Sumbit ">
</form><br>

</div>


